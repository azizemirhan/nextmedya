<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Page;
use Illuminate\Support\Str;

class SeoAnalysisService
{
    /**
     * Bir yazının veya sayfanın SEO kalitesini analiz eder
     *
     * @param Post|Page $model
     * @param string $locale
     * @return array
     */
    public function analyze($model, string $locale = 'tr'): array
    {
        $focusKeyword = $model->getTranslation('focus_keyword', $locale);

        if (empty($focusKeyword)) {
            return [
                'score' => 0,
                'checks' => [],
                'message' => 'Odak anahtar kelime belirlenmemiş. Analiz yapılamıyor.'
            ];
        }

        $checks = [];
        $score = 0;
        $maxScore = 100;

        // 1. Odak kelime SEO başlığında mı?
        $seoTitle = $model->getTranslation('seo_title', $locale) ?: $model->getTranslation('title', $locale);
        $checks['focus_in_title'] = [
            'label' => 'Odak kelime SEO başlığında',
            'status' => $this->containsKeyword($seoTitle, $focusKeyword),
            'weight' => 15
        ];

        // 2. Odak kelime Meta açıklamada mı?
        $metaDescription = $model->getTranslation('meta_description', $locale);
        $checks['focus_in_meta'] = [
            'label' => 'Odak kelime Meta açıklamada',
            'status' => $this->containsKeyword($metaDescription, $focusKeyword),
            'weight' => 10
        ];

        // 3. Odak kelime URL'de mi?
        $checks['focus_in_url'] = [
            'label' => 'Odak kelime URL\'de',
            'status' => $this->containsKeyword($model->slug, $focusKeyword),
            'weight' => 10
        ];

        // 4. Odak kelime içeriğin ilk %10'unda mı? (sadece Post için)
        $content = '';
        $contentExists = method_exists($model, 'getTranslation') && isset($model->content);

        if ($contentExists) {
            $content = strip_tags($model->getTranslation('content', $locale));
            $contentLength = mb_strlen($content);
            $firstPart = mb_substr($content, 0, (int)($contentLength * 0.1));
            $checks['focus_in_first_paragraph'] = [
                'label' => 'Odak kelime içeriğin ilk %10\'unda',
                'status' => $this->containsKeyword($firstPart, $focusKeyword),
                'weight' => 10
            ];

            // 5. Odak kelime H2/H3 başlıklarında kullanılmış mı?
            $checks['focus_in_headings'] = [
                'label' => 'Odak kelime alt başlıklarda (H2/H3)',
                'status' => $this->checkInHeadings($model->getTranslation('content', $locale), $focusKeyword),
                'weight' => 10
            ];

            // 6. İçerik Uzunluğu
            $wordCount = str_word_count($content);
            $checks['content_length'] = [
                'label' => "İçerik uzunluğu ({$wordCount} kelime)",
                'status' => $wordCount >= 300,
                'weight' => 10,
                'info' => $wordCount < 300 ? 'En az 300 kelime önerilir' : 'İdeal uzunluk'
            ];
        }

        // 7. SEO Başlık Uzunluğu (Piksel bazlı kontrol - yaklaşık)
        $titleLength = mb_strlen($seoTitle);
        $checks['title_length'] = [
            'label' => "SEO Başlık uzunluğu ({$titleLength} karakter)",
            'status' => $titleLength >= 40 && $titleLength <= 60,
            'weight' => 10,
            'info' => $this->getTitleLengthFeedback($titleLength)
        ];

        // 8. Meta Açıklama Uzunluğu
        $descLength = mb_strlen($metaDescription ?? '');
        $checks['meta_length'] = [
            'label' => "Meta açıklama uzunluğu ({$descLength} karakter)",
            'status' => $descLength >= 120 && $descLength <= 160,
            'weight' => 10,
            'info' => $this->getDescriptionLengthFeedback($descLength)
        ];

        // 9. Görsellerde Alt Text var mı? (sadece Post için)
        if (isset($model->featured_image_alt_text)) {
            $checks['has_alt_text'] = [
                'label' => 'Öne çıkan görselde Alt metni',
                'status' => !empty($model->getTranslation('featured_image_alt_text', $locale)),
                'weight' => 5
            ];
        }

        // 10. İçeride link var mı? (sadece content varsa)
        if ($contentExists) {
            $hasInternalLinks = $this->hasInternalLinks($model->getTranslation('content', $locale));
            $hasExternalLinks = $this->hasExternalLinks($model->getTranslation('content', $locale));

            $checks['internal_links'] = [
                'label' => 'İç linkler',
                'status' => $hasInternalLinks,
                'weight' => 5,
                'info' => $hasInternalLinks ? 'Var' : 'Yok - İçeride başka sayfalarınıza link verin'
            ];

            $checks['external_links'] = [
                'label' => 'Dış linkler',
                'status' => $hasExternalLinks,
                'weight' => 5,
                'info' => $hasExternalLinks ? 'Var' : 'Yok - Güvenilir kaynaklara link verin'
            ];
        }

        // Skor hesaplama
        foreach ($checks as $check) {
            if ($check['status']) {
                $score += $check['weight'];
            }
        }

        return [
            'score' => $score,
            'max_score' => $maxScore,
            'percentage' => round(($score / $maxScore) * 100),
            'checks' => $checks,
            'rating' => $this->getRating($score, $maxScore)
        ];
    }

    /**
     * Anahtar kelimenin metinde olup olmadığını kontrol eder (case-insensitive)
     */
    private function containsKeyword(?string $text, string $keyword): bool
    {
        if (empty($text) || empty($keyword)) {
            return false;
        }

        return mb_stripos($text, $keyword) !== false;
    }

    /**
     * Anahtar kelimenin H2/H3 başlıklarında olup olmadığını kontrol eder
     */
    private function checkInHeadings(string $content, string $keyword): bool
    {
        preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/is', $content, $matches);

        if (empty($matches[1])) {
            return false;
        }

        foreach ($matches[1] as $heading) {
            if ($this->containsKeyword(strip_tags($heading), $keyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * İçeride dahili link var mı?
     */
    private function hasInternalLinks(string $content): bool
    {
        $domain = parse_url(config('app.url'), PHP_URL_HOST);
        preg_match_all('/<a[^>]+href=["\']([^"\']+)["\'][^>]*>/i', $content, $matches);

        foreach ($matches[1] ?? [] as $url) {
            if (Str::contains($url, $domain) || Str::startsWith($url, '/')) {
                return true;
            }
        }

        return false;
    }

    /**
     * İçeride harici link var mı?
     */
    private function hasExternalLinks(string $content): bool
    {
        $domain = parse_url(config('app.url'), PHP_URL_HOST);
        preg_match_all('/<a[^>]+href=["\']([^"\']+)["\'][^>]*>/i', $content, $matches);

        foreach ($matches[1] ?? [] as $url) {
            if (Str::startsWith($url, 'http') && !Str::contains($url, $domain)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Başlık uzunluğu için geri bildirim
     */
    private function getTitleLengthFeedback(int $length): string
    {
        if ($length < 40) {
            return 'Çok kısa - En az 40 karakter önerilir';
        } elseif ($length > 60) {
            return 'Çok uzun - Google aramada kesilebilir';
        }
        return 'İdeal uzunluk';
    }

    /**
     * Açıklama uzunluğu için geri bildirim
     */
    private function getDescriptionLengthFeedback(int $length): string
    {
        if ($length === 0) {
            return 'Meta açıklama boş';
        } elseif ($length < 120) {
            return 'Çok kısa - En az 120 karakter önerilir';
        } elseif ($length > 160) {
            return 'Çok uzun - Google aramada kesilebilir';
        }
        return 'İdeal uzunluk';
    }

    /**
     * Skora göre rating döndürür
     */
    private function getRating(int $score, int $maxScore): array
    {
        $percentage = ($score / $maxScore) * 100;

        if ($percentage >= 80) {
            return ['label' => 'Mükemmel', 'color' => 'success', 'icon' => '🟢'];
        } elseif ($percentage >= 60) {
            return ['label' => 'İyi', 'color' => 'info', 'icon' => '🔵'];
        } elseif ($percentage >= 40) {
            return ['label' => 'Orta', 'color' => 'warning', 'icon' => '🟡'];
        } else {
            return ['label' => 'Zayıf', 'color' => 'danger', 'icon' => '🔴'];
        }
    }

    /**
     * Google SERP Önizlemesi için veri hazırlar
     */
    public function generateSerpPreview($model, string $locale = 'tr'): array
    {
        $title = $model->getTranslation('seo_title', $locale) ?: $model->getTranslation('title', $locale);

        // Description - Post için excerpt, Page için meta_description
        $description = $model->getTranslation('meta_description', $locale);
        if (empty($description) && isset($model->excerpt)) {
            $description = $model->getTranslation('excerpt', $locale);
        }

        // URL - Model tipine göre
        $url = $model instanceof Post
            ? route('blog.show', $model->slug)
            : route('frontend.page.show', $model->slug);

        // Başlık uzunluğu (piksel bazlı yaklaşık)
        $titlePixels = $this->estimatePixelWidth($title);
        $titleTruncated = $titlePixels > 600;

        // Açıklama uzunluğu
        $descPixels = $this->estimatePixelWidth($description);
        $descTruncated = $descPixels > 920;

        return [
            'title' => $title,
            'title_truncated' => $titleTruncated,
            'title_display' => $titleTruncated ? Str::limit($title, 60) : $title,
            'description' => $description,
            'description_truncated' => $descTruncated,
            'description_display' => $descTruncated ? Str::limit($description, 155) : $description,
            'url' => $url,
            'url_display' => parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH),
        ];
    }

    /**
     * Metnin piksel genişliğini tahmin eder (ortalama)
     */
    private function estimatePixelWidth(string $text): int
    {
        // Ortalama karakter genişliği ~10px (Google font için yaklaşık)
        return mb_strlen($text) * 10;
    }
}