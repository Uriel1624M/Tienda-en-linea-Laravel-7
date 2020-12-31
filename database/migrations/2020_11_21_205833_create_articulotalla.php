<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulotalla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulotalla', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->unsignedInteger('id_articulo');
            $table->foreign('id_articulo')->references('id')->on('articulo');
            $table->unsignedInteger('id_talla');
            $table->foreign('id_talla')->references('id')->on('talla');
            $table->integer('stock');
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
        Schema::dropIfExists('articulotalla');
    }
}
