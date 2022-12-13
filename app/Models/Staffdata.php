<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffdata extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'phone',
        'email',
        'address',
        'pname',
        'phone2',
        'dob',
        'birthplace',
        'state',
        'other',
        'rep',
        'lga',
        'prschool',
        'reason',
        'bloodgr',
        'genotype',
        'ailment',
        'disability',
        'image',
        'occupation',
        'occupation2',
        'officeadd',
        'officeadd2',
        'level',
        'mname',
        'mphone',
        'email2',
        'status',
        'bid',
    ];

    protected $table = 'staffdata';


    
}
