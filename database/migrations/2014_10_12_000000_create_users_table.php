<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//consultas sql 
use Illuminate\Support\Facades\DB;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('last_name',100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',60);
            $table->enum('type',['user','admin']);
            $table->boolean('active');
            $table->text('address');
            $table->string('url_imagen');


            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
