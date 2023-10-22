<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trabajo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //Relacion uno a muchos
    public function videos() {
        return $this->hasMany(tutorial::class);
    }

    public function recursos() {
        return $this->hasMany(recurso::class);
    }


    public function gethorasAttribute() {
        if ($this->tiempoEstimado == 0) {
            return 0;
        }
        $tiempo = $this->segundos_tiempo($this->tiempoEstimado);
        $result = explode(':',$tiempo);
        return $result[0]*60*60;
    }

    public function getminutosAttribute() {
        if ($this->tiempoEstimado == 0) {
            return 0;
        }
        $tiempo = $this->segundos_tiempo($this->tiempoEstimado);
        $result = explode(':',$tiempo);
        return $result[1]*60;
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
