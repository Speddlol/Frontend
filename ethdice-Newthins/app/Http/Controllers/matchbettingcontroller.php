<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrBet;
use App\Models\user;
use App\Models\Betslip;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateBetslipRequest;
use Illuminate\Support\Facades\DB;

class matchbettingController extends Controller
{

    public function createBetslip(Request $request)
{
    $path = null; // initialize $path as null
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'odd_one' => 'required|numeric',
        'odd_two' => 'required|numeric',
        'odd_three' => 'nullable|numeric', // third odd is optional now
        'description' => 'nullable|string|max:500', // description is optional now
        'picture' => 'nullable|image|max:2048', // picture is optional now
    ]);

    // Handle the file upload
    $path = null; // initialize as null
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        // generate a new filename. getClientOriginalExtension() for the file extension
        $filename = 'picture_' . time() . '.' . $picture->getClientOriginalExtension();
        // Move the file to the 'public/images' directory under your project root
        $picture->move(public_path('images'), $filename);
        // Define $path as the location of the uploaded file
        $path = 'images/' . $filename; // if picture is provided, $path will be updated

    }

    $betslip = new Betslip();
    $betslip->name = $request->input('name');
    $betslip->odd_one = $request->input('odd_one');
    $betslip->odd_two = $request->input('odd_two');
    $betslip->odd_three = $request->input('odd_three');
    $betslip->description = $request->input('description');
    $betslip->picture = $path;
    $betslip->save();


    return back()->with('success', 'Betslip created successfully');
}
public function placeBet(Request $request, Betslip $betslip)
{
    $this->validate($request, [
        'bet_amount' => 'required|numeric|min:1',
    ]);

    $betAmount = $request->input('bet_amount');
    $selectedOdd = $request->input('selected_odd');
    $user = auth()->user();

    // Check if user has enough coins
    if ($user->coins < $betAmount) {
        return response()->json([
            'message' => 'Insufficient funds'
        ], 400);
    }

    // Deduct bet amount
    $user->coins -= $betAmount;
    $user->save();

    $bet = new PrBet();
    $bet->user_id = $user->id;
    $bet->betslip_id = $betslip->id;
    $bet->bet_amount = $betAmount;
    $bet->selected_odd = $selectedOdd;  // Saving the name of the odd
    $bet->status = 'pending';  // Or whatever status you want to set
    $bet->save();

    return response()->json([
        'message' => 'Bet placed successfully'
    ], 200);
}
    public function index()
{
    $betslips = Betslip::where('status', 'open')->get();


    
    return view('matchbetting', compact('betslips'));
}
public function closeBetslip(Request $request, Betslip $betslip)
{
    $request->validate([
        'winning_odd' => 'required|in:odd_one,odd_two,odd_three'
    ]);

    DB::transaction(function () use ($request, $betslip) {
        $winning_odd_name = $request->input('winning_odd');
        $winning_odd_value = $betslip->$winning_odd_name;

        $betslip->status = 'closed';
        $betslip->winning_odd = $winning_odd_value;
        $betslip->save();

        // Get all the bets that were placed on this betslip
        $bets = PrBet::where('betslip_id', $betslip->id)->get();

        foreach ($bets as $bet) {
            Log::info('Selected odd for bet: ' . $bet->selected_odd);
            Log::info('Winning odd: ' . $winning_odd_name);
            
            if ($bet->selected_odd == $winning_odd_name) {
                $user = User::find($bet->user_id);
                Log::info('User coins before update: ' . $user->coins);
                $user->coins += $bet->bet_amount * $winning_odd_value;
                Log::info('User coins after update: ' . $user->coins);
                $user->save();
                Log::info('Coins updated for user: ' . $user->id);

                $bet->status = 'closed';
                $bet->save();
            } else {
                Log::info('Condition not met for bet: ' . $bet->id);
            }
        }
    });


    return redirect()->route('admin.betslip');  // assuming you have a route named 'admin.betslip'
}
}