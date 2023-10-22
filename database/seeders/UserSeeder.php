<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Carlos Marti',
            'email' => 'carlos.marti.mallen@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole(['Admin','GestorRRHH']);
        /* $user->assingRole('GestorRRHH'); */

        User::factory(6)->create();
    }
}
