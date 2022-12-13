<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;
    protected $fillable=[
        'student',
        'term',
        'sess',
        'premark',
        'tremark',
        'psign',
        'tsign',
        'class',
        'other',
    ];
    protected $table = 'remark';
}
