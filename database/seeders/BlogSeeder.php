<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Yabancı anahtar kısıtlamalarını geçici olarak devre dışı bırak
        Schema::disableForeignKeyConstraints();

        // 2. Tabloları boşalt (Post ilişkilerini de temizle)
        DB::table('post_tag')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('categories')->truncate();

        // 3. Yabancı anahtar kısıtlamalarını tekrar aktif et
        Schema::enableForeignKeyConstraints();

        // 4. Varsayılan bir yazar oluşturalım veya bulalım
        $author = User::firstOrCreate(
            ['email' => 'admin@nextmedya.com'],
            [
                'name' => 'Next Medya Admin',
                'password' => Hash::make('password123'), // Güvenli bir şifre kullanın
            ]
        );

        // 5. Next Medya için Kategorileri oluşturalım (Çok dilli)
        $cat1 = Category::create([
            'name' => ['tr' => 'Dijital Pazarlama', 'en' => 'Digital Marketing'],
            'slug' => Str::slug('Dijital Pazarlama'),
            'is_active' => true,
        ]);
        $cat2 = Category::create([
            'name' => ['tr' => 'E-Ticaret', 'en' => 'E-Commerce'],
            'slug' => Str::slug('E-Ticaret'),
            'is_active' => true,
        ]);
        $cat3 = Category::create([
            'name' => ['tr' => 'Web Tasarım', 'en' => 'Web Design'],
            'slug' => Str::slug('Web Tasarım'),
            'is_active' => true,
        ]);
        $cat4 = Category::create([
            'name' => ['tr' => 'SEO ve İçerik', 'en' => 'SEO and Content'],
            'slug' => Str::slug('SEO ve İçerik'),
            'is_active' => true,
        ]);

        // 6. Next Medya için Etiketleri oluşturalım (Çok dilli)
        $tag1 = Tag::create(['name' => ['tr' => 'Sosyal Medya', 'en' => 'Social Media'], 'slug' => Str::slug('Sosyal Medya')]);
        $tag2 = Tag::create(['name' => ['tr' => 'Google Ads', 'en' => 'Google Ads'], 'slug' => Str::slug('Google Ads')]);
        $tag3 = Tag::create(['name' => ['tr' => 'SEO', 'en' => 'SEO'], 'slug' => Str::slug('SEO')]);
        $tag4 = Tag::create(['name' => ['tr' => 'İçerik Pazarlama', 'en' => 'Content Marketing'], 'slug' => Str::slug('İçerik Pazarlama')]);
        $tag5 = Tag::create(['name' => ['tr' => 'E-Ticaret Çözümleri', 'en' => 'E-Commerce Solutions'], 'slug' => Str::slug('E-Ticaret Çözümleri')]);
        $tag6 = Tag::create(['name' => ['tr' => 'Mobil Uyumlu', 'en' => 'Mobile Responsive'], 'slug' => Str::slug('Mobil Uyumlu')]);
        $tag7 = Tag::create(['name' => ['tr' => 'Dönüşüm Optimizasyonu', 'en' => 'Conversion Optimization'], 'slug' => Str::slug('Dönüşüm Optimizasyonu')]);
        $tag8 = Tag::create(['name' => ['tr' => 'Dijital Strateji', 'en' => 'Digital Strategy'], 'slug' => Str::slug('Dijital Strateji')]);

        // 7. Yazıları oluşturalım (Çok dilli)

        // BLOG YAZISI 1
        $post1_content_tr = <<<'HTML'
<p>Dijital çağda bir işletmenin başarısı, artık sadece kaliteli ürün veya hizmet sunmakla sınırlı değil. Müşterilerinizin büyük çoğunluğu, satın alma kararlarını vermeden önce internette araştırma yapıyor, markaları karşılaştırıyor ve sosyal medyada deneyimleri paylaşıyor. Bu noktada, güçlü bir dijital varlık, sadece 'bulunmak' değil, 'öne çıkmak' ve 'tercih edilmek' anlamına gelir.</p>

<h5>Dijital Varlık Nedir?</h5>
<p>Dijital varlık, markanızın internet üzerindeki tüm izlerini ve etkileşimlerini kapsar. Bu, profesyonel bir web sitesi, aktif sosyal medya hesapları, arama motorlarındaki görünürlük, Google Haritalar'daki yeriniz, müşteri yorumları ve daha fazlasını içerir. Kısacası, potansiyel bir müşteri sizi dijital ortamda aradığında ne bulacak? İşte dijital varlık bu sorunun cevabıdır.</p>

<h5>Neden Bu Kadar Önemli?</h5>
<ul>
    <li><strong>Güvenilirlik ve Kredibilite:</strong> Profesyonel bir web sitesi ve düzenli güncellemeler yapılan sosyal medya hesapları, markanızın ciddiyetini ve güvenilirliğini gösterir. Dijital varlığı zayıf olan bir işletme, potansiyel müşteriler gözünde profesyonel olmayan veya güncel olmayan bir görüntü çizebilir.</li>
    <li><strong>Erişilebilirlik:</strong> Müşterileriniz 7/24 sizi bulabilmeli ve ihtiyaç duydukları bilgilere kolayca ulaşabilmelidir. Web siteniz, ürünleriniz, hizmetleriniz, iletişim bilgileriniz ve sıkça sorulan sorular gibi bilgilere anında erişim sağlamalıdır.</li>
    <li><strong>Rekabet Avantajı:</strong> Rakipleriniz muhtemelen zaten dijital dünyada aktifler. Eğer siz yoksanız veya varlığınız zayıfsa, müşteriler doğal olarak daha görünür olan rakiplerinizi tercih edecektir.</li>
    <li><strong>Maliyet Etkinliği:</strong> Geleneksel pazarlama yöntemlerine (gazete ilanları, billboard'lar vb.) kıyasla, dijital pazarlama genellikle daha düşük maliyetlerle çok daha geniş kitlelere ulaşmanızı sağlar. Ayrıca, dijital kampanyaların performansını detaylı bir şekilde ölçebilir ve optimize edebilirsiniz.</li>
    <li><strong>Müşteri İlişkileri:</strong> Sosyal medya ve e-posta pazarlama gibi kanallar, müşterilerinizle doğrudan ve sürekli iletişim kurmanıza, onların geri bildirimlerini almanıza ve sadık bir topluluk oluşturmanıza olanak tanır.</li>
</ul>

<h5>Güçlü Bir Dijital Varlık Nasıl Oluşturulur?</h5>
<p>Güçlü bir dijital varlık oluşturmak, tutarlı ve stratejik bir yaklaşım gerektirir:</p>
<ul>
    <li><strong>Profesyonel Web Sitesi:</strong> Hızlı, mobil uyumlu, kullanıcı dostu ve SEO optimizasyonlu bir web sitesi temeldir.</li>
    <li><strong>Aktif Sosyal Medya Varlığı:</strong> Hedef kitlenizin bulunduğu platformlarda (Instagram, Facebook, LinkedIn, Twitter vb.) düzenli ve değerli içerikler paylaşın.</li>
    <li><strong>Arama Motoru Optimizasyonu (SEO):</strong> Google ve diğer arama motorlarında üst sıralarda çıkmak için web sitenizi ve içeriklerinizi optimize edin.</li>
    <li><strong>İçerik Pazarlama:</strong> Blog yazıları, videolar, infografikler gibi değerli içeriklerle uzmanlığınızı gösterin ve müşteri çekin.</li>
    <li><strong>Online İtibar Yönetimi:</strong> Müşteri yorumlarını takip edin, olumsuz geri bildirimlere profesyonelce yanıt verin ve olumlu deneyimleri teşvik edin.</li>
</ul>

<p>Sonuç olarak, güçlü bir dijital varlık, günümüz iş dünyasında hayatta kalmanın ve büyümenin olmazsa olmazıdır. Next Medya olarak, markanızın dijital dünyada güçlü bir şekilde var olmasını ve hedef kitlenizle etkili bir şekilde bağlantı kurmasını sağlayacak çözümler sunuyoruz.</p>
HTML;

        $post1_content_en = <<<'HTML'
<p>In the digital age, a business's success is no longer limited to just offering quality products or services. The majority of your customers research online, compare brands, and share experiences on social media before making purchasing decisions. At this point, a strong digital presence means not just 'being there,' but 'standing out' and 'being preferred.'</p>

<h5>What is Digital Presence?</h5>
<p>Digital presence encompasses all of your brand's traces and interactions on the internet. This includes a professional website, active social media accounts, visibility on search engines, your location on Google Maps, customer reviews, and more. In short, what will a potential customer find when they search for you in the digital environment? Digital presence is the answer to this question.</p>

<h5>Why Is It So Important?</h5>
<ul>
    <li><strong>Trustworthiness and Credibility:</strong> A professional website and regularly updated social media accounts demonstrate your brand's seriousness and reliability. A business with a weak digital presence may appear unprofessional or outdated in the eyes of potential customers.</li>
    <li><strong>Accessibility:</strong> Your customers should be able to find you 24/7 and easily access the information they need. Your website should provide instant access to information such as your products, services, contact details, and frequently asked questions.</li>
    <li><strong>Competitive Advantage:</strong> Your competitors are probably already active in the digital world. If you're not there or your presence is weak, customers will naturally prefer your more visible competitors.</li>
    <li><strong>Cost Effectiveness:</strong> Compared to traditional marketing methods (newspaper ads, billboards, etc.), digital marketing generally allows you to reach much larger audiences at lower costs. Additionally, you can measure and optimize the performance of digital campaigns in detail.</li>
    <li><strong>Customer Relationships:</strong> Channels like social media and email marketing allow you to communicate directly and continuously with your customers, receive their feedback, and build a loyal community.</li>
</ul>

<h5>How to Build a Strong Digital Presence?</h5>
<p>Building a strong digital presence requires a consistent and strategic approach:</p>
<ul>
    <li><strong>Professional Website:</strong> A fast, mobile-friendly, user-friendly, and SEO-optimized website is fundamental.</li>
    <li><strong>Active Social Media Presence:</strong> Share regular and valuable content on platforms where your target audience is located (Instagram, Facebook, LinkedIn, Twitter, etc.).</li>
    <li><strong>Search Engine Optimization (SEO):</strong> Optimize your website and content to rank high on Google and other search engines.</li>
    <li><strong>Content Marketing:</strong> Demonstrate your expertise and attract customers with valuable content such as blog posts, videos, and infographics.</li>
    <li><strong>Online Reputation Management:</strong> Monitor customer reviews, respond professionally to negative feedback, and encourage positive experiences.</li>
</ul>

<p>In conclusion, a strong digital presence is essential for survival and growth in today's business world. As Next Medya, we offer solutions to ensure your brand has a strong presence in the digital world and connects effectively with your target audience.</p>
HTML;

        $post1 = Post::create([
            'title' => ['tr' => 'Dijital Dünyada Güçlü Bir Varlık Oluşturmanın Önemi', 'en' => 'The Importance of Building a Strong Presence in the Digital World'],
            'slug' => Str::slug('Dijital Dünyada Güçlü Bir Varlık Oluşturmanın Önemi'),
            'content' => ['tr' => $post1_content_tr, 'en' => $post1_content_en],
            'excerpt' => ['tr' => 'Güçlü bir dijital varlık neden işletmeniz için kritik? Web sitesi, sosyal medya ve SEO stratejilerinin önemi.', 'en' => 'Why is a strong digital presence critical for your business? The importance of website, social media, and SEO strategies.'],
            'featured_image' => 'uploads/posts/featured/nextmedya-blog-1.jpg',
            'user_id' => $author->id,
            'category_id' => $cat1->id,
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(15),
        ]);

        // BLOG YAZISI 2
        $post2_content_tr = <<<'HTML'
<p>Muhteşem bir web siteniz var, sosyal medyada aktifsiniz, değerli içerikler üretiyorsunuz ama trafik düşük ve satışlar beklediğiniz gibi değil mi? Problem genellikle burada yatar: Arama motorlarında görünür değilsiniz. İşte tam da bu noktada SEO (Search Engine Optimization - Arama Motoru Optimizasyonu) devreye girer.</p>

<h5>SEO Nedir?</h5>
<p>SEO, web sitenizin Google gibi arama motorlarında organik (ücretsiz) olarak üst sıralarda çıkmasını sağlamak için yapılan teknik ve stratejik çalışmaların bütünüdür. Kullanıcılar bir arama yaptığında, sizinle ilgili anahtar kelimelerde ilk sayfada, hatta ilk sıralarda çıkmak, daha fazla trafik, daha fazla potansiyel müşteri ve sonuç olarak daha fazla satış anlamına gelir.</p>

<h5>SEO Neden Bu Kadar Önemli?</h5>
<ul>
    <li><strong>Organik Trafik = Sürdürülebilir Büyüme:</strong> Ücretli reklamlar (Google Ads gibi) kısa vadede hızlı sonuç verebilir, ancak bütçeniz bittiğinde trafik de durur. SEO ise bir kez doğru yapıldığında, uzun vadede sürekli ve sürdürülebilir trafik getirir. İyi bir SEO stratejisi, adeta dijital dünyadaki 'sabit müşteriniz' gibidir.</li>
    <li><strong>Güvenilirlik ve Otorite:</strong> Kullanıcılar, arama sonuçlarında üst sıralarda çıkan web sitelerini daha güvenilir ve yetkili olarak algılar. Google'da ilk sayfada olmak, markanızın sektörde lider olduğuna dair güçlü bir sinyal gönderir.</li>
    <li><strong>Hedefli Trafik:</strong> SEO, ürün veya hizmetinizi aktif olarak arayan, yani satın almaya en yakın olan kullanıcılara ulaşmanızı sağlar. Örneğin, 'İstanbul'da web tasarım hizmeti' araması yapan biri, zaten bu hizmeti satın almak istiyor demektir. Doğru anahtar kelimelerle sıralamak, en nitelikli trafiği getirir.</li>
    <li><strong>Rekabet Avantajı:</strong> Rakipleriniz SEO'ya yatırım yapıyorsa ve siz yapmıyorsanız, potansiyel müşterileri onlara kaptırıyorsunuz demektir. SEO'da öne geçmek, pazardaki payınızı artırmanın en etkili yollarından biridir.</li>
    <li><strong>Maliyet Etkinliği:</strong> Uzun vadede, SEO'nun müşteri başına maliyeti (CPA - Cost Per Acquisition), ücretli reklamlara göre çok daha düşüktür. Organik sıralamalarda üst sıralara çıktığınızda, her tıklama için ödeme yapmazsınız.</li>
</ul>

<h5>Etkili Bir SEO Stratejisinin Temel Bileşenleri</h5>
<ul>
    <li><strong>Anahtar Kelime Araştırması:</strong> Hedef kitlenizin ne aradığını anlamak ve doğru anahtar kelimeleri belirlemek.</li>
    <li><strong>Teknik SEO:</strong> Sitenizin hızı, mobil uyumluluğu, güvenliği (HTTPS), site haritası, robots.txt dosyası gibi teknik altyapı optimizasyonları.</li>
    <li><strong>On-Page SEO:</strong> Başlık etiketleri (title tags), meta açıklamalar, başlıklar (H1, H2 vb.), içerik kalitesi, iç linkler, görsellerin optimizasyonu gibi sayfa içi faktörler.</li>
    <li><strong>Off-Page SEO:</strong> Diğer kaliteli web sitelerinden gelen backlinkler (geri bağlantılar), sosyal medya sinyalleri ve online itibar.</li>
    <li><strong>Kaliteli İçerik:</strong> Kullanıcılar için değerli, orijinal, bilgilendirici ve düzenli olarak güncellenmiş içerikler.</li>
    <li><strong>Yerel SEO:</strong> Özellikle yerel bir işletmeyseniz, Google My Business optimizasyonu, yerel dizinlerde yer alma gibi stratejiler.</li>
</ul>

<h5>SEO Bir Maraton, Sprint Değil</h5>
<p>SEO'nun sonuç vermesi zaman alır. Rekabete, sektöre ve mevcut durumunuza bağlı olarak ilk ciddi sonuçları görmek 3-6 ay, bazen daha uzun sürebilir. Ancak sabır ve süreklilik karşılığında, uzun vadede çok büyük getiriler sağlar.</p>

<p>Next Medya olarak, web sitenizin teknik altyapısından içerik stratejisine, yerel SEO'dan backlink profilinize kadar tüm SEO süreçlerinizi yönetiyor ve arama motorlarında en üst sıralara çıkmanızı sağlıyoruz.</p>
HTML;

        $post2_content_en = <<<'HTML'
<p>You have a great website, you're active on social media, you produce valuable content, but traffic is low and sales aren't what you expected? The problem usually lies here: You're not visible on search engines. This is exactly where SEO (Search Engine Optimization) comes into play.</p>

<h5>What is SEO?</h5>
<p>SEO is the sum of technical and strategic work done to ensure your website ranks high organically (free) on search engines like Google. When users search, appearing on the first page, even in the top positions, for keywords related to you means more traffic, more potential customers, and consequently more sales.</p>

<h5>Why Is SEO So Important?</h5>
<ul>
    <li><strong>Organic Traffic = Sustainable Growth:</strong> Paid ads (like Google Ads) can deliver quick results in the short term, but when your budget runs out, so does the traffic. SEO, once done correctly, brings continuous and sustainable traffic in the long term. A good SEO strategy is like your 'regular customer' in the digital world.</li>
    <li><strong>Trustworthiness and Authority:</strong> Users perceive websites that rank high in search results as more reliable and authoritative. Being on the first page of Google sends a strong signal that your brand is a leader in the industry.</li>
    <li><strong>Targeted Traffic:</strong> SEO allows you to reach users who are actively searching for your product or service, i.e., those closest to making a purchase. For example, someone searching for 'web design service in Istanbul' already wants to buy this service. Ranking for the right keywords brings the most qualified traffic.</li>
    <li><strong>Competitive Advantage:</strong> If your competitors are investing in SEO and you're not, you're losing potential customers to them. Getting ahead in SEO is one of the most effective ways to increase your market share.</li>
    <li><strong>Cost Effectiveness:</strong> In the long term, the cost per acquisition (CPA) of SEO is much lower compared to paid advertising. When you rank high in organic results, you don't pay for each click.</li>
</ul>

<h5>Key Components of an Effective SEO Strategy</h5>
<ul>
    <li><strong>Keyword Research:</strong> Understanding what your target audience is searching for and identifying the right keywords.</li>
    <li><strong>Technical SEO:</strong> Technical infrastructure optimizations such as site speed, mobile compatibility, security (HTTPS), sitemap, robots.txt file.</li>
    <li><strong>On-Page SEO:</strong> On-page factors such as title tags, meta descriptions, headings (H1, H2, etc.), content quality, internal links, image optimization.</li>
    <li><strong>Off-Page SEO:</strong> Backlinks from other quality websites, social media signals, and online reputation.</li>
    <li><strong>Quality Content:</strong> Valuable, original, informative, and regularly updated content for users.</li>
    <li><strong>Local SEO:</strong> Especially if you're a local business, strategies like Google My Business optimization and being listed in local directories.</li>
</ul>

<h5>SEO is a Marathon, Not a Sprint</h5>
<p>SEO takes time to show results. Depending on competition, industry, and your current situation, seeing the first serious results can take 3-6 months, sometimes longer. However, with patience and consistency, it provides very high returns in the long run.</p>

<p>As Next Medya, we manage all your SEO processes from your website's technical infrastructure to content strategy, from local SEO to your backlink profile, and ensure you reach the top rankings on search engines.</p>
HTML;

        $post2 = Post::create([
            'title' => ['tr' => 'SEO: Dijital Başarının Anahtarı', 'en' => 'SEO: The Key to Digital Success'],
            'slug' => Str::slug('SEO Dijital Başarının Anahtarı'),
            'content' => ['tr' => $post2_content_tr, 'en' => $post2_content_en],
            'excerpt' => ['tr' => 'SEO neden işletmeniz için kritik? Arama motorlarında üst sıralara çıkmanın yolları ve SEO stratejileri.', 'en' => 'Why is SEO critical for your business? Ways to rank high on search engines and SEO strategies.'],
            'featured_image' => 'uploads/posts/featured/nextmedya-blog-2.jpg',
            'user_id' => $author->id,
            'category_id' => $cat4->id,
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(10),
        ]);

        // BLOG YAZISI 3
        $post3_content_tr = <<<'HTML'
<p>E-ticaret sektörü son yıllarda inanılmaz bir hızla büyüdü ve pandemiyle birlikte bu büyüme daha da hızlandı. Artık her büyüklükteki işletme, ürünlerini online satmanın potansiyelini keşfetti. Ancak bir e-ticaret sitesi açmak, başarılı olmak için yeterli değil. Doğru platform seçiminden kullanıcı deneyimine, ödeme sistemlerinden lojistik entegrasyonuna kadar birçok faktör, başarınızı doğrudan etkiler.</p>

<h5>E-Ticaret Siteniz İçin Doğru Altyapıyı Seçmek</h5>
<p>E-ticaret platformu seçimi, işletmenizin büyüklüğüne, bütçenize, teknik bilginize ve ihtiyaçlarınıza bağlıdır. Popüler seçenekler şunlardır:</p>
<ul>
    <li><strong>Hazır E-Ticaret Platformları (SaaS):</strong> Shopify, Wix E-commerce, Squarespace gibi platformlar, hızlı kurulum ve kullanım kolaylığı sunar. Teknik bilgiye ihtiyaç duymadan kısa sürede satışa başlayabilirsiniz. Ancak özelleştirme seçenekleri sınırlıdır ve aylık abonelik ücreti ödemeniz gerekir.</li>
    <li><strong>Açık Kaynak Platformlar:</strong> WooCommerce (WordPress), Magento, PrestaShop gibi platformlar, tamamen özelleştirilebilir ve genişletilebilir çözümler sunar. Daha fazla kontrol ve esneklik sağlarlar, ancak kurulum, yönetim ve güvenlik için teknik uzmanlık gerektirir.</li>
    <li><strong>Özel Geliştirme:</strong> Tamamen size özel, sıfırdan yazılan bir e-ticaret platformu, en yüksek özelleştirme ve kontrol seviyesini sunar. Benzersiz bir iş modeli veya çok özel gereksinimleri olan büyük işletmeler için idealdir, ancak en maliyetli ve zaman alıcı seçenektir.</li>
</ul>

<h5>Kullanıcı Deneyimi (UX): Satışın Kalbi</h5>
<p>E-ticaret sitenizdeki kullanıcı deneyimi, dönüşüm oranlarınızı doğrudan etkiler. Ziyaretçiler sitenizde kolayca gezinebilmeli, aradıklarını hızlıca bulmalı ve satın alma işlemini sorunsuz tamamlayabilmelidir.</p>
<ul>
    <li><strong>Hızlı Yükleme Süreleri:</strong> Yavaş yüklenen sayfalar, yüksek terk oranlarına neden olur. Sitenizin mobil ve masaüstünde hızlı yüklenmesi kritiktir.</li>
    <li><strong>Mobil Uyumluluk:</strong> Online alışverişlerin büyük çoğunluğu mobil cihazlardan yapılır. Siteniz her ekran boyutunda mükemmel görünmeli ve çalışmalıdır.</li>
    <li><strong>Basit ve Anlaşılır Navigasyon:</strong> Kategoriler, ürün sayfaları ve sepet net ve mantıklı bir şekilde organize edilmelidir.</li>
    <li><strong>Kaliteli Ürün Görselleri ve Açıklamalar:</strong> Profesyonel fotoğraflar, detaylı ürün açıklamaları ve müşteri yorumları, güven oluşturur ve satın alma kararını kolaylaştırır.</li>
    <li><strong>Kolay Ödeme Süreci:</strong> Çok adımlı, karmaşık ödeme süreçleri sepet terk oranını artırır. Misafir ödeme (kayıt olmadan ödeme) seçeneği sunmak ve popüler ödeme yöntemlerini (kredi kartı, banka kartı, havale, kapıda ödeme) desteklemek önemlidir.</li>
</ul>

<h5>Güvenlik ve Güven</h5>
<p>Online alışveriş yapan müşterilerin en büyük endişelerinden biri güvenliktir. SSL sertifikası (HTTPS), güvenli ödeme gateway'leri ve gizlilik politikaları, müşterilerinizin güvenini kazanmanız için zorunludur. Ayrıca, 'İade ve Değişim Politikası', 'Teslimat Bilgileri' ve 'İletişim' sayfalarınızın net ve kolay ulaşılabilir olması gerekir.</p>

<h5>Pazarlama ve SEO</h5>
<p>Harika bir e-ticaret siteniz olsa bile, müşteriler sizi bulamazsa satış yapamazsınız. Dijital pazarlama stratejileri kritik öneme sahiptir:</p>
<ul>
    <li><strong>SEO:</strong> Ürün sayfalarınızı ve blog içeriklerinizi arama motorları için optimize edin.</li>
    <li><strong>Google Shopping ve Ürün Reklamları:</strong> Ürünlerinizi doğrudan arama sonuçlarında gösterin.</li>
    <li><strong>Sosyal Medya Pazarlama:</strong> Instagram, Facebook ve Pinterest gibi platformlarda aktif olun ve ürünlerinizi tanıtın.</li>
    <li><strong>E-posta Pazarlama:</strong> Müşteri veritabanınızı oluşturun ve düzenli kampanyalar gönderin.</li>
    <li><strong>Influencer İşbirlikleri:</strong> Sektörünüzdeki etkileyicilerle çalışarak daha geniş kitlelere ulaşın.</li>
</ul>

<h5>Analiz ve Optimizasyon</h5>
<p>E-ticaret başarısı sürekli ölçüm ve iyileştirme gerektirir. Google Analytics, Google Search Console ve e-ticaret platformunuzun sunduğu raporları düzenli olarak takip edin. Hangi ürünler daha çok satılıyor? Hangi sayfalar yüksek terk oranına sahip? Hangi pazarlama kanalı en iyi dönüşüm sağlıyor? Bu verilere göre stratejinizi sürekli optimize edin.</p>

<p>Next Medya olarak, e-ticaret sitenizin kurulumundan pazarlamasına, optimizasyonundan büyüme stratejilerinize kadar her aşamada yanınızdayız. Başarılı bir online mağaza oluşturmak ve büyütmek için ihtiyacınız olan tüm dijital çözümleri sunuyoruz.</p>
HTML;

        $post3_content_en = <<<'HTML'
<p>The e-commerce sector has grown at an incredible pace in recent years, and this growth has accelerated even more with the pandemic. Now businesses of all sizes have discovered the potential of selling their products online. However, launching an e-commerce site is not enough to be successful. Many factors directly affect your success, from choosing the right platform to user experience, from payment systems to logistics integration.</p>

<h5>Choosing the Right Infrastructure for Your E-Commerce Site</h5>
<p>Choosing an e-commerce platform depends on your business size, budget, technical knowledge, and needs. Popular options include:</p>
<ul>
    <li><strong>Ready-Made E-Commerce Platforms (SaaS):</strong> Platforms like Shopify, Wix E-commerce, Squarespace offer quick setup and ease of use. You can start selling in a short time without needing technical knowledge. However, customization options are limited and you need to pay a monthly subscription fee.</li>
    <li><strong>Open Source Platforms:</strong> Platforms like WooCommerce (WordPress), Magento, PrestaShop offer fully customizable and expandable solutions. They provide more control and flexibility, but require technical expertise for setup, management, and security.</li>
    <li><strong>Custom Development:</strong> A completely custom e-commerce platform written from scratch offers the highest level of customization and control. It's ideal for large businesses with unique business models or very specific requirements, but it's the most costly and time-consuming option.</li>
</ul>

<h5>User Experience (UX): The Heart of Sales</h5>
<p>User experience on your e-commerce site directly affects your conversion rates. Visitors should be able to navigate your site easily, find what they're looking for quickly, and complete the purchase process smoothly.</p>
<ul>
    <li><strong>Fast Loading Times:</strong> Slow loading pages cause high abandonment rates. It's critical that your site loads quickly on both mobile and desktop.</li>
    <li><strong>Mobile Compatibility:</strong> The majority of online shopping is done from mobile devices. Your site should look and work perfectly on all screen sizes.</li>
    <li><strong>Simple and Clear Navigation:</strong> Categories, product pages, and cart should be organized clearly and logically.</li>
    <li><strong>Quality Product Images and Descriptions:</strong> Professional photos, detailed product descriptions, and customer reviews build trust and facilitate purchase decisions.</li>
    <li><strong>Easy Payment Process:</strong> Multi-step, complex payment processes increase cart abandonment rates. It's important to offer guest checkout (payment without registration) and support popular payment methods (credit card, debit card, bank transfer, cash on delivery).</li>
</ul>

<h5>Security and Trust</h5>
<p>One of the biggest concerns of customers shopping online is security. SSL certificate (HTTPS), secure payment gateways, and privacy policies are essential for gaining your customers' trust. Additionally, your 'Return and Exchange Policy', 'Delivery Information', and 'Contact' pages should be clear and easily accessible.</p>

<h5>Marketing and SEO</h5>
<p>Even if you have a great e-commerce site, you can't make sales if customers can't find you. Digital marketing strategies are critically important:</p>
<ul>
    <li><strong>SEO:</strong> Optimize your product pages and blog content for search engines.</li>
    <li><strong>Google Shopping and Product Ads:</strong> Display your products directly in search results.</li>
    <li><strong>Social Media Marketing:</strong> Be active on platforms like Instagram, Facebook, and Pinterest and promote your products.</li>
    <li><strong>Email Marketing:</strong> Build your customer database and send regular campaigns.</li>
    <li><strong>Influencer Collaborations:</strong> Reach wider audiences by working with influencers in your industry.</li>
</ul>

<h5>Analysis and Optimization</h5>
<p>E-commerce success requires continuous measurement and improvement. Regularly monitor Google Analytics, Google Search Console, and the reports provided by your e-commerce platform. Which products are selling more? Which pages have high abandonment rates? Which marketing channel provides the best conversion? Continuously optimize your strategy based on this data.</p>

<p>As Next Medya, we're with you at every stage from setting up your e-commerce site to marketing it, from optimization to your growth strategies. We offer all the digital solutions you need to create and grow a successful online store.</p>
HTML;

        $post3 = Post::create([
            'title' => ['tr' => 'E-Ticaret Başarısının Sırları: Doğru Strateji ve Araçlar', 'en' => 'Secrets of E-Commerce Success: The Right Strategy and Tools'],
            'slug' => Str::slug('E-Ticaret Başarısının Sırları'),
            'content' => ['tr' => $post3_content_tr, 'en' => $post3_content_en],
            'excerpt' => ['tr' => 'Başarılı bir e-ticaret sitesi nasıl kurulur? Platform seçimi, kullanıcı deneyimi, ödeme sistemleri ve pazarlama stratejileri.', 'en' => 'How to build a successful e-commerce site? Platform selection, user experience, payment systems, and marketing strategies.'],
            'featured_image' => 'uploads/posts/featured/nextmedya-blog-3.jpg',
            'user_id' => $author->id,
            'category_id' => $cat2->id,
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(5),
        ]);

        // BLOG YAZISI 4
        $post4_content_tr = <<<'HTML'
<p>Dijital pazarlama, günümüz rekabetçi ortamında işletmeler için bir lüks değil, bir zorunluluktur. Ancak birçok firma, dijital pazarlamayı tekil kanallara indirgeme hatasına düşer: "Sadece Instagram'da varız", "Biraz Google reklamı veriyoruz" veya "Arada bir blog yazıyoruz". Oysa gerçek başarı, bu kanalların izole bir şekilde çalışmasıyla değil, birbiriyle entegre, bütüncül bir stratejiyle gelir. Buna **Entegre Dijital Pazarlama** diyoruz.</p>

<p>Entegre dijital pazarlama; SEO, içerik pazarlaması, sosyal medya, e-posta pazarlaması ve ücretli reklamların (PPC) tek bir hedef doğrultusunda, bir orkestra uyumuyla çalışması demektir. Her bir kanal, diğerinin etkisini güçlendirir ve müşteri yolculuğunun farklı aşamalarında potansiyel müşteriye dokunur.</p>

<h5>"Silo" Yaklaşımının Tehlikeleri</h5>
<p>Pazarlama kanallarınız birbiriyle konuşmadığında ("silo" halinde çalıştığında) ne olur?</p>
<ul>
    <li><strong>Kaynak İsrafı:</strong> SEO ekibinin optimize ettiği anahtar kelimelerden içerik ekibinin haberi olmaz. İçerik ekibinin yazdığı harika bir blog yazısı sosyal medyada paylaşılmaz.</li>
    <li><strong>Tutarsız Marka Mesajı:</strong> Instagram'da eğlenceli ve samimi bir dil konuşurken, web sitenizde aşırı resmi ve kurumsal bir dil kullanmak, müşterinin kafasını karıştırır ve güveni zedeler.</li>
    <li><strong>Müşteri Yolculuğunda Kopukluk:</strong> Bir müşteri sosyal medya reklamınızı görüyor, ilgileniyor ama web sitenize geldiğinde o kampanyayla ilgili hiçbir bilgi bulamıyor. Sonuç? Kayıp bir müşteri.</li>
    <li><strong>Veri Siloları:</strong> Her kanalın verileri ayrı ayrı tutulduğunda, müşteri davranışlarının bütüncül bir resmini göremezsiniz. Bu, stratejik karar almayı zorlaştırır.</li>
</ul>

<h5>Entegre Dijital Pazarlamanın Faydaları</h5>
<ul>
    <li><strong>Güçlendirilmiş Mesaj ve Marka Tutarlılığı:</strong> Tüm kanallarda tutarlı bir marka sesi ve görsel kimlik, marka bilinirliğini ve güvenilirliğini artırır.</li>
    <li><strong>Sinerjik Etki:</strong> SEO ile optimize edilmiş bir blog yazısı, sosyal medyada paylaşıldığında daha fazla erişim sağlar. Bu erişim, web sitenize trafik getirir, SEO sinyallerini güçlendirir ve potansiyel müşterileri e-posta listenize katmanıza olanak tanır.</li>
    <li><strong>Daha İyi Müşteri Deneyimi:</strong> Müşteri, hangi kanalda sizinle etkileşime girerse girsin, tutarlı ve akıcı bir deneyim yaşar. Bu, müşteri sadakatini artırır.</li>
    <li><strong>Veri Odaklı Kararlar:</strong> Tüm kanallardan gelen verileri bir araya getirdiğinizde, müşteri davranışlarını daha iyi anlar ve stratejinizi daha etkili bir şekilde optimize edersiniz.</li>
    <li><strong>Daha Yüksek ROI:</strong> Kaynakları daha verimli kullanır, tekrarları ve israfı azaltır, sonuçta yatırım getirinizi (ROI) maksimize edersiniz.</li>
</ul>

<h5>Entegre Dijital Pazarlama Stratejisi Nasıl Oluşturulur?</h5>
<ol>
    <li><strong>Net Hedefler Belirleyin:</strong> Ne başarmak istiyorsunuz? Marka bilinirliği mi, web trafiği mi, satış mı? Tüm kanallar bu hedefe hizmet etmelidir.</li>
    <li><strong>Hedef Kitlenizi Derinlemesine Tanıyın:</strong> Müşterileriniz kimler? Online davranışları nedir? Hangi kanallarda aktifler?</li>
    <li><strong>Tutarlı Bir Marka Mesajı Oluşturun:</strong> Tüm kanallarda kullanılacak temel bir marka hikayesi, ton ve görsel kimlik belirleyin.</li>
    <li><strong>İçerik Takvimi Oluşturun:</strong> Hangi içerik hangi kanalda, ne zaman paylaşılacak? SEO, sosyal medya, e-posta ve blog içeriklerini birbirine entegre edin.</li>
    <li><strong>Kanallar Arası Koordinasyon Sağlayın:</strong> Ekipler arasında düzenli iletişim ve iş birliği, entegrasyonun temelidir. Haftalık toplantılar, ortak proje yönetim araçları kullanın.</li>
    <li><strong>Verileri Birleştirin ve Analiz Edin:</strong> Google Analytics, CRM sisteminiz, sosyal medya analiz araçlarını bir araya getirerek müşteri yolculuğunu takip edin.</li>
    <li><strong>Test Edin, Ölçün, Optimize Edin:</strong> Sürekli iyileştirme, entegre pazarlamanın ruhudur. A/B testleri yapın, verilere göre stratejinizi güncelleyin.</li>
</ol>

<h5>Örnek Bir Entegre Kampanya</h5>
<p>Diyelim ki yeni bir ürün lansmanı yapıyorsunuz:</p>
<ul>
    <li><strong>1. Hafta:</strong> Blog'da ürünle ilgili detaylı bir yazı yayınlanır (SEO optimizasyonlu). Aynı içerik, e-posta listenize teaser olarak gönderilir.</li>
    <li><strong>2. Hafta:</strong> Ürünün tanıtıldığı bir video sosyal medyada paylaşılır. Video, blog yazısına link verir. Google Ads ve Facebook Ads kampanyaları başlar, landing page'e trafik çeker.</li>
    <li><strong>3. Hafta:</strong> Müşteri yorumları ve case study'leri sosyal medyada ve blog'da paylaşılır. Influencer işbirlikleri devreye girer. Retargeting reklamlarıyla, web sitesini ziyaret edip ürünü almayan kişilere tekrar ulaşılır.</li>
    <li><strong>Devam Eden Süreç:</strong> E-posta pazarlama ile ürünü satın alan müşterilere teşekkür edilir, ürünle ilgili ipuçları gönderilir ve çapraz satış fırsatları sunulur.</li>
</ul>

<p>Next Medya olarak, entegre dijital pazarlama stratejileri geliştiriyor ve uyguluyoruz. Tüm dijital kanallarınızı uyum içinde yönetir, markanızın sesini güçlendirir ve iş hedeflerinize ulaşmanızı sağlarız.</p>
HTML;

        $post4_content_en = <<<'HTML'
<p>Digital marketing is not a luxury but a necessity for businesses in today's competitive environment. However, many companies make the mistake of reducing digital marketing to individual channels: "We're only on Instagram," "We run some Google ads," or "We write a blog post occasionally." The real success doesn't come from these channels working in isolation, but from an integrated, holistic strategy. We call this **Integrated Digital Marketing**.</p>

<p>Integrated digital marketing means SEO, content marketing, social media, email marketing, and paid advertising (PPC) working in harmony like an orchestra toward a single goal. Each channel strengthens the effect of the others and touches potential customers at different stages of the customer journey.</p>

<h5>The Dangers of the "Silo" Approach</h5>
<p>What happens when your marketing channels don't talk to each other (when they work in "silos")?</p>
<ul>
    <li><strong>Resource Waste:</strong> The content team doesn't know about the keywords the SEO team optimized. A great blog post written by the content team isn't shared on social media.</li>
    <li><strong>Inconsistent Brand Message:</strong> Speaking a fun and friendly language on Instagram while using an overly formal and corporate language on your website confuses the customer and damages trust.</li>
    <li><strong>Disconnect in Customer Journey:</strong> A customer sees your social media ad, is interested, but when they come to your website, they can't find any information about that campaign. The result? A lost customer.</li>
    <li><strong>Data Silos:</strong> When each channel's data is kept separately, you can't see a holistic picture of customer behaviors. This makes strategic decision-making difficult.</li>
</ul>

<h5>Benefits of Integrated Digital Marketing</h5>
<ul>
    <li><strong>Amplified Message and Brand Consistency:</strong> A consistent brand voice and visual identity across all channels increases brand awareness and reliability.</li>
    <li><strong>Synergistic Effect:</strong> A blog post optimized with SEO gains more reach when shared on social media. This reach brings traffic to your website, strengthens SEO signals, and allows you to add potential customers to your email list.</li>
    <li><strong>Better Customer Experience:</strong> Customers have a consistent and smooth experience regardless of which channel they interact with you on. This increases customer loyalty.</li>
    <li><strong>Data-Driven Decisions:</strong> When you bring together data from all channels, you better understand customer behaviors and optimize your strategy more effectively.</li>
    <li><strong>Higher ROI:</strong> You use resources more efficiently, reduce duplication and waste, and ultimately maximize your return on investment (ROI).</li>
</ul>

<h5>How to Create an Integrated Digital Marketing Strategy?</h5>
<ol>
    <li><strong>Set Clear Goals:</strong> What do you want to achieve? Brand awareness, web traffic, or sales? All channels should serve this goal.</li>
    <li><strong>Know Your Target Audience Deeply:</strong> Who are your customers? What are their online behaviors? Which channels are they active on?</li>
    <li><strong>Create a Consistent Brand Message:</strong> Define a core brand story, tone, and visual identity to be used across all channels.</li>
    <li><strong>Create a Content Calendar:</strong> Which content will be shared on which channel and when? Integrate SEO, social media, email, and blog content.</li>
    <li><strong>Ensure Cross-Channel Coordination:</strong> Regular communication and collaboration between teams is the foundation of integration. Use weekly meetings and shared project management tools.</li>
    <li><strong>Consolidate and Analyze Data:</strong> Bring together Google Analytics, your CRM system, and social media analytics tools to track the customer journey.</li>
    <li><strong>Test, Measure, Optimize:</strong> Continuous improvement is the spirit of integrated marketing. Conduct A/B tests and update your strategy based on data.</li>
</ol>

<h5>Example of an Integrated Campaign</h5>
<p>Let's say you're launching a new product:</p>
<ul>
    <li><strong>Week 1:</strong> A detailed blog post about the product is published (SEO optimized). The same content is sent to your email list as a teaser.</li>
    <li><strong>Week 2:</strong> A video introducing the product is shared on social media. The video links to the blog post. Google Ads and Facebook Ads campaigns start, driving traffic to the landing page.</li>
    <li><strong>Week 3:</strong> Customer reviews and case studies are shared on social media and the blog. Influencer collaborations kick in. Retargeting ads reach people who visited the website but didn't purchase the product.</li>
    <li><strong>Ongoing Process:</strong> Email marketing thanks customers who purchased the product, sends product tips, and offers cross-selling opportunities.</li>
</ul>

<p>As Next Medya, we develop and implement integrated digital marketing strategies. We manage all your digital channels in harmony, amplify your brand's voice, and help you achieve your business goals.</p>
HTML;

        $post4 = Post::create([
            'title' => ['tr' => 'Entegre Dijital Pazarlama: Tüm Kanalları Uyumlu Kullanmak', 'en' => 'Integrated Digital Marketing: Using All Channels in Harmony'],
            'slug' => Str::slug('Entegre Dijital Pazarlama'),
            'content' => ['tr' => $post4_content_tr, 'en' => $post4_content_en],
            'excerpt' => ['tr' => 'SEO, sosyal medya, içerik ve ücretli reklamlar nasıl birlikte çalışır? Entegre dijital pazarlama stratejisi oluşturma rehberi.', 'en' => 'How do SEO, social media, content, and paid ads work together? A guide to creating an integrated digital marketing strategy.'],
            'featured_image' => 'uploads/posts/featured/nextmedya-blog-4.jpg',
            'user_id' => $author->id,
            'category_id' => $cat1->id,
            'status' => 'published',
            'published_at' => Carbon::now(),
        ]);

        // 8. Yazılar ve etiketler arasındaki ilişkiyi kuralım
        $post1->tags()->attach([$tag8->id, $tag6->id, $tag1->id]); // Dijital Strateji, Mobil Uyumlu, Sosyal Medya
        $post2->tags()->attach([$tag3->id, $tag4->id, $tag7->id]); // SEO, İçerik Pazarlama, Dönüşüm Optimizasyonu
        $post3->tags()->attach([$tag5->id, $tag7->id, $tag2->id]); // E-Ticaret Çözümleri, Dönüşüm Optimizasyonu, Google Ads
        $post4->tags()->attach([$tag8->id, $tag1->id, $tag4->id, $tag3->id]); // Dijital Strateji, Sosyal Medya, İçerik Pazarlama, SEO

        echo "\n✅ Blog Seeder başarıyla çalıştırıldı!\n";
        echo "📝 4 Blog yazısı oluşturuldu.\n";
        echo "📁 4 Kategori oluşturuldu.\n";
        echo "🏷️  8 Etiket oluşturuldu.\n";
        echo "👤 1 Yazar oluşturuldu (admin@nextmedya.com)\n\n";
    }
}