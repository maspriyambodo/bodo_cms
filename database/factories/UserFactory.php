<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'role' => $this->faker->numberBetween(1, 8), // Assuming roles are between 1 and 3
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'pict' => 'src/media/avatars/blank.png', // Default image
            'email_verified_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'password' => bcrypt('password'), // Default password
            'remember_token' => Str::random(10),
            'is_trash' => $this->faker->boolean(20), // 20% chance of being 'deleted'
            'created_at' => now(),
            'created_by' => null, // You can set this to a specific user ID if needed
            'updated_at' => now(),
            'updated_by' => null, // You can set this to a specific user ID if needed
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static {
        return $this->state(fn(array $attributes) => [
                    'email_verified_at' => null,
        ]);
    }
}
