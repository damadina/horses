<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Ramsey\Collection\Collection;

class DyanmicInputs extends Component
{

    public Collection $inputs;
    public function render()
    {
        return view('livewire.dyanmic-inputs');
    }


    public function addInput()
    {
        $this->inputs->push(['email' => '']);
    }
}
