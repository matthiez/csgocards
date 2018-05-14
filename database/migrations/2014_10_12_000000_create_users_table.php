<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigInteger('steamid')->unique();
            $table->string('steam_avatar')->nullable();
            $table->string('steam_persona_name')->nullable();
            $table->string('player')->unique()->nullable();
            $table->string('trade_link')->nullable();
            $table->rememberToken();
            $table->string('ip');
            $table->string('timezone')->nullable();
            $table->timestamps();
            $table->string('auth_token');
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
