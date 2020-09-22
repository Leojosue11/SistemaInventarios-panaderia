<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;
use App\Models\UnidadMedidas;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RegistroMateriaPrima;
use App\Models\MateriaPrimaProveedor;
use Illuminate\Support\Facades\Validator;

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
            'date_format' => 'El campo :attribute no tiene el formato correcto :format'

        ];


        //Valiacion
        $validator = Validator::make($request->all(), [
            'ProveedorId' => 'required',
            'BodegaID' => 'required',
            'MateriaPrimaID' => 'required',
            'CantidadTotal' => 'required',
            'Desperdicio' => 'required',
            'FechaCaducidad' => 'required',
            'UnidadMedidaID' => 'required',
            'PrecioUnitario' => 'required',


        ], $messages);




        //Si falla la validacion

        if ($validator->fails()) {

            $errores = $validator->errors();

            $json = array(
                "status" => 404,

                "detalles" => $errores


            );

            return json_encode($json, true);
        } else {

            //si todo sale bien 
            $MateriaPrimaProv = MateriaPrimaProveedor::create($request->all());
            return '{"msg":"creado","result":' . $MateriaPrimaProv . '}';
        }
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
    public function update(Request $request, MateriaPrimaProveedor $materiaPrimaProveedor)
    {
        //
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
}
