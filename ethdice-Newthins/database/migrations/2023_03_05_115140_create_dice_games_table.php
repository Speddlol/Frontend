
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiceGamesTable extends Migration
{
    public function up()
    {
        Schema::create('dice_games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('bet_amount', 10, 2);
            $table->decimal('win_chance', 5, 2);
            $table->enum('result', ['win', 'lose']);
            $table->unsignedSmallInteger('rand_num');
            $table->decimal('payout', 5, 2);
            $table->decimal('win_amount', 10, 2);
            $table->decimal('house_edge', 10, 2)->nullable();
            $table->decimal('jackpot_edge', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dice_games');
    }
}
