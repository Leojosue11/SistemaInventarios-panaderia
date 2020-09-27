<?php

namespace App\Http\Controllers;

use App\Models\MovimientosMP;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MovimientosMPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimientosMateria = DB::table('movimientos_m_p_s')
        ->join('registro_materia_primas', 'movimientos_m_p_s.MateriaPrimaID', '=', 'registro_materia_primas.IdRegistroMP')
        ->join('sucursals','movimientos_m_p_s.SucursalID','=','sucursals.IdSucursal')
        ->select(
            'movimientos_m_p_s.IdMovimiento',
            'movimientos_m_p_s.Cantidad',
            'movimientos_m_p_s.FechaMovimiento',
            'registro_materia_primas.IdRegistroMP',
            'registro_materia_primas.NombreMP',
            'sucursals.IdSucursal',
            'sucursals.NombreSucursal',




        )
        ->get();
        return $movimientosMateria;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=['required'=>'El campo :attribute  es requerido.'
        
    ];
    
    //Validacion

    $validator = Validator::make($request->all(),[

        'MateriaPrimaID'=>'required',
        'Cantidad'=>'required',
        'FechaMovimiento'=>'required',
        'SucursalID'=>'required',

    ],$messages);


    if ($validator->fails()) {
                
        $errores=$validator->errors();
        
        $json=array(
            
            "status"=>404,
            "detalles"=>$errores
        );
        
        return json_encode($json,true);
    }

    else
    {
        
        //si todo sale bien 
        
        $MovimientoMateriaPrima=MovimientosMP::create($request->all());
        return '{"msg":"creado","result":' . $MovimientoMateriaPrima . '}';
        //$request->session()->flash('alert-success', 'Pedido Agregado Correctamente');
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovimientosMP  $movimientosMP
     * @return \Illuminate\Http\Response
     */
    public function show(MovimientosMP $movimientosMP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovimientosMP  $movimientosMP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovimientosMP $movimientosMP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MovimientosMP  $movimientosMP
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovimientosMP $movimientosMP)
    {
        //
    }
}
