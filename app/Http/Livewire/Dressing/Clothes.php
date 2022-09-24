<?php

namespace App\Http\Livewire\Dressing;

use App\Models\Dressing;
use Livewire\Component;

class Clothes extends Component
{
    public Dressing $dressing;


    public function render()
    {
        return view('livewire.dressing.clothes');
    }

    public function showImageBack()
    {
        $this->image_path = $this->dressing->image_back;
    }

    public function showImageFront()
    {
        $this->image_path = $this->dressing->image_front;
    }
}
