<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinflipGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bet_amount',
        'chosen_side',
        'status',
        'user_id_2',
        'bet_amount_2',
        'chosen_side_2',
        'winner',
        'countdown',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_2()
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }
}
