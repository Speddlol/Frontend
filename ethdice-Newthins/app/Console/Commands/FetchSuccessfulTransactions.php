<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\EtherscanController;
use Illuminate\Http\Request;

class FetchSuccessfulTransactions extends Command
{
    protected $signature = 'fetch:successful-transactions';
    protected $description = 'Fetch successful transactions from Etherscan';

    public function handle()
    {
        $etherscanController = new EtherscanController();
        $request = new Request();
        $etherscanController->getSuccessfulTransactions($request);

        $this->info('Successful transactions fetched successfully.');

        return 0;
    }
}

