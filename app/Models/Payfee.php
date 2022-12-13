<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payfee extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'salesid',
        'amount',
        'note',
        'term',
        'sess',
        'tan',
        'rep',
        'bid',
    ];
    protected $table = 'payfees';
}
