<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    protected $fillable = [
        'bid',
        'slot',
        'amount',
        'trno',
        'ctime',
        'term',
        'package',
        'sess',
        'total',
        'remain',
        'active',
        'token',
        'rep',

      ];
      protected $table = 'slot';
}
