<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Franchise extends Authenticatable
{
    use HasFactory;

    use Notifiable;
    protected $table= "franchises";
    protected $guard = 'franchise';
  //Mass assignable attributes
    protected $fillable = [
        'name', 'email', 'password','phone'
    ];

    //hidden attributes
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user(){
            return $this->hasMany('App\User');
        }
        public function posts(){
            return $this->hasMany('App\Post');
        }
        public function sendPasswordResetNotification($token)
        {
        //$this->notify(new SellerResetPasswordNotification($token));
        }

        public function franRating(){
            return $this->hasMany('App\User');
    }
}
