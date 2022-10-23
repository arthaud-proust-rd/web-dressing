<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyClothingImageRequest;
use App\Http\Requests\UpsertClothingImageRequest;
use App\Services\ClothingImageService;
use Illuminate\Support\Facades\Storage;

class ClothingImageController extends Controller
{
    public function store(UpsertClothingImageRequest $request): string
    {
        return ClothingImageService::optimize($request->image)
            ->getPath();
    }

    public function update(UpsertClothingImageRequest $request): string
    {
        return ClothingImageService::optimize($request->image)
            ->getPath();
    }

    public function destroy(DestroyClothingImageRequest $request)
    {
        if (!Storage::disk('public')->exists($request->image_path)) {
            abort(404);
        }

        Storage::disk('public')->delete($request->image_path);
    }
}
