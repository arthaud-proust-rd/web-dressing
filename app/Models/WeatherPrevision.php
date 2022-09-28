<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherPrevision extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'fillable'
    ];
}
