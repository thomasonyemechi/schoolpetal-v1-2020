<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable =[
        'course',
        'rep',
        'bid',
        'photo',
        'class',
        'term',
        'info',
        'cindex',
    ];

    protected $table='course';

    public $primaryKey = 'sn';
}
