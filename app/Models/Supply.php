<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'photo',
        'rep',
        'bid',
    ];
    protected $table = 'supply';
}
