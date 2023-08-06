<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrBetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert the "PrBettax" user into the houses table
        DB::table('houses')->insert([
            'name' => 'PrBettax',
            'coins' => 0.00,
        ]);
    }
}