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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Join para traer informacion de la materia prima y mostrarlo en la vista
        $MateriaPrima = RegistroMateriaPrima::all();
        $Unidades = DB::table('registro_materia_primas')
        ->join('unidad_medidas','registro_materia_primas.UnidadMedidaID', '=' , 'unidad_medidas.MagnitudUnidadID')
        ->select('unidad_medidas.*')
        ->get();
        return '{"MateriaPrima":"'.$MateriaPrima.'","UnidadMedida":"'.$Unidades.'"}';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //RegidtroMateriaPrima::create($request->all());

        $MateriaPrima = new RegistroMateriaPrima();

        //Captura los datos del formulario para Validar
        $datos = array("CodigoMP" =>$request ->input("CodigoMP"),
        "NombreMP" =>$request ->input("NombreMP"),
        "Clase" =>$request ->input("Clase"),
        "Observacion" =>$request ->input("Observacion"),
        "Descripcion" =>$request ->input("Descripcion"),
        "UnidadMedidaId" =>$request ->input("UnidadMedidaId"));

        //Validaciones ($Validator)
        
        //Si los datos estan correctos, guarda en la base 
        $MateriaPrima->CodigoMP = $datos["CodigoMP"];
        $MateriaPrima->NombreMP = $datos["NombreMP"];
        $MateriaPrima->Observacion = $datos["Observacion"];
        $MateriaPrima->Clase = $datos["Clase"];
        $MateriaPrima->Descripcion = $datos["Descripcion"];
        $MateriaPrima->UnidadMedidaId = $datos["UnidadMedidaId"];

        $MateriaPrima->save();

        $json = array("status"=>200,
        "msj"=> "Guardado exitoso"
        );
    
        return json_encode($json, true );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegistroMateriaPrima  $registroMateriaPrima
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroMateriaPrima $registroMateriaPrima)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegistroMateriaPrima  $registroMateriaPrima
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, RegistroMateriaPrima $registroMateriaPrima)
    {
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegistroMateriaPrima  $registroMateriaPrima
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroMateriaPrima $registroMateriaPrima)
    {
        //
    }
}
