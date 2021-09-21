<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseRatings extends Model
{
    use HasFactory;

    protected $table = 'franchise_ratings';
    protected $fillable = [
        'franchiseId','userId','rating','review'
    ];
}
