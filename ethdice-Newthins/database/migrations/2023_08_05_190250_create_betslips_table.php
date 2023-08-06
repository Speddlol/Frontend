<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betslips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('odd_one', 8, 2);
            $table->decimal('odd_two', 8, 2);
            $table->decimal('odd_three', 8, 2)->nullable(); // make odd_three nullable
            $table->string('description', 500)->nullable(); // make description nullable
            $table->string('picture')->nullable(); // make picture nullable
            $table->string('status')->default('open'); // added status column
            $table->string('winning_odd')->nullable(); // added winning_odd column
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
        Schema::dropIfExists('betslips');
    }
}
