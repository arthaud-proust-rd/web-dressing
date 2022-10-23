<?php

namespace App\Models;

use App\Enums\ClothingCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clothing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'dressing_id',
        'note',
        'category',
        'images',
        'image_front',
        'image_back',
        'weather_options'
    ];

    protected $casts = [
        'dressing_id' => 'int',
        'images' => 'array',
        'weather_options' => 'array'
    ];

    public function dressing(): BelongsTo
    {
        return $this->belongsTo(Dressing::class);
    }

    public function scopeCategory($query, ClothingCategory $category)
    {
        return $query->where('category', $category->value);
    }

    public function scopeCategoryInt($query, int $category)
    {
        return $query->where('category', $category);
    }

    public function scopeWeatherOptions($query, array $options)
    {
        $q = $query;
        foreach ($options as $option => $value) {
            $q = $query->where('weather_options->' . $option, $value);
        }
        return $q;
    }

}
