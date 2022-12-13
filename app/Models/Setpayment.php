<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'amount',
        'title',
        'type',
        'month',
        'year',
        'bid',
        'rep',
    ];

    protected $table = 'setpayment';
}
