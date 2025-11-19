<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('team_members')->insert([
            [
                'name' => json_encode(['tr' => 'Tuncay Öztürk', 'en' => 'Tuncay Ozturk']),
                'position' => json_encode(['tr' => 'Yönetim Kurulu Başkanı', 'en' => 'Chairman of the Board']),
                'photo' => 'https://placehold.co/275x430',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => 'https://twitter.com',
                'linkedin_url' => 'https://linkedin.com',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['tr' => 'Ayşe Yılmaz', 'en' => 'Ayse Yilmaz']),
                'position' => json_encode(['tr' => 'Baş Mimar', 'en' => 'Chief Architect']),
                'photo' => 'https://placehold.co/275x430',
                'facebook_url' => null,
                'twitter_url' => null,
                'linkedin_url' => 'https://linkedin.com',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['tr' => 'Ahmet Kaya', 'en' => 'Ahmet Kaya']),
                'position' => json_encode(['tr' => 'Proje Müdürü', 'en' => 'Project Manager']),
                'photo' => 'https://placehold.co/275x430',
                'facebook_url' => null,
                'twitter_url' => 'https://twitter.com',
                'linkedin_url' => 'https://linkedin.com',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['tr' => 'Fatma Vural', 'en' => 'Fatma Vural']),
                'position' => json_encode(['tr' => 'Finans Departmanı', 'en' => 'Finance Department']),
                'photo' => 'https://placehold.co/275x430',
                'facebook_url' => null,
                'twitter_url' => null,
                'linkedin_url' => null,
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
