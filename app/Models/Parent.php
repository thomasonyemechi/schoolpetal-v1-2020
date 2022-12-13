<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parent extends Model
{
    use HasFactory;
    protected $filable = [
        'uid',
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
    protected $table = 'parent';
}
