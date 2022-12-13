<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smssetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'bid',
        'apikey',
        'senderid',
    ];

    protected $table = 'smssetup';
    
}
