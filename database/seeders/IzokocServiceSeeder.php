<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class IzokocServiceSeeder extends Seeder
{
    /**
     * İzokoç İzolasyon Hizmetleri Seeder
     * Tüm izolasyon ve yalıtım hizmetleri için güncellenmiş veri seti
     */
    public function run(): void
    {
        $services = [
            // HİZMET 2: Buhar Hattı İzolasyonu
            [
                'title' => [
                    'tr' => 'Buhar Hattı İzolasyonu',
                    'en' => 'Steam Line Insulation'
                ],
                'slug' => 'buhar-hatti-izolasyonu',
                'summary' => [
                    'tr' => 'Yüksek basınçlı buhar hatlarında maksimum enerji verimliliği için özel tasarlanmış izolasyon sistemleri.',
                    'en' => 'Specially designed insulation systems for maximum energy efficiency in high-pressure steam lines.'
                ],
                'content' => [
                    'tr' => '<p>Buhar hatları, endüstriyel tesislerde en yüksek ısı kayıplarının yaşandığı sistemlerden biridir. İzokoç olarak, düşük ve yüksek basınçlı buhar hatlarında profesyonel izolasyon uygulamaları ile enerji tasarrufunuzu maksimize ediyoruz.</p>

<h3>Buhar Hattı İzolasyonunun Kritik Önemi</h3>
<p>İzolasyonsuz bir buhar hattında metrekare başına saatte 1000 kcal\'den fazla ısı kaybı yaşanabilir. Bu da yıllık binlerce lira yakıt maliyeti anlamına gelir.</p>

<h3>Teknik Özelliklerimiz</h3>
<ul>
<li>450°C\'ye kadar sıcaklık dayanımı</li>
<li>Yüksek yoğunluklu taşyünü kullanımı</li>
<li>Paslanmaz sac veya alüminyum kaplama</li>
<li>Tam sızdırmazlık garantisi</li>
</ul>

<h3>Uygulama Prosedürü</h3>
<p>Buhar hattınızın basınç ve sıcaklık değerlerine göre en uygun izolasyon kalınlığını hesaplayıp, TSE standartlarına uygun uygulama gerçekleştiriyoruz.</p>',
                    'en' => '<p>Steam lines are one of the systems with the highest heat losses in industrial facilities. As İzokoç, we maximize your energy savings with professional insulation applications in low and high-pressure steam lines.</p>

<h3>Critical Importance of Steam Line Insulation</h3>
<p>In an uninsulated steam line, more than 1000 kcal of heat loss can occur per square meter per hour. This means thousands of lira in annual fuel costs.</p>

<h3>Our Technical Features</h3>
<ul>
<li>Temperature resistance up to 450°C</li>
<li>Use of high-density rock wool</li>
<li>Stainless steel or aluminum cladding</li>
<li>Full sealing guarantee</li>
</ul>

<h3>Application Procedure</h3>
<p>We calculate the most suitable insulation thickness according to the pressure and temperature values ​​of your steam line and perform the application in accordance with TSE standards.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Yüksek enerji tasarrufu (%40-50)', 'en' => 'High energy savings (40-50%)']],
                    ['text' => ['tr' => 'Personel güvenliğinin sağlanması', 'en' => 'Ensuring personnel safety']],
                    ['text' => ['tr' => 'Buhar kalitesinin korunması', 'en' => 'Preservation of steam quality']],
                    ['text' => ['tr' => 'Sistem ömrünün uzatılması', 'en' => 'Extended system lifespan']],
                    ['text' => ['tr' => 'Yoğuşma ve korozyonun önlenmesi', 'en' => 'Prevention of condensation and corrosion']],
                ],
                'expectations_content' => [
                    'tr' => '<p>Her buhar hattı projesi için özel mühendislik hesaplamaları yapıp, en ekonomik ve verimli çözümü sunuyoruz. Termal kamera ile kalite kontrolü garantisi veriyoruz.</p>',
                    'en' => '<p>We make special engineering calculations for each steam line project and offer the most economical and efficient solution. We guarantee quality control with thermal camera.</p>'
                ],
                'support_items' => [
                    ['text' => ['tr' => 'Düşük Basınç Buhar Hattı İzolasyonu', 'en' => 'Low Pressure Steam Line Insulation']],
                    ['text' => ['tr' => 'Yüksek Basınç Buhar Hattı İzolasyonu', 'en' => 'High Pressure Steam Line Insulation']],
                    ['text' => ['tr' => 'Buhar Dağıtım Manifold İzolasyonu', 'en' => 'Steam Distribution Manifold Insulation']],
                    ['text' => ['tr' => 'Kondensat Hattı İzolasyonu', 'en' => 'Condensate Line Insulation']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Buhar hattı izolasyonu kaç derece dayanır?', 'en' => 'What temperature can steam line insulation withstand?'],
                        'answer' => ['tr' => '<p>Kullandığımız taşyünü malzemeler 450°C\'ye kadar dayanım gösterir. Özel uygulamalarda 600°C\'ye kadar çıkabiliriz.</p>', 'en' => '<p>The rock wool materials we use are resistant up to 450°C. We can go up to 600°C in special applications.</p>'],
                    ],
                ],
                'cover_image' => 'uploads/services/buhar-hatti-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/buhar-hatti-1.jpg',
                    'uploads/services/gallery/buhar-hatti-2.jpg',
                ],
                'order' => 2,
                'is_active' => true,
                'banner_title' => ['tr' => 'Buhar Hattı İzolasyonu', 'en' => 'Steam Line Insulation'],
                'banner_subtitle' => ['tr' => 'Maksimum Verimlilik', 'en' => 'Maximum Efficiency'],
            ],

            // HİZMET 3: Kazan İzolasyonu
            [
                'title' => [
                    'tr' => 'Kazan İzolasyonu',
                    'en' => 'Boiler Insulation'
                ],
                'slug' => 'kazan-izolasyonu',
                'summary' => [
                    'tr' => 'Endüstriyel kazanlar için özel tasarlanmış, enerji tasarrufu sağlayan ve güvenliği artıran profesyonel izolasyon sistemleri.',
                    'en' => 'Specially designed insulation systems for industrial boilers that provide energy savings and increase safety.'
                ],
                'content' => [
                    'tr' => '<p>Kazan izolasyonu, endüstriyel tesislerde enerji verimliliğinin sağlanması ve işletme maliyetlerinin düşürülmesi için en önemli uygulamalardan biridir. İzokoç olarak, buhar kazanları, kızgın yağ kazanları ve termal yağ kazanlarında uzman kadromuzla profesyonel izolasyon hizmetleri sunuyoruz.</p>

<h3>Kazan İzolasyonunun Önemi</h3>
<p>Kazanlardan kaybedilen ısı, toplam enerji tüketiminin %10-20\'sini oluşturabilir. Doğru yapılan bir kazan izolasyonu ile bu kayıplar minimize edilerek hem yakıt tasarrufu sağlanır, hem de çalışma ortamı güvenliği artırılır.</p>

<h3>Özel Uygulama Teknikleri</h3>
<ul>
<li>Yüksek sıcaklığa dayanıklı seramik fiber malzemeler</li>
<li>Çok katmanlı izolasyon sistemleri</li>
<li>Paslanmaz sac kaplama ile koruma</li>
<li>Termal görüntüleme ile kalite kontrolü</li>
</ul>

<h3>Uygulama Sürecimiz</h3>
<p>Öncelikle kazanınızın teknik özelliklerini inceleyerek en uygun izolasyon sistemini tasarlıyoruz. Ardından kalifiye ekibimiz ile kesintisiz ve hızlı bir şekilde uygulamayı tamamlıyoruz.</p>',
                    'en' => '<p>Boiler insulation is one of the most important applications for ensuring energy efficiency and reducing operating costs in industrial facilities. As İzokoç, we offer professional insulation services with our expert staff for steam boilers, hot oil boilers, and thermal oil boilers.</p>

<h3>Importance of Boiler Insulation</h3>
<p>Heat lost from boilers can account for 10-20% of total energy consumption. With proper boiler insulation, these losses are minimized, providing both fuel savings and increased workplace safety.</p>

<h3>Special Application Techniques</h3>
<ul>
<li>High temperature resistant ceramic fiber materials</li>
<li>Multi-layer insulation systems</li>
<li>Protection with stainless steel cladding</li>
<li>Quality control with thermal imaging</li>
</ul>

<h3>Our Application Process</h3>
<p>First, we examine the technical specifications of your boiler and design the most suitable insulation system. Then, we complete the application quickly and seamlessly with our qualified team.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Yakıt maliyetlerinde %15-30 tasarruf', 'en' => '15-30% savings in fuel costs']],
                    ['text' => ['tr' => 'Kazan verimliliğinin artırılması', 'en' => 'Increased boiler efficiency']],
                    ['text' => ['tr' => 'Yüzey sıcaklığının düşürülmesi', 'en' => 'Reduced surface temperature']],
                    ['text' => ['tr' => 'Bakım maliyetlerinin azaltılması', 'en' => 'Reduced maintenance costs']],
                    ['text' => ['tr' => 'İş güvenliği standartlarına uyum', 'en' => 'Compliance with occupational safety standards']],
                ],
                'expectations_content' => [
                    'tr' => '<p>Her kazan tipi için özel çözümler üretiyoruz. Mevcut izolasyonun yenilenmesi veya yeni kazan izolasyonu - her durumda en yüksek performansı garanti ediyoruz.</p>',
                    'en' => '<p>We produce special solutions for each boiler type. Renewal of existing insulation or new boiler insulation - we guarantee the highest performance in every case.</p>'
                ],
                'support_items' => [
                    ['text' => ['tr' => 'Buhar Kazanı İzolasyonu', 'en' => 'Steam Boiler Insulation']],
                    ['text' => ['tr' => 'Kızgın Yağ Kazanı İzolasyonu', 'en' => 'Hot Oil Boiler Insulation']],
                    ['text' => ['tr' => 'Termal Yağ Kazanı İzolasyonu', 'en' => 'Thermal Oil Boiler Insulation']],
                    ['text' => ['tr' => 'Baca İzolasyonu', 'en' => 'Chimney Insulation']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Kazan izolasyonu ne kadar dayanır?', 'en' => 'How long does boiler insulation last?'],
                        'answer' => ['tr' => '<p>Kaliteli malzeme ve doğru uygulama ile 10-15 yıl arası kullanım ömrü sağlanır.</p>', 'en' => '<p>With quality materials and proper application, a service life of 10-15 years is provided.</p>'],
                    ],
                    [
                        'question' => ['tr' => 'İzolasyon sırasında kazan durur mu?', 'en' => 'Does the boiler stop during insulation?'],
                        'answer' => ['tr' => '<p>Planlı bakım döneminde yapılması önerilir. Ancak acil durumlarda çalışır vaziyette de uygulama yapılabilir.</p>', 'en' => '<p>It is recommended to be done during scheduled maintenance period. However, in emergencies, application can also be done while running.</p>'],
                    ],
                ],
                'cover_image' => 'uploads/services/kazan-izolasyonu-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/kazan-izolasyonu-1.jpg',
                    'uploads/services/gallery/kazan-izolasyonu-2.jpg',
                    'uploads/services/gallery/kazan-izolasyonu-3.jpg',
                ],
                'order' => 3,
                'is_active' => true,
                'banner_title' => ['tr' => 'Kazan İzolasyonu', 'en' => 'Boiler Insulation'],
                'banner_subtitle' => ['tr' => 'Enerji Verimliliği ve Güvenlik', 'en' => 'Energy Efficiency and Safety'],
            ],
            [
                'title' => [
                    'tr' => 'Tank İzolasyonu',
                    'en' => 'Tank Insulation'
                ],
                'slug' => 'tank-izolasyonu',
                'summary' => [
                    'tr' => 'Sıcak ve soğuk sıvı depolama tankları için özel izolasyon çözümleri ile enerji kaybını önleyin.',
                    'en' => 'Prevent energy loss with special insulation solutions for hot and cold liquid storage tanks.'
                ],
                'content' => [
                    'tr' => '<p>Tank izolasyonu, depolanan sıvıların sıcaklığının korunması ve enerji kayıplarının minimuma indirilmesi için hayati önem taşır. İzokoç olarak, çelik, paslanmaz çelik ve polyester tanklar için profesyonel izolasyon hizmetleri sunuyoruz.</p>

<h3>Tank İzolasyonu Çeşitleri</h3>
<p><strong>Sıcak Tank İzolasyonu:</strong> Sıcak su, termal yağ ve kimyasal depolama tanklarında ısı kaybını önler.</p>
<p><strong>Soğuk Tank İzolasyonu:</strong> Soğutulmuş ürün tanklarında yoğuşmayı engeller ve enerji tasarrufu sağlar.</p>

<h3>Uygulama Yöntemlerimiz</h3>
<ul>
<li>Püskürtme poliüretan köpük uygulaması</li>
<li>Panel sistem izolasyon</li>
<li>Taşyünü levha uygulaması</li>
<li>Alüminyum veya galvaniz sac kaplama</li>
</ul>

<h3>Özel Çözümler</h3>
<p>Tank geometrisine, içeriğine ve çalışma sıcaklığına göre özel tasarım yaparak maksimum verimlilik sağlıyoruz.</p>',
                    'en' => '<p>Tank insulation is vital for maintaining the temperature of stored liquids and minimizing energy losses. As İzokoç, we offer professional insulation services for steel, stainless steel, and polyester tanks.</p>

<h3>Types of Tank Insulation</h3>
<p><strong>Hot Tank Insulation:</strong> Prevents heat loss in hot water, thermal oil, and chemical storage tanks.</p>
<p><strong>Cold Tank Insulation:</strong> Prevents condensation in refrigerated product tanks and provides energy savings.</p>

<h3>Our Application Methods</h3>
<ul>
<li>Spray polyurethane foam application</li>
<li>Panel system insulation</li>
<li>Rock wool board application</li>
<li>Aluminum or galvanized sheet metal cladding</li>
</ul>

<h3>Custom Solutions</h3>
<p>We provide maximum efficiency by designing customized solutions according to tank geometry, content, and operating temperature.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Ürün kalitesinin korunması', 'en' => 'Preservation of product quality']],
                    ['text' => ['tr' => 'Enerji tasarrufu sağlanması', 'en' => 'Energy savings provided']],
                    ['text' => ['tr' => 'Yoğuşma problemlerinin önlenmesi', 'en' => 'Prevention of condensation problems']],
                    ['text' => ['tr' => 'Tank ömrünün uzatılması', 'en' => 'Extended tank lifespan']],
                ],
                'expectations_content' => [
                    'tr' => '<p>Tank boyutuna, içeriğine ve çalışma sıcaklığına göre özel çözümler geliştiriyoruz. Tüm uygulamalarımızda kalite ve güvenlik standartlarına tam uyum sağlıyoruz.</p>',
                    'en' => '<p>We develop custom solutions based on tank size, content, and operating temperature. We ensure full compliance with quality and safety standards in all our applications.</p>'
                ],
                'support_items' => [
                    ['text' => ['tr' => 'Sıcak Su Tankı İzolasyonu', 'en' => 'Hot Water Tank Insulation']],
                    ['text' => ['tr' => 'Kimyasal Tank İzolasyonu', 'en' => 'Chemical Tank Insulation']],
                    ['text' => ['tr' => 'Fuel Oil Tankı İzolasyonu', 'en' => 'Fuel Oil Tank Insulation']],
                    ['text' => ['tr' => 'Soğutma Tankı İzolasyonu', 'en' => 'Refrigeration Tank Insulation']],
                ],
                'faqs' => null,
                'cover_image' => 'uploads/services/tank-izolasyonu-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/tank-izolasyonu-1.jpg',
                    'uploads/services/gallery/tank-izolasyonu-2.jpg',
                ],
                'order' => 4,
                'is_active' => true,
                'banner_title' => ['tr' => 'Tank İzolasyonu', 'en' => 'Tank Insulation'],
                'banner_subtitle' => ['tr' => 'Sıcak ve Soğuk Depolama Çözümleri', 'en' => 'Hot and Cold Storage Solutions'],
            ],

// HİZMET 5: Kızgın Yağ Hattı İzolasyonu
            [
                'title' => [
                    'tr' => 'Kızgın Yağ Hattı İzolasyonu',
                    'en' => 'Hot Oil Line Insulation'
                ],
                'slug' => 'kizgin-yag-hatti-izolasyonu',
                'summary' => [
                    'tr' => 'Termal yağ sistemlerinde yüksek sıcaklık dayanımı ve enerji verimliliği sağlayan özel izolasyon çözümleri.',
                    'en' => 'Special insulation solutions providing high temperature resistance and energy efficiency in thermal oil systems.'
                ],
                'content' => [
                    'tr' => '<p>Kızgın yağ (termal yağ) sistemleri, 300-350°C sıcaklıklarda çalışan hassas proseslerdir. İzokoç olarak, bu yüksek sıcaklıklara özel tasarlanmış izolasyon malzemeleri ve uygulama teknikleri ile enerji kayıplarınızı minimum seviyeye indiriyoruz.</p>

<h3>Kızgın Yağ Sistemlerinin Özellikleri</h3>
<p>Termal yağ sistemleri, buhar sistemlerine göre daha yüksek sıcaklıklarda çalışabilir ve basınç gerektirmez. Bu nedenle özel izolasyon tekniklerine ihtiyaç duyar.</p>

<h3>Kullanılan Malzemeler</h3>
<ul>
<li>Yüksek yoğunluklu taşyünü (450°C\'ye kadar)</li>
<li>Seramik fiber malzemeler (özel uygulamalar için)</li>
<li>Paslanmaz sac veya alüminyum kaplama</li>
<li>Isıya dayanıklı bağlantı elemanları</li>
</ul>',
                    'en' => '<p>Hot oil (thermal oil) systems are sensitive processes operating at temperatures of 300-350°C. As İzokoç, we minimize your energy losses with insulation materials and application techniques specially designed for these high temperatures.</p>

<h3>Features of Hot Oil Systems</h3>
<p>Thermal oil systems can operate at higher temperatures than steam systems and do not require pressure. Therefore, they need special insulation techniques.</p>

<h3>Materials Used</h3>
<ul>
<li>High density rock wool (up to 450°C)</li>
<li>Ceramic fiber materials (for special applications)</li>
<li>Stainless steel or aluminum cladding</li>
<li>Heat resistant fasteners</li>
</ul>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Yüksek sıcaklıklarda güvenli çalışma', 'en' => 'Safe operation at high temperatures']],
                    ['text' => ['tr' => 'Proses sıcaklığının korunması', 'en' => 'Preservation of process temperature']],
                    ['text' => ['tr' => 'Enerji kayıplarının minimizasyonu', 'en' => 'Minimization of energy losses']],
                    ['text' => ['tr' => 'Sistemin ömrünün uzatılması', 'en' => 'Extended system lifespan']],
                ],
                'expectations_content' => null,
                'support_items' => [
                    ['text' => ['tr' => 'Termal Yağ Hattı İzolasyonu', 'en' => 'Thermal Oil Line Insulation']],
                    ['text' => ['tr' => 'Kızgın Yağ Manifold İzolasyonu', 'en' => 'Hot Oil Manifold Insulation']],
                    ['text' => ['tr' => 'Expansion Tank İzolasyonu', 'en' => 'Expansion Tank Insulation']],
                ],
                'faqs' => null,
                'cover_image' => 'uploads/services/kizgin-yag-cover.jpg',
                'gallery_images' => null,
                'order' => 5,
                'is_active' => true,
                'banner_title' => ['tr' => 'Kızgın Yağ Hattı İzolasyonu', 'en' => 'Hot Oil Line Insulation'],
                'banner_subtitle' => ['tr' => 'Yüksek Sıcaklık Çözümleri', 'en' => 'High Temperature Solutions'],
            ],

// HİZMET 6: Soğutma Hattı İzolasyonu
            [
                'title' => [
                    'tr' => 'Soğutma Hattı İzolasyonu',
                    'en' => 'Cooling Line Insulation'
                ],
                'slug' => 'sogutma-hatti-izolasyonu',
                'summary' => [
                    'tr' => 'Chiller ve soğutma sistemlerinde yoğuşmayı önleyen, enerji tasarrufu sağlayan profesyonel izolasyon çözümleri.',
                    'en' => 'Professional insulation solutions that prevent condensation and provide energy savings in chiller and cooling systems.'
                ],
                'content' => [
                    'tr' => '<p>Soğutma hatlarında izolasyon, yoğuşmayı önlemek ve enerji verimliliğini artırmak için kritik öneme sahiptir. İzokoç olarak, elastomerik kauçuk ve kapalı hücre köpük malzemelerle profesyonel soğutma hattı izolasyonu uygulamaları gerçekleştiriyoruz.</p>

<h3>Soğutma İzolasyonunun Önemi</h3>
<p>İzolasyonsuz soğutma hatlarında yoğuşma (terleme) problemi oluşur. Bu durum hem korozyona hem de enerji kayıplarına neden olur.</p>

<h3>Özel Malzemeler</h3>
<ul>
<li>Elastomerik kauçuk köpük (kapalı hücre)</li>
<li>Poliüretan köpük</li>
<li>Buhar bariyeri uygulaması</li>
<li>UV\'ye dayanıklı dış kaplama</li>
</ul>',
                    'en' => '<p>Insulation on cooling lines is critically important to prevent condensation and increase energy efficiency. As İzokoç, we perform professional cooling line insulation applications with elastomeric rubber and closed cell foam materials.</p>

<h3>Importance of Cooling Insulation</h3>
<p>Condensation (sweating) problems occur on uninsulated cooling lines. This situation causes both corrosion and energy losses.</p>

<h3>Special Materials</h3>
<ul>
<li>Elastomeric rubber foam (closed cell)</li>
<li>Polyurethane foam</li>
<li>Vapor barrier application</li>
<li>UV resistant outer coating</li>
</ul>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Yoğuşmanın tamamen önlenmesi', 'en' => 'Complete prevention of condensation']],
                    ['text' => ['tr' => 'Enerji verimliliğinin artırılması', 'en' => 'Increased energy efficiency']],
                    ['text' => ['tr' => 'Korozyon riskinin azaltılması', 'en' => 'Reduced corrosion risk']],
                    ['text' => ['tr' => 'Sistem performansının korunması', 'en' => 'Preservation of system performance']],
                ],
                'expectations_content' => null,
                'support_items' => [
                    ['text' => ['tr' => 'Chiller Hattı İzolasyonu', 'en' => 'Chiller Line Insulation']],
                    ['text' => ['tr' => 'Soğuk Su Hattı İzolasyonu', 'en' => 'Cold Water Line Insulation']],
                    ['text' => ['tr' => 'Freon Hattı İzolasyonu', 'en' => 'Freon Line Insulation']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Neden elastomerik kauçuk kullanılır?', 'en' => 'Why is elastomeric rubber used?'],
                        'answer' => ['tr' => '<p>Kapalı hücre yapısı sayesinde nem geçirmez ve yoğuşmayı %100 önler.</p>', 'en' => '<p>Thanks to its closed cell structure, it is impermeable to moisture and prevents condensation 100%.</p>'],
                    ],
                ],
                'cover_image' => 'uploads/services/sogutma-hatti-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/sogutma-hatti-1.jpg',
                ],
                'order' => 6,
                'is_active' => true,
                'banner_title' => ['tr' => 'Soğutma Hattı İzolasyonu', 'en' => 'Cooling Line Insulation'],
                'banner_subtitle' => ['tr' => 'Yoğuşma ve Enerji Koruması', 'en' => 'Condensation and Energy Protection'],
            ],

// HİZMET 7: Havalandırma İzolasyonu
            [
                'title' => [
                    'tr' => 'Havalandırma İzolasyonu',
                    'en' => 'Ventilation Insulation'
                ],
                'slug' => 'havalandirma-izolasyonu',
                'summary' => [
                    'tr' => 'HVAC sistemlerinde ses ve ısı izolasyonu sağlayan, enerji verimliliğini artıran kanal izolasyon çözümleri.',
                    'en' => 'Duct insulation solutions that provide sound and heat insulation in HVAC systems and increase energy efficiency.'
                ],
                'content' => [
                    'tr' => '<p>Havalandırma (HVAC) sistemlerinde kanal izolasyonu, hem enerji tasarrufu hem de akustik konfor için gereklidir. İzokoç olarak, cam yünü, taşyünü ve elastomerik malzemeler ile profesyonel kanal izolasyonu hizmetleri sunuyoruz.</p>

<h3>Endüstriyel Havalandırma Sistemleri</h3>
<p>Fabrikalar, AVM\'ler ve büyük yapılarda havalandırma kanallarının izolasyonu enerji maliyetlerini önemli ölçüde azaltır.</p>

<h3>Kafe Ve Restoran Havalandırma Sistemleri</h3>
<p>Mutfak egzoz sistemlerinde özel yangın dayanımlı izolasyon malzemeleri kullanıyoruz.</p>',
                    'en' => '<p>In ventilation (HVAC) systems, duct insulation is necessary for both energy savings and acoustic comfort. As İzokoç, we offer professional duct insulation services with glass wool, rock wool, and elastomeric materials.</p>

<h3>Industrial Ventilation Systems</h3>
<p>Insulation of ventilation ducts in factories, shopping malls, and large buildings significantly reduces energy costs.</p>

<h3>Cafe And Restaurant Ventilation Systems</h3>
<p>We use special fire-resistant insulation materials in kitchen exhaust systems.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Enerji kaybının önlenmesi', 'en' => 'Prevention of energy loss']],
                    ['text' => ['tr' => 'Gürültünün azaltılması', 'en' => 'Noise reduction']],
                    ['text' => ['tr' => 'Yoğuşma problemlerinin çözümü', 'en' => 'Solution to condensation problems']],
                    ['text' => ['tr' => 'İç hava kalitesinin korunması', 'en' => 'Preservation of indoor air quality']],
                ],
                'expectations_content' => null,
                'support_items' => [
                    ['text' => ['tr' => 'Endüstriyel Havalandırma Sistemleri', 'en' => 'Industrial Ventilation Systems']],
                    ['text' => ['tr' => 'Kafe Ve Restoran Havalandırma Sistemleri', 'en' => 'Cafe And Restaurant Ventilation Systems']],
                ],
                'faqs' => null,
                'cover_image' => 'uploads/services/havalandirma-cover.jpg',
                'gallery_images' => null,
                'order' => 7,
                'is_active' => true,
                'banner_title' => ['tr' => 'Havalandırma İzolasyonu', 'en' => 'Ventilation Insulation'],
                'banner_subtitle' => ['tr' => 'Enerji ve Akustik Çözümler', 'en' => 'Energy and Acoustic Solutions'],
            ],

// HİZMET 8: Vana Yalıtım Ceketleri
            [
                'title' => [
                    'tr' => 'Buhar Vana Yalıtım Ceketi',
                    'en' => 'Steam Valve Insulation Jacket'
                ],
                'slug' => 'buhar-vana-yalitim-ceketi',
                'summary' => [
                    'tr' => 'Sökülüp takılabilir, enerji tasarrufu sağlayan, bakım kolaylığı sunan profesyonel vana izolasyon ceketleri.',
                    'en' => 'Professional valve insulation jackets that are removable, provide energy savings, and offer easy maintenance.'
                ],
                'content' => [
                    'tr' => '<p>Vana yalıtım ceketleri, endüstriyel tesislerde en çok ısı kaybının yaşandığı noktalar olan vana, flanş ve bağlantı elemanları için özel olarak tasarlanmış çıkarılabilir izolasyon çözümleridir.</p>

<h3>Vana Ceketlerinin Avantajları</h3>
<p>Geleneksel sac kaplamalı izolasyona göre bakım sırasında çok daha hızlı sökülüp takılabilir. Yüzlerce kez tekrar kullanılabilir.</p>

<h3>Teknik Özellikler</h3>
<ul>
<li>600°C\'ye kadar sıcaklığa dayanıklı</li>
<li>Özel ısıya dayanıklı kumaş kaplama</li>
<li>Cırt cırt veya kayış bağlantı sistemi</li>
<li>Her vana tipine özel imalat</li>
</ul>',
                    'en' => '<p>Valve insulation jackets are removable insulation solutions specially designed for valves, flanges, and connection elements, which are the points with the most heat loss in industrial facilities.</p>

<h3>Advantages of Valve Jackets</h3>
<p>Compared to traditional sheet metal insulation, they can be removed and installed much faster during maintenance. Can be reused hundreds of times.</p>

<h3>Technical Features</h3>
<ul>
<li>Resistant to temperatures up to 600°C</li>
<li>Special heat-resistant fabric coating</li>
<li>Velcro or strap connection system</li>
<li>Custom manufacturing for each valve type</li>
</ul>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Bakım süresinde %80 azalma', 'en' => '80% reduction in maintenance time']],
                    ['text' => ['tr' => 'Yüzlerce kez tekrar kullanılabilir', 'en' => 'Reusable hundreds of times']],
                    ['text' => ['tr' => 'Enerji kaybının %95 önlenmesi', 'en' => 'Prevention of 95% energy loss']],
                    ['text' => ['tr' => 'Hızlı yatırım geri dönüşü', 'en' => 'Quick return on investment']],
                ],
                'expectations_content' => null,
                'support_items' => [
                    ['text' => ['tr' => 'Buhar Vana Yalıtım Ceketi', 'en' => 'Steam Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Soğutma Vana Yalıtım Ceketi', 'en' => 'Cooling Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Kızgın Yağ Vana Yalıtım Ceketi', 'en' => 'Hot Oil Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Kazan Kapakları Yalıtım Ceketi', 'en' => 'Boiler Cap Insulation Jacket']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Vana ceketi ne kadar dayanır?', 'en' => 'How long does a valve jacket last?'],
                        'answer' => ['tr' => '<p>Normal kullanımda 5-7 yıl arası kullanım ömrü vardır. Yüzlerce kez sökülüp takılabilir.</p>', 'en' => '<p>With normal use, it has a service life of 5-7 years. Can be removed and installed hundreds of times.</p>'],
                    ],
                ],
                'cover_image' => 'uploads/services/vana-ceketi-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/vana-ceketi-1.jpg',
                    'uploads/services/gallery/vana-ceketi-2.jpg',
                ],
                'order' => 8,
                'is_active' => true,
                'banner_title' => ['tr' => 'Vana Yalıtım Ceketleri', 'en' => 'Valve Insulation Jackets'],
                'banner_subtitle' => ['tr' => 'Sökülüp Takılabilir Çözümler', 'en' => 'Removable Solutions'],
            ],

// HİZMET 9: İzolasyonlu Eşanjör Kutusu
            [
                'title' => [
                    'tr' => 'İzolasyonlu Eşanjör Kutusu',
                    'en' => 'Insulated Heat Exchanger Box'
                ],
                'slug' => 'izolasyonlu-esanjor-kutusu',
                'summary' => [
                    'tr' => 'Eşanjörler için özel tasarlanmış, enerji kaybını minimuma indiren profesyonel izolasyon kutuları.',
                    'en' => 'Professional insulation boxes specially designed for heat exchangers that minimize energy loss.'
                ],
                'content' => [
                    'tr' => '<p>Eşanjörler, endüstriyel proseslerde ısı transferi sağlayan kritik ekipmanlardır. İzokoç olarak, eşanjörleriniz için özel tasarlanmış, sökülüp takılabilir izolasyon kutuları üretiyoruz.</p>

<h3>Özel Tasarım</h3>
<p>Her eşanjör tipine özel ölçü alınarak, ekipmana tam oturan izolasyon kutuları imalatı yapıyoruz.</p>',
                    'en' => '<p>Heat exchangers are critical equipment that provide heat transfer in industrial processes. As İzokoç, we produce removable insulation boxes specially designed for your heat exchangers.</p>

<h3>Custom Design</h3>
<p>We manufacture insulation boxes that fit the equipment perfectly by taking measurements specific to each heat exchanger type.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Proses verimliliğinin artırılması', 'en' => 'Increased process efficiency']],
                    ['text' => ['tr' => 'Enerji kayıplarının minimizasyonu', 'en' => 'Minimization of energy losses']],
                    ['text' => ['tr' => 'Kolay bakım imkanı', 'en' => 'Easy maintenance possibility']],
                ],
                'expectations_content' => null,
                'support_items' => null,
                'faqs' => null,
                'cover_image' => 'uploads/services/esanjor-cover.jpg',
                'gallery_images' => null,
                'order' => 9,
                'is_active' => true,
                'banner_title' => ['tr' => 'İzolasyonlu Eşanjör Kutusu', 'en' => 'Insulated Heat Exchanger Box'],
                'banner_subtitle' => ['tr' => 'Özel Tasarım Çözümler', 'en' => 'Custom Design Solutions'],
            ],
            [
                'title' => [
                    'tr' => 'Soğutma Vana Yalıtım Ceketi',
                    'en' => 'Cooling Valve Insulation Jacket'
                ],
                'slug' => 'sogutma-vana-yalitim-ceketi',
                'summary' => [
                    'tr' => 'Chiller ve soğutma sistemlerindeki vanalar için özel tasarlanmış, yoğuşmayı önleyen, sökülüp takılabilir yalıtım ceketleri.',
                    'en' => 'Specially designed removable insulation jackets for valves in chiller and cooling systems that prevent condensation.'
                ],
                'content' => [
                    'tr' => '<p>Soğutma sistemlerindeki vanalar, yoğuşma problemi yaşanan en kritik noktalardandır. İzokoç Soğutma Vana Yalıtım Ceketleri, bu problemleri ortadan kaldırmak için özel olarak tasarlanmıştır.</p>

<h3>Soğutma Sistemlerinde Vana Yalıtımının Önemi</h3>
<p>Soğutma hatlarındaki vanalarda izolasyon yapılmadığında, yüzey sıcaklığı düşük olduğu için havadaki nem yoğuşarak damla damla su oluşur. Bu durum hem korozyona hem de iş güvenliği problemlerine yol açar.</p>

<h3>Özel Tasarım Özellikleri</h3>
<ul>
<li><strong>Kapalı Hücre Yapı:</strong> Elastomerik kauçuk malzeme, nemi geçirmez</li>
<li><strong>Buhar Bariyeri:</strong> İlave buhar bariyeri katmanı ile tam koruma</li>
<li><strong>Esnek Tasarım:</strong> Her vana şekline uyum sağlar</li>
<li><strong>Kolay Bakım:</strong> Dakikalar içinde sökülüp takılabilir</li>
</ul>

<h3>Uygulama Alanları</h3>
<p>Chiller sistemleri, soğuk su hatları, iklimlendirme sistemleri, soğuk hava depoları ve endüstriyel soğutma sistemlerinde kullanılır.</p>

<h3>Malzeme Özellikleri</h3>
<p>-20°C ile +110°C arası sıcaklık aralığında çalışabilir. UV\'ye dayanıklı dış yüzey kaplaması sayesinde dış mekanda da kullanılabilir.</p>',
                    'en' => '<p>Valves in cooling systems are among the most critical points experiencing condensation problems. İzokoç Cooling Valve Insulation Jackets are specially designed to eliminate these problems.</p>

<h3>Importance of Valve Insulation in Cooling Systems</h3>
<p>When insulation is not applied to valves in cooling lines, moisture in the air condenses and forms water droplets because the surface temperature is low. This situation leads to both corrosion and occupational safety problems.</p>

<h3>Special Design Features</h3>
<ul>
<li><strong>Closed Cell Structure:</strong> Elastomeric rubber material is impermeable to moisture</li>
<li><strong>Vapor Barrier:</strong> Full protection with additional vapor barrier layer</li>
<li><strong>Flexible Design:</strong> Adapts to every valve shape</li>
<li><strong>Easy Maintenance:</strong> Can be removed and installed within minutes</li>
</ul>

<h3>Application Areas</h3>
<p>Used in chiller systems, cold water lines, air conditioning systems, cold storage facilities, and industrial cooling systems.</p>

<h3>Material Properties</h3>
<p>Can operate in a temperature range of -20°C to +110°C. Can also be used outdoors thanks to UV-resistant outer surface coating.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Yoğuşmanın %100 önlenmesi', 'en' => '100% prevention of condensation']],
                    ['text' => ['tr' => 'Korozyon riskinin ortadan kaldırılması', 'en' => 'Elimination of corrosion risk']],
                    ['text' => ['tr' => 'Enerji kayıplarının minimizasyonu', 'en' => 'Minimization of energy losses']],
                    ['text' => ['tr' => 'Bakım süresinde %85 azalma', 'en' => '85% reduction in maintenance time']],
                    ['text' => ['tr' => 'Yüzlerce kez tekrar kullanılabilir', 'en' => 'Reusable hundreds of times']],
                    ['text' => ['tr' => 'İş güvenliği standartlarına uyum', 'en' => 'Compliance with occupational safety standards']],
                ],
                'expectations_content' => [
                    'tr' => '<p>Her soğutma vana modeli için özel ölçü alarak, tam oturan ve %100 yoğuşma garantisi veren ceketler üretiyoruz. Tüm ürünlerimiz test edilerek teslim edilir.</p>',
                    'en' => '<p>We produce jackets that fit perfectly and guarantee 100% condensation prevention by taking custom measurements for each cooling valve model. All our products are tested before delivery.</p>'
                ],
                'support_items' => [
                    ['text' => ['tr' => 'Chiller Vana Yalıtım Ceketi', 'en' => 'Chiller Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Soğuk Su Hattı Vana Ceketi', 'en' => 'Cold Water Line Valve Jacket']],
                    ['text' => ['tr' => 'Freon Vana Yalıtım Ceketi', 'en' => 'Freon Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Soğuk Hava Deposu Vana Ceketi', 'en' => 'Cold Storage Valve Jacket']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Neden elastomerik kauçuk tercih edilir?', 'en' => 'Why is elastomeric rubber preferred?'],
                        'answer' => ['tr' => '<p>Elastomerik kauçuk, kapalı hücre yapısı sayesinde nem geçirmez. Bu özellik, soğutma sistemlerinde yoğuşmayı önlemek için kritik öneme sahiptir. Ayrıca esnektir ve her türlü vana geometrisine uyum sağlar.</p>', 'en' => '<p>Elastomeric rubber is impermeable to moisture thanks to its closed cell structure. This feature is critical for preventing condensation in cooling systems. It is also flexible and adapts to all types of valve geometries.</p>'],
                    ],
                    [
                        'question' => ['tr' => 'Soğutma vana ceketi kaç derece dayanır?', 'en' => 'What temperature can cooling valve jackets withstand?'],
                        'answer' => ['tr' => '<p>Soğutma vana ceketlerimiz -20°C ile +110°C arasında güvenle çalışır. Bu sıcaklık aralığı, tüm soğutma ve iklimlendirme uygulamaları için yeterlidir.</p>', 'en' => '<p>Our cooling valve jackets operate safely between -20°C and +110°C. This temperature range is sufficient for all cooling and air conditioning applications.</p>'],
                    ],
                    [
                        'question' => ['tr' => 'Dış mekanda kullanılabilir mi?', 'en' => 'Can it be used outdoors?'],
                        'answer' => ['tr' => '<p>Evet, UV\'ye dayanıklı dış yüzey kaplaması sayesinde dış mekan uygulamalarında da güvenle kullanılabilir. Güneş ışınları ve hava koşullarına karşı dayanıklıdır.</p>', 'en' => '<p>Yes, it can be safely used in outdoor applications thanks to its UV-resistant outer surface coating. It is resistant to sunlight and weather conditions.</p>'],
                    ],
                ],
                'cover_image' => 'uploads/services/sogutma-vana-ceketi-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/sogutma-vana-1.jpg',
                    'uploads/services/gallery/sogutma-vana-2.jpg',
                ],
                'order' => 10,
                'is_active' => true,
                'banner_title' => ['tr' => 'Soğutma Vana Yalıtım Ceketi', 'en' => 'Cooling Valve Insulation Jacket'],
                'banner_subtitle' => ['tr' => 'Yoğuşma Problemine Son', 'en' => 'End to Condensation Problems'],
            ],

// HİZMET 11: Kızgın Yağ Vana Yalıtım Ceketi
            [
                'title' => [
                    'tr' => 'Kızgın Yağ Vana Yalıtım Ceketi',
                    'en' => 'Hot Oil Valve Insulation Jacket'
                ],
                'slug' => 'kizgin-yag-vana-yalitim-ceketi',
                'summary' => [
                    'tr' => 'Termal yağ sistemlerinde 350°C\'ye kadar yüksek sıcaklıklara dayanıklı, enerji tasarrufu sağlayan sökülüp takılabilir vana ceketleri.',
                    'en' => 'Removable valve jackets for thermal oil systems resistant to high temperatures up to 350°C, providing energy savings.'
                ],
                'content' => [
                    'tr' => '<p>Kızgın yağ (termal yağ) sistemleri, endüstrinin en yüksek sıcaklıklarda çalışan proseslerindendir. Bu sistemlerdeki vanalarda yapılan izolasyon, hem enerji tasarrufu hem de personel güvenliği açısından kritik öneme sahiptir.</p>

<h3>Kızgın Yağ Sistemlerinin Özellikleri</h3>
<p>Termal yağ sistemleri genellikle 250-350°C sıcaklıklarda çalışır. Bu yüksek sıcaklıklar nedeniyle özel izolasyon malzemeleri ve uygulama teknikleri gerektirir.</p>

<h3>Yüksek Sıcaklık Teknolojisi</h3>
<ul>
<li><strong>Seramik Fiber İçerik:</strong> 600°C\'ye kadar dayanım</li>
<li><strong>Çok Katmanlı Yapı:</strong> Maksimum termal koruma</li>
<li><strong>Isıya Dayanıklı Kumaş:</strong> Özel dokuma dış kaplama</li>
<li><strong>Modüler Tasarım:</strong> Kolay montaj ve demontaj</li>
</ul>

<h3>Enerji Tasarrufu</h3>
<p>350°C sıcaklıktaki bir vananın yalıtımı, yıllık yaklaşık 15.000 kWh enerji tasarrufu sağlar. Bu da binlerce lira maliyet düşüşü anlamına gelir.</p>

<h3>Güvenlik Önlemleri</h3>
<p>İzolasyonsuz kızgın yağ vanaları, yüzey sıcaklığı 300°C\'yi aşabilir. Bu sıcaklık, ciddi yanık riskine neden olur. Vana ceketlerimiz, yüzey sıcaklığını 60°C\'nin altına düşürerek iş güvenliğini sağlar.</p>',
                    'en' => '<p>Hot oil (thermal oil) systems are among the industry\'s highest temperature operating processes. Insulation of valves in these systems is critical for both energy savings and personnel safety.</p>

<h3>Features of Hot Oil Systems</h3>
<p>Thermal oil systems typically operate at temperatures of 250-350°C. These high temperatures require special insulation materials and application techniques.</p>

<h3>High Temperature Technology</h3>
<ul>
<li><strong>Ceramic Fiber Content:</strong> Resistance up to 600°C</li>
<li><strong>Multi-Layer Structure:</strong> Maximum thermal protection</li>
<li><strong>Heat Resistant Fabric:</strong> Special woven outer coating</li>
<li><strong>Modular Design:</strong> Easy assembly and disassembly</li>
</ul>

<h3>Energy Savings</h3>
<p>Insulation of a valve at 350°C provides approximately 15,000 kWh of annual energy savings. This means thousands of lira in cost reduction.</p>

<h3>Safety Measures</h3>
<p>Uninsulated hot oil valves can have surface temperatures exceeding 300°C. This temperature causes a serious risk of burns. Our valve jackets ensure occupational safety by reducing the surface temperature below 60°C.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Yüksek sıcaklıkta güvenli çalışma (600°C)', 'en' => 'Safe operation at high temperature (600°C)']],
                    ['text' => ['tr' => 'Enerji kayıplarında %90 azalma', 'en' => '90% reduction in energy losses']],
                    ['text' => ['tr' => 'Personel güvenliğinin sağlanması', 'en' => 'Ensuring personnel safety']],
                    ['text' => ['tr' => 'Bakım kolaylığı ve hız', 'en' => 'Maintenance convenience and speed']],
                    ['text' => ['tr' => '3-6 ay içinde yatırım geri dönüşü', 'en' => 'Return on investment within 3-6 months']],
                    ['text' => ['tr' => 'Uzun ömür ve dayanıklılık', 'en' => 'Long life and durability']],
                ],
                'expectations_content' => [
                    'tr' => '<p>Her kızgın yağ vanası için yerinde teknik analiz yapıyor, özel mühendislik hesaplamalarıyla en uygun izolasyon kalınlığını belirliyoruz. Tüm ürünlerimiz termal kamera ile test edilir.</p>',
                    'en' => '<p>We perform on-site technical analysis for each hot oil valve and determine the most suitable insulation thickness with special engineering calculations. All our products are tested with thermal camera.</p>'
                ],
                'support_items' => [
                    ['text' => ['tr' => 'Termal Yağ Vana Ceketi (250-350°C)', 'en' => 'Thermal Oil Valve Jacket (250-350°C)']],
                    ['text' => ['tr' => 'Yüksek Sıcaklık Flanş Ceketi', 'en' => 'High Temperature Flange Jacket']],
                    ['text' => ['tr' => 'Kızgın Yağ Manifold İzolasyon Ceketi', 'en' => 'Hot Oil Manifold Insulation Jacket']],
                    ['text' => ['tr' => 'Sıcak Yağ Pompası İzolasyon Ceketi', 'en' => 'Hot Oil Pump Insulation Jacket']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => '350°C sıcaklıkta güvenli midir?', 'en' => 'Is it safe at 350°C temperature?'],
                        'answer' => ['tr' => '<p>Evet, seramik fiber malzememiz 600°C\'ye kadar dayanıklıdır. 350°C\'deki bir vanada güvenle kullanılabilir ve yüzey sıcaklığını 60°C\'nin altına düşürür.</p>', 'en' => '<p>Yes, our ceramic fiber material is resistant up to 600°C. It can be safely used on a valve at 350°C and reduces the surface temperature below 60°C.</p>'],
                    ],
                    [
                        'question' => ['tr' => 'Ne kadar enerji tasarrufu sağlar?', 'en' => 'How much energy savings does it provide?'],
                        'answer' => ['tr' => '<p>350°C sıcaklıktaki DN100 bir vana için yıllık yaklaşık 15.000 kWh enerji tasarrufu sağlanır. Bu, yıllık 7.500-10.000 TL arasında maliyet düşüşü anlamına gelir.</p>', 'en' => '<p>Approximately 15,000 kWh of annual energy savings is provided for a DN100 valve at 350°C. This means an annual cost reduction of 7,500-10,000 TL.</p>'],
                    ],
                    [
                        'question' => ['tr' => 'Bakım sırasında kolayca sökülür mü?', 'en' => 'Is it easily removed during maintenance?'],
                        'answer' => ['tr' => '<p>Evet, özel cırt cırt veya kayış bağlantı sistemi sayesinde dakikalar içinde sökülüp takılabilir. Geleneksel sac izolasyona göre %90 daha hızlıdır.</p>', 'en' => '<p>Yes, it can be removed and installed within minutes thanks to the special velcro or strap connection system. It is 90% faster than traditional sheet metal insulation.</p>'],
                    ],
                ],
                'cover_image' => 'uploads/services/kizgin-yag-vana-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/kizgin-yag-vana-1.jpg',
                    'uploads/services/gallery/kizgin-yag-vana-2.jpg',
                    'uploads/services/gallery/kizgin-yag-vana-3.jpg',
                ],
                'order' => 11,
                'is_active' => true,
                'banner_title' => ['tr' => 'Kızgın Yağ Vana Yalıtım Ceketi', 'en' => 'Hot Oil Valve Insulation Jacket'],
                'banner_subtitle' => ['tr' => 'Yüksek Sıcaklık Çözümleri', 'en' => 'High Temperature Solutions'],
            ],

// HİZMET 12: Kazan Kapakları Yalıtım Ceketi
            [
                'title' => [
                    'tr' => 'Kazan Kapakları Yalıtım Ceketi',
                    'en' => 'Boiler Covers Insulation Jacket'
                ],
                'slug' => 'kazan-kapaklari-yalitim-ceketi',
                'summary' => [
                    'tr' => 'Kazan kapakları, muayene kapakları ve erişim noktaları için özel tasarlanmış, sökülüp takılabilir yalıtım ceketleri.',
                    'en' => 'Specially designed removable insulation jackets for boiler covers, inspection covers, and access points.'
                ],
                'content' => [
                    'tr' => '<p>Kazanların muayene kapakları, erişim kapakları ve bakım açıklıkları, genellikle ihmal edilen ancak önemli enerji kayıplarına neden olan noktalardır. İzokoç Kazan Kapakları Yalıtım Ceketleri, bu problemlere pratik ve ekonomik çözüm sunar.</p>

<h3>Kazan Kapakları Neden Önemlidir?</h3>
<p>Bir kazandaki izolasyonsuz kapak veya açıklık, metrekare başına saatte 2000 kcal\'den fazla ısı kaybına neden olabilir. Ayrıca, yüksek yüzey sıcaklıkları personel için tehlike oluşturur.</p>

<h3>Özel Tasarım Avantajları</h3>
<ul>
<li><strong>Tam Oturum:</strong> Her kapak geometrisine özel imalat</li>
<li><strong>Hızlı Erişim:</strong> Bakım için saniyeler içinde açılır</li>
<li><strong>Yüksek Sıcaklık Dayanımı:</strong> 450°C\'ye kadar güvenle çalışır</li>
<li><strong>Tekrar Kullanılabilir:</strong> Yüzlerce açma-kapama döngüsüne dayanır</li>
</ul>

<h3>Uygulama Alanları</h3>
<p>Buhar kazanları, kızgın yağ kazanları, termal yağ kazanları, fırınlar ve yüksek sıcaklıkta çalışan tüm endüstriyel ekipmanlarda kullanılır.</p>

<h3>Ekonomik Avantajlar</h3>
<p>Kazan kapakları izolasyon ceketleri, genellikle 6-12 ay içinde kendini amorti eder. Enerji tasarrufu yanında, bakım süresinin kısalması da önemli maliyet avantajı sağlar.</p>',
                    'en' => '<p>Inspection covers, access covers, and maintenance openings of boilers are often neglected points that cause significant energy losses. İzokoç Boiler Cover Insulation Jackets offer practical and economical solutions to these problems.</p>

<h3>Why Are Boiler Covers Important?</h3>
<p>An uninsulated cover or opening on a boiler can cause more than 2000 kcal of heat loss per square meter per hour. Additionally, high surface temperatures pose a danger to personnel.</p>

<h3>Special Design Advantages</h3>
<ul>
<li><strong>Perfect Fit:</strong> Custom manufacturing for each cover geometry</li>
<li><strong>Quick Access:</strong> Opens within seconds for maintenance</li>
<li><strong>High Temperature Resistance:</strong> Operates safely up to 450°C</li>
<li><strong>Reusable:</strong> Withstands hundreds of open-close cycles</li>
</ul>

<h3>Application Areas</h3>
<p>Used in steam boilers, hot oil boilers, thermal oil boilers, furnaces, and all industrial equipment operating at high temperatures.</p>

<h3>Economic Advantages</h3>
<p>Boiler cover insulation jackets typically pay for themselves within 6-12 months. In addition to energy savings, shortening maintenance time also provides significant cost advantages.</p>'
                ],
                'benefits' => [
                    ['text' => ['tr' => 'Enerji kayıplarında %95 azalma', 'en' => '95% reduction in energy losses']],
                    ['text' => ['tr' => 'Bakım süresinde %90 kısalma', 'en' => '90% reduction in maintenance time']],
                    ['text' => ['tr' => 'Personel güvenliğinin artırılması', 'en' => 'Increased personnel safety']],
                    ['text' => ['tr' => '6-12 ay içinde yatırım geri dönüşü', 'en' => 'Return on investment within 6-12 months']],
                    ['text' => ['tr' => 'Uzun ömür ve dayanıklılık', 'en' => 'Long life and durability']],
                    ['text' => ['tr' => 'Her türlü geometriye uyum', 'en' => 'Adaptation to all types of geometry']],
                ],
                'expectations_content' => [
                    'tr' => '<p>Her kazan kapağı için yerinde ölçüm yaparak, milimetre hassasiyetinde tam oturan ceketler üretiyoruz. Özel mühendislik çözümleri ile her türlü kapak ve açıklık için ideal izolasyon sağlıyoruz.</p>',
                    'en' => '<p>We produce perfectly fitting jackets with millimeter precision by taking on-site measurements for each boiler cover. We provide ideal insulation for all types of covers and openings with special engineering solutions.</p>'
                ],
                'support_items' => [
                    ['text' => ['tr' => 'Kazan Muayene Kapağı Ceketi', 'en' => 'Boiler Inspection Cover Jacket']],
                    ['text' => ['tr' => 'Kazan Erişim Kapağı Yalıtımı', 'en' => 'Boiler Access Cover Insulation']],
                    ['text' => ['tr' => 'Fırın Kapağı İzolasyon Ceketi', 'en' => 'Furnace Cover Insulation Jacket']],
                    ['text' => ['tr' => 'Baca Temizleme Kapağı Ceketi', 'en' => 'Chimney Cleaning Cover Jacket']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Her kazan modeline uyar mı?', 'en' => 'Does it fit every boiler model?'],
                        'answer' => ['tr' => '<p>Evet, yerinde ölçüm alarak her kazan modeli ve kapak tipi için özel üretim yapıyoruz. Standart veya atipik geometriler fark etmeksizin çözüm üretebiliriz.</p>', 'en' => '<p>Yes, we custom manufacture for every boiler model and cover type by taking on-site measurements. We can provide solutions regardless of standard or atypical geometries.</p>'],
                    ],
                    [
                        'question' => ['tr' => 'Bakım sırasında ne kadar sürede çıkarılır?', 'en' => 'How long does it take to remove during maintenance?'],
                        'answer' => ['tr' => '<p>Cırt cırt veya hızlı bağlantı sistemleri sayesinde 10-30 saniye içinde çıkarılabilir. Geleneksel izolasyona göre saatler kazandırır.</p>', 'en' => '<p>It can be removed within 10-30 seconds thanks to velcro or quick connection systems. Saves hours compared to traditional insulation.</p>'],
                    ],
                    [
                        'question' => ['tr' => 'Kaç kez kullanılabilir?', 'en' => 'How many times can it be used?'],
                        'answer' => ['tr' => '<p>Normal kullanım koşullarında 500-1000 açma-kapama döngüsüne dayanır. Bu da yaklaşık 5-7 yıllık kullanım ömrü anlamına gelir.</p>', 'en' => '<p>Under normal usage conditions, it withstands 500-1000 open-close cycles. This means approximately 5-7 years of service life.</p>'],
                    ],
                ],
                'cover_image' => 'uploads/services/kazan-kapaklari-cover.jpg',
                'gallery_images' => [
                    'uploads/services/gallery/kazan-kapaklari-1.jpg',
                    'uploads/services/gallery/kazan-kapaklari-2.jpg',
                ],
                'order' => 12,
                'is_active' => true,
                'banner_title' => ['tr' => 'Kazan Kapakları Yalıtım Ceketi', 'en' => 'Boiler Covers Insulation Jacket'],
                'banner_subtitle' => ['tr' => 'Pratik ve Ekonomik Çözüm', 'en' => 'Practical and Economical Solution'],
            ],
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}