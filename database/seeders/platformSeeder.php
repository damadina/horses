<?php

namespace Database\Seeders;

use App\Models\platform;
use App\Models\tutorial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class platformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        platform::create([
            'title' => 'Youtube',
        ]);
        platform::create([
            'title' => 'Vimeo',
        ]);
    }
}
