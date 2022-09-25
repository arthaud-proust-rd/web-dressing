<?php

namespace App\Models;

use App\Enums\ClothingCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clothing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'note',
        'category',
        'image_front',
        'image_back',
    ];

    public function dressing(): BelongsTo
    {
        return $this->belongsTo(Dressing::class);
    }

    public function getImage($image): ?string
    {
        return match ($image) {
            "front" => $this->image_front,
            "back" => $this->image_back,
            default => null,
        };
    }

    public function scopeCategory($query, ClothingCategory $category)
    {
        return $query->where('category', $category->value);
    }

    public function scopeCategoryInt($query, int $category)
    {
        return $query->where('category', $category);
    }
}
