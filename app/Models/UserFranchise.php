<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserFranchise extends Model
{
    use HasFactory;

    use Notifiable;

    protected $table = 'user_franchises';

    protected $fillable = [
        'userId', '	franchiseId'
    ];

}
