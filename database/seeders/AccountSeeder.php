<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        // Örnek olarak 50 adet şirket oluşturalım
        Account::factory(50)->create();
    }
}
