<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat',
        'bid',
        'des',
        'rep',
        'unitcost',
        'pin',
        'item',
        'type'
    ];

    protected $table = 'stock';

    public function cat() {
        return $this->belongTo('App\Models\Cat');
    }

   
}
