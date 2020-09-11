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
            $table->unsignedBigInteger('ProveedorPersonaID');
            $table->foreign('ProveedorPersonaID')->references('IdProveedorPersona')->on('proveedor_personas');
            $table->unsignedBigInteger('ProveedorEmpresaID');
            $table->foreign('ProveedorEmpresaID')->references('IdProveedorEmpresa')->on('proveedor_empresas');

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
