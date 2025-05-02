<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'slug' => $this->faker->unique()->slug(),
            'logo' => $this->faker->imageUrl(640, 480, 'business'),
            'points' => $this->faker->numberBetween(0, 100),
            'wins' => $this->faker->numberBetween(0, 50),
            'games_played' => $this->faker->numberBetween(1, 100),
        ];
    }
}
