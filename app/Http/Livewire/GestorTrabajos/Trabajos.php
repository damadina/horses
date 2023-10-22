<?php

namespace App\Http\Livewire\GestorTrabajos;

use App\Models\platform;
use App\Models\recurso;
use App\Models\trabajo;
use App\Models\tutorial;
use App\Models\videotrabajo;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Livewire\WithPagination;


class Trabajos extends Component
{
    use WithPagination;
    /* public $tiposTrabajo; */
    public $trabajo, $title;
    public $search;
    public $modalOn = false;
    public $horas = 0;
    public $minutos = 0;
    public $tiempoEstimado = 0;
    public $rules = [
        'trabajo.title' => 'required',
        'tiempoEstimado' => 'bail|required|numeric|gt:0',
    ];


    public function mount() {
        $this->trabajo = new trabajo();
    }


    public function render()
    {

        $tiposTrabajo = trabajo::where('title','LIKE','%'.$this->search.'%')
        ->orderBy('created_at','desc')
        ->with(['videos'])->paginate(8);


        /* $tiposTrabajo = catalogotrabajo::paginate(8); */

        return view('livewire.GestorTrabajos.catalogo-trabajos',compact('tiposTrabajo'))->layout('layouts.gestor');
    }

    public function edit(trabajo $trabajo) {
        $this->trabajo = $trabajo;
        $this->horas= $this->trabajo->horas;
        $this->minutos= $this->trabajo->minutos;
    }
    public function update() {
        $this->tiempoEstimado = $this->horas + $this->minutos;
        $this->trabajo->tiempoEstimado = $this->tiempoEstimado;

        $this->validate();
        $this->trabajo->save();
        $this->trabajo = new trabajo();
    }

    public function cancelUpdate() {
        $this->trabajo = new trabajo();
    }
     public function saveTrabajo() {

        $this->validate([
            'title' => 'required',
            'tiempoEstimado' => 'bail|required|numeric|gt:0',

        ]);
        trabajo::create([
            'title' => $this->title,
            'tiempoEstimado' => $this->tiempoEstimado,
        ]);
        $this->reset(['title']);
        $this->modalOn = false;
        $this->render();

     }
     public function limpiar_page() {
        $this->resetPage();
    }
    public function openModal() {
        $this->resetValidation();
        $this->modalOn = true;
        $this->reset('horas','minutos','title','tiempoEstimado');
    }

    public function updatedHoras($value)
    {
        $this->tiempoEstimado = $this->horas + $this->minutos;
    }
    public function updatedMinutos($value)
    {
        $this->tiempoEstimado = $this->horas + $this->minutos;
    }

    public function segundos_tiempo($segundos) {

        $minutos = $segundos / 60;
        $horas = floor($minutos / 60);
        $minutos2 = $minutos % 60;


        $segundos_2 = $segundos % 60 % 60 % 60;
        if ($minutos2 < 10)
            $minutos2 = '0'.$minutos2;

        if ($segundos_2 < 10)
            $segundos_2 = '0'.$segundos_2;

        if ($segundos < 60) { /* segundos */
            $resultado = round($segundos).' Segundos';
        }
        elseif($segundos > 60 && $segundos < 3600) { /* minutos */
            $resultado = $minutos2
                .':'
                .$segundos_2
                .' Minutos';
        } else { /* horas */
            $resultado = $horas . ':' . $minutos2 ;
        }

        if($resultado == '0 Segundos') {
            $resultado ="";
        }

        return $resultado;
    }


}
