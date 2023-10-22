<?php

namespace App\Http\Livewire\GestorTrabajos;

use App\Models\recurso;
use Livewire\Component;
use App\Models\trabajo;
use Illuminate\Auth\Events\Validated;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class TrabajoRecurso extends Component
{
    use WithFileUploads;
    public $trabajo;
    public $recurso;
    public $title;
    public $file;

    public function mount(trabajo $trabajo) {
        $this->trabajo = $trabajo;
        $this->recurso = new recurso();

    }
    public function render()
    {
        return view('livewire.gestor-trabajos.trabajo-recurso');
    }

    public function save() {
       $this->validate([
        'title' => 'required',
        'file' => 'required|mimes:pdf'
       ]);
       $url = $this->file->store('resources');

       recurso::create([
        'title' => $this->title,
        'url' => $url,
        'trabajo_id' => $this->trabajo->id,
       ]);
       $this->trabajo = trabajo::find($this->trabajo->id);
    }

    public function download(recurso $recurso) {

        return response()->download(storage_path('app/'.$recurso->url));
    }

    public function destroy(recurso $recurso) {
        Storage::delete($recurso->url);
        $recurso->delete();
        $this->trabajo = trabajo::find($this->trabajo->id);
    }
}
