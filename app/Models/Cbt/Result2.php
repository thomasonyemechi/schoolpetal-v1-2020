<?php

namespace App\Models\Cbt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result2 extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'type',
        'esn',
        'tcode',
        'qn',
        'myoption',
        'score',
    ];

    protected $table = 'result2';
}
