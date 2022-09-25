<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithFileUploads;

class Input extends Component
{
    use WithFileUploads;

    public string $title;
    public string $name;
    public string $type;
    public array $options;
    public Model $bind;

    public bool $isFileLoading = false;
    public bool $isFileLoaded = false;

    public $value;

    public function mount($name, $value=null, $bind=null)
    {
        if($value!==null) {
            return;
        }
        if($bind) {
            $this->value = old($name)?old($name):$bind[$name];
        } else {
            $this->value = old($name);
        }
    }

    public function render()
    {
        return view('livewire.input');
    }

}
