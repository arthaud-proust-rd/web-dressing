<?php

namespace App\Http\Livewire\Dressing;

use App\Models\Dressing;
use Livewire\Component;

class Weather extends Component
{
    public Dressing $dressing;

    public function render()
    {
        return view('livewire.dressing.weather');
    }
}
