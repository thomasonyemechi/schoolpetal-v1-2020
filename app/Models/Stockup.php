<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockup extends Model
{
    use HasFactory;

    protected $fillable = [
        'salesid',
        'pid',
        'bid',
        'cat',
        'qty', 
        'unitprice',
        'packprice',
        'unitcost',
        'totalcost'
  
    ];

    protected $table = 'stockup';
}
