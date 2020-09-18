<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
           $table->bigIncrements('IdSucursal');
           $table->string('NombreSucursal', 30)->unique();
           $table->string('Ubicacion', 100);
           $table->string('TelefonoSucursal', 8);
           $table->unsignedbigInteger('EncargadoID');
           $table->foreign('EncargadoID')->references('IdEncargado')->on('encargados');
           
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
        Schema::dropIfExists('sucursals');
    }
}
