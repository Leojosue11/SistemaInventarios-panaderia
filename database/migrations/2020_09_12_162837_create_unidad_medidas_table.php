<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_medidas', function (Blueprint $table) {
            $table->bigIncrements('IdUnidadMedida'); //PK, longitud 6
            $table->string('NombreUnidad', 25)->unique(); //Unique index
            $table->string('AbreviaturaUnidad', 10)->nullable(); //Campo opcional
            $table->unsignedBigInteger('MagnitudUnidadID');//Llave foránea, tabla MagnitudUnidad longitud 6
            $table->foreign('MagnitudUnidadID')->references('IdMagnitudUnidad')->on('magnitud_unidads');

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
        Schema::dropIfExists('unidad_medidas');
    }
}
