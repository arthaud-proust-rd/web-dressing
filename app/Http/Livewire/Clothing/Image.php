<?php

namespace App\Http\Livewire\Clothing;

use App\Models\Clothing;
use Livewire\Component;

class Image extends Component
{
    public Clothing $clothing;

    public string $displayed_image = 'front';

    public function render()
    {
        return view('livewire.clothing.image');
    }

    public function toggleDisplayedImage(): void
    {
        $this->displayed_image = $this->displayed_image==="front"?"back":"front";
    }
}
