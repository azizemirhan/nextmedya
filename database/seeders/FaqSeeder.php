<?php

namespace Database\Seeders;

use App\Models\Faq; // Faq modelini import ettiğinizden emin olun
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Önce mevcut verileri temizlemek isterseniz bu satırı ekleyebilirsiniz.
        // Faq::truncate();

        $faqs = [
            [
                'question' => [
                    'tr' => 'İnşaatta ticari yönetim nedir?',
                    'en' => 'What is commercial management in construction?',
                ],
                'answer' => [
                    'tr' => 'İnşaatta ticari yönetim, bir inşaat projesinin baştan sona planlanmasını, yürütülmesini ve koordinasyonunu sağlar. Bunlar genellikle satılan veya kiralanan bina veya yenileme projeleri gibi özel projeler içindir.',
                    'en' => 'Commercial management in construction ensures the planning, execution, and coordination of a construction project from the start to finish. These are often for specific projects such as building or renovation projects that are sold or leased.',
                ],
                'order' => 1,
            ],
            [
                'question' => [
                    'tr' => 'Mesleki sağlık riski yönetimi nasıl yapılır?',
                    'en' => 'Occupational Health Risk Management?',
                ],
                'answer' => [
                    'tr' => 'Mesleki sağlık riski yönetimi, iş yerindeki potansiyel tehlikeleri belirlemek, riskleri değerlendirmek ve bu riskleri ortadan kaldırmak veya kabul edilebilir seviyelere indirmek için kontrol önlemleri uygulamak amacıyla yapılan sistematik bir süreçtir.',
                    'en' => 'Occupational health risk management is a systematic process to identify potential hazards in the workplace, assess risks, and implement control measures to eliminate or reduce these risks to acceptable levels.',
                ],
                'order' => 2,
            ],
            [
                'question' => [
                    'tr' => 'Bir inşaat yönetimine nasıl başlanır?',
                    'en' => 'Start a construction management?',
                ],
                'answer' => [
                    'tr' => 'Bir inşaat yönetimine başlamak için öncelikle detaylı bir proje planı oluşturulmalı, bütçe belirlenmeli, gerekli izinler alınmalı ve doğru ekip ile tedarikçiler seçilmelidir. Süreç boyunca etkin iletişim ve kalite kontrol kritik öneme sahiptir.',
                    'en' => 'To start construction management, you must first create a detailed project plan, set a budget, obtain the necessary permits, and select the right team and suppliers. Effective communication and quality control are critical throughout the process.',
                ],
                'order' => 3,
            ],
            [
                'question' => [
                    'tr' => 'İnşaat projelerinde kalite nasıl ölçülür?',
                    'en' => 'Measure quality in construction projects?',
                ],
                'answer' => [
                    'tr' => 'Kalite, belirlenen teknik şartnamelere, standartlara ve müşteri beklentilerine uygunluk, kullanılan malzemelerin dayanıklılığı, işçilik kalitesi ve projenin zamanında ve bütçe dahilinde tamamlanması gibi kriterlerle ölçülür.',
                    'en' => 'Quality is measured by criteria such as compliance with specified technical specifications, standards, and client expectations, the durability of materials used, the quality of workmanship, and the completion of the project on time and within budget.',
                ],
                'order' => 4,
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::create($faqData);
        }
    }
}
