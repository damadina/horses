<?php

namespace Database\Seeders;

use App\Models\trabajo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class trabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        trabajo::factory(20)->create();
    }
}
