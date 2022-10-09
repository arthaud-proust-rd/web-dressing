<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Sopamo\LaravelFilepond\Filepond;

class ImageService
{

    private \Intervention\Image\Image $image;
    private string $optimizedImagePath;
    private \Intervention\Image\Image $optimizedImage;

    public function __construct($image)
    {
        $this->image = Image::make($image);
    }

    public static function fromFilePond(string $serverId): static
    {
        $filepond = app(Filepond::class);

        $filepondDisk = config('filepond.temporary_files_disk');

        $path = $filepond->getPathFromServerId($serverId);

        $fullpath = Storage::disk($filepondDisk)->path($path);

        return new self($fullpath);
    }

    private function store(): void
    {
        $this->optimizedImagePath = 'clothing/' . Str::uuid() . '.jpg';

        Storage::disk('public')->put($this->optimizedImagePath, $this->optimizedImage);
    }

    public function optimizeForClothing(): static
    {
        $this->optimizedImage = $this->image
            ->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');

        return $this;
    }

    public function optimize(): static
    {
        $this->optimizedImage = $this->image
            ->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');

        return $this;
    }

    public function getImage(): \Intervention\Image\Image
    {
        return $this->optimizedImage;
    }

    public function getPath(): string
    {
        $this->store();

        return $this->optimizedImagePath;
    }
}
