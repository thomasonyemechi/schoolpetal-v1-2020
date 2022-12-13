<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'manager',
        'phone',
        'phone2',
        'address',
        'website',
        'motto',
        'password',
        'active',
        'expires',
        'bid',
        'sid',
    ];

}
