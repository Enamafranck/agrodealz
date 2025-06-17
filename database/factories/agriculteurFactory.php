<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\agriculteur>
 */
class agriculteurFactory extends Factory
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
            'nom_complet' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $password ??= Hash::make(fake()->firstName() . '123'),
            'remember_token' => Str::random(10),
            'numero_CNI' => fake()->unique()->regexify('[A-Z]{2}[0-9]{6}'), // Format: AB123456
            'telephone' => fake()->regexify('6[0-9]{8}'), // Format camerounais : 6xxxxxxxx
            'photo_CNI' => fake()->imageUrl(400, 300, 'documents', true, 'CNI'), // URL d'image factice
            'photo de la personne' => fake()->imageUrl(300, 400, 'people', true, 'Portrait'), // URL d'image factice
            'typeExploitation' => fake()->randomElement(['Agricole', 'Industrielle', 'Commerciale', 'Artisanale', 'Services']),
        ];
    }
}
