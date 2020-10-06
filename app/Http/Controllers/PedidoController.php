<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\inventario;
use App\Http\Controllers\Controller;
use App\Models\MovimientosMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedido = DB::table('pedidos')
            ->join('registro_materia_primas', 'pedidos.RegistroMPID', '=', 'registro_materia_primas.IdRegistroMP')
            ->join('bodegas', 'pedidos.BodegaID', '=', 'bodegas.IdBodega')
            ->join('sucursals', 'pedidos.SucursalID', '=', 'sucursals.IdSucursal')
            ->select(
                'pedidos.IdPedido',
                'pedidos.CantidadPedido',
                'pedidos.DescripcionPedido',
                'registro_materia_primas.IdRegistroMP',
                'registro_materia_primas.NombreMP',
                'bodegas.IdBodega',
                'bodegas.NombreBodega',
                'sucursals.IdSucursal',
                'sucursals.NombreSucursal',

            )
            ->get();
        return $pedido;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mensajes personalizados

        $messages = ['required' => 'El campo :attribute  es requerido.'];

        //Valiacion

        $validator = Validator::make($request->all(), [

            'RegistroMPID' => 'required',
            'CantidadPedido' => 'required',
            'DescripcionPedido' => 'required',
            'BodegaID' => 'required',
            'SucursalID' => 'required'

        ], $messages);

        //Si falla la validacion

        if ($validator->fails()) {

            $errores = $validator->errors();

            return response()->json($errores, 402);
        } else {

            //Guarda los Movimientos a las Sucursales
            $MovimientoMateriaPrima = Pedido::create($request->all());
            //Crea un registro en el historial de Movimientos
            MovimientosMP::Create([
                'MateriaPrimaID' => $MovimientoMateriaPrima["RegistroMPID"],
                'Cantidad' => $MovimientoMateriaPrima["CantidadPedido"],
                'FechaMovimiento' => today(),
                'SucursalID' => $MovimientoMateriaPrima["SucursalID"]
            ]);

            // Sino existe un registro en bodega de la Materia Prima lo crea, sino lo actualiza
            $Inventario = inventario::where('RegistroMPID', $MovimientoMateriaPrima["RegistroMPID"])->first();
            if ($Inventario == false) {
                $Msj = "No puede hacer movimiento porque no hay entradas de Materia Prima";
                return response()->json($Msj, 402);
            } else {
                if ($MovimientoMateriaPrima["CantidadPedido"] > $Inventario["Disponible"]) {
                    $Msj = "No hay disponibilidad suficiente en Inventario. Disponibilidad: " . $Inventario["Disponible"];
                    return response()->json($Msj, 402);
                }
                //Hace la Resta del inventario - Salida 
                $Disponible = 0;
                $Disponible =  $this->Restar_Disponibilidad($Inventario["Disponible"], $MovimientoMateriaPrima["CantidadPedido"]);

                //Actualiza Disponibilidad
                DB::table('inventarios')->where('RegistroMPID', $MovimientoMateriaPrima["RegistroMPID"])
                    ->update([
                        'Disponible' => $Disponible
                    ]);
            }

            return '{"msg":"creado","result":' . $MovimientoMateriaPrima . '}';
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $IdPedido)
    {
        //forma 1
        //$IdPedido->update($request->all());
       
            //Actualiza informacion en Pedidos
            $pedido = Pedido::find($IdPedido);
            $pedido->RegistroMPID = $request->input("RegistroMPID");
            $pedido->CantidadPedido = $request->input("CantidadPedido");
            $pedido->DescripcionPedido = $request->input("DescripcionPedido");
            $pedido->BodegaID = $request->input("BodegaID");
            $pedido->SucursalID = $request->input("SucursalID");
            $pedido->save();
            return response()->json($pedido);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
    public function Restar_Disponibilidad($CantidadInv, $SalidaBod)
    {
        $Cantidad = 0;
        $Cantidad = ($CantidadInv - $SalidaBod);
        return $Cantidad;
    }
    public function Sumar_Retorno($CantidadInv, $Salida)
    {
        $Disponible = 0;
        $Disponible = ($CantidadInv + $Salida);
        return $Disponible;
    }
}
