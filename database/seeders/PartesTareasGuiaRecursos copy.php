<?php

namespace Database\Seeders;

use App\Models\categoriaparte;
use App\Models\categoriatipotrabajo;
use App\Models\empleado;
use App\Models\guiaparte;
use App\Models\parte;
use App\Models\recursosparte;
use App\Models\tarea;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;
use DateInterval;
use DatePeriod;
use Faker\Factory as Faker;
use Faker\Generator;

class PartesTareasGuiaRecursos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $faker;
    public function run(): void
    {
        $this->faker = app(Generator::class);

        $this->crea_categorias();



        $fechas = $this->generaFechas("20-08-2023","15-09-2023");

        $users = user::all();

        foreach($users as $user)
        {
            if(!$user->empleado) {
                continue;
            }

            $key = array_rand($fechas);
            $fechaParte = $fechas[$key];

            $parte = parte::create([
                'fecha' => $fechaParte,
                'title' => $this->faker->name,
                'categoriaparte_id' =>  categoriaparte::all()->random()->id,
            ]);

            for ($i = 1; $i <= 3; $i++) {
                $empleado = empleado::all()->random();
                tarea::create([
                    'title' => $this->faker->name,
                    'description' => $this->faker->sentence(),
                    'parte_id' => $parte->id,
                    'user_id' => $empleado->user->id,
                ]);

            }

        }

        $this->crea_guiaParte();
        $this->crea_recursoParte();



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


    public function crea_categorias() {
        for ($i = 1; $i <= 6; $i++) {
            categoriatipotrabajo::create([
                'title' => $this->faker->name,
            ]);
        }
    }

    public function crea_recursoParte() {
        $videos = [
            'https://www.youtube.com/watch?v=yYQ9CI_kUww',
            'https://youtu.be/-4fNi9HZYsg',
            'https://youtu.be/qHrHovci1qA'
        ];

        for ($i = 1; $i <= 20; $i++) {
            $key = array_rand($videos);
            $url = $videos[$key];
            recursosparte::create([
                'title' => $this->faker->name,
                'url' => $url,
                'type' => 'youtube',
                'parte_id' =>  parte::all()->random()->id,
            ]);
        }
    }

}
