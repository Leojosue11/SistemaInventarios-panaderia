<?php

namespace App\Http\Controllers;

use App\Models\RegistroMateriaPrima;
use App\Models\UnidadMedidas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegistroMateriaPrimaController extends Controller
{

    public function index()
    {
        $materiaPrima = DB::table('registro_materia_primas')
            ->join('unidad_medidas', 'registro_materia_primas.UnidadMedidaID', '=', 'unidad_medidas.IdUnidadMedida')
            ->join('proveedores', 'registro_materia_primas.ProveedorID', '=', 'proveedores.IdProveedor')
            ->select(
                'registro_materia_primas.CodigoMP',
                'registro_materia_primas.NombreMP',
                'registro_materia_primas.Clase',
                'registro_materia_primas.Observacion',
                'registro_materia_primas.Descripcion',
                'unidad_medidas.NombreUnidad',
                'unidad_medidas.IdUnidadMedida',
                'proveedores.NombreProveedor',
                'proveedores.IdProveedor'
            )
            ->get();
        return $materiaPrima;
    }


    public function store(Request $request)
    {
        $Mensaje=[
            'required' => 'El :attribute es requerido',
            'unique' => 'El registro ya existe en la base'
                    

        ];

        $validaciones = validator::make($request->all(),[
            //unique:nombredelatabla
            'CodigoMP' => 'required|max:50|unique:registro_materia_primas',
            'NombreMP' => 'required|unique:registro_materia_primas',
            'Clase' => 'required',
            'Observacion' => 'required',
            'ProveedorID'=>'required',
            'UnidadMedidaID' => 'required'
            


        ],$Mensaje);


        if ($validaciones->fails()){
            $errores = $validaciones->errors();

            return response()-> json($errores, 402);
        }else{
             $registroMateriaPrima = RegistroMateriaPrima::create($request->all());
            return '{"msg":"creado","result":' . $registroMateriaPrima . '}';
        };

    }


    public function show(RegistroMateriaPrima $registroMateriaPrima)
    {
        //
    }


    public function update(Request $request, RegistroMateriaPrima $registroMateriaPrima)
    {
        //
    }


    public function destroy(RegistroMateriaPrima $registroMateriaPrima)
    {
        //
    }
    public function ShowMateriaPrima()
    {
        $Materia = RegistroMateriaPrima::all();
        return $Materia;
    }
}
