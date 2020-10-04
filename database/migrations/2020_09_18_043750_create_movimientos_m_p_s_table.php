<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosMPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_m_p_s', function (Blueprint $table) {
            $table->bigIncrements('IdMovimiento');            
            $table->unsignedBigInteger('MateriaPrimaID');
            $table->foreign('MateriaPrimaID')->references('IdRegistroMP')->on('registro_materia_primas');
            $table->bigInteger('Cantidad');
            $table->string('FechaMovimiento');
            $table->unsignedBigInteger('SucursalID');
            $table->foreign('SucursalID')->references('IdSucursal')->on('sucursals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos_m_p_s');
    }
}
