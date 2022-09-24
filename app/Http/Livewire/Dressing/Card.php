<?php

namespace App\Http\Livewire\Dressing;

use Livewire\Component;
use App\Models\Dressing;

class Card extends Component
{
    public Dressing $dressing;
    public function render()
    {
        return view('livewire.dressing.card');
    }
}
