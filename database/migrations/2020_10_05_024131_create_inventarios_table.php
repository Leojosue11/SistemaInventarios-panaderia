<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->bigIncrements('IdInventario');
            $table->unsignedbigInteger('RegistroMPID');
            $table->foreign('RegistroMPID')->references('IdRegistroMP')->on('registro_materia_primas');
            $table->bigInteger('Disponible');
            $table->unsignedbigInteger('SucursalID');
            $table->foreign('SucursalID')->references('IdSucursal')->on('sucursals');
            $table->unsignedbigInteger('BodegaID');
            $table->foreign('BodegaID')->references('IdBodega')->on('bodegas');
            $table->date('FechaIngreso');
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
        Schema::dropIfExists('inventarios');
    }
}
