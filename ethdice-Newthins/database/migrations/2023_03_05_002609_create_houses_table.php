<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatehousesTable extends Migration
{
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('coins', 10, 2);
            $table->timestamps();
        });
    
        DB::table('houses')->insert(
            array(
                array('name' => 'DiceHouse', 'coins' => 0.00),
                array('name' => 'DiceJackpot', 'coins' => 0.00)
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
