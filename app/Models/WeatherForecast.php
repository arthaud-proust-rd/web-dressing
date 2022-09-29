<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherForecast extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'city',
        'fillable'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
