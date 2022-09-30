<?php

namespace App\Models;

use App\Enums\ClothingCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function getClothesCategoriesStatsAttribute(): array
    {
        $stats = [];
        foreach (ClothingCategory::cases() as $category)
        {
            $stats[] = [
                'class' => $category,
                'count' => $this->clothes()->category($category)->count()
            ];
        }
        return $stats;
    }
}
