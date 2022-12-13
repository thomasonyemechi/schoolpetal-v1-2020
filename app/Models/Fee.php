<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'year',
        'sess',
        'term',
        'class',
        'fee',
        'amount',
        'discount',
        'tan',
        'bid',
        'rep',
        'active',
    ];
    protected $table = 'fee';
 
    // public function feecat()
    // {
    //     return $this->belongsTo('App\Models\Feecat', 'fee');
    // }

    public function feecat()
    {
        return $this->hasOne('App\Models\Feecat','id', 'fee');
    }


}
