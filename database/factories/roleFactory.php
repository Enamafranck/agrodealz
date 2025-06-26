<?php

namespace Database\Factories;

use App\Models\role;
use Illuminate\Database\Eloquent\Factories\Factory;

class roleFactory extends Factory
{
    protected $model = role::class;

    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(['agriculteur', 'proprietaire', 'administrateur']),
        ];
    }
}
