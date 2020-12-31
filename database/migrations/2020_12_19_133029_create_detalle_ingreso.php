<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->decimal('precio_compra');
            $table->decimal('precio_venta'); 
            $table->unsignedInteger('idingreso');
            $table->foreign('idingreso')
                    ->references('id')
                    ->on('ingreso')
                    ->onDelete('cascade');
            $table->unsignedInteger('idarticulo')
                    ->references('id')
                    ->on('articulo');
            $table->unsignedInteger('idtalla')
                    ->references('id')
                    ->on('talla');
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
        Schema::dropIfExists('detalle_ingreso');
    }
}
