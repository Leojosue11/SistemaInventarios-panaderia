<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('IdProducto', 6);
            $table->string('NombreProducto', 30)->unique();
            $table->string('CodigoProducto', 20)->unique();
            $table->bigInteger('CategoriaID')->default(6);
            $table->bigInteger('UnidadMedidaID')->nullable()->default(6);
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
        Schema::dropIfExists('productos');
    }
}
