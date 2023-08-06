<?php

namespace App\Http\Controllers;
use App\Models\CoinflipGame;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\House;
use Illuminate\Support\Facades\Log;




use Illuminate\Http\Request;

class CoinflipController extends Controller
{
    public function index()
    {
        $openGames = CoinflipGame::whereIn('status', ['open'])->get();
        $myGames = $openGames->where('user_id', Auth::id());
        $openGames = $openGames->diff($myGames);
        return view('coinflip', ['openGames' => $openGames, 'myGames' => $myGames ,'game' => null]);
    }
    public function createGame(Request $request)
{
    $user = auth()->user();
    // Validate the input data
    $request->validate([
        'bet_amount' => 'required|integer|min:1',
        'chosen_side' => 'required|in:heads,tails',
    ]);

    $betAmount = $request->input('bet_amount');

    // Check if the user has enough coins to place the bet
    if ($user->coins < $betAmount) {
        return redirect()->back()->withErrors(['error' => 'Insufficient coins']);
    }

    // Get the max_bet from the Coinfliptax house user
    $coinfliptaxUser = House::where('name', 'Coinfliptax')->first();
    $maxBet = optional($coinfliptaxUser)->max_bet;

    // Optionally, set a maximum bet limit based on the user's available balance and the Coinfliptax max_bet
    $maxBet = min($maxBet, $user->coins);


    // Validate the bet amount to ensure it doesn't exceed the user's available balance and the Coinfliptax max_bet
    $request->validate([
        'bet_amount' => 'lte:' . $maxBet,
    ]);

    // Optionally, add other game-specific validation rules here, if needed

    // Deduct the bet amount from the user's balance
    $user->coins -= $betAmount;
    $user->save();

    // Create the coinflip game record
    $coinflipGame = new CoinflipGame([
        'user_id' => $user->id,
        'bet_amount' => $betAmount,
        'chosen_side' => $request->input('chosen_side'),
        'status' => 'open',
    ]);

    $coinflipGame->save();
    $coinflipGame = CoinflipGame::with('user:id,name,coins')->find($coinflipGame->id);
    $retValue = compact("coinflipGame");

    broadcast(new \App\Events\CoinFlipGameCreatedEvent($retValue))->toOthers();

    return response($retValue);
}

public function joinGame(Request $request, $gameId)
{
    $user = auth()->user();

    // Find the open coinflip game with the given game ID and lock it for update to prevent concurrent joining
    try {
        $game = CoinflipGame::where('id', $gameId)->where('status', 'open')->lockForUpdate()->firstOrFail();
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Invalid game']);
    }

    // Check if the user is trying to join their own game
    if ($game->user_id == $user->id) {
        return redirect()->back()->withErrors(['error' => 'You cannot join your own game']);
    }

    // Check if the user has enough coins to join the game
    if ($user->coins < $game->bet_amount) {
        return redirect()->back()->withErrors(['error' => 'Insufficient coins']);
    }

    $user->coins -= $game->bet_amount;
    $user->save();

    // Set the game as active and store the second user's data
    $countdown = 5; // Set the countdown time (you can adjust this as needed)
    $game->countdown = $countdown;
    $game->user_id_2 = $user->id;
    $game->chosen_side_2 = $game->chosen_side === 'heads' ? 'tails' : 'heads'; // Set the opposite of the first player's choice
    $game->status = 'active';
    $game->save();

    // Generate the hash and determine the result of the flip
    $serverSeed = bin2hex(random_bytes(16)); // Generates 16 bytes (32 characters in hexadecimal)
    $clientSeed = $game->id; // Use the game ID as the client seed for added randomness
    $hash = hash('sha256', $serverSeed . "-" . $clientSeed);
    $flip_result = ((int) substr($hash, 0, 8) % 2 == 0) ? 'heads' : 'tails'; // This is the result of the coin flip




// Update the game with the result of the flip
$game->winner = $flip_result;
$game->status = 'completed';
$game->save();

if ($flip_result == $game->chosen_side) {
    $winningUser = User::find($game->user_id);
} else {
    $winningUser = User::find($game->user_id_2);
}

$winAmount = $game->bet_amount * 2;
// Calculate the house edge (5% of the win amount)
$houseEdge = round(0.05 * $winAmount, 2);
$coinfliptaxUser = House::where('name', 'Coinfliptax')->first();
$coinfliptaxUser->coins += $houseEdge; // Add the house edge to Coinfliptax user
$coinfliptaxUser->save();

$winningUser->coins += $winAmount - $houseEdge;
$winningUser->save();

$game = CoinflipGame::with(['user:id,name,coins', 'user_2:id,name,coins'])->find($gameId);

$retValue = compact("game");

broadcast(new \App\Events\CoinFlipGameJoinedEvent($retValue));
}
public function cancelGame(Request $request, $gameId)
{
    try {
        $user = auth()->user();

        // Find the open coinflip game with the given game ID and lock it for update to prevent concurrent joining
        $game = CoinflipGame::where('id', $gameId)->where('status', 'open')->lockForUpdate()->firstOrFail();


        // Check if the user is the owner of the game
        if ($game->user_id != $user->id) {
            return redirect()->back()->withErrors(['error' => 'You cannot cancel this game']);
        }

        // Set the game as canceled and refund the user's bet
        $game->status = 'canceled';
        $user->coins += $game->bet_amount;
        $user->save();
        $game->save();

        broadcast(new \App\Events\CoinFlipGameCancelEvent($retValue));


        // Include a success return statement here.
    } catch (\Exception $e) {
        // Log the exception message
        Log::error('Error canceling game: ' . $e->getMessage());

        // Return an error response
        return response()->json(['error' => 'An error occurred while canceling the game'], 500);
    }
}

}
