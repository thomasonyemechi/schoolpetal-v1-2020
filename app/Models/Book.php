<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'bookid',
        'name',
        'cat',
        'rep',
        'file',
        'bid',
        'des',
        'sname'
    ];

    protected $table = 'books';
}
