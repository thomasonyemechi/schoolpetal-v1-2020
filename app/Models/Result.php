<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable=[
        'uid',
        'term',
        'year',
        'sess',
        'class',
        'subject',
        't1',
        't2',
        't3',
        't4',
        'exam',
        'resultid',
        'tan',
        'bid',
        'rep',
    ];
    protected $table = 'result';
}
