<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $filllable = [
        'topic',
        'mid',
        'video',
        'note',
        'tindex',
        'eligible',
        'rep',
        'bid',
    ];

    protected $table='topic';
}
