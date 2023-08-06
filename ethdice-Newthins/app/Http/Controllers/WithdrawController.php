<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Brick\Math\BigDecimal;





class WithdrawController extends Controller
{
    public function create()
    {
        $client = new Client([
            'base_uri' => 'https://api.etherscan.io/api/',
        ]);
        $response = $client->request('GET', '', [
            'query' => [
                'module' => 'proxy',
                'action' => 'eth_gasPrice',
                'apikey' => 'NMHIJP3N6ACFDC97VK9WWYQ9VWMTRX3WZA',
            ],
        ]);
        $gasPriceInGwei = hexdec($response->getBody()->getContents()) / 1e9;
    
        // Get the current Ether to USD exchange rate
        $coinGeckoClient = new Client([
            'base_uri' => 'https://api.coingecko.com/api/v3/',
        ]);
        $ethToUsdRate = $this->getEthToUsdRate($coinGeckoClient);
    
        // Convert the gas price from Gwei to USD
        $gasPriceInUsd = $gasPriceInGwei * $ethToUsdRate;
    
        // Convert the gas price from USD to coins
        $gasPriceInCoins = round($gasPriceInUsd * 2, 1);
        $gasPrice = $gasPriceInCoins + 2;
    
        // Set gasPriceBNB to 1 coin
        $gasPriceBNB = 1;
    
        return view('withdraw', ['gasPrice' => $gasPrice, 'gasPriceBNB' => $gasPriceBNB]);
    }
    
private function getEthToUsdRate($client)
{
    $response = $client->request('GET', 'simple/price', [
        'query' => [
            'ids' => 'ethereum',
            'vs_currencies' => 'usd',
        ],
    ]);
    $body = json_decode($response->getBody(), true);
    $ethToUsdRate = $body['ethereum']['usd'];

    $ethToUsdRate /= 1e14;

    return $ethToUsdRate;
}
public function store(Request $request)
{
    $user = auth()->user();
    $balance = $user->coins;

    if ($request->bnb_address) {
        $gasPrice = $request->input('gas_price_bnb');
    } else {
        $gasPrice = $request->input('gas_price');
    }
    
    // Validate the request
    $request->validate([
        'coins' => ['required', 'integer', 'min:1', function ($attribute, $value, $fail) use ($balance, $gasPrice) {
            if ($value + $gasPrice > $balance) {
                $fail('The ' . $attribute . ' is invalid.');
            }
        }],
        'eth_address' => 'required_without:bnb_address',
        'bnb_address' => 'required_without:eth_address',
    ]);
    
    // Create a new withdrawal record
    $withdrawal = new Withdrawal();
    $withdrawal->user_id = $user->id;
    // save total withdrawal amount (coins + gas price)
    $withdrawal->coins = $request->coins + $gasPrice; 
    $withdrawal->eth_address = $request->eth_address;
    $withdrawal->bnb_address = $request->bnb_address;
    $withdrawal->save();
    
    try {
        DB::beginTransaction();
    
        // Deduct the coins and gas price from the user's balance
        if ($request->bnb_address) {
            $user->coins -= ($request->coins + 1);
        } else {
            $user->coins -= ($request->coins + $gasPrice);
        }
        $user->save();
    
        DB::commit();
    
        return redirect()->back()->with('success', 'Withdrawal request submitted successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
    }
}


public function showGas()
{
    $client = new Client([
        'base_uri' => 'https://ethgasstation.info',
    ]);
    $response = $client->request('GET', '/api/ethgasAPI.json');
    $body = json_decode($response->getBody(), true);

    $gasPrice = $body['safeLow'] / 10; // in Gwei

    return view('withdraw', ['gasPrice' => $gasPrice]);
}
public function rejectWithdrawal($id)
{
    try {
        DB::beginTransaction();
        
        $withdrawal = Withdrawal::findOrFail($id);
        $user = User::findOrFail($withdrawal->user_id);
        
        // return coins back to the user
        $user->coins += $withdrawal->coins;
        
        $user->save();
        
        // update withdrawal status to rejected
        $withdrawal->status = 'rejected';
        $withdrawal->save();
        
        DB::commit();
        
        return redirect()->back()->with('success', 'Withdrawal request has been rejected and coins are returned to the user.');
    } catch (\Exception $e) {
        DB::rollback();
        
        return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
    }
}




}



