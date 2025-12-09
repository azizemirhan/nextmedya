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

        $services = [
            // HİZMET 1: Mekanik Tesisat / Boru İzolasyonu
            [
                'title' => ['tr' => 'Mekanik Tesisat ve Boru İzolasyonu', 'en' => 'Mechanical/HVAC & Pipe Insulation'],
                'slug' => 'mekanik-tesisat-izolasyonu',
                'summary' => ['tr' => 'Isıtma, soğutma, buhar ve kızgın yağ hatlarında enerji kayıplarını önleyen profesyonel yalıtım çözümleri.', 'en' => 'Professional insulation solutions to prevent energy loss in heating, cooling, steam, and hot oil lines.'],
                'content' => ['tr' => 'Tesislerdeki en büyük enerji kayıpları genellikle boru hatlarından kaynaklanır. İzokoç olarak, buhar hatları, kızgın yağ tesisatları ve soğutma (chiller) hatları için en uygun malzemelerle (taşyünü, kauçuk köpüğü vb.) ve alüminyum/galvaniz sac kaplama ile yalıtım uygulamaları yapıyoruz. Amacımız, proses verimliliğinizi artırmak ve işletme maliyetlerinizi düşürmektir.', 'en' => 'The largest energy losses in facilities often come from pipelines. As İzokoç, we apply insulation with the most suitable materials (rockwool, rubber foam, etc.) and aluminum/galvanized sheet metal cladding for steam lines, hot oil installations, and cooling (chiller) lines. Our goal is to increase your process efficiency and reduce your operating costs.'],
                'benefits' => [
                    ['text' => ['tr' => 'Maksimum enerji tasarrufu ve verimlilik', 'en' => 'Maximum energy savings and efficiency']],
                    ['text' => ['tr' => 'İşletme maliyetlerinde ölçülebilir azalma', 'en' => 'Measurable reduction in operating costs']],
                    ['text' => ['tr' => 'İSG için güvenli yüzey sıcaklıkları', 'en' => 'Safe surface temperatures for OHS']],
                    ['text' => ['tr' => 'Korozyona karşı koruma ve uzun ömür', 'en' => 'Corrosion protection and long lifespan']],
                ],
                'expectations_content' => ['tr' => 'Prosesinize (buhar, soğuk, yağ) özel malzeme seçimi ve uluslararası standartlarda uygulama garantisi sunuyoruz. Hatlarınızdaki enerji kaçağını durduruyoruz.', 'en' => 'We offer material selection specific to your process (steam, cold, oil) and guarantee application at international standards. We stop the energy leakage in your lines.'],
                'support_items' => [
                    ['text' => ['tr' => 'Buhar Hattı İzolasyonu', 'en' => 'Steam Line Insulation']],
                    ['text' => ['tr' => 'Kızgın Yağ Hattı İzolasyonu', 'en' => 'Hot Oil Line Insulation']],
                    ['text' => ['tr' => 'Soğutma ve Chiller Hattı İzolasyonu', 'en' => 'Cooling and Chiller Line Insulation']],
                    ['text' => ['tr' => 'Sıcak & Soğuk Su Tesisatı Yalıtımı', 'en' => 'Hot & Cold Water Plumbing Insulation']],
                ],
                'faqs' => [
                    [
                        'question' => ['tr' => 'Doğru izolasyon kalınlığı nasıl belirlenir?', 'en' => 'How is the correct insulation thickness determined?'],
                        'answer' => ['tr' => 'Kalınlık, hattın sıcaklığına, boru çapına ve hedeflenen enerji tasarrufu miktarına göre mühendislik hesaplamalarıyla belirlenir.', 'en' => 'The thickness is determined by engineering calculations based on the line temperature, pipe diameter, and targeted amount of energy savings.'],
                    ],
                    [
                        'question' => ['tr' => 'Kaplama malzemesi (Sac, PVC) neye göre seçilir?', 'en' => 'How is the cladding material (Sheet Metal, PVC) chosen?'],
                        'answer' => ['tr' => 'İç ortam uygulamalarında alüminyum veya PVC, dış ortam ve ağır sanayi koşullarında ise galvaniz veya paslanmaz sac kaplama tercih edilir.', 'en' => 'Aluminum or PVC is preferred for indoor applications, while galvanized or stainless steel cladding is preferred for outdoor and heavy industry conditions.'],
                    ],
                ],
                'cover_image' => 'placeholders/service_cover_1.jpg',
                'gallery_images' => ['placeholders/service_gallery_1.jpg', 'placeholders/service_gallery_2.jpg', 'placeholders/service_gallery_3.jpg'],
                'order' => 1, 'is_active' => true,
            ],
            // HİZMET 2: Endüstriyel Ekipman İzolasyonu
            [
                'title' => ['tr' => 'Kazan, Tank ve Ekipman İzolasyonu', 'en' => 'Boiler, Tank & Equipment Insulation'],
                'slug' => 'kazan-tank-izolasyonu',
                'summary' => ['tr' => 'Kazanlar, depolama tankları, eşanjörler ve diğer endüstriyel ekipmanlar için özel yalıtım uygulamaları.', 'en' => 'Custom insulation applications for boilers, storage tanks, heat exchangers, and other industrial equipment.'],
                'content' => ['tr' => 'Endüstriyel ekipmanların (buhar kazanları, depolama tankları, eşanjörler, filtreler) yalıtımı, hem prosesin kararlılığı hem de enerji tasarrufu için kritik öneme sahiptir. Yüksek sıcaklıktaki yüzeyler için taşyünü, düşük sıcaklıktaki tanklar için kauçuk veya poliüretan bazlı çözümler sunarak prosesinizi güvence altına alıyoruz.', 'en' => 'Insulating industrial equipment (steam boilers, storage tanks, exchangers, filters) is critical for both process stability and energy savings. We secure your process by offering rockwool solutions for high-temperature surfaces and rubber or polyurethane-based solutions for low-temperature tanks.'],
                'benefits' => [
                    ['text' => ['tr' => 'Proses sıcaklığının sabit tutulması', 'en' => 'Maintaining stable process temperature']],
                    ['text' => ['tr' => 'Çalışma ortamı güvenliğinin artırılması', 'en' => 'Increasing workplace safety']],
                    ['text' => ['tr' => 'Ekipman ömrünün uzatılması', 'en' => 'Extending equipment lifespan']],
                    ['text' => ['tr' => 'Yoğuşma ve donma riskinin önlenmesi', 'en' => 'Prevention of condensation and freezing risks']],
                ],
                'expectations_content' => ['tr' => 'Ekipmanınızın geometrisine tam uyumlu, sökülüp takılabilir veya sabit, en yüksek kalitede yalıtım sağlıyoruz.', 'en' => 'We provide the highest quality insulation, either removable or fixed, perfectly matching your equipment\'s geometry.'],
                'support_items' => [
                    ['text' => ['tr' => 'Kazan İzolasyonu ve Sac Kaplaması', 'en' => 'Boiler Insulation and Cladding']],
                    ['text' => ['tr' => 'Depolama Tankı İzolasyonu (Sıcak/Soğuk)', 'en' => 'Storage Tank Insulation (Hot/Cold)']],
                    ['text' => ['tr' => 'Eşanjör ve Filtre Yalıtımı', 'en' => 'Heat Exchanger and Filter Insulation']],
                ],
                'faqs' => null,
                'cover_image' => 'placeholders/service_cover_2.jpg',
                'gallery_images' => ['placeholders/service_gallery_4.jpg', 'placeholders/service_gallery_5.jpg'],
                'order' => 2, 'is_active' => true,
            ],
            // HİZMET 3: Vana Ceketleri
            [
                'title' => ['tr' => 'Sökülebilir Vana ve Ekipman Ceketleri', 'en' => 'Removable Valve & Equipment Jackets'],
                'slug' => 'vana-ceketleri',
                'summary' => ['tr' => 'Bakım kolaylığı sağlayan, sökülüp takılabilir, yüksek tasarruflu termal yalıtım ceketleri.', 'en' => 'Easy-to-maintain, removable, and high-efficiency thermal insulation jackets.'],
                'content' => ['tr' => 'Vana, flanş, kompansatör gibi sık bakım gerektiren ekipmanlar, sabit yalıtımın en zayıf halkalarıdır. İzokoç Vana Ceketleri, bu noktalar için özel olarak tasarlanır. Yüksek sıcaklığa dayanıklı kumaşlar ve yalıtım malzemeleri ile üretilirler. Kolayca sökülüp takılabilir, bakım süresini kısaltır ve enerji kaçağını %100\'e yakın oranda engeller.', 'en' => 'Equipment requiring frequent maintenance, such as valves, flanges, and expansion joints, are the weakest links in fixed insulation. İzokoç Valve Jackets are specially designed for these points. They are produced with high-temperature resistant fabrics and insulation materials. They can be easily removed and reinstalled, shorten maintenance time, and prevent energy leakage by nearly 100%.'],
                'benefits' => [
                    ['text' => ['tr' => 'Bakım ve onarımda hız ve kolaylık', 'en' => 'Speed and ease of maintenance and repair']],
                    ['text' => ['tr' => 'Yalıtımın tekrar tekrar kullanılabilmesi', 'en' => 'Reusability of the insulation']],
                    ['text' => ['tr' => 'Noktasal ısı kayıplarının tamamen önlenmesi', 'en' => 'Complete prevention of point heat losses']],
                    ['text' => ['tr' => 'Çok kısa sürede yatırım geri dönüşü (ROI)', 'en' => 'Very short investment return period (ROI)']],
                ],
                'expectations_content' => ['tr' => 'Her vana ve ekipman için yerinde ölçü alarak, ekipmana özel, tam uyumlu ceket imalatı yapıyoruz.', 'en' => 'We manufacture custom-fit jackets for each valve and piece of equipment by taking on-site measurements.'],
                'support_items' => [
                    ['text' => ['tr' => 'Buhar Vana Yalıtım Ceketi', 'en' => 'Steam Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Kızgın Yağ Vana Yalıtım Ceketi', 'en' => 'Hot Oil Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Soğutma Vana Yalıtım Ceketi', 'en' => 'Cooling Valve Insulation Jacket']],
                    ['text' => ['tr' => 'Kazan Kapakları Yalıtım Ceketi', 'en' => 'Boiler Cap Insulation Jacket']],
                ],
                'faqs' => null,
                'cover_image' => 'placeholders/service_cover_3.jpg',
                'gallery_images' => null,
                'order' => 3, 'is_active' => true,
            ],
            // HİZMET 4: Havalandırma İzolasyonu
            [
                'title' => ['tr' => 'Havalandırma & Klima Kanalı İzolasyonu', 'en' => 'Ventilation & HVAC Duct Insulation'],
                'slug' => 'havalandirma-izolasyonu',
                'summary' => ['tr' => 'Klima kanallarında ısı kaybını, yoğuşmayı (terlemeyi) ve gürültüyü önleyen profesyonel kanal yalıtımı.', 'en' => 'Professional duct insulation that prevents heat loss, condensation (sweating), and noise in HVAC ducts.'],
                'content' => ['tr' => 'Havalandırma ve klima (HVAC) sistemlerinde, şartlandırılmış havanın (sıcak veya soğuk) taşındığı kanalların yalıtımı, sistem verimliliği için zorunludur. Yanlış yalıtım, enerji kaybına, terlemeye (yoğuşma) ve gürültüye neden olur. Hem kauçuk köpüğü hem de camyünü/taşyünü bazlı kanal yalıtım uygulamalarıyla sisteminizin performansını maksimize ediyoruz.', 'en' => 'In ventilation and air conditioning (HVAC) systems, insulating the ducts that carry conditioned air (hot or cold) is mandatory for system efficiency. Incorrect insulation causes energy loss, sweating (condensation), and noise. We maximize your system\'s performance with both rubber foam and glasswool/rockwool-based duct insulation applications.'],
                'benefits' => [
                    ['text' => ['tr' => 'Yoğuşma (terleme) riskinin ortadan kaldırılması', 'en' => 'Elimination of condensation (sweating) risk']],
                    ['text' => ['tr' => 'Kanal kaynaklı gürültünün azaltılması (Akustik Yalıtım)', 'en' => 'Reduction of duct-borne noise (Acoustic Insulation)']],
                    ['text' => ['tr' => 'HVAC sistem verimliliğinin artırılması', 'en' => 'Increased HVAC system efficiency']],
                    ['text' => ['tr' => 'İç hava kalitesinin korunması', 'en' => 'Preservation of indoor air quality']],
                ],
                'expectations_content' => null,
                'support_items' => null,
                'faqs' => null,
                'cover_image' => 'placeholders/service_cover_4.jpg',
                'gallery_images' => ['placeholders/service_gallery_6.jpg'],
                'order' => 4, 'is_active' => true,
            ]
        ];

        foreach ($services as $serviceData) {
            // Spatie translatable modelinde create() metodu bu yapıyı destekler
            Service::create($serviceData);
        }
    }
}