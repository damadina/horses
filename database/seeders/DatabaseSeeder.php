<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\catalogotrabajo;
use App\Models\empleado;
use App\Models\platform;
use App\Models\videotrabajo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);


        $this->call(empleadoSeeder::class);
        $this->call(userEmpleadoVacacionesSeeder::class);
        /* $this->call(PartesTareasGuiaRecursos::class);
 */
        $this->call(trabajoSeeder::class);
        $this->call(platformSeeder::class);
        $this->call(tutorialSeeder::class);
        $this->call(recursoSeeder::class);



    }
}
