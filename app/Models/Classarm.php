<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classarm extends Model
{
    use HasFactory;
    protected $fillable = [
        'arm',
        'rep',
        'bid',
    ];
    protected $table = 'classarm';
}
