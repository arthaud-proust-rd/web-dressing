<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class OptimizedImage
{

    public static function getPath($requestFile): ?string
    {
        if(self::isEmptyRequestFile($requestFile))
        {
            return null;
        }

        return self::getOptimizedAndStoreSImage($requestFile);
    }

    private static function isEmptyRequestFile($requestFile): bool
    {
        return !$requestFile;
    }

    private static function getOptimizedAndStoreSImage($requestFile): string
    {
        $image = self::getOptimizedImage($requestFile);

        return self::storeOptimizedImage($image);
    }

    private static function getOptimizedImage($requestFile): \Intervention\Image\Image
    {
        return Image::make($requestFile)
            ->resize(1000, null, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg');
    }

    private static function storeOptimizedImage(\Intervention\Image\Image $image): string
    {
        $path = 'clothing/' . Str::uuid() . '.jpg';
        Storage::disk('public')->put( $path, $image);

        return $path;
    }
}
