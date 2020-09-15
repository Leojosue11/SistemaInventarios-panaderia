<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroMateriaPrimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_materia_primas', function (Blueprint $table) {
            $table->bigIncrements('IdRegistroMP'); //Llave primaria, longitud 6
            $table->string('CodigoMP')->unique(); //Llave foránea, tabla Producto longitud 6
            $table->string('NombreMP',200);
            $table->string('Clase',200);
            $table->string('Observacion', 100)->default('Sin observación disponible'); //Not null
            $table->unsignedBigInteger('ProveedorID');
            $table->foreign('ProveedorID')->references('IdProveedor')->on('proveedores');
            $table->string('Descripcion', 200)->nullable()->default('Sin descripción disponible'); //Opcional
            $table->unsignedBigInteger('UnidadMedidaID');
            $table->foreign('UnidadMedidaID')->references('IdUnidadMedida')->on('unidad_medidas'); //Llave foránea, tabla UnidadMedidas 

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
        Schema::dropIfExists('registro_materia_primas');
    }
}
