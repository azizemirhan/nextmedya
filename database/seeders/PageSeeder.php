<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection; // PageSection modelini import ettiğinizden emin olun
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema; // Schema'yı import ettiğinizden emin olun

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $existingPage = Page::where('slug', 'anasayfa')->first();
        if ($existingPage) {
            $existingPage->sections()->delete();
            $existingPage->forceDelete(); // Tamamen silmek daha temiz olabilir
        }
        PageSection::truncate();

        $homepage = Page::create([
            'title'             => ['tr' => 'Ana Sayfa', 'en' => 'Homepage'],
            'slug'              => 'anasayfa',
            'status'            => 'published',
            'banner_title'      => ['tr' => 'Tuncay İnşaat', 'en' => 'Tuncay Construction'],
            'banner_subtitle'   => ['tr' => 'Geleceği Güvenle İnşa Ediyoruz', 'en' => 'Building the Future with Confidence'],
            'seo_title'         => ['tr' => 'Tuncay İnşaat - Ana Sayfa', 'en' => 'Tuncay Construction - Homepage'],
            'meta_description'  => ['tr' => 'Yenilikçi ve güvenilir inşaat çözümleri sunan Tuncay İnşaat ana sayfası.', 'en' => 'Homepage of Tuncay Construction, offering innovative and reliable construction solutions.'],

            // DÜZELTME: Boş anahtar 'keywords' olarak değiştirildi.
            'keywords'          => ['tr' => 'inşaat, müteahhitlik, proje', 'en' => 'construction, contracting, project'],

            'index_status'      => 'index',
            'follow_status'     => 'follow',
        ]);

        $sections = config('sections', []);
        $order = 1;

        foreach ($sections as $key => $config) {
            if ($homepage->sections()->where('section_key', $key)->doesntExist()) {
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

            if ($this->isImageField($name, $type)) {
                $final[$name] = $baseImageUrl;
                continue;
            }

            if (Arr::exists($contentToSave, $name)) {
                $value = $contentToSave[$name];
                if (is_array($value) && array_keys($value) === range(0, count($value) - 1)) {
                    // Bu alanı bir textarea'da göstermek için JSON string'e çeviriyoruz.
                    $final[$name] = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    continue; // Bu alanı işledik, döngünün sonraki adımına geç.
                }
                if ($translatable && is_string($value)) {
                    $final[$name] = ['tr' => $value, 'en' => $value];
                } else {
                    $final[$name] = $value;
                }
            } elseif ($translatable) {
                $final[$name] = ['tr' => '', 'en' => ''];
            }
        }

        return $final;
    }

    /**
     * Alanın görsel olup olmadığını belirler.
     * - type: image|file|photo|media
     * - name regex: /(image|_img|_image|logo|photo|thumbnail|thumb|banner|icon)$/i
     */
    private function isImageField(string $name, string $type): bool
    {
        if (in_array($type, ['image', 'file', 'photo', 'media'], true)) {
            return true;
        }
        return (bool)preg_match('/(image|_img|_image|logo|photo|thumbnail|thumb|banner|icon)$/i', $name);
    }

    /**
     * Bölümlere özel metin/numara dummy verileri.
     */
    private function dummyData(): array
    {
        return [
            'service-cards-promo' => [
                'service_count' => 3,
            ],
            'about-us-promo' => [
                'small_title' => ['tr' => "Tuncay İnşaat'a Hoş Geldiniz", 'en' => 'Welcome to Tuncay Construction'],
                'main_title' => ['tr' => 'Güven ve Kaliteyle Hizmetinizdeyiz', 'en' => 'At Your Service with Trust and Quality'],
                'content' => ['tr' => 'Yılların verdiği tecrübe ve uzman kadromuzla, her türlü inşaat projenizde modern çözümler sunuyoruz.', 'en' => 'With years of experience and our expert staff, we offer modern solutions for all your construction projects.'],
                'signature_name' => 'Tuncay Öztürk',
                'signature_title' => 'Yönetim Kurulu Başkanı',
            ],
            'projects-slider' => [
                'small_title' => ['tr' => 'Projelerimiz', 'en' => 'Our Projects'],
                'main_title' => ['tr' => 'Tamamlanan Projeler', 'en' => 'Completed Projects'],
                'project_count' => 6,
            ],
            'team-slider' => [
                'small_title' => ['tr' => 'Uzman Kadromuz', 'en' => 'Our Expert Team'],
                'main_title' => ['tr' => 'Ekibimizle Tanışın', 'en' => 'Meet Our Team'],
            ],
            'core-features' => [
                'small_title' => ['tr' => 'Temel Değerlerimiz', 'en' => 'Core Features'],
                'main_title' => ['tr' => 'Bizi Farklı Kılan Nedir?', 'en' => 'What Makes Us Different'],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Örnek bir video URL'si
            ],
            'call-to-action-banner' => [
                'title' => ['tr' => 'Projeniz', 'en' => 'Your Project'],
                'subtitle' => ['tr' => 'Burada Başlar', 'en' => 'Starts Here'],
                'content' => ['tr' => 'Hayalinizdeki projeyi hayata geçirmek için uzman ekibimizle iletişime geçin.', 'en' => 'Contact our expert team to bring your dream project to life.'],
            ],
            'testimonials-slider' => [
                'small_title' => ['tr' => 'Referanslar', 'en' => 'Testimonials'],
                'main_title' => ['tr' => 'Müşterilerimiz Ne Dedi?', 'en' => 'What Our Clients Say'],
            ],
            'latest-blog-posts' => [
                'small_title' => ['tr' => 'Sektörden Haberler', 'en' => 'News from the Sector'],
                'main_title' => ['tr' => 'Son Blog Yazıları', 'en' => 'Latest Blog Posts'],
                'post_count' => 3,
            ],
            'tabbed-services' => [
                'title' => ['tr' => 'Sunduğumuz Hizmetler', 'en' => 'Services We Offer'],
            ],
            'about-detailed' => [
                'top_heading' => ['tr' => 'İnşaat sektöründe küçük ve orta ölçekli firmaların çıkarlarını temsil ediyoruz', 'en' => 'Representing the interests of small and medium-sized building companies in the construction industry'],
                'left_title' => ['tr' => 'Biz Kimiz?', 'en' => 'Who We Are?'],
                'left_content' => ['tr' => 'Misyonumuz, sadece bugünün insanlarının hayatlarında bir fark yaratmak değil, aynı zamanda gelecek nesiller ve yaşadığımız gezegen için bir miras bırakmaktır. Portföyümüzde, yüksek kaliteli bitirmeler ve iyi onarımlarla, farklı katlardaki onlarca başarılı konut projesi bulunmaktadır. Ev inşa etmek bizim mesleğimizdir!', 'en' => 'We are resolute in our mission to not only make a difference to the lives of people today but to also leave a legacy for future generations and the planet we live in. Our portfolio includes dozens of successfully completed projects of houses of different storeys, with high-quality finishes and good repairs. Building houses is our vocation!'],
                'right_title' => ['tr' => 'Sizin İçin Ne Var?', 'en' => 'What\'s in it for me?'],
                'right_items' => [
                    ['item_text' => ['tr' => 'Yüksek performanslı, düşük karbonlu beton çözümü', 'en' => 'High performing, low carbon concrete solution']],
                    ['item_text' => ['tr' => 'İşçilerin becerileri için değer', 'en' => 'Value for workers\' skills']],
                    ['item_text' => ['tr' => 'İnşaatta mükemmel standartlar', 'en' => 'Excellent standards in construction']],
                    ['item_text' => ['tr' => 'Kapsayıcı bir endüstri', 'en' => 'An inclusive industry']],
                    ['item_text' => ['tr' => 'Sadece bize inanmayın', 'en' => 'Don\'t take our word for it']],
                ],
            ],
            'process-steps' => [
                'small_title' => ['tr' => 'Plan + Kontrol', 'en' => 'Plan + Control'],
                'main_title' => ['tr' => 'Nasıl Çalışıyor?', 'en' => 'How it Works'],
                'steps' => [
                    ['step_title' => ['tr' => 'Faz Planı', 'en' => 'Phase Plan'], 'step_content' => ['tr' => 'Bu adım, tasarım sürecini ve kilometre taşlarını inşaatla birleştirir.', 'en' => 'This step connects the design process and its milestones with construction.']],
                    ['step_title' => ['tr' => 'Tasarım Çekme Planı', 'en' => 'Design Pull Plan'], 'step_content' => ['tr' => 'Hedeflerimize ulaşmak için tasarım ekibiyle detaylı bir plan oluştururuz.', 'en' => 'We work with the design team to establish a detailed plan for reaching our goals.']],
                    ['step_title' => ['tr' => 'Koordineli Düzen', 'en' => 'Coordinated Layout'], 'step_content' => ['tr' => 'Bu süreç, tek bir doğru nokta oluşturur: tüm proje için koordineli çizimler.', 'en' => 'This process creates a single point of truth: coordinated drawings for all projects.']],
                    ['step_title' => ['tr' => 'Kalite Kontrol', 'en' => 'Quality Control'], 'step_content' => ['tr' => 'İnşaat öncesinde Koordineli Düzen adımında geometrinin çözülmüş olması.', 'en' => 'Having geometry worked out in the Coordinated Layout step, prior to construction.']],
                ],
            ],
            'key-benefits' => [
                'main_title' => ['tr' => 'Temel Faydalar', 'en' => 'Key Benefits'],
                'benefits' => [
                    ['benefit_text' => ['tr' => 'İşçilik giderleri, inşaat sektöründe maliyet düşürme önlemlerinin ortak bir hedefidir.', 'en' => 'Labor expenses are a common target for cost reduction measures in the construction industry.']],
                    ['benefit_text' => ['tr' => 'İyi bir malzeme yönetim sistemi, doğru iletişim, planlama ve takip araçlarını içerir.', 'en' => 'A good material management system includes proper communication, scheduling, and tracking tools.']],
                    ['benefit_text' => ['tr' => 'Tedarikler inşaat sahasına teslim edildiğinde ne kadar hızlı kullanılırsa o kadar iyidir.', 'en' => 'Faster supplies can be used upon delivery to a construction site, the better.']],
                    ['benefit_text' => ['tr' => 'Etkili malzeme yönetim sistemleri sadece malzemelerin doğru yerde olmasını sağlamaz.', 'en' => 'Effective material management systems not only ensure that materials are in the right place.']],
                ],
            ],
            'contact-detailed' => [
                'small_title' => ['tr' => 'Nasıl Yardımcı Olabiliriz?', 'en' => 'How can we help?'],
                'main_title' => ['tr' => 'İletişim Formu ile Kalite ve Tutku', 'en' => 'Quality & Passion With Contact Form'],
                'content' => ['tr' => 'Sorularınız mı var veya sohbet etmek mi istiyorsunuz? İletişim formumuzu doldurun, sizi doğru kişilerle temasa geçirelim.', 'en' => 'Have questions or want to chat? Fill out our contact form, and we’ll put you in touch with the right people!'],
                'bio_name' => 'Walimes Jonnie',
                'bio_title' => 'Constro Şirket Direktörü',
                'contact_info' => [
                    ['info_title' => 'Adres', 'info_line1' => '65 Allerton Street 901 N Pitt Str, USA'],
                    ['info_title' => 'Telefon', 'info_line1' => 'Tel: (+380) 50 318 47 07', 'info_line2' => 'Fax: (+182) 50 318 47 07'],
                    ['info_title' => 'E-posta', 'info_line1' => 'username@domain.com', 'info_line2' => 'username@domain.com'],
                ],
            ],
            'faq-accordion' => [
                'small_title' => ['tr' => 'Sıkça Sorulan Sorular', 'en' => 'Frequently asked question'],
                'main_title' => ['tr' => 'Hayalinizdeki Ev İçin Çözümler Bulmak', 'en' => 'Finding Solutions For Your Dream House'],
                'faq_count' => 5, // Data handler'dan çekileceği için burada sadece sayı belirtilir
            ],
            'location-map' => [
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3184.453303867664!2d32.85974411529188!3d39.92079007942699!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d34f0d619b027d%3A0x6b2e0c0c0b2c1d2e!2sKizilay%2C%20Cankaya%2C%20Ankara%2C%20Turkey!5e0!3m2!1sen!2sus!4v1642077000000!5m2!1sen!2sus',
            ],
        ];
    }
}
