<?php

namespace Database\Seeders;

use App\Models\recurso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class recursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        recurso::factory(50)->create();

    }
}
