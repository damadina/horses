<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\empleado;
use App\Models\vacacione;
use DateTime;
use DateInterval;
use DatePeriod;
use Faker\Factory as Faker;

class userEmpleadoVacacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $faker;
    public function run(): void
    {
        $this->faker = Faker::create();
        $vacaciones = [
            '01-07-2023 a 15-07-2023',
            '01-08-2023 a 15-08-2023',
            '01-09-2023 a 15-09-2023',
            '01-10-2023 a 15-10-2023',
            '01-11-2023 a 15-11-2023',
            '01-12-2023 a 15-12-2023',
        ];

        $totalUsuarios = User::all();
        $row_oddEven = 0;
        foreach ($totalUsuarios as $usuario) {
            ++$row_oddEven;
            if ($row_oddEven % 2 == 0) {
                continue;
            }

            $usuario->update(['userType' => 2]);

            $empleado = empleado::create([
                'dialibre' => rand(1, 7),
                'bio' => $this->faker->paragraph(),
                'website' => $this->faker->sentence(),
                'facebook' => $this->faker->sentence(),
                'linkedin' => $this->faker->sentence(),
                'instagran' => $this->faker->sentence(),
                'user_id' => $usuario->id,

            ]);


            // UN rango de vacaciones
            $k = array_rand($vacaciones);
            $valores = explode(' a ',$vacaciones[$k]);
            $fechas = $this->generaFechas($valores[0],$valores[1]);

            $date1 = new DateTime($fechas[0]);
            $date2 = new DateTime(end($fechas));
            $interval = $date1->diff($date2);
            $dias = $interval->days;


            vacacione::create([
                'rango' => $vacaciones[$k],
                'fechaDesde' => $fechas[0],
                'fechaHasta' => end($fechas),
                'dias' => $dias,
                'empleado_id' => $empleado->id,

            ]);

            // Otro Rango de vacaciones
            $k = array_rand($vacaciones);
            $valores = explode(' a ',$vacaciones[$k]);
            $fechas = $this->generaFechas($valores[0],$valores[1]);

            $date1 = new DateTime($fechas[0]);
            $date2 = new DateTime(end($fechas));
            $interval = $date1->diff($date2);
            $dias = $interval->days;


            vacacione::create([
                'rango' => $vacaciones[$k],
                'fechaDesde' => $fechas[0],
                'fechaHasta' => end($fechas),
                'dias' => $dias,
                'empleado_id' => $empleado->id,

            ]);

            // Otro Más Rango de vacaciones
            $k = array_rand($vacaciones);
            $valores = explode(' a ',$vacaciones[$k]);
            $fechas = $this->generaFechas($valores[0],$valores[1]);

            $date1 = new DateTime($fechas[0]);
            $date2 = new DateTime(end($fechas));
            $interval = $date1->diff($date2);
            $dias = $interval->days;


            vacacione::create([
                'rango' => $vacaciones[$k],
                'fechaDesde' => $fechas[0],
                'fechaHasta' => end($fechas),
                'dias' => $dias,
                'empleado_id' => $empleado->id,

            ]);





        }


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
