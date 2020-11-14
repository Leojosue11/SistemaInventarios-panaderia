<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados=Empleado::all();
        return $empleados;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'TituloID' => 'required',
            'NombreEmpleado'=>'required|max:25',
            'ApellidoEmpleado'=>'required|max:25',
            'DireccionEmpleado'=>'required|max:100',
            'EmailEmpleado' => 'required|max:30|unique:empleados',
            'TelefonoEmpleado'=>'required',
            'MovilEmpleado'=>'required',
            'DUIEmpleado' => 'required|max:12|unique:empleados',
            'GeneroEmpleado'=>'required',
            'FechaContratacion'=>'required',
            'FechaNacimiento'=>'required',
            'CargoID' => 'required',
            'Observaciones' => 'max:100',
            
           
        ],$Mensaje);


        if ($validaciones->fails()){
            $errores = $validaciones->errors();

            return response()-> json($errores, 402);
        }else{
             $empleados = Empleado::create($request->all());

            return '{"msg":"creado","result":' . $empleados . '}';
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleados)
    {
        $empleados = DB::table('empleados')
        ->join('titulos', 'empleados.TituloID', '=', 'titulos.IdTitulo')
        ->join('cargos', 'empleados.CargoID', '=', 'cargos.IdCargo')
        ->select(
            
            'empleados.IdEmpleado',
            'empleados.NombreEmpleado',
            'empleados.ApellidoEmpleado',
            'empleados.DireccionEmpleado',
            'empleados.EmailEmpleado',
            'empleado.TelefonoEmpleado',
            'empleados.MovilEmpleado',
            'empleados.DUIEmpleado',
            'empleados.GeneroEmpleado',
            'empleados.FechaContratacion',
            'empleados.FechaNacimiento',
            'empleados.Observacion',
            'titulos.IdTitulo',
            'titulos.Titulo',
            'cargos.IdCargo',
            'cargos.NombreCargo'
            )
        ->get();
        return $empleados;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$IdEmpleado)
    {
        //Actualiza la informacion de Pedidos
        $empleado = Empleado::find($IdEmpleado);
        $empleado->TituloID = $request->input("TituloID");
        $empleado->NombreEmpleado = $request->input("NombreEmpleado");
        $empleado->ApellidoEmpleado = $request->input("ApellidoEmpleado");
        $empleado->DireccionEmpleado = $request->input("DireccionEmpleado");
        $empleado->EmailEmpleado = $request->input("EmailEmpleado");
        $empleado->TelefonoEmpleado = $request->input("TelefonoEmpleado");
        $empleado->MovilEmpleado = $request->input("MovilEmpleado");
        $empleado->DUIEmpleado = $request->input("DUIEmpleado");
        $empleado->GeneroEmpleado = $request->input("GeneroEmpleado");
        $empleado->FechaContratacion = $request->input("FechaContratacion");
        $empleado->FechaNacimiento = $request->input("FechaNacimiento");
        $empleado->CargoID = $request->input("CargoID");
        $empleado->Observaciones = $request->input("Observaciones");
        
        $empleado->save();
        return response()->json($empleado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
