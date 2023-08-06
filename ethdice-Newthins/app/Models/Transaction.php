<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'block_number',
        'timestamp',
        'from_address',
        'to_address',
        'value',
        'gas_price',
        'gas_used',
        'coin_value',
        'network'
    ];
    
}