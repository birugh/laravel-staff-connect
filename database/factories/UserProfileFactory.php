<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    public function definition(): array
    {
        $img = 'profiles/unsplash-profile' . fake()->numberBetween(1, 15) . '.png';

        return [
            'user_id' => null,
            'nik' => fake()->numerify('################'),
            'phone_number' => fake()->numerify('#############'),
            'address' => fake()->address(),
            'date_of_birth' => fake()->date(),
            'profile_path' => $img,
        ];
    }
}
