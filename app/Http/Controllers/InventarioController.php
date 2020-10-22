<?php

namespace App\Http\Controllers;

use App\Models\inventario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedido = DB::table('inventarios')
            ->join('registro_materia_primas', 'inventarios.RegistroMPID', '=', 'registro_materia_primas.IdRegistroMP')
            ->join('bodegas', 'inventarios.BodegaID', '=', 'bodegas.IdBodega')
            ->select(
                'inventarios.IdInventario',
                'registro_materia_primas.NombreMP',
                'inventarios.Disponible',
                'bodegas.NombreBodega',
                'inventarios.FechaIngreso',
            )
            ->get();
        return $pedido;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(inventario $inventario)
    {
        //
    }
}
