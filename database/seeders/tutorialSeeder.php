<?php

namespace Database\Seeders;

use App\Models\tutorial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tutorial::factory(40)->create();
    }
}
