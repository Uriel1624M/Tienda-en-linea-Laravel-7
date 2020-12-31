<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_comprobante');
            $table->string('serie_comprobante');
            $table->string('num_comprobante');
            $table->date('fecha');
            $table->decimal('impuesto');
            $table->string('estado');
            $table->unsignedInteger('idProveedor');
            $table->foreign('idProveedor')->references('id')->on('proveedor');
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
        Schema::dropIfExists('ingreso');
    }
}
