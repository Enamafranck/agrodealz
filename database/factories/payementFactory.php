<?php

namespace Database\Factories;

use App\Models\payement;
use App\Models\Agriculteur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\payement>
 */
class payementFactory extends Factory
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
            
            'idagriculteur' => agriculteur::inRandomOrder()->first()->idagriculteur,
            'montantpaye' => $this->faker->randomFloat(2, 300000, 150000), // Montant entre 5000 et 50000 avec 2 décimales
            'datepayement' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
