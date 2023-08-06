<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PrBet;
use App\Models\Betslip; // Make sure the namespace is correct


class BetHistoryController extends Controller
{
    public function index()
{
    $userBets = PrBet::where('user_id', auth()->id())->get();
    $betslipNames = Betslip::pluck('name', 'id');
 foreach ($userBets as $bet) {
        $betslip = Betslip::find($bet->betslip_id);
        $bet->multiplier = $bet->selected_odd === 'odd_one' ? $betslip->odd_one : $betslip->odd_two;
        $bet->potential_win = $bet->bet_amount * $bet->multiplier;
    }
    return view('bet-history', compact('userBets', 'betslipNames'));

}
}
