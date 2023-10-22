<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Models\empleado;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class entradasalidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public $fechas;
    public function definition(): array
    {
        $this->generaFechas();
        return [
            'fecha' => $this->fechas[array_rand($this->fechas,1)],
            'entrada' => "08:00",
            'salida' => "22:00",
            'empleado_id' => empleado::all()->random()->id,
        ];
    }

    public function generaFechas() {
        $start = "2023-09-01";
        $end = "2023-09-19";
        $format ="Y-m-d";

        $fechas = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) {
            $fechas[] = $date->format($format);
        }
        $this->fechas = $fechas;

    }
}
