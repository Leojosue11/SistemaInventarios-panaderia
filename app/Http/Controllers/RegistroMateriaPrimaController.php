<?php

namespace App\Http\Controllers;

use App\Models\RegistroMateriaPrima;
use App\Models\UnidadMedidas;
use App\Models\inventario;
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
                'registro_materia_primas.IdRegistroMP',
                'registro_materia_primas.CodigoMP',
                'registro_materia_primas.NombreMP',
                'registro_materia_primas.Clase',
                'registro_materia_primas.Observacion',
                'registro_materia_primas.Descripcion',
                'registro_materia_primas.Inactivo',
                'unidad_medidas.NombreUnidad',
                'unidad_medidas.IdUnidadMedida',
                'proveedores.NombreProveedor',
                'proveedores.IdProveedor'
            )
            ->where('registro_materia_primas.Inactivo', '<>', 1)
            ->orderByDesc("IdRegistroMP")
            ->get();
        return $materiaPrima;
    }


    public function store(Request $request)
    {
        $Mensaje = [
            'required' => 'El :attribute es requerido',
            'unique' => 'El registro ya existe en la base'


        ];

        $validaciones = validator::make($request->all(), [
            //unique:nombredelatabla
            'CodigoMP' => 'required|max:50|unique:registro_materia_primas',
            'NombreMP' => 'required|unique:registro_materia_primas',
            'Clase' => 'required',
            'Observacion' => 'required',
            'ProveedorID' => 'required',
            'UnidadMedidaID' => 'required'



        ], $Mensaje);


        if ($validaciones->fails()) {
            $errores = $validaciones->errors();

            return response()->json($errores, 402);
        } else {
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


    public function destroy($IdRegistroMP)
    {
        $materiaPrima = RegistroMateriaPrima::where('IdRegistroMP', $IdRegistroMP)
            ->update([
                'Inactivo' => 1
            ]);
        // $res = User::destroy($id);
        if ($materiaPrima) {
            return response()->json([
                'msg' => 'Borrado exitoso'
            ], 200);
        } else {
            return response()->json([
                'msg' => 'No se encontró registro'
            ], 402);
        }
    }


    public function ShowMateriaPrima()
    {
        $Materia = RegistroMateriaPrima::all();
        return $Materia;
    }
}
