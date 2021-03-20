<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Council extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table= "councils";

    protected $guard = 'council';

    protected $fillable = [
        'name', 'email', 'password','day'
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        //$this->notify(new AdminResetPasswordNotification($token));
    }
    public function posts(){
      //return $this->hasMany('App\Post');
    }
}
