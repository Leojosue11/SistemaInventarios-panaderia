<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedidas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnidadMedidasController extends Controller
{

    public function index()
    {
        $materia = UnidadMedidas::all();
        return $materia;
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnidadMedidas  $unidadMedidas
     * @return \Illuminate\Http\Response
     */
    public function show(UnidadMedidas $unidadMedidas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnidadMedidas  $unidadMedidas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnidadMedidas $unidadMedidas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnidadMedidas  $unidadMedidas
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnidadMedidas $unidadMedidas)
    {
        //
    }
}
