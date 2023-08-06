<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JackpotPlayer extends Model
{
    protected $fillable = ['user_id', 'bet_amount'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
