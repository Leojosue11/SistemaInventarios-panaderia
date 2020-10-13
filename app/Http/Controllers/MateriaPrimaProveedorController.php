<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;
use App\Models\UnidadMedidas;
use App\Models\MovimientosMP;
use App\Models\inventario;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RegistroMateriaPrima;
use App\Models\MateriaPrimaProveedor;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MateriaPrimaProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiaPrimaProveedor = DB::table('materia_prima_proveedors')
            ->join('proveedores', 'materia_prima_proveedors.ProveedorId', '=', 'proveedores.IdProveedor')
            ->join('registro_materia_primas', 'materia_prima_proveedors.MateriaPrimaID', '=', 'registro_materia_primas.IdRegistroMP')
            ->join('unidad_medidas', 'materia_prima_proveedors.UnidadMedidaID', '=', 'unidad_medidas.IdUnidadMedida')
            ->join('bodegas', 'materia_prima_proveedors.BodegaID', '=', 'bodegas.IdBodega')
            ->select(
                'materia_prima_proveedors.CantidadTotal',
                'materia_prima_proveedors.Desperdicio',
                'materia_prima_proveedors.FechaCaducidad',
                'materia_prima_proveedors.PrecioUnitario',
                'proveedores.IdProveedor',
                'proveedores.NombreProveedor',
                'registro_materia_primas.IdRegistroMP',
                'registro_materia_primas.NombreMP',
                'unidad_medidas.IdUnidadMedida',
                'unidad_medidas.NombreUnidad',
                'bodegas.NombreBodega',
                'bodegas.IdBodega'
            )
            ->orderByDesc("IDMatPrimaProveedor")
            ->get();
        return $materiaPrimaProveedor;
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

        $messages = [
            'required' => 'El campo :attribute  es requerido.',
            //'date_format' => 'El campo :attribute no tiene el formato correcto :format'

        ];


        //Valiacion
        $validator = Validator::make($request->all(), [
            'ProveedorId' => 'required',
            'BodegaID' => 'required',
            'MateriaPrimaID' => 'required',
            'CantidadTotal' => 'required',
            'Desperdicio' => 'required',
            'FechaCaducidad' => 'required', //|date_format:d-m-Y
            'UnidadMedidaID' => 'required',
            'PrecioUnitario' => 'required',


        ], $messages);

        //Si falla la validacion
        if ($validator->fails()) {

            $errores = $validator->errors();
            return response()->json($errores, 402);
        }


        //Valida que la fecha no sea inferior a la fecha de hoy
        $date = Carbon::now();

        $date = $date->format('Y-m-d');

        $fecha = $request['FechaCaducidad'];
        //$fecha=Carbon::yesterday();


        if ($fecha <= $date) {

            $message = array('Fecha de Caducidad invalida');
            return response()->json([
                'message' => $message,
            ], 402);
        }




        //Guarda Entrada de Materia Prima
        $MateriaPrimaProv = MateriaPrimaProveedor::create($request->all());



        // Sino existe un registro en bodega de la Materia Prima lo crea, sino lo actualiza
        $Inventario = inventario::where('RegistroMPID', $MateriaPrimaProv["MateriaPrimaID"])->first();


        if ($Inventario == false) {
            Inventario::create([
                "RegistroMPID" => $MateriaPrimaProv["MateriaPrimaID"],
                "BodegaID" => $MateriaPrimaProv["BodegaID"],
                "Disponible" => $MateriaPrimaProv["CantidadTotal"],
                "FechaIngreso" => today()
            ]);
        } else {
            //Actualiza Disponibilidad de Bodega
            $Cantidad =  $this->Calcular_Disponibilidad($Inventario["Disponible"], $MateriaPrimaProv["CantidadTotal"]);

            DB::table('inventarios')->where('RegistroMPID', $MateriaPrimaProv["MateriaPrimaID"])
                ->update([
                    'Disponible' => $Cantidad
                ]);
        }

        return '{"msg":"creado","result":' . $MateriaPrimaProv . '}';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MateriaPrimaProveedor  $materiaPrimaProveedor
     * @return \Illuminate\Http\Response
     */
    public function show(MateriaPrimaProveedor $materiaPrimaProveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MateriaPrimaProveedor  $materiaPrimaProveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IDMatPrimaProveedor)
    {
         //Valida que la fecha no sea inferior a la fecha de hoy
         $date = Carbon::now();

         $date = $date->format('Y-m-d');
 
         $fecha = $request['FechaCaducidad'];
         //$fecha=Carbon::yesterday();
 
 
        //  if ($fecha <= $date) {
 
        //      $message = array('Fecha de Caducidad invalida');
        //      return response()->json([
        //          'message' => $message,
        //      ], 402);
        //  }
 

        $materiaPP = MateriaPrimaProveedor::find($IDMatPrimaProveedor);
        $materiaPP->ProveedorId = $request->input("ProveedorId");
        $materiaPP->BodegaID = $request->input("BodegaID");
        $materiaPP->CantidadTotal = $request->input("CantidadTotal");
        $materiaPP->Desperdicio = $request->input("Desperdicio");
        $materiaPP->FechaCaducidad = $request->input("FechaCaducidad");
        $materiaPP->MateriaPrimaID = $request->input("MateriaPrimaID");
        $materiaPP->UnidadMedidaID = $request->input("UnidadMedidaID");
        $materiaPP->PrecioUnitario = $request->input("PrecioUnitario");
        $materiaPP->save();
        return response()->json($materiaPP);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MateriaPrimaProveedor  $materiaPrimaProveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(MateriaPrimaProveedor $materiaPrimaProveedor)
    {
        //
    }
    public function Calcular_Disponibilidad($CantidadInv, $CantidadEntrada)
    {
        $Disponible = 0;
        $Disponible = ($CantidadInv + $CantidadEntrada);
        return $Disponible;
    }
}
