<?php

namespace Database\Factories;

use App\Models\trabajo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\recursotrabajo>
 */
class recursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'url' => "url",
            'trabajo_id' =>  trabajo::all()->random()->id,
        ];
    }
}
