<?php

namespace Database\Factories;

use App\Models\trabajo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\videotrabajo>
 */
class tutorialFactory extends Factory
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
            'url' => 'https://youtu.be/qHrHovci1qA',
            'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/qHrHovci1qA?si=UQrsh2DPJuEtZrHI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            'platform_id' => 1,
            'trabajo_id' => trabajo::all()->random()->id
        ];
    }
}
