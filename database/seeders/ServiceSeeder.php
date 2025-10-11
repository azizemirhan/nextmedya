<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Başlamadan önce mevcut verileri temizle
        Service::truncate();

        $services = [
            [
                'title' => ['tr' => 'Genel Müteahhitlik', 'en' => 'General Contracting'],
                'slug' => 'genel-muteahhitlik',
                'summary' => ['tr' => 'Projenizin başlangıcından bitişine kadar tüm süreçleri profesyonel ekibimizle yönetiyoruz.', 'en' => 'We manage all processes of your project from start to finish with our professional team.'],
                'content' => ['tr' => 'Tuncay İnşaat olarak, projenizin vizyonundan anahtar teslimine kadar her aşamada yanınızdayız. Tedarik zinciri yönetiminden saha operasyonlarına, kalite kontrolden bütçe yönetimine kadar tüm sorumluluğu üstlenerek size sorunsuz bir inşaat deneyimi sunuyoruz.', 'en' => 'As Tuncay Construction, we are with you at every stage, from the vision of your project to the turnkey delivery. We offer you a seamless construction experience by taking full responsibility, from supply chain management to field operations, from quality control to budget management.'],
                'benefits' => [
                    ['text' => ['tr' => 'Tek noktadan proje yönetimi ve sorumluluk', 'en' => 'Single-point project management and accountability']],
                    ['text' => ['tr' => 'Optimize edilmiş bütçe ve zaman çizelgesi', 'en' => 'Optimized budget and timeline']],
                    ['text' => ['tr' => 'Yüksek kalite standartları ve iş güvenliği', 'en' => 'High quality standards and work safety']],
                    ['text' => ['tr' => 'Geniş tedarikçi ve alt yüklenici ağı', 'en' => 'Extensive network of suppliers and subcontractors']],
                ],
                'expectations_content' => ['tr' => 'Her projede en yüksek beklentileri karşılamayı hedefleriz. Şeffaf raporlama ve sürekli iletişim ile projenizin her anında kontrolün sizde olmasını sağlarız.', 'en' => 'We aim to meet the highest expectations in every project. With transparent reporting and constant communication, we ensure you are in control at every moment of your project.'],
                'support_items' => [
                    ['text' => ['tr' => 'Fizibilite ve konsept çalışmaları', 'en' => 'Feasibility and concept studies']],
                    ['text' => ['tr' => 'Ruhsat ve yasal izinlerin takibi', 'en' => 'Follow-up of permits and legal permissions']],
                    ['text' => ['tr' => 'Malzeme seçimi ve tedariği', 'en' => 'Material selection and procurement']],
                    ['text' => ['tr' => 'Saha denetimi ve yönetimi', 'en' => 'Site supervision and management']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Proje maliyetleri nasıl belirleniyor?', 'en' => 'How are project costs determined?'],
                        'answer' => ['tr' => 'Proje maliyetleri, detaylı bir keşif, malzeme seçimi ve işçilik analizleri sonucunda şeffaf bir şekilde belirlenir.', 'en' => 'Project costs are determined transparently as a result of a detailed survey, material selection, and labor analysis.'],
                    ],
                    [
                        'question' => ['tr' => 'Proje ne kadar sürede tamamlanır?', 'en' => 'How long does the project take to complete?'],
                        'answer' => ['tr' => 'Süre, projenin büyüklüğüne ve kapsamına bağlı olarak değişmekle birlikte, sözleşmede belirtilen zaman çizelgesine sıkı sıkıya bağlı kalırız.', 'en' => 'Although the duration varies depending on the size and scope of the project, we strictly adhere to the timeline specified in the contract.'],
                    ],
                ],
                'cover_image' => 'placeholders/service_cover_1.jpg',
                'gallery_images' => ['placeholders/service_gallery_1.jpg', 'placeholders/service_gallery_2.jpg', 'placeholders/service_gallery_3.jpg'],
                'order' => 1, 'is_active' => true,
            ],
            [
                'title' => ['tr' => 'Kentsel Dönüşüm', 'en' => 'Urban Transformation'],
                'slug' => 'kentsel-donusum',
                'summary' => ['tr' => 'Riskli yapılarınızı, modern yönetmeliklere uygun, güvenli ve değerli yaşam alanlarına dönüştürüyoruz.', 'en' => 'We transform your risky buildings into safe, valuable living spaces in compliance with modern regulations.'],
                'content' => ['tr' => 'Deprem kuşağında yer alan ülkemizde kentsel dönüşüm, bir tercih değil, zorunluluktur. Tuncay İnşaat olarak, riskli yapılarınızı güncel deprem yönetmeliklerine uygun, modern ve estetik binalara dönüştürme sürecinde hukuki ve teknik danışmanlık sağlıyoruz.', 'en' => 'In our country, located in an earthquake zone, urban transformation is not a choice but a necessity. As Tuncay Construction, we provide legal and technical consultancy in the process of transforming your risky buildings into modern and aesthetic structures compliant with current earthquake regulations.'],
                'benefits' => [
                    ['text' => ['tr' => 'Depreme dayanıklı ve güvenli konutlar', 'en' => 'Earthquake-resistant and safe housing']],
                    ['text' => ['tr' => 'Mülkünüzün değerinde artış', 'en' => 'Increase in your property\'s value']],
                    ['text' => ['tr' => 'Modern ve konforlu yaşam alanları', 'en' => 'Modern and comfortable living spaces']],
                    ['text' => ['tr' => 'Yasal süreçlerde profesyonel destek', 'en' => 'Professional support in legal processes']],
                ],
                'expectations_content' => ['tr' => 'Kat malikleriyle tam bir uyum içinde çalışarak, herkes için en adil ve kazançlı çözümleri üretmek önceliğimizdir.', 'en' => 'Our priority is to work in full harmony with the flat owners to produce the fairest and most profitable solutions for everyone.'],
                'support_items' => [
                    ['text' => ['tr' => 'Riskli yapı tespiti ve raporlama', 'en' => 'Risky building assessment and reporting']],
                    ['text' => ['tr' => 'Hukuki danışmanlık ve sözleşme hazırlığı', 'en' => 'Legal consultancy and contract preparation']],
                    ['text' => ['tr' => 'Yeni proje tasarımı ve sunumu', 'en' => 'New project design and presentation']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Dönüşüm süreci ne kadar sürer?', 'en' => 'How long does the transformation process take?'],
                        'answer' => ['tr' => 'Süreç, anlaşma, projelendirme ve inşaat aşamaları dahil olmak üzere binanın durumuna göre 18 ila 24 ay arasında değişebilir.', 'en' => 'The process can vary between 18 to 24 months depending on the building\'s condition, including agreement, design, and construction phases.'],
                    ]
                ],
                'cover_image' => 'placeholders/service_cover_2.jpg',
                'gallery_images' => ['placeholders/service_gallery_4.jpg', 'placeholders/service_gallery_5.jpg'],
                'order' => 2, 'is_active' => true,
            ],
            [
                'title' => ['tr' => 'Anahtar Teslim Villa Projeleri', 'en' => 'Turnkey Villa Projects'],
                'slug' => 'anahtar-teslim-villa-projeleri',
                'summary' => ['tr' => 'Arsanız üzerine, hayallerinizdeki villayı tasarlıyor, inşa ediyor ve size sadece kapıyı açıp yerleşmeyi bırakıyoruz.', 'en' => 'We design and build your dream villa on your land, leaving you only to open the door and settle in.'],
                'content' => ['tr' => 'Kişiye özel tasarımlarla, lüks ve konforu bir araya getiren villa projeleri geliştiriyoruz. Mimari tasarımdan peyzaj düzenlemesine kadar her detayı sizin için düşünüyoruz.', 'en' => 'We develop villa projects that combine luxury and comfort with personalized designs. We consider every detail for you, from architectural design to landscape arrangement.'],
                'benefits' => [
                    ['text' => ['tr' => 'Size özel özgün mimari tasarım', 'en' => 'Unique architectural design tailored for you']],
                    ['text' => ['tr' => 'A+ kalite malzeme ve işçilik', 'en' => 'A+ quality materials and craftsmanship']],
                    ['text' => ['tr' => 'Belirlenen bütçe ve zamanda teslimat', 'en' => 'Delivery on the specified budget and time']],
                    ['text' => ['tr' => 'Tek sözleşme ile tüm süreçlerin yönetimi', 'en' => 'Management of all processes with a single contract']],
                ],
                'expectations_content' => ['tr' => 'Lüks ve estetiği, fonksiyonellikle birleştirerek size sadece bir ev değil, bir yaşam tarzı sunuyoruz.', 'en' => 'By combining luxury and aesthetics with functionality, we offer you not just a house, but a lifestyle.'],
                'support_items' => null, 'faqs' => null,
                'cover_image' => 'placeholders/service_cover_3.jpg',
                'gallery_images' => null,
                'order' => 3, 'is_active' => true,
            ],
            [
                'title' => ['tr' => 'Endüstriyel Tesis İnşaatı', 'en' => 'Industrial Facility Construction'],
                'slug' => 'endustriyel-tesis-insaati',
                'summary' => ['tr' => 'Fabrika, depo ve üretim tesisleri gibi büyük ölçekli endüstriyel yapıların projelendirilmesi ve inşası.', 'en' => 'Project planning and construction of large-scale industrial buildings such as factories, warehouses, and production facilities.'],
                'content' => ['tr' => 'Endüstriyel projeler, özel uzmanlık ve deneyim gerektirir. Üretim akışınıza uygun, verimli ve dayanıklı tesisleri, uluslararası standartlarda ve zamanında teslim ediyoruz.', 'en' => 'Industrial projects require special expertise and experience. We deliver efficient and durable facilities suitable for your production flow, on time and in compliance with international standards.'],
                'benefits' => [
                    ['text' => ['tr' => 'Üretim verimliliğine odaklı tasarım', 'en' => 'Design focused on production efficiency']],
                    ['text' => ['tr' => 'Uluslararası standartlarda inşaat', 'en' => 'Construction at international standards']],
                    ['text' => ['tr' => 'Ağır sanayi yüklerine dayanıklı yapılar', 'en' => 'Structures resistant to heavy industrial loads']],
                ],
                'expectations_content' => null, 'support_items' => null, 'faqs' => null,
                'cover_image' => 'placeholders/service_cover_4.jpg',
                'gallery_images' => ['placeholders/service_gallery_6.jpg'],
                'order' => 4, 'is_active' => true,
            ]
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}
