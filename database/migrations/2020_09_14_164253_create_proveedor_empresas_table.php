<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor_empresas', function (Blueprint $table) {
            $table->bigIncrements('IdProveedorEmpresa');
            $table->string('NombreEmpresa', 50);
            $table->string('DireccionEmpresa', 50);
            $table->string('EmailEmpresa', 25);
            $table->string('TelefonoEmpresa', 8);
            $table->string('MovilEmpresa', 8);
            $table->string('FaxEmpresa', 9);
            $table->string('NIdFiscalEmpresa', 25);

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
        Schema::dropIfExists('proveedor_empresas');
    }
}
