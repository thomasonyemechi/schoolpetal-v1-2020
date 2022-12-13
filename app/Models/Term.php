<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $fillable = [
        'term',
        'sess',
        'termindex',
        'close',
        'resume',
        'active',
        'rep',
        'bid',
    ];

    protected $table = 'term';

}
