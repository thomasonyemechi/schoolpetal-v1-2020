<?php

namespace App\Models\Cbt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable=[
        'subject',
        'class',
        'examtype',
        'eindex',
        'rep',
        'term',
        'status',
        'code',
        'bid',
    ];

    protected $table = 'exam';

    public $primaryKey = 'sn';
}
