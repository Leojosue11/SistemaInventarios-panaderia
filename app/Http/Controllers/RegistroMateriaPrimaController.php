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
        //RegidtroMateriaPrima::create($request->all());

        $MateriaPrima = new RegistroMateriaPrima();

        //Captura los datos del formulario para Validar
        $CodigoMP = $request->input("CodigoMP");
        $NombreMP = $request->input("NombreMP");
        $Clase = $request->input("Clase");
        $Observacion = $request->input("Observacion");
        $Descripcion = $request->input("Descripcion");
        $UnidadMedidaID = $request->input("UnidadMedidaID");
        $ProveedorID = $request->input("ProveedorID");
        $MateriaPrima->CodigoMP = $CodigoMP;
        $MateriaPrima->NombreMP = $NombreMP;
        $MateriaPrima->Clase = $Clase;
        $MateriaPrima->Observacion = $Observacion;
        $MateriaPrima->Descripcion = $Descripcion;
        $MateriaPrima->UnidadMedidaID = $UnidadMedidaID;
        $MateriaPrima->ProveedorID = $ProveedorID;
        $MateriaPrima->save();

        return '{"msg":"creado","result":' . $MateriaPrima . '}';

        //Validaciones ($Validator)

        //Si los datos estan correctos, guarda en la base
        /* $MateriaPrima->CodigoMP = $datos["CodigoMP"];
         $MateriaPrima->NombreMP = $datos["NombreMP"];
         $MateriaPrima->Clase = $datos["Clase"];
         $MateriaPrima->Observacion = $datos["Observacion"];
         $MateriaPrima->Descripcion = $datos["Descripcion"];
         $MateriaPrima->UnidadMedidaId = $datos["UnidadMedidaId"];
         $MateriaPrima->save();
         $json = array(
             "status" => 200,
             "msj" => "Guardado exitoso"
         );
         return json_encode($json, true);*/
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
    public function MateriaPrima()
    {
        $Materia = RegistroMateriaPrima::all();
        return $Materia;
    }
}
