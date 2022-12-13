<?php

namespace App\Models\Cbt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'esn',
        'subject',
        'tcode',
        'total',
        'ctime',
        'ctime2',
        'term',
        'sess',
        'bid',
    ];

    protected $table='result3';

}
