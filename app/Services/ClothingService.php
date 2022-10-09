<?php

namespace App\Services;

use App\Enums\ClothingWeatherOptions;
use App\Models\Clothing;

class ClothingService
{

    private Clothing $instance;


    public function __construct(?Clothing $instance)
    {
        $this->instance = $instance;
    }

    public static function fromEmpty(): static
    {
        return new self(new Clothing);
    }

    public function setName(?string $name): static
    {
        $this->instance->name = $name;

        return $this;
    }

    public function setDressingId(int $dressingId): static
    {
        $this->instance->dressing_id = $dressingId;

        return $this;
    }

    public function setNote(int $note): static
    {
        $this->instance->note = $note;

        return $this;
    }

    public function setCategory(int $category): static
    {
        $this->instance->category = $category;

        return $this;
    }

    public function setImageFront($image): static
    {
        $this->instance->image_front = ImageService::fromFilePond($image)
            ->optimizeForClothing()
            ->getPath();

        return $this;
    }

    public function setImageBack($image): static
    {
        $this->instance->image_back = ImageService::fromFilePond($image)
            ->optimizeForClothing()
            ->getPath();

        return $this;
    }

    public function setWeatherOptions(array $weatherOptions): static
    {
        $wo = [];
        foreach (ClothingWeatherOptions::values() as $option) {
            $wo[$option] = in_array($option, $weatherOptions, true);
        }

        $this->instance->weather_options = $wo;

        return $this;
    }

    public function setWeatherOptionsFromAssociative(array $weatherOptions): static
    {
        $wo = [];
        foreach (ClothingWeatherOptions::values() as $option) {
            $wo[$option] = array_key_exists($option, $weatherOptions) && (bool)$weatherOptions[$option];
        }

        $this->instance->weather_options = $wo;

        return $this;
    }

    public function save(): static
    {
        $this->instance->save();

        return $this;
    }

    public function getInstance(): Clothing
    {
        return $this->instance;
    }
}
