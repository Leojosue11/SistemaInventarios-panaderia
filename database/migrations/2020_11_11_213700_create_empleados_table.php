<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('IdEmpleado');
            $table->unsignedbigInteger('TituloID');
            $table->foreign('TituloID')->references('IdTitulo')->on('titulos');
            $table->string('NombreEmpleado', 25);
            $table->string('ApellidoEmpleado', 25);
            $table->string('DireccionEmpleado', 100);
            $table->string('EmailEmpleado', 50)->unique();
            $table->string('TelefonoEmpleado', 8);
            $table->string('MovilEmpleado', 8);
            $table->string('DUIEmpleado', 12)->unique();
            $table->string('GeneroEmpleado', 1);
            $table->string('FechaContratacion');
            $table->string('FechaNacimiento');
            $table->unsignedbigInteger('CargoID');
            $table->foreign('CargoID')->references('IdCargo')->on('cargos');
            $table->string('Observaciones', 200)->nullable()->default('Ninguna observación');
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
        Schema::dropIfExists('empleados');
    }
}
