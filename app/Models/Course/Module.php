<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'module',
        'cid',
        'rep',
        'des',
        'mindex',
        'bid',
    ];
    protected $table='module';
}
