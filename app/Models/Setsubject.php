<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setsubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'classid',
        'sid',
        'bid',
    ];

    protected $table = 'setsubject';


    protected $primarykey = 'sn';

    public function classe()
    {
        return $this->hasMany('App\Models\Classe','id', 'classid');
    }


    public function subject()
    {
        return $this->hasMany('App\Models\Subject','id', 'classid');
    }


}
