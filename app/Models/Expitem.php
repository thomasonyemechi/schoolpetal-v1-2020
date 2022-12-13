<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expitem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item',
        'des',
        'rep',
        'bid',
    ];
    protected $table = 'expitem';
}
