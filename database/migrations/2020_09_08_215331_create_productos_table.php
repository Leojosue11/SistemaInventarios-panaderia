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
            $table->bigIncrements('IdProducto'); //Llave primaria, longitud 6
            $table->string('NombreProducto', 30)->unique(); //Unique index
            $table->string('CodigoProducto', 20)->unique(); //Unique index
            $table->unsignedBigInteger('CategoriaID');
            $table->foreign('CategoriaID')->references('IdCategoria')->on('categorias'); //Llave foránea, tabla Categoría, longitud 6
 //         
            
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
