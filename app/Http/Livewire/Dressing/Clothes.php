<?php

namespace App\Http\Livewire\Dressing;

use App\Models\Dressing;
use Livewire\Component;

class Clothes extends Component
{
    public $categories;

    public Dressing $dressing;

    public bool $areFiltersVisible = false;

    public string $orderBy = 'created_at:desc';

    public string $view = "list";

    public function render()
    {
        return view('livewire.dressing.clothes');
    }

    public function toggleFiltersVisibility(): void
    {
        $this->areFiltersVisible = !$this->areFiltersVisible;
    }

    public function filteredClothes()
    {
        [$orderByColumn, $orderByValue] = explode(':', $this->orderBy);

        return $this->dressing->clothes()
            ->orderBy($orderByColumn, $orderByValue);
    }

    public function setView(string $view): void
    {
        $this->view = $view;
    }
}
