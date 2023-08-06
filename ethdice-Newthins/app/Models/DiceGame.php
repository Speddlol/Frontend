<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiceGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bet_amount',
        'win_chance',
        'result',
        'rand_num',
        'payout',
        'win_amount',
        'house_edge',
        'dice_jackpot',
        'created_at',
        'ticket',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getLastNGames(int $n)
    {
        return self::orderBy('id', 'desc')->limit($n)->get();
    }
}

