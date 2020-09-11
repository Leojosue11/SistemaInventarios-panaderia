<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_personas', function (Blueprint $table) {
            $table->bigIncrements('IdProveedorPersona');
            $table->string('TituloProveedor', 25);
            $table->string('PrimerNombreProveedor', 12);
            $table->string('SegundoNombreProveedor', 12);
            $table->string('PrimerApellidoProveedor', 12);
            $table->string('SegundoApellidoProveedor', 12);
            $table->string('NITProveedor', 20);
            $table->string('TelefonoProveedor', 8);

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
        Schema::dropIfExists('proveedor_personas');
    }
}
