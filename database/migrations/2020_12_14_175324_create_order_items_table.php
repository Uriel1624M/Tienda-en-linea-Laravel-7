<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precio',5,2);
            $table->integer('quantity')->unsigned();
            $table->integer('id_talla')->unsigned();
            $table->unsignedInteger('articulo_id');
            $table->foreign('articulo_id')
                ->references('id')
                ->on('articulo')
                ->onDelete('cascade');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
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
        Schema::dropIfExists('order_items');
    }
}
