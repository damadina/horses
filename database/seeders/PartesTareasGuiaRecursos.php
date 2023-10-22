<?php

namespace Database\Seeders;

use App\Models\catalogotrabajo;
use App\Models\categoriaparte;
use App\Models\categoriatipotrabajo;
use App\Models\categoriatrabajo;
use App\Models\empleado;
use App\Models\guiaparte;
use App\Models\jornada;
use App\Models\parte;
use App\Models\recursosparte;
use App\Models\recursotipotrabajo;
use App\Models\tarea;
use App\Models\tipotrabajo;
use App\Models\trabajo;
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
        $this->crea_tiposTrabajo();
        /* $this->crea_recursoTipoTrabajo(); */

        $fechas = $this->generaFechas("20-08-2023","15-09-2023");



        /* for ($i = 1; $i <= 200; $i++) {
            $key = array_rand($fechas);
            $fechaTrabajo = $fechas[$key];
            $this->checkIfexist($fechaTrabajo);
            $trabajo = trabajo::create([
                'title' => $this->faker->name,
                'description' => $this->faker->sentence,
                'tipotrabajo_id' => tipotrabajo::all()->random()->id,
                'empleado_id' => empleado::all()->random()->id,
                'jornada_id' => $this->checkIfexist($fechaTrabajo),
            ]);

            $title = "Trabajo de ".$trabajo->UserName;
            $trabajo->update([
                'title'=>$title,
                'description' => 'Descrripción del trabajo de '.$trabajo->UserName
            ]);
        } */

    }

    public function checkIfexist($fecha){
        $jornada = jornada::firstOrCreate(
            [ 'dia' => $fecha ],
        );

        return $jornada->id;
    }


    public function generaFechas($desde,$hasta) {
        $start = $desde;
        $end = $hasta;
        $format ="Y-m-d";

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
        for ($i = 1; $i <= 4; $i++) {
            categoriatrabajo::create([
                'title' => 'Categoria '.$i,
            ]);
        }
    }

    public function crea_tiposTrabajo() {
        for ($i = 1; $i <= 16; $i++) {
            catalogotrabajo::create([
                'title' => 'Trabajo '.$i,
                'categoriatrabajo_id' => categoriatrabajo::all()->random()->id,
            ]);
        }
    }




    public function crea_recursoTipoTrabajo() {

        for ($i = 1; $i <= 10; $i++) {
            recursotipotrabajo::create([
                'title' => $this->faker->name,
                'tipotrabajo_id' =>  tipotrabajo::all()->random()->id,
            ]);
        }
    }

}
