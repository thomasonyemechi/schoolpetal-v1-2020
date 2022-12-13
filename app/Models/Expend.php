<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expend extends Model
{
    use HasFactory;
    protected $fillable = [
        'expid',
        'salesid',
        'amount',
        'des',
        'name',
        'rep',
        'bid',
        'status',
    ];



    protected $table = 'expend';
}
