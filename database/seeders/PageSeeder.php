<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $existingPage = Page::where('slug', 'anasayfa')->first();
        if ($existingPage) {
            $existingPage->sections()->delete();
            $existingPage->forceDelete();
        }
        PageSection::truncate();

        $homepage = Page::create([
            'title'             => ['tr' => 'Ana Sayfa', 'en' => 'Homepage'],
            'slug'              => 'anasayfa',
            'status'            => 'published',
            'banner_title' => ['tr' => 'Next Medya', 'en' => 'Next Medya'],
            'banner_subtitle' => ['tr' => 'Dijital Dünyada İzinizi Bırakın', 'en' => 'Leave Your Mark in the Digital World'],
            'seo_title' => ['tr' => 'Next Medya - Ana Sayfa', 'en' => 'Next Medya - Homepage'],
            'meta_description' => ['tr' => 'Dijital pazarlama, web tasarım ve SEO hizmetleriyle markanızı büyütün.', 'en' => 'Grow your brand with digital marketing, web design and SEO services.'],
            'keywords' => ['tr' => 'dijital pazarlama, web tasarım, SEO, sosyal medya', 'en' => 'digital marketing, web design, SEO, social media'],
            'index_status'      => 'index',
            'follow_status'     => 'follow',
        ]);

        // SADECE 3 SECTION - Bu sırayla eklenecek
        $homepageSections = ['main-slider', 'service-cards-news', 'pricing-table'];
        $order = 1;

        foreach ($homepageSections as $key) {
            $config = config('sections.' . $key);
            if ($config && $homepage->sections()->where('section_key', $key)->doesntExist()) {
                $homepage->sections()->create([
                    'section_key' => $key,
                    'content' => $this->buildSectionContent($key, $config['fields'] ?? []),
                    'order' => $order++,
                    'is_active' => true,
                ]);
            }
        }

        Schema::enableForeignKeyConstraints();
    }

    private function buildSectionContent(string $key, array $fields): array
    {
        $dummyData = $this->dummyData();
        $contentToSave = $dummyData[$key] ?? [];
        $final = [];
        $baseImageUrl = 'https://placehold.co/600x400';

        foreach ($fields as $field) {
            $name = $field['name'] ?? null;
            $type = strtolower((string)($field['type'] ?? ''));
            $translatable = (bool)($field['translatable'] ?? false);

            if (!$name) continue;

            // Önce dummy data'da bu alan var mı kontrol et
            if (Arr::exists($contentToSave, $name)) {
                $value = $contentToSave[$name];

                // REPEATER için direkt array olarak kaydet
                if ($type === 'repeater' && is_array($value)) {
                    $final[$name] = $value;
                } elseif ($translatable && is_string($value)) {
                    $final[$name] = ['tr' => $value, 'en' => $value];
                } else {
                    $final[$name] = $value;
                }
            } // Dummy data'da yoksa ama image field ise placeholder ekle
            elseif ($this->isImageField($name, $type)) {
                $final[$name] = $baseImageUrl;
            } // Translatable ise boş array
            elseif ($translatable) {
                $final[$name] = ['tr' => '', 'en' => ''];
            }
        }

        return $final;
    }

    private function isImageField(string $name, string $type): bool
    {
        if (in_array($type, ['image', 'file', 'photo', 'media'], true)) {
            return true;
        }

        // preg_match sadece string için çalışır, tip kontrolü ekle
        if (!is_string($name)) {
            return false;
        }

        return (bool)preg_match('/(image|_img|_image|logo|photo|thumbnail|thumb|banner|icon)$/i', $name);
    }

    /**
     * SADECE 3 SECTION İÇİN DUMMY DATA
     * - main-slider
     * - service-cards-news
     * - pricing-table
     */
    private function dummyData(): array
    {
        return [
            'main-slider' => [
                'slides' => [
                    [
                        'label' => ['tr' => 'Dijital Varlığınızı Şekillendiriyoruz', 'en' => 'Shaping Your Digital Presence'],
                        'title' => ['tr' => 'Stratejiden Başarıya', 'en' => 'From Strategy to Success'],
                        'highlight_text' => ['tr' => 'Dijital Çözümler', 'en' => 'Digital Solutions'],
                        'description' => ['tr' => 'Next Medya olarak, markanızın dijital dünyadaki potansiyelini ortaya çıkarıyoruz. Veri odaklı stratejiler, yaratıcı tasarımlar ve en son teknolojilerle işletmenizi geleceğe taşıyoruz.', 'en' => 'As Next Medya, we unleash your brand\'s potential in the digital world. We carry your business to the future with data-driven strategies, creative designs, and the latest technologies.'],
                        'primary_button_text' => ['tr' => 'Hizmetlerimizi Keşfedin', 'en' => 'Discover Our Services'],
                        'primary_button_link' => '/hizmetler',
                        'secondary_button_text' => ['tr' => 'Teklif Alın', 'en' => 'Get a Quote'],
                        'secondary_button_link' => '/iletisim',
                        'project_stat' => ['tr' => '300+', 'en' => '300+'],
                        'customer_stat' => ['tr' => '250+', 'en' => '250+'],
                        'award_stat' => ['tr' => '20+', 'en' => '20+'],
                        'customer_experience_stat' => ['tr' => '10 Yıl+', 'en' => '10+ Years'],
                        'point_stat' => ['tr' => '4.9/5', 'en' => '4.9/5'],
                    ],
                    [
                        'label' => ['tr' => 'Arama Motorlarında Zirveye', 'en' => 'To the Top of Search Engines'],
                        'title' => ['tr' => 'Organik Büyüme ve', 'en' => 'Organic Growth and'],
                        'highlight_text' => ['tr' => 'Görünürlük', 'en' => 'Visibility'],
                        'description' => ['tr' => 'SEO ve içerik pazarlaması uzmanlığımızla web sitenizin trafiğini artırıyor, doğru hedef kitleye ulaşmanızı sağlıyor ve marka bilinirliğinizi güçlendiriyoruz.', 'en' => 'With our expertise in SEO and content marketing, we increase your website traffic, ensure you reach the right target audience, and strengthen your brand awareness.'],
                        'primary_button_text' => ['tr' => 'Ücretsiz SEO Analizi', 'en' => 'Free SEO Analysis'],
                        'primary_button_link' => '/seo-analizi',
                        'secondary_button_text' => ['tr' => 'Başarı Hikayeleri', 'en' => 'Success Stories'],
                        'secondary_button_link' => '/projeler',
                        'project_stat' => ['tr' => '400+', 'en' => '400+'],
                        'customer_stat' => ['tr' => '350+', 'en' => '350+'],
                        'award_stat' => ['tr' => '15+', 'en' => '15+'],
                        'customer_experience_stat' => ['tr' => '8 Yıl+', 'en' => '8+ Years'],
                        'point_stat' => ['tr' => '5.0/5', 'en' => '5.0/5'],
                    ],
                ],
                'references' => [
                    ['refence' => 'https://placehold.co/200x80/cccccc/333333?text=Marka+1'],
                    ['refence' => 'https://placehold.co/200x80/cccccc/333333?text=Marka+2'],
                    ['refence' => 'https://placehold.co/200x80/cccccc/333333?text=Marka+3'],
                    ['refence' => 'https://placehold.co/200x80/cccccc/333333?text=Marka+4'],
                    ['refence' => 'https://placehold.co/200x80/cccccc/333333?text=Marka+5'],
                    ['refence' => 'https://placehold.co/200x80/cccccc/333333?text=Marka+6'],
                ],
            ],
            'service-cards-news' => [
                'title' => ['tr' => 'Neler Yapıyoruz?', 'en' => 'What We Do?'],
                'subtitle' => ['tr' => 'Markanızın ihtiyaç duyduğu tüm dijital hizmetleri tek bir çatı altında sunarak, büyüme yolculuğunuzda stratejik ortağınız oluyoruz.', 'en' => 'By offering all the digital services your brand needs under one roof, we become your strategic partner on your growth journey.'],
                'services' => [
                    [
                        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                        'card_title' => ['tr' => 'Web Tasarım ve Geliştirme', 'en' => 'Web Design & Development'],
                        'card_description' => ['tr' => 'Kullanıcı deneyimi odaklı, mobil uyumlu ve modern tasarımlı web siteleri oluşturuyoruz. Kurumsal sitelerden karmaşık platformlara kadar geniş bir yelpazede hizmet sunuyoruz.', 'en' => 'We create user-experience-focused, mobile-compatible, and modernly designed websites. We offer a wide range of services from corporate sites to complex platforms.'],
                    ],
                    [
                        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="2" x2="22" y2="6"/><path d="M7.5 20.5 19 9l-4-4L3.5 16.5 2 22z"/></svg>',
                        'card_title' => ['tr' => 'SEO ve İçerik Pazarlaması', 'en' => 'SEO & Content Marketing'],
                        'card_description' => ['tr' => 'Arama motorlarında üst sıralarda yer almanız için teknik SEO, içerik stratejileri ve link inşası çalışmalarıyla organik görünürlüğünüzü artırıyoruz.', 'en' => 'We increase your organic visibility with technical SEO, content strategies, and link building efforts to rank you higher in search engines.'],
                    ],
                    [
                        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 11 8-5 8 5v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="m22 9-2.09 1.14"/><path d="M12.5 2.25 14 3l-1.2 2.4"/><path d="m4.5 5.5.94.51"/><path d="m18 10 1.55.85"/><path d="M14.25 21.75 13 20l1.2-2.4"/><path d="M3.75 14.25 5 13l-1.2-2.4"/></svg>',
                        'card_title' => ['tr' => 'Dijital Reklam Yönetimi (PPC)', 'en' => 'Digital Advertising (PPC)'],
                        'card_description' => ['tr' => 'Google Ads ve sosyal medya reklam kampanyalarınızı yöneterek yatırım getirinizi (ROI) en üst düzeye çıkarıyor, bütçenizi en verimli şekilde kullanmanızı sağlıyoruz.', 'en' => 'We maximize your return on investment (ROI) by managing your Google Ads and social media advertising campaigns, ensuring the most efficient use of your budget.'],
                    ],
                    [
                        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>',
                        'card_title' => ['tr' => 'Sosyal Medya Yönetimi', 'en' => 'Social Media Management'],
                        'card_description' => ['tr' => 'Markanızın sosyal medyadaki sesini oluşturuyor, hedef kitlenizle etkileşim kuruyor ve topluluk yönetimi ile marka sadakatini güçlendiriyoruz.', 'en' => 'We create your brand\'s voice on social media, engage with your target audience, and strengthen brand loyalty through community management.'],
                    ],
                ],
                'logos' => [
                    ['alt_text' => ['tr' => 'Partner Logo 1', 'en' => 'Partner Logo 1']],
                    ['alt_text' => ['tr' => 'Partner Logo 2', 'en' => 'Partner Logo 2']],
                    ['alt_text' => ['tr' => 'Partner Logo 3', 'en' => 'Partner Logo 3']],
                    ['alt_text' => ['tr' => 'Partner Logo 4', 'en' => 'Partner Logo 4']],
                ],
            ],
            'pricing-table' => [
                'most_popular_badge' => ['tr' => '🚀 En Popüler', 'en' => '🚀 Most Popular'],
                'packages' => [
                    [
                        'plan_name' => ['tr' => 'Dijital Başlangıç', 'en' => 'Digital Starter'],
                        'is_popular' => '0',
                        'currency' => '₺',
                        'monthly_price' => '15.000',
                        'payment_period' => ['tr' => 'tek seferlik ödeme', 'en' => 'one-time payment'],
                        'payment_info' => ['tr' => 'Yeni başlayanlar için ideal', 'en' => 'Ideal for starters'],
                        'discount_info_1' => ['tr' => '• Kurumsal Web Sitesi Kurulumu', 'en' => '• Corporate Website Setup'],
                        'discount_info_2' => ['tr' => '• Temel SEO ve Sosyal Medya Kurulumu', 'en' => '• Basic SEO & Social Media Setup'],
                        'features' => [
                            ['feature_text' => ['tr' => 'Modern & Mobil Uyumlu Tasarım', 'en' => 'Modern & Mobile-Friendly Design'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => '5 Adete Kadar Sayfa Tasarımı', 'en' => 'Up to 5 Page Designs'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Yönetim Paneli (CMS) Entegrasyonu', 'en' => 'Admin Panel (CMS) Integration'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Temel SEO Kurulumu (Google Index)', 'en' => 'Basic SEO Setup (Google Index)'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Sosyal Medya Hesap Entegrasyonu', 'en' => 'Social Media Account Integration'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'İletişim Formu ve Harita', 'en' => 'Contact Form & Map'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => '1 Yıl Hosting & SSL Dahil', 'en' => '1 Year Hosting & SSL Included'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => '30 Gün Teknik Destek', 'en' => '30 Days Technical Support'], 'is_new' => '0'],
                        ],
                        'cta_button_text' => ['tr' => 'Paketi Seç', 'en' => 'Choose Plan'],
                        'cta_button_icon' => '➡️',
                        'cta_button_link' => '/iletisim?paket=dijital-baslangic',
                    ],
                    [
                        'plan_name' => ['tr' => 'İşletmeni Büyüt', 'en' => 'Business Growth'],
                        'is_popular' => '1',
                        'currency' => '₺',
                        'monthly_price' => '12.500',
                        'payment_period' => ['tr' => 'aylık abonelik', 'en' => 'monthly subscription'],
                        'payment_info' => ['tr' => 'KOBİ\'ler ve büyüyen markalar için', 'en' => 'For SMEs and growing brands'],
                        'discount_info_1' => ['tr' => '• Sürekli SEO ve İçerik Pazarlaması', 'en' => '• Ongoing SEO & Content Marketing'],
                        'discount_info_2' => ['tr' => '• Sosyal Medya & Reklam Yönetimi', 'en' => '• Social Media & Ad Management'],
                        'features' => [
                            ['feature_text' => ['tr' => 'Tüm Başlangıç Paketi Özellikleri', 'en' => 'All Starter Package Features'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Aylık SEO Optimizasyonu', 'en' => 'Monthly SEO Optimization'], 'is_new' => '1'],
                            ['feature_text' => ['tr' => '4 Adet Blog İçeriği Üretimi', 'en' => '4 Blog Content Creations'], 'is_new' => '1'],
                            ['feature_text' => ['tr' => 'Haftalık Sosyal Medya Paylaşımları', 'en' => 'Weekly Social Media Posts'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Google Ads Reklam Yönetimi', 'en' => 'Google Ads Management'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Aylık Performans Raporlaması', 'en' => 'Monthly Performance Reporting'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'E-Bülten Altyapısı Kurulumu', 'en' => 'Newsletter System Setup'], 'is_new' => '1'],
                            ['feature_text' => ['tr' => 'Sürekli Teknik Destek', 'en' => 'Continuous Technical Support'], 'is_new' => '0'],
                        ],
                        'cta_button_text' => ['tr' => 'Hemen Başla', 'en' => 'Get Started'],
                        'cta_button_icon' => '🚀',
                        'cta_button_link' => '/iletisim?paket=isletmeni-buyut',
                    ],
                    [
                        'plan_name' => ['tr' => 'Kurumsal Partner', 'en' => 'Corporate Partner'],
                        'is_popular' => '0',
                        'currency' => '₺',
                        'monthly_price' => '25.000+',
                        'payment_period' => ['tr' => 'aylık / proje bazlı', 'en' => 'monthly / project-based'],
                        'payment_info' => ['tr' => 'Kapsamlı çözümler için', 'en' => 'For comprehensive solutions'],
                        'discount_info_1' => ['tr' => '• 360 Derece Dijital Pazarlama', 'en' => '• 360° Digital Marketing'],
                        'discount_info_2' => ['tr' => '• Özel Geliştirme ve Raporlama', 'en' => '• Custom Development & Reporting'],
                        'features' => [
                            ['feature_text' => ['tr' => 'Tüm Büyüme Paketi Özellikleri', 'en' => 'All Business Growth Features'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Özel Web/Yazılım Geliştirme', 'en' => 'Custom Web/Software Development'], 'is_new' => '1'],
                            ['feature_text' => ['tr' => 'Detaylı Rakip ve Pazar Analizi', 'en' => 'Detailed Competitor & Market Analysis'], 'is_new' => '1'],
                            ['feature_text' => ['tr' => 'Çok Kanallı Reklam Stratejileri', 'en' => 'Multi-Channel Ad Strategies'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'İtibar Yönetimi ve PR Desteği', 'en' => 'Reputation Management & PR Support'], 'is_new' => '1'],
                            ['feature_text' => ['tr' => 'Gelişmiş Analitik ve CRO', 'en' => 'Advanced Analytics & CRO'], 'is_new' => '1'],
                            ['feature_text' => ['tr' => 'Özel Atanmış Proje Yöneticisi', 'en' => 'Dedicated Project Manager'], 'is_new' => '0'],
                            ['feature_text' => ['tr' => 'Öncelikli Destek Hattı', 'en' => 'Priority Support Line'], 'is_new' => '0'],
                        ],
                        'cta_button_text' => ['tr' => 'İletişime Geçin', 'en' => 'Contact Us'],
                        'cta_button_icon' => '💼',
                        'cta_button_link' => '/iletisim?paket=kurumsal-partner',
                    ],
                ],
            ],
        ];
    }
}
