<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithFileUploads;

class Input extends Component
{
    use WithFileUploads;

    public string $title;
    public string $property;
    public string $name;
    public string $type;
    public array $options;
    public ?Model $bind;

    public ?string $nestedIn;

    public $value;

    public function mount($property, $bind=null, $nestedIn=null, $value=null)
    {
        $this->property = $property;
        $this->bind = $bind;
        $this->nestedIn = $nestedIn;
        $this->name = $nestedIn ? "${nestedIn}[${property}]" : $this->property;

        $this->defineValueFromDefault($value);
    }

    private function getBindPropertyValue(): mixed
    {
        return $this->nestedIn? $this->bind[$this->nestedIn][$this->property] : $this->bind[$this->property];
    }

    private function defineValueFromDefault($value): void
    {
        if($value!==null) {
            $this->value = $value;
            return;
        }

        if($this->bind) {
            $this->value = $this->getBindPropertyValue();
        }

        if (old($this->property)) {
            $this->value = old($this->property);
        }
    }

    public function render()
    {
        return view('livewire.input');
    }

}
