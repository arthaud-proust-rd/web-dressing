<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Input extends Component
{
    use WithFileUploads;

    public string $title;
    public string $name;
    public string $type;
    public array $options;

    public bool $isFileLoading = false;
    public bool $isFileLoaded = false;

    public $value;

    public function mount()
    {
        $this->value = old('note');
    }

    public function render()
    {
        return view('livewire.input');
    }

}
