<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
      'a',
      'b',
      'c',
      'd',
      'e',
      'f',
      'ca1',
      'ca2',
      'ca3',
      'exam',
      'ta',
      'tb',
      'tc',
      'td',
      'te',
      'te',
      'tf',
      'pa',
      'pb',
      'pc',
      'pd',
      'pe',
      'pf',
      'bid',
    ];
    protected $table = 'grade';
}
