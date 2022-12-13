<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classcat extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat',
        'rep',
        'bid',
    ];
    protected $table = 'classcat';
}
