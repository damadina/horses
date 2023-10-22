<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Models\empleado;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vacacione>
 */
class vacacioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $userId = 0;
    public $lastElement;

    public function definition(): array
    {
        $fechasRango = [
            '01-07-2023 a 15-07-2023',
            '01-08-2023 a 15-08-2023',
            '01-09-2023 a 15-09-2023',
            '01-10-2023 a 15-10-2023',
            '01-11-2023 a 15-11-2023',
            '01-12-2023 a 15-12-2023',
        ];




        $k = array_rand($fechasRango);
        $valores = explode(' a ',$fechasRango[$k]);
        $fechas = $this->generaFechas($valores[0],$valores[1]);

        $date1 = new DateTime($fechas[0]);
        $date2 = new DateTime(end($fechas));
        $interval = $date1->diff($date2);
        $dias = $interval->days;
        $pp = empleado::all();
        $this->lastElement =($pp->count());

        return [
            'rango' => $fechasRango[$k],
            'fechaDesde' => $fechas[0],
            'fechaHasta'=> end($fechas),
            'dias' => $dias,
            'empleado_id' => $this->getEmpleado(),
        ];
    }

    public function getEmpleado() {
        if($this->userId == $this->lastElement) {
           $this->userId =0;
        }
        $this->userId = $this->userId + 1;
        return $this->userId;
    }


    public function generaFechas($desde,$hasta) {
        $start = $desde;
        $end = $hasta;
        $format ="d-m-Y";

        $fechas = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) {
            $fechas[] = $date->format($format);
        }
        return($fechas);

    }
}
