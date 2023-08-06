<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJackpotGamesTable extends Migration
{
    public function up()
    {
        Schema::create('jackpot_games', function (Blueprint $table) {
            $table->id();
            $table->string('server_seed');
            $table->string('client_seed');
            $table->unsignedBigInteger('winner_id');
            $table->decimal('winning_amount', 16, 8);
            $table->decimal('commission_amount', 16, 8);
            $table->timestamps();
        
            $table->foreign('winner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jackpot_games');
    }
}
