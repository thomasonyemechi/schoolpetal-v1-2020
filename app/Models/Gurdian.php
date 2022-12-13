<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurdian extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'phone',
        'motheremail',
        'pname',
        'phone2',
        'dob',
        'birthplace',
        'state',
        'other',
        'rep',
        'lga',
        'address',
        'occupation',
        'occupation2',
        'officeadd',
        'officeadd2',
        'level',
        'mname',
        'mphone',
        'fatheremail',
        'status',
        'bid',
        'password',
        'pwd',
    ];
    protected $table = 'parent';
}
