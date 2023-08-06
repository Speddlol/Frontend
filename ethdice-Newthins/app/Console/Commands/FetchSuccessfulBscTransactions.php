<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BscScanController;
use Illuminate\Http\Request;

class FetchSuccessfulBscTransactions extends Command
{
    protected $signature = 'fetch:successful-bsc-transactions';
    protected $description = 'Fetch successful transactions from BscScan';

    public function handle()
    {
        
        $bscScanController = new BscScanController();
        $request = new Request();
        $bscScanController->getSuccessfulbscTransactions($request);

        $this->info('Successful BSC transactions fetched successfully.');

        return 0;
    }
}
