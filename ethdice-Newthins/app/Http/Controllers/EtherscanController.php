<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Transaction; // replace with your Transaction model namespace
use App\Models\User; // replace with your User model namespace
use Illuminate\Support\Facades\Cache;


class EtherscanController extends Controller
{
    private $client;
    
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.coingecko.com/api/v3/',
        ]);
    }
    public function getSuccessfulTransactions(Request $request)
    {
        $ethApiKey = 'NMHIJP3N6ACFDC97VK9WWYQ9VWMTRX3WZA'; // replace with your Etherscan API key
        $coinGeckoClient = new Client([
            'base_uri' => 'https://api.coingecko.com/api/v3/',
        ]);
        $users = User::all();
        foreach ($users as $user) {
            $address = $user->eth_address;
            $ethResponse = $this->getEthereumTransactions($ethApiKey, $address);
            $ethToUsdRate = $this->getEthToUsdRate($coinGeckoClient);
            if ($ethResponse) {
                $transactions = json_decode($ethResponse->getBody(), true);
                if (is_array($transactions['result'])) {
                    foreach ($transactions['result'] as $tx) {
                        // check if transaction already exists in the database
                        $existingTx = Transaction::where('hash', $tx['hash'])->first();

                        if ($existingTx === null) {
                            // calculate Coin value
                            $usdValue = $tx['value'] / 1e18 * $ethToUsdRate;
                            $coinValue = $usdValue * 2;

                            // create new transaction model and save it to the database
                            $newTx = new Transaction();
                            $newTx->hash = $tx['hash'];
                            $newTx->block_number = $tx['blockNumber'];
                            $newTx->timestamp = $tx['timeStamp'];
                            $newTx->from_address = $tx['from'];
                            $newTx->to_address = $tx['to'];
                            $newTx->value = $tx['value'] / 1e18;
                            $newTx->coin_value = $coinValue;
                            $newTx->gas_price = $tx['gasPrice'];
                            $newTx->gas_used = $tx['gasUsed'];
                            $newTx->network = 'ethereum'; // Set the network for ethereum transactions
                            $newTx->save();

                            
                        }
                    }
                }
            }
            sleep(6);
        }

        return response()->json(['message' => 'Success']);
    }

    private function getEthereumTransactions($apiKey, $address)
    {
        $client = new Client([
            'base_uri' => 'https://api.etherscan.io/api/',
        ]);        
        $response = $client->request('GET', '', [
            'query' => [
                'module' => 'account',
                'action' => 'txlist',
                'address' => $address,
                'apikey' => $apiKey,
                'sort' => 'desc',
                'startblock' => 0,
                'endblock' => 'latest',
                'page' => 1,
                'offset' => 100,
                'txreceiptstatus' => 1,
            ],
        ]);

        return $response;
    }

    private function getEthToUsdRate($client)
    {
        // Retrieve the cached conversion rate, if available
        $ethToUsdRate = Cache::get('eth_to_usd_rate');
    
        // If the conversion rate is not cached, fetch it and store it in the cache
        if ($ethToUsdRate === null) {
            $response = $client->request('GET', 'simple/price', [
                'query' => [
                    'ids' => 'ethereum',
                    'vs_currencies' => 'usd',
                ],
            ]);
            $body = json_decode($response->getBody(), true);
            $ethToUsdRate = $body['ethereum']['usd'];
    
            // Cache the conversion rate for 5 minutes
            Cache::put('eth_to_usd_rate', $ethToUsdRate, 300); // 300 seconds = 5 minutes
        }
    
        return $ethToUsdRate;
    }
    public function convertCoinsToEth(Request $request)
    {
        $coinValue = $request->input('coin_value');
        $usdPerCoin = 1 / 2; // 1 USD is worth 2 coins
    
        // Convert the coin value to USD
        $usdValue = $coinValue * $usdPerCoin;
    
        // Get the current ETH to USD rate
        $ethToUsdRate = $this->getEthToUsdRate($this->client);
    
        // Convert the USD value to ETH
        $ethValue = $usdValue / $ethToUsdRate;
    
        return response()->json(['eth_value' => $ethValue]);
    }
    

}
