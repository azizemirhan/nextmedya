<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'website' => 'https://' . fake()->domainName(),
            'industry' => fake()->randomElement(['Teknoloji', 'Finans', 'Sağlık', 'E-ticaret', 'Danışmanlık']),
            'lifecycle_stage' => fake()->randomElement(['lead', 'customer', 'partner']),
            'status' => fake()->randomElement(['active', 'prospect']),
            'owner_id' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
