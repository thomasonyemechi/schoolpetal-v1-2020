<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat',
        'rep',
        'bid'
    ];

    public function stock() {
        return $this->hasMany('App\Models\Stock');
    }
}
