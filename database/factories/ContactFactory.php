<?php

// database/factories/ContactFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    // database/factories/ContactFactory.php
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'job_title' => $this->faker->jobTitle,
            'department' => $this->faker->word,

            // !!! BUNLARI EKLEME !!!
            // 'primary_email' => $this->faker->unique()->safeEmail,
            // 'primary_phone' => $this->faker->phoneNumber,

            'emails' => [
                ['label' => 'iş', 'value' => $this->faker->unique()->safeEmail],
                ['label' => 'kişisel', 'value' => $this->faker->safeEmail],
            ],
            'phones' => [
                ['label' => 'cep', 'number' => $this->faker->phoneNumber],
                ['label' => 'ofis', 'number' => $this->faker->phoneNumber],
            ],
            'addresses' => [
                ['label' => 'ev', 'line1' => $this->faker->streetAddress, 'city' => $this->faker->city],
            ],
            'socials' => [
                ['label' => 'linkedin', 'value' => 'https://linkedin.com/in/' . $this->faker->userName],
            ],
            'custom_fields' => [
                ['key' => 'kaynak', 'value' => $this->faker->randomElement(['web', 'referans'])],
            ],
            'is_decision_maker' => $this->faker->boolean,
            'consent_email' => $this->faker->boolean,
            'consent_sms' => $this->faker->boolean,
            'score' => $this->faker->numberBetween(0, 100),
        ];
    }

}
