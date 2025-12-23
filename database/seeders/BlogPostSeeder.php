<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    /**
     * SEO uyumlu 5 adet blog yazısı oluşturur.
     */
    public function run(): void
    {
        // Varsayılan kullanıcı ve kategori
        $user = User::first();
        $category = Category::first() ?? Category::create([
            'name' => ['tr' => 'Dijital Pazarlama', 'en' => 'Digital Marketing'],
            'slug' => 'dijital-pazarlama',
            'description' => ['tr' => 'Dijital pazarlama haberleri ve stratejileri', 'en' => 'Digital marketing news and strategies'],
            'is_active' => true,
        ]);

        $posts = [
            // 1. SEO Hakkında
            [
                'title' => [
                    'tr' => '2024 Yılında SEO Stratejileri: Google Sıralamalarında Üst Sıralara Çıkmanın Yolları',
                    'en' => 'SEO Strategies in 2024: Ways to Rank Higher on Google'
                ],
                'slug' => 'seo-stratejileri-2024-google-siralamalarinda-ust-siralara-cikma',
                'excerpt' => [
                    'tr' => 'SEO dünyasında 2024 yılında öne çıkan stratejileri, Google algoritma güncellemelerini ve web sitenizi üst sıralara taşıyacak taktikleri keşfedin.',
                    'en' => 'Discover the top SEO strategies of 2024, Google algorithm updates, and tactics to boost your website rankings.'
                ],
                'content' => [
                    'tr' => '<h2>SEO Neden Önemli?</h2>
<p>Dijital çağda, işletmelerin online görünürlüğü büyük önem taşımaktadır. Arama motoru optimizasyonu (SEO), web sitenizin Google ve diğer arama motorlarında üst sıralarda yer almasını sağlayan kritik bir stratejidir.</p>

<h3>2024\'te Öne Çıkan SEO Trendleri</h3>
<ul>
<li><strong>Yapay Zeka ve Makine Öğrenimi:</strong> Google\'ın BERT ve MUM algoritmaları, kullanıcı niyetini daha iyi anlamak için yapay zeka kullanmaktadır.</li>
<li><strong>Core Web Vitals:</strong> Sayfa deneyimi metrikleri sıralama faktörleri arasında kritik öneme sahip.</li>
<li><strong>E-E-A-T:</strong> Deneyim, Uzmanlık, Otorite ve Güvenilirlik artık her zamankinden daha önemli.</li>
<li><strong>Sesli Arama Optimizasyonu:</strong> Mobil cihazlarla sesli aramaların artışı yeni SEO fırsatları sunuyor.</li>
</ul>

<h3>Teknik SEO Önerileri</h3>
<p>Web sitenizin teknik altyapısını güçlendirmek için şu adımları izleyin:</p>
<ol>
<li>Sayfa yükleme hızını 3 saniyenin altına indirin</li>
<li>Mobile-first indeksleme için responsive tasarım kullanın</li>
<li>SSL sertifikası ile güvenli bağlantı sağlayın</li>
<li>XML sitemap ve robots.txt dosyalarını düzenleyin</li>
</ol>

<h3>İçerik Stratejisi</h3>
<p>Kaliteli içerik üretimi SEO\'nun temelini oluşturur. Kullanıcı niyetine uygun, özgün ve değerli içerikler oluşturarak organik trafiğinizi artırabilirsiniz.</p>

<h3>Sonuç</h3>
<p>SEO, uzun vadeli bir yatırımdır. Doğru stratejilerle web sitenizin görünürlüğünü artırarak potansiyel müşterilerinize ulaşabilirsiniz.</p>',
                    'en' => '<h2>Why is SEO Important?</h2>
<p>In the digital age, online visibility is crucial for businesses. Search Engine Optimization (SEO) is a critical strategy that helps your website rank higher on Google and other search engines.</p>

<h3>Top SEO Trends in 2024</h3>
<ul>
<li><strong>AI and Machine Learning:</strong> Google\'s BERT and MUM algorithms use AI to better understand user intent.</li>
<li><strong>Core Web Vitals:</strong> Page experience metrics are critical ranking factors.</li>
<li><strong>E-E-A-T:</strong> Experience, Expertise, Authority, and Trust are more important than ever.</li>
<li><strong>Voice Search Optimization:</strong> Growing voice searches on mobile devices offer new SEO opportunities.</li>
</ul>

<h3>Technical SEO Recommendations</h3>
<p>Follow these steps to strengthen your website\'s technical infrastructure:</p>
<ol>
<li>Reduce page load time to under 3 seconds</li>
<li>Use responsive design for mobile-first indexing</li>
<li>Ensure secure connection with SSL certificate</li>
<li>Configure XML sitemap and robots.txt files</li>
</ol>

<h3>Conclusion</h3>
<p>SEO is a long-term investment. With the right strategies, you can increase your website\'s visibility and reach potential customers.</p>'
                ],
                'seo_title' => [
                    'tr' => 'SEO Stratejileri 2024 | Google Sıralama Rehberi | NextMedya',
                    'en' => 'SEO Strategies 2024 | Google Ranking Guide | NextMedya'
                ],
                'meta_description' => [
                    'tr' => '2024 yılında SEO stratejileri, Google algoritma güncellemeleri ve web sitenizi arama motorlarında üst sıralara taşıyacak profesyonel taktikler.',
                    'en' => 'SEO strategies in 2024, Google algorithm updates, and professional tactics to rank your website higher in search engines.'
                ],
                'keywords' => [
                    'tr' => 'seo stratejileri, google sıralama, seo 2024, arama motoru optimizasyonu, dijital pazarlama, web sitesi optimizasyonu',
                    'en' => 'seo strategies, google ranking, seo 2024, search engine optimization, digital marketing, website optimization'
                ],
                'focus_keyword' => ['tr' => 'seo stratejileri', 'en' => 'seo strategies'],
            ],

            // 2. Web Tasarım
            [
                'title' => [
                    'tr' => 'Modern Web Tasarım Trendleri: Kullanıcı Deneyimini Ön Plana Çıkaran Tasarımlar',
                    'en' => 'Modern Web Design Trends: Designs That Prioritize User Experience'
                ],
                'slug' => 'modern-web-tasarim-trendleri-kullanici-deneyimi',
                'excerpt' => [
                    'tr' => '2024 yılının en popüler web tasarım trendlerini, UX/UI prensiplerini ve dönüşüm oranlarını artıran tasarım stratejilerini keşfedin.',
                    'en' => 'Discover the most popular web design trends of 2024, UX/UI principles, and design strategies that increase conversion rates.'
                ],
                'content' => [
                    'tr' => '<h2>Web Tasarımın Önemi</h2>
<p>Profesyonel bir web sitesi, markanızın dijital vitrinidir. İlk izlenim saniyeler içinde oluşur ve ziyaretçilerinizin sitenizde kalıp kalmayacağını belirler.</p>

<h3>2024 Web Tasarım Trendleri</h3>

<h4>1. Minimalist Tasarım</h4>
<p>Az ama öz yaklaşımı, kullanıcıların dikkatini önemli unsurlara yönlendirir. Temiz tipografi, geniş boşluklar ve net çağrı-aksiyon butonları bu trendin temelini oluşturur.</p>

<h4>2. Dark Mode (Karanlık Mod)</h4>
<p>Göz yorgunluğunu azaltan ve modern bir görünüm sağlayan karanlık mod, kullanıcılar arasında popülerliğini korumaktadır.</p>

<h4>3. Mikro Animasyonlar</h4>
<p>Kullanıcı etkileşimlerini zenginleştiren küçük animasyonlar, sitenizi daha dinamik ve ilgi çekici hale getirir.</p>

<h4>4. Glassmorphism</h4>
<p>Buzlu cam efekti veren tasarımlar, derinlik ve şıklık katarak modern web sitelerinde sıkça kullanılmaktadır.</p>

<h3>UX/UI Prensipleri</h3>
<ul>
<li>Kullanıcı odaklı tasarım</li>
<li>Tutarlı navigasyon yapısı</li>
<li>Erişilebilirlik standartları</li>
<li>Mobil öncelikli yaklaşım</li>
</ul>

<h3>Dönüşüm Odaklı Tasarım</h3>
<p>Estetik kadar işlevsellik de önemlidir. Stratejik yerleştirilmiş CTA butonları, güven rozetleri ve sosyal kanıtlar dönüşüm oranlarınızı artırır.</p>',
                    'en' => '<h2>The Importance of Web Design</h2>
<p>A professional website is your brand\'s digital storefront. First impressions are formed within seconds and determine whether visitors stay on your site.</p>

<h3>2024 Web Design Trends</h3>

<h4>1. Minimalist Design</h4>
<p>The less-is-more approach directs users\' attention to important elements. Clean typography, wide spaces, and clear call-to-action buttons form the basis of this trend.</p>

<h4>2. Dark Mode</h4>
<p>Dark mode, which reduces eye strain and provides a modern look, maintains its popularity among users.</p>

<h4>3. Micro Animations</h4>
<p>Small animations that enrich user interactions make your site more dynamic and engaging.</p>

<h4>4. Glassmorphism</h4>
<p>Designs with frosted glass effect add depth and elegance, frequently used in modern websites.</p>

<h3>Conversion-Focused Design</h3>
<p>Functionality is as important as aesthetics. Strategically placed CTA buttons, trust badges, and social proof increase your conversion rates.</p>'
                ],
                'seo_title' => [
                    'tr' => 'Web Tasarım Trendleri 2024 | UX/UI Rehberi | NextMedya',
                    'en' => 'Web Design Trends 2024 | UX/UI Guide | NextMedya'
                ],
                'meta_description' => [
                    'tr' => 'Modern web tasarım trendleri, kullanıcı deneyimi prensipleri ve dönüşüm oranlarını artıran profesyonel tasarım stratejileri rehberi.',
                    'en' => 'Modern web design trends, user experience principles, and professional design strategies guide that increase conversion rates.'
                ],
                'keywords' => [
                    'tr' => 'web tasarım, ux tasarım, ui tasarım, modern web sitesi, kullanıcı deneyimi, responsive tasarım',
                    'en' => 'web design, ux design, ui design, modern website, user experience, responsive design'
                ],
                'focus_keyword' => ['tr' => 'web tasarım', 'en' => 'web design'],
            ],

            // 3. Sosyal Medya
            [
                'title' => [
                    'tr' => 'Sosyal Medya Pazarlama Stratejileri: Markanızı Büyütmenin Yolları',
                    'en' => 'Social Media Marketing Strategies: Ways to Grow Your Brand'
                ],
                'slug' => 'sosyal-medya-pazarlama-stratejileri-marka-buyutme',
                'excerpt' => [
                    'tr' => 'Etkili sosyal medya pazarlama stratejileri, platform analizi ve markanızı sosyal medyada büyütmek için uygulanabilir taktikler.',
                    'en' => 'Effective social media marketing strategies, platform analysis, and actionable tactics to grow your brand on social media.'
                ],
                'content' => [
                    'tr' => '<h2>Sosyal Medya Pazarlamanın Gücü</h2>
<p>Sosyal medya, markaların hedef kitleleriyle doğrudan iletişim kurabildikleri en güçlü platformlardan biridir. Doğru stratejiyle milyonlarca potansiyel müşteriye ulaşabilirsiniz.</p>

<h3>Platform Bazlı Stratejiler</h3>

<h4>Instagram</h4>
<p>Görsel odaklı içerikler, Reels videoları ve Story\'ler ile etkileşim oranlarınızı artırın. Influencer işbirlikleri marka bilinirliğinizi güçlendirir.</p>

<h4>LinkedIn</h4>
<p>B2B pazarlama için ideal platform. Profesyonel içerikler, sektörel analizler ve şirket kültürünüzü yansıtan paylaşımlar yapın.</p>

<h4>TikTok</h4>
<p>Genç kitleye ulaşmak için kısa, eğlenceli ve yaratıcı videolar üretin. Trend akımlarını takip ederek viral içerikler oluşturun.</p>

<h4>YouTube</h4>
<p>Uzun formatlı video içerikler, eğitim videoları ve ürün tanıtımları için YouTube\'u kullanın. SEO uyumlu başlıklar ve açıklamalar önemlidir.</p>

<h3>İçerik Takvimi Oluşturma</h3>
<p>Düzenli ve planlı paylaşımlar için içerik takvimi oluşturun:</p>
<ul>
<li>Haftalık tema belirleyin</li>
<li>Özel günleri ve kampanyaları planlayın</li>
<li>İçerik çeşitliliği sağlayın</li>
<li>Analiz sonuçlarına göre optimize edin</li>
</ul>

<h3>Etkileşim ve Topluluk Yönetimi</h3>
<p>Takipçilerinizle aktif iletişim kurun. Yorumlara yanıt verin, soruları cevaplayın ve topluluk oluşturun.</p>',
                    'en' => '<h2>The Power of Social Media Marketing</h2>
<p>Social media is one of the most powerful platforms where brands can directly communicate with their target audiences. With the right strategy, you can reach millions of potential customers.</p>

<h3>Platform-Based Strategies</h3>

<h4>Instagram</h4>
<p>Increase your engagement rates with visual content, Reels videos, and Stories. Influencer collaborations strengthen your brand awareness.</p>

<h4>LinkedIn</h4>
<p>Ideal platform for B2B marketing. Share professional content, industry analyses, and posts reflecting your company culture.</p>

<h4>TikTok</h4>
<p>Create short, fun, and creative videos to reach younger audiences. Follow trend currents to create viral content.</p>

<h3>Creating a Content Calendar</h3>
<p>Create a content calendar for regular and planned posts:</p>
<ul>
<li>Set weekly themes</li>
<li>Plan special days and campaigns</li>
<li>Ensure content diversity</li>
<li>Optimize based on analysis results</li>
</ul>'
                ],
                'seo_title' => [
                    'tr' => 'Sosyal Medya Pazarlama Stratejileri | Marka Büyütme | NextMedya',
                    'en' => 'Social Media Marketing Strategies | Brand Growth | NextMedya'
                ],
                'meta_description' => [
                    'tr' => 'Instagram, LinkedIn, TikTok ve YouTube için sosyal medya pazarlama stratejileri. Markanızı sosyal medyada büyütmenin yolları.',
                    'en' => 'Social media marketing strategies for Instagram, LinkedIn, TikTok, and YouTube. Ways to grow your brand on social media.'
                ],
                'keywords' => [
                    'tr' => 'sosyal medya pazarlama, instagram pazarlama, linkedin b2b, tiktok marketing, sosyal medya yönetimi',
                    'en' => 'social media marketing, instagram marketing, linkedin b2b, tiktok marketing, social media management'
                ],
                'focus_keyword' => ['tr' => 'sosyal medya pazarlama', 'en' => 'social media marketing'],
            ],

            // 4. E-Ticaret
            [
                'title' => [
                    'tr' => 'E-Ticaret Sitesi Kurulumu: Online Mağazanızı Başarıyla Açmanın Adımları',
                    'en' => 'E-Commerce Website Setup: Steps to Successfully Launch Your Online Store'
                ],
                'slug' => 'e-ticaret-sitesi-kurulumu-online-magaza-acma',
                'excerpt' => [
                    'tr' => 'E-ticaret sitenizi kurmak için gereken adımlar, platform seçimi, ödeme entegrasyonları ve başarılı bir online mağaza için ipuçları.',
                    'en' => 'Steps to set up your e-commerce site, platform selection, payment integrations, and tips for a successful online store.'
                ],
                'content' => [
                    'tr' => '<h2>Neden E-Ticaret?</h2>
<p>Dijital dönüşümün hız kazandığı günümüzde, e-ticaret artık bir tercih değil zorunluluk haline gelmiştir. Online satış kanalları, 7/24 satış imkanı ve geniş müşteri kitlesine erişim sağlar.</p>

<h3>E-Ticaret Platformu Seçimi</h3>

<h4>Özel Yazılım (Custom Development)</h4>
<p>Tamamen ihtiyaçlarınıza özel geliştirilen e-ticaret çözümleri. Sınırsız özelleştirme, ölçeklenebilirlik ve tam kontrol sunar.</p>

<h4>Hazır Platformlar</h4>
<ul>
<li><strong>WooCommerce:</strong> WordPress tabanlı, esnek ve genişletilebilir</li>
<li><strong>Shopify:</strong> Kullanımı kolay, hızlı kurulum</li>
<li><strong>Magento:</strong> Büyük ölçekli e-ticaret siteleri için ideal</li>
</ul>

<h3>Temel Özellikler</h3>
<p>Başarılı bir e-ticaret sitesi için olmazsa olmaz özellikler:</p>
<ol>
<li>Güvenli ödeme altyapısı (SSL, 3D Secure)</li>
<li>Mobil uyumlu responsive tasarım</li>
<li>Hızlı sayfa yüklenme süreleri</li>
<li>Kolay navigasyon ve ürün arama</li>
<li>Detaylı ürün sayfaları ve görseller</li>
<li>Müşteri yorumları ve puanlama sistemi</li>
</ol>

<h3>Ödeme Çözümleri</h3>
<p>Türkiye\'de popüler ödeme çözümleri: iyzico, PayTR, Param, sanal POS entegrasyonları.</p>

<h3>Kargo ve Lojistik</h3>
<p>Hızlı ve güvenilir teslimat, müşteri memnuniyetinin anahtarıdır. Yurtiçi Kargo, Aras Kargo, MNG Kargo gibi firmaların API entegrasyonlarını kullanın.</p>',
                    'en' => '<h2>Why E-Commerce?</h2>
<p>In today\'s rapidly digitizing world, e-commerce has become a necessity rather than an option. Online sales channels provide 24/7 sales capability and access to a wide customer base.</p>

<h3>E-Commerce Platform Selection</h3>

<h4>Custom Development</h4>
<p>E-commerce solutions developed specifically for your needs. Offers unlimited customization, scalability, and full control.</p>

<h4>Ready Platforms</h4>
<ul>
<li><strong>WooCommerce:</strong> WordPress-based, flexible and extensible</li>
<li><strong>Shopify:</strong> Easy to use, quick setup</li>
<li><strong>Magento:</strong> Ideal for large-scale e-commerce sites</li>
</ul>

<h3>Essential Features</h3>
<p>Must-have features for a successful e-commerce site:</p>
<ol>
<li>Secure payment infrastructure (SSL, 3D Secure)</li>
<li>Mobile-friendly responsive design</li>
<li>Fast page load times</li>
<li>Easy navigation and product search</li>
<li>Detailed product pages and images</li>
<li>Customer reviews and rating system</li>
</ol>'
                ],
                'seo_title' => [
                    'tr' => 'E-Ticaret Sitesi Kurulumu | Online Mağaza Açma Rehberi | NextMedya',
                    'en' => 'E-Commerce Site Setup | Online Store Launch Guide | NextMedya'
                ],
                'meta_description' => [
                    'tr' => 'E-ticaret sitesi kurulum rehberi. Platform seçimi, ödeme entegrasyonları, kargo çözümleri ve başarılı online mağaza için adımlar.',
                    'en' => 'E-commerce site setup guide. Platform selection, payment integrations, shipping solutions, and steps for a successful online store.'
                ],
                'keywords' => [
                    'tr' => 'e-ticaret sitesi, online mağaza, e-ticaret kurulum, woocommerce, shopify, ödeme entegrasyonu',
                    'en' => 'e-commerce site, online store, e-commerce setup, woocommerce, shopify, payment integration'
                ],
                'focus_keyword' => ['tr' => 'e-ticaret sitesi', 'en' => 'e-commerce site'],
            ],

            // 5. Dijital Dönüşüm
            [
                'title' => [
                    'tr' => 'Dijital Dönüşüm Rehberi: İşletmenizi Geleceğe Taşıyın',
                    'en' => 'Digital Transformation Guide: Take Your Business to the Future'
                ],
                'slug' => 'dijital-donusum-rehberi-isletmenizi-gelecege-tasiyin',
                'excerpt' => [
                    'tr' => 'Dijital dönüşüm stratejileri, teknoloji yatırımları ve işletmenizi dijital çağa uyarlamanın adımları hakkında kapsamlı rehber.',
                    'en' => 'Comprehensive guide on digital transformation strategies, technology investments, and steps to adapt your business to the digital age.'
                ],
                'content' => [
                    'tr' => '<h2>Dijital Dönüşüm Nedir?</h2>
<p>Dijital dönüşüm, teknolojinin iş süreçlerine, şirket kültürüne ve müşteri deneyimine entegre edilmesi sürecidir. Bu sadece teknoloji değişikliği değil, aynı zamanda iş yapış biçiminin tamamının yeniden değerlendirilmesidir.</p>

<h3>Dijital Dönüşümün Faydaları</h3>
<ul>
<li><strong>Verimlilik Artışı:</strong> Otomasyon sayesinde manuel işlemler azalır</li>
<li><strong>Maliyet Tasarrufu:</strong> Dijital süreçler operasyonel maliyetleri düşürür</li>
<li><strong>Müşteri Deneyimi:</strong> Kişiselleştirilmiş ve hızlı hizmet sunumu</li>
<li><strong>Veri Odaklı Kararlar:</strong> Analitik araçlarla daha iyi karar alma</li>
<li><strong>Rekabet Avantajı:</strong> Dijital öncelikli yaklaşımla öne geçin</li>
</ul>

<h3>Dönüşüm Adımları</h3>

<h4>1. Mevcut Durum Analizi</h4>
<p>İşletmenizin dijital olgunluk seviyesini belirleyin. Hangi süreçler dijitalleştirilebilir? Hangi teknolojiler eksik?</p>

<h4>2. Strateji Belirleme</h4>
<p>Net hedefler koyun, öncelikleri belirleyin ve yol haritası oluşturun.</p>

<h4>3. Teknoloji Seçimi</h4>
<p>CRM, ERP, bulut çözümleri, otomasyon araçları gibi ihtiyacınıza uygun teknolojileri seçin.</p>

<h4>4. Uygulama ve Entegrasyon</h4>
<p>Aşamalı geçiş planıyla yeni sistemleri devreye alın, mevcut sistemlerle entegre edin.</p>

<h4>5. Eğitim ve Değişim Yönetimi</h4>
<p>Çalışanlarınızı yeni teknolojilere adapte edin, değişim direncini yönetin.</p>

<h3>Başarı Metrikleri</h3>
<p>Dijital dönüşüm başarısını ölçmek için KPI\'lar belirleyin: müşteri memnuniyeti, operasyonel verimlilik, gelir artışı, pazar payı.</p>',
                    'en' => '<h2>What is Digital Transformation?</h2>
<p>Digital transformation is the process of integrating technology into business processes, company culture, and customer experience. It\'s not just a technology shift but a complete re-evaluation of how business is done.</p>

<h3>Benefits of Digital Transformation</h3>
<ul>
<li><strong>Increased Efficiency:</strong> Automation reduces manual processes</li>
<li><strong>Cost Savings:</strong> Digital processes lower operational costs</li>
<li><strong>Customer Experience:</strong> Personalized and fast service delivery</li>
<li><strong>Data-Driven Decisions:</strong> Better decision making with analytics tools</li>
<li><strong>Competitive Advantage:</strong> Get ahead with digital-first approach</li>
</ul>

<h3>Transformation Steps</h3>

<h4>1. Current State Analysis</h4>
<p>Determine your business\'s digital maturity level. Which processes can be digitized? Which technologies are missing?</p>

<h4>2. Strategy Definition</h4>
<p>Set clear goals, identify priorities, and create a roadmap.</p>

<h4>3. Technology Selection</h4>
<p>Choose technologies suited to your needs: CRM, ERP, cloud solutions, automation tools.</p>

<h4>4. Implementation and Integration</h4>
<p>Deploy new systems with a phased transition plan, integrate with existing systems.</p>

<h3>Success Metrics</h3>
<p>Define KPIs to measure digital transformation success: customer satisfaction, operational efficiency, revenue growth, market share.</p>'
                ],
                'seo_title' => [
                    'tr' => 'Dijital Dönüşüm Rehberi | İşletme Dijitalleşme Stratejileri | NextMedya',
                    'en' => 'Digital Transformation Guide | Business Digitization Strategies | NextMedya'
                ],
                'meta_description' => [
                    'tr' => 'Dijital dönüşüm stratejileri, teknoloji yatırımları ve işletmenizi dijital çağa uyarlama adımları. Kapsamlı dijital dönüşüm rehberi.',
                    'en' => 'Digital transformation strategies, technology investments, and steps to adapt your business to the digital age. Comprehensive guide.'
                ],
                'keywords' => [
                    'tr' => 'dijital dönüşüm, dijitalleşme, işletme teknolojisi, otomasyon, crm sistemi, bulut çözümler',
                    'en' => 'digital transformation, digitization, business technology, automation, crm system, cloud solutions'
                ],
                'focus_keyword' => ['tr' => 'dijital dönüşüm', 'en' => 'digital transformation'],
            ],
        ];

        foreach ($posts as $index => $postData) {
            Post::updateOrCreate(
                ['slug' => $postData['slug']],
                [
                    'title' => $postData['title'],
                    'slug' => $postData['slug'],
                    'excerpt' => $postData['excerpt'],
                    'content' => $postData['content'],
                    'seo_title' => $postData['seo_title'],
                    'meta_description' => $postData['meta_description'],
                    'keywords' => $postData['keywords'],
                    'focus_keyword' => $postData['focus_keyword'],
                    'user_id' => $user->id ?? 1,
                    'category_id' => $category->id,
                    'status' => 'published',
                    'visibility' => 'public',
                    'published_at' => now()->subDays(5 - $index), // Farklı tarihler
                    'index_status' => 'index',
                    'follow_status' => 'follow',
                    'schema_article_type' => 'BlogPosting',
                    'og_title' => $postData['seo_title'],
                    'og_description' => $postData['meta_description'],
                    'twitter_title' => $postData['seo_title'],
                    'twitter_description' => $postData['meta_description'],
                    'twitter_card_type' => 'summary_large_image',
                ]
            );
        }
    }
}
