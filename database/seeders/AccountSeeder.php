<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('tr_TR');

        // Eğer user yoksa bir tane admin oluştur
        $owner = User::first() ?? User::factory()->create([
            'name' => 'Admin Kullanıcı',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        foreach (range(1, 20) as $i) {
            $companyName = $faker->company;

            Account::create([
                'name' => $companyName,
                'legal_name' => $companyName.' Tic. Ltd. Şti.',
                'website' => $faker->url,
                'tax_number' => $faker->numerify('##########'),
                'registration_no' => $faker->numerify('#######'),

                'emails' => [
                    ['value' => $faker->companyEmail, 'label' => 'work', 'primary' => true],
                    ['value' => 'info@'.$faker->domainName, 'label' => 'info'],
                ],
                'phones' => [
                    ['country' => '+90', 'number' => '5'.$faker->numerify('3########'), 'label' => 'mobile', 'primary' => true],
                    ['country' => '+90', 'number' => $faker->phoneNumber, 'label' => 'office'],
                ],
                'addresses' => [
                    [
                        'type' => 'hq',
                        'lines' => [$faker->streetAddress],
                        'city' => $faker->city,
                        'country' => 'TR',
                        'zip' => $faker->postcode,
                    ],
                ],
                'socials' => [
                    'linkedin' => 'https://linkedin.com/company/'.str_replace(' ', '', strtolower($companyName)),
                    'instagram' => 'https://instagram.com/'.$faker->userName,
                ],
                'custom_fields' => [
                    'crm_code' => 'AC-'.strtoupper($faker->bothify('##??')),
                    'tier' => $faker->randomElement(['Gold', 'Silver', 'Bronze']),
                ],

                'industry' => $faker->randomElement(['Yazılım', 'İnşaat', 'Perakende', 'Finans', 'Sağlık']),
                'employee_count' => $faker->numberBetween(10, 500),
                'annual_revenue' => $faker->numberBetween(1_000_000, 50_000_000),
                'lifecycle_stage' => $faker->randomElement(['lead', 'customer', 'partner', 'vendor']),
                'status' => $faker->randomElement(['active', 'inactive', 'prospect', 'churned']),
                'score' => $faker->numberBetween(0, 100),
                'source' => $faker->randomElement(['webform', 'referans', 'ads', 'outbound']),

                'owner_id' => $owner->id,
                'last_contacted_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'next_activity_at' => $faker->dateTimeBetween('now', '+3 months'),
                'internal_notes' => $faker->sentence(8),
            ]);
        }
    }
}
