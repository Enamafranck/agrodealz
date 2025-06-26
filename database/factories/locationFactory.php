<?php

namespace Database\Factories;
use App\Models\Agriculteur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\location>
 */
class locationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
             'idagriculteur' => Agriculteur::inRandomOrder()->first()->idagriculteur,
            'date_debut' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'date_fin' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
