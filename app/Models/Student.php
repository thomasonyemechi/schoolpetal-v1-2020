<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class Student extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'uid',
        'regno',
        'surname',
        'firstname',
        'midname',
        'class',
        'arm',
        'sess',
        'rep',
        'sex',
        'username',
        'password',
        'pwd',
        'status',
        'active',
        'x',
        'parent',
        'bid',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $guard = 'std';


    //creating a relationship between student and student data
    public function studentdata()
    {
        return $this->hasOne('App\Models\Studentdata','uid', 'uid');
    }

    //relationship btween student and class
    public function classe()
    {
        return $this->hasOne('App\Models\Classe','id', 'class');
    }

}
