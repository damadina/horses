<?php

namespace App\Http\Livewire\Gestor;

use Livewire\Component;

class MasterCrea extends Component
{
    public function render()
    {
        return view('livewire.gestortrabajos.master-crea')->layout('layouts.gestor');
    }
}
