<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagnitudUnidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magnitud_unidads', function (Blueprint $table) {
            $table->bigIncrements('IdMagnitudUnidad'); //PK, longitud 6
            $table->string('NombreMagnitud', 25)->unique(); //Unique index
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
        Schema::dropIfExists('magnitud_unidads');
    }
}
