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
            $table->string('CodigoProveedor', 15)->unique();
            $table->string('NombreProveedor', 50)->unique();
            $table->unsignedBigInteger('TipoProveedorID');
            $table->foreign('TipoProveedorID')->references('IdTipo')->on('tipo_proveedors');
            $table->string('TelefonoProveedor', 8);
            $table->string('MovilProveedor', 8);
            $table->string('EmailProveedor', 25);
            $table->string('FaxProveedor', 9)->nullable();
            $table->string('NITPRoveedor', 20)->nullable();
            $table->string('NIDFiscal', 25)->nullable();
            $table->string('TituloProveedor', 50)->nullable();
            $table->boolean('Inactivo')->default(false);
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
