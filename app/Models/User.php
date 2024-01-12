<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "users";

    const User_active = 0;
    const Admin_active = 1;

    public function products(){
        return $this->hasMany('App\Models\Product','id_user','id')->withDefault();
    }

    public function bill(){
        return $this->hasMany('App\Models\Bill','id_user','id')->withDefault();
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment','id_user','id')->withDefault();
    }

    public function rating(){
        return $this->hasMany('App\Models\Rating','id_user','id')->withDefault();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
