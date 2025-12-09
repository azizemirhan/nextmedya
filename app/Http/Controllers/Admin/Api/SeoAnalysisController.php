<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Services\SeoAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeoAnalysisController extends Controller
{
    protected $seoService;

    public function __construct(SeoAnalysisService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Canlı SEO analizi (AJAX endpoint)
     */
    public function liveAnalysis(Request $request)
    {
        $locale = $request->input('locale', 'tr');
        $focusKeyword = $request->input('focus_keyword') ?? '';
        $title = $request->input('title') ?? '';
        $seoTitle = ($request->input('seo_title') ?? '') ?: $title;
        $metaDescription = $request->input('meta_description') ?? '';
        $content = $request->input('content') ?? '';
        $slug = $request->input('slug') ?? '';
        $featuredImageAlt = $request->input('featured_image_alt') ?? '';

        if (empty($focusKeyword)) {
            return response()->json([
                'score' => 0,
                'checks' => [],
                'message' => 'Odak anahtar kelime belirlenmemiş.'
            ]);
        }

        $checks = [];
        $score = 0;
        $maxScore = 100;

        // 1. Odak kelime SEO başlığında mı?
        $checks['focus_in_title'] = [
            'label' => 'Odak kelime SEO başlığında',
            'status' => $this->containsKeyword($seoTitle, $focusKeyword),
            'weight' => 15
        ];

        // 2. Odak kelime Meta açıklamada mı?
        $checks['focus_in_meta'] = [
            'label' => 'Odak kelime Meta açıklamada',
            'status' => $this->containsKeyword($metaDescription, $focusKeyword),
            'weight' => 10
        ];

        // 3. Odak kelime URL'de mi?
        $checks['focus_in_url'] = [
            'label' => 'Odak kelime URL\'de',
            'status' => $this->containsKeyword($slug, $focusKeyword),
            'weight' => 10
        ];

        // 4. Odak kelime içeriğin ilk %10'unda mı?
        $plainContent = strip_tags($content);
        $contentLength = mb_strlen($plainContent);
        $firstPart = mb_substr($plainContent, 0, (int)($contentLength * 0.1));
        $checks['focus_in_first_paragraph'] = [
            'label' => 'Odak kelime içeriğin ilk %10\'unda',
            'status' => $this->containsKeyword($firstPart, $focusKeyword),
            'weight' => 10
        ];

        // 5. Odak kelime H2/H3 başlıklarında kullanılmış mı?
        $checks['focus_in_headings'] = [
            'label' => 'Odak kelime alt başlıklarda (H2/H3)',
            'status' => $this->checkInHeadings($content, $focusKeyword),
            'weight' => 10
        ];

        // 6. İçerik Uzunluğu
        $wordCount = str_word_count($plainContent);
        $checks['content_length'] = [
            'label' => "İçerik uzunluğu ({$wordCount} kelime)",
            'status' => $wordCount >= 300,
            'weight' => 10,
            'info' => $wordCount < 300 ? 'En az 300 kelime önerilir' : 'İdeal uzunluk'
        ];

        // 7. SEO Başlık Uzunluğu
        $titleLength = mb_strlen($seoTitle);
        $checks['title_length'] = [
            'label' => "SEO Başlık uzunluğu ({$titleLength} karakter)",
            'status' => $titleLength >= 40 && $titleLength <= 60,
            'weight' => 10,
            'info' => $this->getTitleLengthFeedback($titleLength)
        ];

        // 8. Meta Açıklama Uzunluğu
        $descLength = mb_strlen($metaDescription);
        $checks['meta_length'] = [
            'label' => "Meta açıklama uzunluğu ({$descLength} karakter)",
            'status' => $descLength >= 120 && $descLength <= 160,
            'weight' => 10,
            'info' => $this->getDescriptionLengthFeedback($descLength)
        ];

        // 9. Görsellerde Alt Text var mı?
        $checks['has_alt_text'] = [
            'label' => 'Öne çıkan görselde Alt metni',
            'status' => !empty($featuredImageAlt),
            'weight' => 5
        ];

        // 10. İçeride linkler
        $hasInternalLinks = $this->hasInternalLinks($content);
        $hasExternalLinks = $this->hasExternalLinks($content);

        $checks['internal_links'] = [
            'label' => 'İç linkler',
            'status' => $hasInternalLinks,
            'weight' => 5
        ];

        $checks['external_links'] = [
            'label' => 'Dış linkler',
            'status' => $hasExternalLinks,
            'weight' => 5
        ];

        // Skor hesaplama
        foreach ($checks as $check) {
            if ($check['status']) {
                $score += $check['weight'];
            }
        }

        $percentage = round(($score / $maxScore) * 100);

        return response()->json([
            'score' => $score,
            'max_score' => $maxScore,
            'percentage' => $percentage,
            'checks' => $checks,
            'rating' => $this->getRating($percentage)
        ]);
    }

    /**
     * Google SERP Önizlemesi
     */
    public function serpPreview(Request $request)
    {
        $title = $request->input('seo_title') ?: $request->input('title');
        $description = $request->input('meta_description');
        $slug = $request->input('slug', 'ornek-yazi');

        $url = config('app.url') . '/blog/' . $slug;

        // Başlık uzunluğu kontrolü
        $titlePixels = $this->estimatePixelWidth($title);
        $titleTruncated = $titlePixels > 600;

        // Açıklama uzunluğu kontrolü
        $descPixels = $this->estimatePixelWidth($description);
        $descTruncated = $descPixels > 920;

        return response()->json([
            'title' => $title,
            'title_truncated' => $titleTruncated,
            'title_display' => $titleTruncated ? Str::limit($title, 60) : $title,
            'description' => $description,
            'description_truncated' => $descTruncated,
            'description_display' => $descTruncated ? Str::limit($description, 155) : $description,
            'url' => $url,
            'url_display' => SeoAnalysisController . phpparse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH),
        ]);
    }

    // Helper metodlar
    private function containsKeyword(?string $text, string $keyword): bool
    {
        if (empty($text) || empty($keyword)) return false;
        return mb_stripos($text, $keyword) !== false;
    }

    private function checkInHeadings(string $content, string $keyword): bool
    {
        preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/is', $content, $matches);
        if (empty($matches[1])) return false;

        foreach ($matches[1] as $heading) {
            if ($this->containsKeyword(strip_tags($heading), $keyword)) {
                return true;
            }
        }
        return false;
    }

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

    private function getTitleLengthFeedback(int $length): string
    {
        if ($length < 40) return 'Çok kısa - En az 40 karakter önerilir';
        if ($length > 60) return 'Çok uzun - Google aramada kesilebilir';
        return 'İdeal uzunluk';
    }

    private function getDescriptionLengthFeedback(int $length): string
    {
        if ($length === 0) return 'Meta açıklama boş';
        if ($length < 120) return 'Çok kısa - En az 120 karakter önerilir';
        if ($length > 160) return 'Çok uzun - Google aramada kesilebilir';
        return 'İdeal uzunluk';
    }

    private function estimatePixelWidth(string $text): int
    {
        return mb_strlen($text) * 10;
    }

    private function getRating(int $percentage): array
    {
        if ($percentage >= 80) {
            return ['label' => 'Mükemmel', 'color' => 'success', 'icon' => '🟢'];
        } elseif ($percentage >= 60) {
            return ['label' => 'İyi', 'color' => 'info', 'icon' => '🔵'];
        } elseif ($percentage >= 40) {
            return ['label' => 'Orta', 'color' => 'warning', 'icon' => '🟡'];
        }
        return ['label' => 'Zayıf', 'color' => 'danger', 'icon' => '🔴'];
    }
}