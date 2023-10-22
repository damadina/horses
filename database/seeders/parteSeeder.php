<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\parte;

class parteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        parte::factory(40)->create();
    }
}
