<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJackpotPlayersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jackpot_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('bet_amount')->default(0);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

public function down()
{
    Schema::dropIfExists('jackpot_players');
}
}