<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_user_coins
            AFTER INSERT ON transactions
            FOR EACH ROW
            BEGIN
                UPDATE users
                SET coins = coins + NEW.coin_value
                WHERE users.eth_address = NEW.to_address;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_user_coins');
    }
}
