<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique();
            $table->unsignedBigInteger('block_number');
            $table->unsignedBigInteger('timestamp');
            $table->string('from_address');
            $table->string('to_address');
            $table->string('value');
            $table->decimal('coin_value', 11, 2)->default(0);
            $table->string('gas_price');
            $table->unsignedBigInteger('gas_used');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
