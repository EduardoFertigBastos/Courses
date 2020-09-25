<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    public    $timestamps = true;
    protected $table      = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf', 'name', 'phone', 'birth', 'gender', 'notes', 'email', 'password', 'status', 'permission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups');
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function setPasswordAttribute ($sPass)
    {
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($sPass) : $sPass;
    }

    public function getFormattedCpfAttribute()
    {
        $sCpf = $this->attributes['cpf']; 

        return substr($sCpf, 0, 3) . '.' . substr($sCpf, 3, 3) . '.' .
               substr($sCpf, 6, 3) . '-' . substr($sCpf, 9, 2);
    }

    public function getFormattedPhoneAttribute()
    {
        $sPhone = $this->attributes['phone'];

        return '(' . substr($sPhone, 0, 2) . ') ' . substr($sPhone, 2 , 4) . '-' . substr($sPhone, 6, 4);
    }

    public function getFormattedBirthAttribute()
    {
        $sBirth = explode('-', $this->attributes['birth']);
        
        if (count($sBirth) === 3) 
        {
            return $sBirth[2] . '/' . $sBirth[1] . '/' . $sBirth[0];
        } 
        else
        {
            return '';
        }        
    }

}