<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('IdProveedor');
            $table->string('CodigoProveedor', 15);
            $table->unsignedBigInteger('TipoProveedorID');
            $table->foreign('TipoProveedorID')->references('IdTipo')->on('tipo_proveedors');
            $table->string('NombreProveedor', 50);
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
        Schema::dropIfExists('proveedores');
    }
}
