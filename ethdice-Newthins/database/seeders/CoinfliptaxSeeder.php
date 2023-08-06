<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinfliptaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert the "Coinfliptax" user into the houses table
        DB::table('houses')->insert([
            'name' => 'Coinfliptax',
            'coins' => 0.00,
        ]);
    }
}
