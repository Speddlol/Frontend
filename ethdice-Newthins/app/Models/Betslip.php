<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Betslip extends Model
{
    protected $fillable = ['name', 'odd_one', 'odd_two', 'odd_three', 'description', 'picture','status', 'winning_odd'];
}