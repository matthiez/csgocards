<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->bigInteger('trade_offer_id')->nullable()->unique();
            $table->bigInteger('inventory_steamid');
            $table->bigInteger('steamid');
            $table->string('trade_link');
            $table->string('items');
            $table->string('item_names');
            $table->integer('items_value');
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
        Schema::dropIfExists('withdrawals');
    }
}
