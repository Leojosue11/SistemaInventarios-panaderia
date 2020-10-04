<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\RegistroMateriaPrima;
use App\Models\Bodega;
use App\Http\Controllers\Controller;
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
        ->join('registro_materia_primas', 'pedidos.RegistroMPID', '=','registro_materia_primas.IdRegistroMP')
        ->join('bodegas', 'pedidos.BodegaID', '=', 'bodegas.IdBodega')
        ->join('sucursals', 'pedidos.SucursalID', '=', 'sucursals.IdSucursal')
        ->select(
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
        
        $messages=['required'=>'El campo :attribute  es requerido.'
            
            ];
            
            //Valiacion
            
            $validator = Validator::make($request->all(),[
                
                'RegistroMPID'=>'required',
                'CantidadPedido'=>'required',
                'DescripcionPedido' => 'required',
                'BodegaID' => 'required',
                'SucursalID'=>'required'
            
            ],$messages);
            
            //Si falla la validacion
            
            if ($validator->fails()) {
                
                $errores=$validator->errors();
                
                return response()-> json($errores,402);
            }
            
            else
            {
                
                //si todo sale bien 
                
                $MovimientoMateriaPrima=Pedido::create($request->all());
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
        
        $pedido=Pedido::find($IdPedido);
        $pedido->RegistroMPID=$request->input("RegistroMPID");
        $pedido->CantidadPedido=$request->input("CantidadPedido");
     
        $pedido->DescripcionPedido=$request->input("DescripcionPedido");
        $pedido->BodegaID=$request->input("BodegaID");
        $pedido->BodegaID=$request->input("SucursalID");
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
}
