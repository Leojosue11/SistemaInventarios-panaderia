<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal = Sucursal::all();
        return $sucursal;
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
            'NombreSucursal' => 'required|max:25|unique:sucursals',
            'Ubicacion'=>'required|max:25',
            'TelefonoSucursal'=>'required|max:8',
            'EncargadoID'=>'required',
                        
           
        ],$Mensaje);


        if ($validaciones->fails()){
            $errores = $validaciones->errors();

            return response()-> json($errores, 402);
        }else{
             $sucursal = Sucursal::create($request->all());

            return '{"msg":"creado","result":' . $sucursal . '}';
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        $sucursal = DB::table('sucursals')
        ->join('encargados','sucursals.EncargadoID','=','encargados.IdEncargado')
        ->select(
            'sucursals.IdSucursal',
            'sucursals.NombreSucursal',
            'sucursals.Ubicacion',
            'sucursals.TelefonoSucursal',
            'sucursals.EncargadoID',
            'encargados.IdEncargado',
            'encargados.NombreEncargado'

        )
        ->get();
        return $sucursal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdSucursal)
    {
        $sucursal = Sucursal::find($IdSucursal);
        $sucursal->NombreSucursal = $request->input("NombreSucursal");
        $sucursal->Ubicacion = $request->input("Ubicacion");
        $sucursal->TelefonoSucursal = $request->input("TelefonoSucursal");
        $sucursal->EncargadoID = $request->input("EncargadoID");

        $sucursal->save();
        return response()->json($sucursal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        //
    }
}
