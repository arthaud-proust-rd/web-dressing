<?php

namespace App\Http\Livewire\Clothing;

use App\Models\Clothing;
use Livewire\Component;

class Card extends Component
{
    public Clothing $clothing;

    public function render()
    {
        return view('livewire.clothing.card');
    }
}
