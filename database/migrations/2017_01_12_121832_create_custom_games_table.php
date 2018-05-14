<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_games', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('steamid');
            $table->string('type');
            $table->string('game');
            $table->string('name');
            $table->string('player');
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
        Schema::dropIfExists('custom_games');
    }
}
