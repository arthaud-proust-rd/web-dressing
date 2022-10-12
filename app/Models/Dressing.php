<?php

namespace App\Models;

use App\Enums\ClothingCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dressing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $casts = [
        'user_id' => 'int',
    ];

    protected $with = [
        'city.weatherForecasts',
        'clothes',
    ];

    protected $appends = [
        'clothes_categories_stats',
        'weather_suggestions'
    ];

    public function clothes(): HasMany
    {
        return $this->hasMany(Clothing::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function getWeatherSuggestionsAttribute(): array
    {
        $suggestions = [];

        foreach ($this->city->weatherForecasts as $weatherForecast) {
            $weatherOptions = [];
            $weatherOptions[$weatherForecast->isRainy ? 'rainy' : 'dry'] = true;
            $weatherOptions[$weatherForecast->isCold ? 'cold' : 'hot'] = true;

            $suggestions[] = $this
                ->clothes()
                ->weatherOptions($weatherOptions)
                ->pluck('id');
        }


        return $suggestions;
    }

    public function getClothesCategoriesStatsAttribute(): array
    {
        $stats = [];
        foreach (ClothingCategory::cases() as $category) {
            $stats[] = [
                'name' => $category->toString(),
                'count' => $this->clothes()->category($category)->count()
            ];
        }
        return $stats;
    }
}
