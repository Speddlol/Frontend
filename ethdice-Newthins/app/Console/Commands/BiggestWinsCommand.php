<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\DiceGame;

class BiggestWinsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dice:biggestwins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the biggest wins of all time';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $biggestWins = DiceGame::where('result', 'win')
        ->orderBy('win_amount', 'desc')
        ->take(6)
        ->get();

    // Store the biggest wins in cache for 1 hour
    Cache::put('biggest_wins', $biggestWins, 3600);

    $this->info('Biggest wins fetched successfully!');
    }
}
