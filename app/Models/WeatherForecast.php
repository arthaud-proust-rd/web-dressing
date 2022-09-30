<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

    protected $casts = [
        'forecast_dt' => 'datetime',
    ];

    protected $appends = [
        'date',
        'hour',
        'day_part',
        'is_rainy',
        'is_cold',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function getDateAttribute()
    {
        return $this->forecast_dt->translatedFormat('l j F');
    }

    public function getHourAttribute()
    {
        return $this->forecast_dt->translatedFormat('H');
    }

    public function getDayPartAttribute()
    {
        return $this->forecast_dt->hour<12?'Matin':'Après-Midi';
    }

    public function getDateTimeAttribute()
    {
        return $this->forecast_dt;
    }

    public function getIsRainyAttribute(): bool
    {
        return $this->precip_proba > 30;
    }

    public function getIsColdAttribute(): bool
    {
        return $this->temp < 15;
    }

    public function scopeMornig(Builder $query): Builder
    {
        return $query->where('forecast_dt', 'like', '%09:00:00');
    }

    public function scopeAfternoon(Builder $query): Builder
    {
        return $query->where('forecast_dt', 'like', '%15:00:00');
    }

}
