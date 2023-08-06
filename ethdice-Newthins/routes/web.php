<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinsController;
use app\http\controllers\CryptoWalletsController;
use app\http\controllers\EthereumController;
use App\Http\Controllers\EtherscanController;
use App\Http\Controllers\JackpotGameController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DiceController;
use App\Http\Controllers\JackpotController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\CoinflipController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\MatchbettingController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\SSEController;
use App\Http\Controllers\BscScanController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\DepositController; // Replace with your DepositController namespace
use App\Http\Controllers\StripeController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dice');
});


Route::get('/whitepaper', function () {
    return view('whitepaper');
});



Route::get('/bet-history', 'App\Http\Controllers\BetHistoryController@index')->name('betHistory');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dice', function () {
        return view('dice');
    })->name('dice');
});


Route::get('/', [DiceController::class, 'index'])->name('home');
Route::post('/crypto-wallets', 'App\Http\Controllers\CryptoWalletsController@update')->name('crypto-wallets.update');
Route::get('/test-connection', [App\Http\Controllers\EthereumController::class, 'testConnection']);
Route::get('/dice', [DiceController::class, 'index'])->name('dice');
Route::post('/dice/play', [DiceController::class, 'play'])->middleware('auth')->name('dice.play');


Route::get('/withdraw', [WithdrawController::class, 'create'])->name('withdraw.create')->middleware('auth');
Route::post('/withdraw', [WithdrawController::class, 'store'])->name('withdraw.store')->middleware('auth');

Route::get('/withdraw/eth', [WithdrawController::class, 'showETHWithdrawForm'])->name('withdraw.eth');
Route::get('/deposit', [DepositController::class, 'showalldeposits'])->middleware('auth');




Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/deposit/stripe', [StripeController::class, 'createCheckoutSession'])->name('deposit.stripe');
    Route::get('/deposit/success', [StripeController::class, 'depositSuccess'])->name('deposit.success');
    Route::get('/deposit/cancel', [StripeController::class, 'depositCancel'])->name('deposit.cancel');
});


Route::get('/convert-coins-to-eth', [EtherscanController::class, 'convertCoinsToEth']);
Route::get('/convert-coins-to-bnb', [BscScanController::class, 'convertCoinsToBnb']);
Route::get('/admin', [WithdrawController::class, 'getAllWithdrawals'])->name('admin');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admindice', [\App\Http\Controllers\AdminController::class, 'admindice'])->name('admin.dice');
    Route::get('/betslip', [AdminController::class, 'betslip'])->name('admin.betslip');
    Route::post('/create-betslip', [MatchbettingController::class, 'createBetslip'])->name('create.betslip');
    Route::get('/adminusers', [\App\Http\Controllers\AdminController::class, 'adminusers'])->name('admin.users');
    Route::get('/bscscan/successful-transactions', [BscScanController::class, 'getSuccessfulTransactions']);
    Route::get('/etherscan/successful-transactions', [EtherscanController::class, 'getSuccessfulTransactions']);
    Route::put('/withdrawals/{id}/approve', [AdminController::class, 'approveWithdrawal'])->name('withdrawals.approve');
    Route::put('/withdrawals/{id}/reject', [AdminController::class, 'rejectWithdrawal'])->name('withdrawals.reject');
    Route::put('/house/updateMaxBet', [App\Http\Controllers\AdminController::class, 'updateMaxBet'])->name('house.updateMaxBet');
    Route::post('/betslip/{betslip}/close', [MatchbettingController::class, 'closeBetslip'])->name('closeBetslip');

});
Route::get('/coinflip', [CoinflipController::class, 'index'])->name('coinflip.index');
Route::middleware(['auth'])->group(function () {
    Route::post('/coinflip/create_game', [CoinflipController::class, 'createGame'])->name('coinflip.create_game');
    Route::post('/coinflip/join_game/{gameId}', [CoinflipController::class, 'joinGame'])->name('coinflip.join_game');
    Route::post('/coinflip/cancel_game/{gameId}', [CoinflipController::class, 'cancelGame'])->name('coinflip.cancel_game');

});
Route::get('/matchbetting', [MatchbettingController::class, 'index']);
Route::middleware(['auth'])->group(function () {
    Route::post('/placeBet/{betslip}', [matchbettingController::class, 'placeBet'])->name('placeBet');
    
    

});

Route::post('/telegram/send-message', [TelegramController::class, 'sendMessage']);







