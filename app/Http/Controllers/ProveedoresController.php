<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use App\Models\TipoProveedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $proveedores = Proveedores::all();
        return $proveedores;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Mensaje=[
            'required' => 'El :attribute es requerido',
            'unique' => 'El registro ya existe en la base',
        ];

        $validaciones = validator::make($request->all(),[
            //unique:nombredelatabla
            'CodigoProveedor' => 'required|max:15|unique:proveedores',
            'NombreProveedor' => 'required|max:50|unique:proveedores',
            'TipoProveedorID' => 'required',
            'TelefonoProveedor' => 'max:8',
            'MovilProveedor' => 'max:8',
            'EmailProveedor' => 'max:25',
            'FaxProveedor' => 'max:9',
            'NITProveedor' => 'required|max:20|',
            'NIDFiscal' => 'max:25',
            'TituloProveedor' => 'max:50'
        ],$Mensaje);


        if ($validaciones->fails()){
            $errores = $validaciones->errors();

            return response()-> json($errores, 402);
        }else{
             $Proveedores = Proveedores::create($request->all());

            return '{"msg":"creado","result":' . $Proveedores . '}';
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedores $proveedores)
    {
        $proveedores = DB::table('proveedores')
        ->join('tipo_proveedors', 'proveedores.TipoProveedorID', '=', 'tipo_proveedors.IdTipo')
        ->select(
            'proveedores.CodigoProveedor',
            'proveedores.NombreProveedor',
            'proveedores.TelefonoProveedor',
            'proveedores.EmailProveedor',
            'tipo_proveedors.IdTipo',
            'tipo_proveedors.NombreTipo'
            )
        ->orderByDesc("IdTipo")
        ->get();
        return $proveedores;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedores $proveedores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedores $proveedores)
    {
        //
    }
}
