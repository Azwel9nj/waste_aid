<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseZone extends Model
{
    use HasFactory;

    protected $table = 'franchise_zones';
    protected $fillable = [
        'zoneId','franchiseId'
    ];
}
