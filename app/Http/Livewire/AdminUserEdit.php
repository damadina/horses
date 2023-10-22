<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\empleado;
use App\Models\vacacione;
use Illuminate\Queue\Listener;
use Illuminate\Database\Eloquent\Collection;
use DatePeriod;
use DateTime;
use DateInterval;

class AdminUserEdit extends Component
{
    public $totalDiasVacaciones;
    public $roles=[];
    public $user;
    public $vacaciones;
    public $vacacionesRemove = array();
    public $nueva;
    public $listaRoles;
    public $nuevo;
    public $diaLibre;
    public $updated = false;




    protected $listeners = ['changeRange','actualizaDiasVacaciones','clickTrash'];

    public function mount(user $user) {
        $this->user = $user;
        $this->roles = $this->user->roles->pluck('id');
        $this->listaRoles = Role::all();
        $this->diaLibre = $user->empleado->diaLibre;

        if($user->empleado->vacaciones) {
            $this->vacaciones = $user->empleado->vacaciones()->get()->toArray();
            $newArray = array();
            foreach($this->vacaciones as $each) {
                $each['updated'] = false;
                array_push($newArray,$each);
            }
            $this->vacaciones = $newArray;
        }

        $this->nuevo = array( "id" => 9999,
                        "rango" => null,
                        'updated' => true,
                        "empleado_id" => $this->user->empleado->id );
        $this->insertar_nuevo();



    }

    public function render()
    {

        return view('livewire.admin-user-edit');
    }


    public function clickTrash($key) {

        array_push($this->vacacionesRemove, $this->vacaciones[$key]);
        unset($this->vacaciones[$key]);
        $this->insertar_nuevo();
    }

    public function actualizaDiasVacaciones($dias) {

        $this->totalDiasVacaciones = $dias;
    }

    public function updatedDiaLibre() {

    }
    public function changeRange($fecha, $key, $start, $end) {

        /* $fecha1= new DateTime($start);
        $fecha2= new DateTime($end);
        $diff = $fecha1->diff($fecha2);
        $dias = $diff->days + 1;

 */

        if($this->vacaciones[$key]['id']==9999) {
            $this->vacaciones[$key]['id']=8888;
        }

        $this->vacaciones[$key]['rango'] = $fecha;
        $this->vacaciones[$key]['updated'] = true;

        $this->vacaciones[$key]['empleado_id'] = $this->user->empleado->id;
        $this->insertar_nuevo();


    }

    public function insertar_nuevo() {
        $existe = false;
        foreach($this->vacaciones as $each) {
            if($each['id'] == 9999) {
                $existe = true;
            }

        }
        if($existe == false) {
            array_unshift($this->vacaciones, $this->nuevo);
        }
        $this->emit('nuevoDatePiker');
    }
    public function actualizar() {
        $this->user->roles()->sync($this->roles);
        $this->user->empleado()->update(['diaLibre' => $this->diaLibre]);

        foreach($this->vacaciones as $each) {
            switch ($each['id']) {
                case 9999:
                    break;
                case 8888:
                    $diasRange = explode(' a ',$each['rango']);
                    $fecha1 = new DateTime($diasRange[0]);
                    $fecha2 = new DateTime(end($diasRange));
                    $totalDias = $fecha2->diff($fecha1)->format("%a");

                    vacacione::create([
                        'rango' => $each['rango'],
                        'fechaDesde' => $diasRange[0],
                        'fechaHasta' => end($diasRange),
                        'dias' => $totalDias,
                        'empleado_id' => $this->user->empleado->id,
                    ]);

                    $this->updated = true;
                    break;
                default:
                    if($each['updated'] == false) {
                        break;
                    }
                    $diasRange = explode(' a ',$each['rango']);
                    $fecha1 = new DateTime($diasRange[0]);
                    $fecha2 = new DateTime(end($diasRange));
                    $totalDias = $fecha2->diff($fecha1)->format("%a");
                    $vacione = vacacione::find($each['id']);
                    $vacione->update([
                        'rango' => $each['rango'],
                        'fechaDesde' => $diasRange[0],
                        'fechaHasta' => end($diasRange),
                        'dias' => $totalDias,
                        'empleado_id' => $this->user->empleado->id,
                    ]);
                    $this->updated = true;

            }
        }
        foreach($this->vacacionesRemove as $each) {
            $vacione = vacacione::find($each['id']);
            $vacione->delete();
            $this->updated = true;

        }

        if ($this->updated) {
            return redirect()->route('admin.users.index')->with(['info' => 'Los datos de empleado se han actualizado correctamente']);
        } else {
            return redirect()->route('admin.users.index');
        }

    }
    public function cancelar() {
        return redirect()->route('admin.users.index');
    }
    function getRangeDate($date_ini, $date_end, $format) {

        $dt_ini = DateTime::createFromFormat($format, $date_ini);
        $dt_end = DateTime::createFromFormat($format, $date_end);
        $period = new DatePeriod(
            $dt_ini,
            new DateInterval('P1D'),
            $dt_end,
        );
        $range = [];
        foreach ($period as $date) {
            $range[] = $date->format($format);
        }
        $range[] = $date_end;
        return $range;
    }

}
