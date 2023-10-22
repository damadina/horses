<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\empleado;
use App\Models\User;

class empleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->pluck('id')->toArray();
        $row_oddEven = 0;
        for ($i = 1; $i <= 4; $i++)  {
            /* ++$row_oddEven;
            if ($row_oddEven % 2 == 0) {
                continue;
            } */
            $key = array_rand($users);
            $idUser = $users[$key];

            empleado::create([
                'diaLibre' => rand(1, 7),
                'user_id' => $idUser,
            ]);
            unset($users[$idUser]);
        }




    }
}
