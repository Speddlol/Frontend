<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'coins',
        'eth_address',
        'bnb_address',
        'status',
    ];

    /**
     * Get the user that owns the withdrawal.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getWithdrawalsByUserId(int $user_id)
    {
        return self::where('user_id', $user_id)->get();
    }
}