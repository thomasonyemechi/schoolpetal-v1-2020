<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feecat extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee',
        'des',
        'tan',
        'active',
        'rep',
        'bid',
    ];
    protected $table = 'feecat';
    public function fee()
    {
        return $this->hasMany('App\Models\Fee', 'fee');
    }  
}
