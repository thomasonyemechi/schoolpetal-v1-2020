<?php

namespace App\Models\Cbt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable=[
        'examtype',
        'rep',
        'bid',
        'status',
        'active'
    ];

    protected $table='type';
}
