<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaPrimaProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_prima_proveedors', function (Blueprint $table) {
            $table->bigIncrements('IDMatPrimaProveedor');
            $table->unsignedBigInteger('ProveedorId');
            $table->foreign('ProveedorId')->references('IdProveedor')->on('proveedores');
            $table->unsignedBigInteger('ProductoId');
            $table->foreign('ProductoID')->references('IdProducto')->on('productos');
            $table->bigInteger('CantidadTotal');
            $table->bigInteger('Desperdicio');
            $table->dateTime('FechaCaducidad');
            $table->unsignedBigInteger('UnidadMedidaID');
            $table->foreign('UnidadMedidaID')->references('IdUnidadMedida')->on('unidad_medidas');
            $table->double('PrecioUnitario', 4, 2)->default(00.00);
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
        Schema::dropIfExists('materia_prima_proveedors');
    }
}
