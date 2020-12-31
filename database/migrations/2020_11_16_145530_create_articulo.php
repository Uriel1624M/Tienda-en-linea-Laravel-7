<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_barras')->unique();
            $table->string('sku');
            $table->string('nombre');
            // $table->string('color');
            $table->string('extract');
            $table->string('descripcion',900);
            $table->string('especificaciones',900);
            $table->string('datos_interes',900);
            $table->string('url_imagen');
            $table->Integer('activo');
            $table->Integer('visible');
            $table->decimal('precio');
            $table->unsignedInteger('id_marca');
            $table->foreign('id_marca')->references('id')->on('marca');
            $table->unsignedInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categoria');

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
        Schema::dropIfExists('articulo');
    }
}
