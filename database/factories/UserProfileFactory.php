<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => User::inRandomOrder()->first()->id,
            // 'user_id' => User::factory(),
            'user_id' => null,
            'nik' => fake()->numerify('################'),
            'phone_number' => fake()->numerify('#############'),
            'address' => fake()->address(),
            'date_of_birth' => fake()->date()
        ];
    }
}
