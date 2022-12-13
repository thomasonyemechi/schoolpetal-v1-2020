<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookcat extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'rep',
        'bid',
    ];

    protected $table = 'bookcat';
}
