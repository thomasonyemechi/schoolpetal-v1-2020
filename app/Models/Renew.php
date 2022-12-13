<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renew extends Model
{
    use HasFactory;
    protected $fillable = [
        'bid',
        'student',
        'ctime',
        'trno',
        'package',
        'lastsub',
        'amount',
        'expire',
        'rep'
    ];
      protected $table = 'renew';
}
