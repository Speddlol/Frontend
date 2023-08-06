<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrBet extends Model
{
    protected $fillable = ['user_id', 'betslip_id', 'bet_amount', 'selected_odd', 'status'];



}
