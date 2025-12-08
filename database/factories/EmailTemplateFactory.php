<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailTemplateFactory extends Factory
{
    public function definition(): array
    {
        // Random variable name, misal: name, amount, date, status, code
        $variable = fake()->randomElement(['name', 'amount', 'date', 'status', 'code', 'invoice']);

        return [
            'name' => fake()->sentence(3),
            'subject' => fake()->sentence(),
            'body' => fake()->paragraph() . "\n\nVariable preview: {{ $variable }}",
        ];
    }
}
