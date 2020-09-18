<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrimaProveedor;
use App\Models\Proveedores;
use App\Models\Producto;
use App\Models\UnidadMedidas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->join('productos', 'materia_prima_proveedors.ProductoID', '=', 'productos.IdProducto')
            ->join('unidad_medidas', 'materia_prima_proveedors.UnidadMedidaID', '=', 'unidad_medidas.IdUnidadMedida')
            ->select(
                'materia_prima_proveedors.CantidadTotal',
                'materia_prima_proveedors.Desperdicio',
                'materia_prima_proveedors.FechaCaducidad',
                'materia_prima_proveedors.PrecioUnitario',
                'proveedores.IdProveedor',
                'proveedores.NombreProveedor',
                'productos.IdProducto',
                'productos.NombreProducto',
                'unidad_medidas.IdUnidadMedida',
                'unidad_medidas.NombreUnidad'

                
            )
            ->get();
        return $materiaPrimaProveedor;
        //$materiaPrimaProveedor = MateriaPrimaProveedor::all();
        //return $materiaPrimaProveedor;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //Valiacion
        $validator = Validator::make($request->all(),[
            'ProveedorId'=>'required',
            'ProductoID'=>'required',
            'CantidadTotal' => 'required',
            'Desperdicio' => 'required',
            'FechaCaducidad'=>'required|date_format:Y/m/d',
            'UnidadMedidaID'=>'required',
            'PrecioUnitario'=>'required',
            
            
        ]);


       

        //Si falla la validacion

        if ($validator->fails()) {

            $errores=$validator->errors();
            
            $json=array(
                "status"=>404,

                "detalles"=>$errores


            );
          
            return json_encode($json,true);
        }
        else{

            //si todo sale bien 
            $MateriaPrimaProv=MateriaPrimaProveedor::create($request->all());
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
