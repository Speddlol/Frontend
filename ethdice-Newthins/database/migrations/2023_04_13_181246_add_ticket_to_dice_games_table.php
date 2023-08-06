<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTicketToDiceGamesTable extends Migration
{
    public function up()
    {
        Schema::table('dice_games', function (Blueprint $table) {
            $table->integer('ticket')->nullable(); // Add the ticket column
        });
    }

    public function down()
    {
        Schema::table('dice_games', function (Blueprint $table) {
            $table->dropColumn('ticket'); // Remove the ticket column
        });
    }
}
