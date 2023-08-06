<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JackpotGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_seed',
        'client_seed',
        'winner_id',
        'winning_amount',
        'commission_amount',
    ];

    public function winningPlayer()
    {
        return $this->belongsTo(User::class, 'winning_player_id');
    }
}
