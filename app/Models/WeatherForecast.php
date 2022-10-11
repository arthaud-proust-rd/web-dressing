<?php

namespace App\Models;

use App\Enums\WeatherForecastDayPart;
use Illuminate\Database\Eloquent\Builder;
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
        'day_part' => WeatherForecastDayPart::class
    ];

    protected $appends = [
        'date',
        'hour',
        'day_part_string',
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

    public function getDayPartStringAttribute(): string
    {
        return $this->day_part->toString();
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
        return $query->where('day_part', WeatherForecastDayPart::MORNING);
    }

    public function scopeAfternoon(Builder $query): Builder
    {
        return $query->where('day_part', WeatherForecastDayPart::AFTERNOON);
    }
}
