<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('IdPedido');
            $table->unsignedbigInteger('RegistroMPID');
            $table->foreign('RegistroMPID')->references('IdRegistroMP')->on('registro_materia_primas');
            $table->bigInteger('CantidadPedido');
            $table->string('DescripcionPedido', 50);
            $table->unsignedbigInteger('BodegaID');
            $table->foreign('BodegaID')->references('IdBodega')->on('bodegas');
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
        Schema::dropIfExists('pedidos');
    }
}
