<?php

namespace App\Http\Livewire;
use Illuminate\Support\Carbon;
use App\Models\empleado;
use App\Models\guiaparte;
use App\Models\jornada;
use App\Models\parte;
use App\Models\trabajo;
use JeroenNoten\LaravelAdminLte\View\Components\Tool\Modal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class GestorRrhh extends Component
{
    public $modalInfo = false;
    public $empleadoActual = "ninguno";
    use WithPagination;
    public function render()
    {



        $fromFecha = "2023-08-20";
        $toFecha = "2023-09-22 ";
        $jornadas = jornada::whereBetween('dia', [$fromFecha, $toFecha])->with('trabajos')->paginate(8);

        Carbon::setLocale('es');


        //todos los trabajos de un empleado ordenado por fechas
       /*  $empleado = empleado::find(1);
        $trabajos = $empleado->trabajos()->paginate(8); */

        //todos los trabajos ordenado por fechas
        /* $fromFecha = "2023-08-20";
        $toFecha = "2023-09-22 ";
        $trabajos = trabajo::whereBetween('fecha', [$fromFecha, $toFecha])->orderBy('empleado_id')->paginate(8); */

        /* $trabajos = trabajo::all()->with('empleado')->get()->sortByDesc('empleado.id');
        dd($trabajos); */

        /* $users = User::all()->with('rated')->get()->sortByDesc('rated.rating'); */






        return view('livewire.gestor-rrhh', compact('jornadas'));
    }

    public function openModoalInfo() {
        $this->modalInfo = true;
    }

    public function closeModoalInfo() {
        $this->modalInfo = false;
    }
}
