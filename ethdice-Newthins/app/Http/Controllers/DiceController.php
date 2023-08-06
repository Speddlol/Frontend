<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DiceGame;
use App\Events\DiceGameCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\User;
use GuzzleHttp\Client;




class DiceController extends Controller
{
    public function index()
    {
        $result = null;
        $winChance = null;
        $payout = null;
        $randNum = null;
        $winAmount = null;
        $betAmount = null;
        $balance = null;
        $jackpotCoins = null;
        $randNumValue= null;
    
        if (Auth::check()) {
            $user = auth()->user();
            $balance = $user->coins;
            $jackpot = House::where('name', 'DiceJackpot')->first();
            $jackpotCoins = $jackpot ? $jackpot->coins : 0;
        }
        $jackpot = House::where('name', 'DiceJackpot')->first();
        $jackpotCoins = $jackpot ? $jackpot->coins : 0;
        $house = House::where('name', 'DiceHouse')->first(); // Get the DiceHouse user from the House table
        $maxBet = $house->max_bet;
    
        $biggestWins = Cache::remember('biggest_wins', 3600, function () {
            return DiceGame::where('result', 'win')
                ->orderBy('win_amount', 'desc')
                ->with('user:id,name')
                ->take(6)
                ->get();
        });
    
        // Fetch the last 8 games excluding the very latest one
        $lastGames = DiceGame::orderBy('id', 'desc')->skip(1)->take(9)->get();
    
        return view('dice', [
            'result' => $result,
            'winChance' => $winChance,
            'payout' => $payout,
            'randNum' => $randNum,
            'winAmount' => $winAmount,
            'betAmount' => $betAmount,
            'balance' => $balance,
            'jackpotCoins' => $jackpotCoins,
            'biggestWins' => $biggestWins,
            'lastGames' => $lastGames,
            'randNumValue' => $randNumValue, // Pass the randNum value to the view
            'max_bet' => $maxBet, 
        ]);
    }
    

public function play(Request $request)
{

    $jackpot = House::where('name', 'DiceJackpot')->first();
    $jackpotCoins = $jackpot ? $jackpot->coins : 0;
    
    $client = new \GuzzleHttp\Client(); // Guzzle HTTP client
    $telegramBotToken = env('TELEGRAM_BOT_TOKEN'); // Retrieve your Telegram bot token

    $user = auth()->user();
    $balance = $user->coins;
    
    $house = House::where('name', 'DiceHouse')->first(); 
    $maxBet = $house->max_bet;
    
    // Generate a random server seed
    $server_seed = Str::random(32);
    
    // Generate a random client seed
    $client_seed = Str::random(32);

    $validatedData = $request->validate([
        'betAmount' => ['required', 'numeric', 'min:1', 'max:' . $maxBet],
        'winChance' => ['required', 'numeric', 'min:5', 'max:90'],
    ]);
    
    // Combine the server and client seeds to create a unique seed for the game
    $combined_seed = hash('sha256', $server_seed . $client_seed);
    
    // Generate the random number using the combined seed
    $randNum = hexdec(substr($combined_seed, 0, 8)) % 100 + 1;
    
         $betAmount = $validatedData['betAmount']; // Get bet amount from request, default to 100
        $randNumValue = $randNum;
        session(['randNumValue' => $randNum]);


        // Validate the bet amount to ensure it is within the user's available balance
        if ($betAmount > $balance) {
            $betAmount = $balance;
        } elseif ($betAmount > $maxBet) {
            $betAmount = $maxBet;
        } elseif ($betAmount < 1) {
            $betAmount = 1;
        }
    
        $winChance = $request->input('winChance', 50); // Get win chance from request, default to 50
    
        // Validate the win chance to ensure it is within the valid range
        if ($betAmount > $balance || $betAmount > $maxBet) {
            $betAmount = min($balance, $maxBet);
        } elseif ($betAmount < 1) {
            $betAmount = 1;
        }
    
    
        $isWinner = $randNum <= $winChance; // Check if the random number is less than or equal to the win chance
        $result = $isWinner ? 'win' : 'lose'; // Set the result to "win" or "lose" based on the win chance
    
        
        if ($winChance == 100) {
            $payout = 5; // Set a fixed payout of 5 for the highest win chance
        } else {
            $payout = (100 - $winChance) / $winChance + 1; // Calculate the payout based on the win chance
        }
    
        $winAmount = round($payout * $betAmount, 2); // Calculate the win amount based on the payout and bet amount
    
        $balance -= $betAmount; // Remove bet amount from balance when user plays the game
    
        $house = House::where('name', 'DiceHouse')->first(); // Get the DiceHouse user from the House table
        
        $ticket = null; // Set ticket to null by default
        
        $houseEdge = 0;
        
        $jackpotWin = false; // Initialize jackpotWin as false at the start of your function

   

    
        if ($result == 'win') {
            $houseEdge = round(0.05 * $winAmount, 2); // Calculate 5% house edge
            $winAmount -= $houseEdge; // Subtract house edge from win amount
            $balance += $winAmount; // Add net win amount to balance if user wins
        
          
            $ticket = rand(1, 100000); // Generate a random number from 1 to 100000 as a ticket
            // Check if the bet amount is greater than or equal to 1 coin
            if($winAmount >= 5) {
                // If the win amount is 200 or more, send a message to your Telegram channel
    
                // Prepare the text of the message
                $message = "User " . $user->name . " just won " . $winAmount . " coins! The jackpot is currently " . $jackpotCoins . " coins!";
    
                try {
                    // Send the HTTP request to the Telegram API
                    $response = $client->request('POST', 'https://api.telegram.org/bot' . $telegramBotToken . '/sendMessage', [
                        'query' => [
                            'chat_id' => '@lolumoa', // Replace with your Telegram channel username
                            'text' => $message,
                        ]
                    ]);
    
                    // Optional: Check the response status code for success
                    if ($response->getStatusCode() != 200) {
                        // Log an error message if the request was not successful
                        Log::error('Failed to send message to Telegram: ' . $response->getBody());
                    }
    
                } catch (\Exception $e) {
                    // Log the exception message if the request failed completely
                    Log::error('Failed to send message to Telegram: ' . $e->getMessage());
                }
            }
            if ($betAmount >= 1) {
                // Check if the ticket matches the jackpot number
                if ($ticket == 42424) { 
                    $jackpot = House::where('name', 'DiceJackpot')->first();
                    $jackpotWin = $jackpot->coins * 0.8; // Calculate 80% of the DiceJackpot balance
                    $jackpot->coins -= $jackpotWin; // Remove 80% from DiceJackpot balance
                    $jackpot->save(); // Save the changes to the DiceJackpot user's balance in the database
                    
                    
            
                    $balance += $jackpotWin; // Add jackpot win amount to user's balance

                    $jackpotWin = true;
                }
            }
            $user->update(['coins' => $balance]); // Update user's coins in database
        
            $house->coins -= $winAmount - $betAmount;

            // Send 10% of house edge to DiceJackpot
            $jackpot = House::where('name', 'DiceJackpot')->first();
            $jackpotAmount = round(0.05 * $houseEdge, 2);
            $jackpot->coins += $jackpotAmount;
    
            // Subtract the jackpot amount from DiceHouse balance
            $house->coins -= $jackpotAmount;
    
            $house->save(); // Save the changes to the DiceHouse user's balance in the database
            $jackpot->save(); // Save the changes to the DiceJackpot user's balance in the database
        } else {
            // Add bet amount to the DiceHouse user's balance if user loses
            $house->coins += $betAmount; 
    
            // Calculate house edge as 5% of bet amount
            $houseEdge = round(0.05 * $betAmount, 2);
    
            // Send 10% of house edge to DiceJackpot
            $jackpot = House::where('name', 'DiceJackpot')->first();
            $jackpotAmount = round(0.05 * $houseEdge, 2);
            $jackpot->coins += $jackpotAmount;
    
            // Subtract the jackpot amount from DiceHouse balance
            $house->coins -= $jackpotAmount;
    
            $house->save(); // Save the changes to the DiceHouse user's balance in the database
            $jackpot->save(); // Save the changes to the DiceJackpot user's balance in the database
    
            $winAmount = null; // Set win amount to null if user loses
        }
    
        $user->update(['coins' => $balance]); // Update user's coins in database
    
        $jackpotCoins = $houses['DiceJackpot']->coins ?? 0;

        

    $game = new DiceGame([
        'user_id' => $user->id,
        'bet_amount' => $betAmount,
        'win_chance' => $winChance,
        'result' => $result,
        'rand_num' => $randNum,
        'payout' => $payout,
        'win_amount' => $winAmount,
        'jackpotCoins' => $jackpotCoins,
        'ticket' => $ticket,
        'house_edge' => $houseEdge, // Add this line
        'created_at' => now(),
    ]);

    

    
    $game->save();
    $biggestWins = Cache::get('biggest_wins', function () {
        return DiceGame::where('result', 'win')
            ->orderBy('win_amount', 'desc')
            ->take(6)
            ->with('user:id,name')
            ->get();
    });
$lastGames = DiceGame::orderBy('id', 'desc')->take(9)->with('user')->get();

    session(compact("betAmount", "winChance", "result", "winAmount"));
    // return redirect()->route('dice')->with([
    //     'winAmount' => $winAmount,
    //     'result' => $result,
    //     'rand_num' => $randNum,
    // ]);

    $jackpotCoins = House::where('name', 'DiceJackpot')->first()->coins;
    broadcast(new \App\Events\DiceRolledEvent(compact("biggestWins", "lastGames", "jackpotCoins")))->toOthers();

        return response(compact("biggestWins", "lastGames", "balance", "randNumValue", "result", "winAmount", "jackpotCoins", "jackpotWin"));

 
    }
}


