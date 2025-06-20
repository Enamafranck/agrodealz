<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_complet' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make(fake()->firstName() . '123'),
            'remember_token' => Str::random(10),
            'numero_CNI' => fake()->unique()->regexify('[A-Z]{2}[0-9]{6}'), // Format: AB123456
            'telephone' => fake()->regexify('6[0-9]{8}'), // Format camerounais : 6xxxxxxxx
            'photo_CNI' => fake()->imageUrl(400, 300, 'documents', true, 'CNI'), // URL d'image factice
            'photo de la personne' => fake()->imageUrl(300, 400, 'people', true, 'Portrait'), // URL d'image factice
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
