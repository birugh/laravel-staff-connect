<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => $this->faker->numberBetween(1, 4),
            'receiver_id' => $this->faker->numberBetween(1, 4),
            'subject' => $this->faker->sentence(1),
            'sent' => $this->faker->dateTimeBetween('now', '+7 days'),
            'body' => $this->faker->paragraph(),
        ];
    }
}
