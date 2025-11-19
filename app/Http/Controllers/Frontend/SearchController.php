<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Post;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Gelişmiş arama - Google benzeri sonuçlar
     */
    public function search(Request $request)
    {
        $query = $request->input('s', '');
        $locale = app()->getLocale();

        // Boş arama kontrolü
        if (empty(trim($query))) {
            return view('frontend.search.index', [
                'query' => '',
                'results' => collect(),
                'totalResults' => 0,
                'executionTime' => 0
            ]);
        }

        $startTime = microtime(true);

        // Tüm sonuçları topla
        $results = collect();

        // 1. PAGES ARAMA
        $pages = $this->searchPages($query, $locale);
        $results = $results->concat($pages);

        // 2. PAGE SECTIONS ARAMA
        $pageSections = $this->searchPageSections($query, $locale);
        $results = $results->concat($pageSections);

        // 3. SERVICES ARAMA (YENİ!)
        $services = $this->searchServices($query, $locale);
        $results = $results->concat($services);

        // 4. POSTS ARAMA
        $posts = $this->searchPosts($query, $locale);
        $results = $results->concat($posts);

        // 5. CATEGORIES ARAMA
        $categories = $this->searchCategories($query, $locale);
        $results = $results->concat($categories);

        // Sonuçları relevance'a göre sırala
        $results = $results->sortByDesc('relevance')->values();

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $totalResults = $results->count();

        return view('frontend.search.index', [
            'query' => $query,
            'results' => $results,
            'totalResults' => $totalResults,
            'executionTime' => $executionTime
        ]);
    }

    /**
     * Pages içinde arama
     */
    protected function searchPages($query, $locale)
    {
        $searchTerm = strtolower($query);

        return Page::where('status', 'published')
            ->get()
            ->filter(function ($page) use ($searchTerm, $locale) {
                $title = strtolower($page->getTranslation('title', $locale, false) ?? '');
                $seoTitle = strtolower($page->getTranslation('seo_title', $locale, false) ?? '');
                $metaDescription = strtolower($page->getTranslation('meta_description', $locale, false) ?? '');
                $keywords = strtolower($page->getTranslation('keywords', $locale, false) ?? '');

                return Str::contains($title, $searchTerm) ||
                    Str::contains($seoTitle, $searchTerm) ||
                    Str::contains($metaDescription, $searchTerm) ||
                    Str::contains($keywords, $searchTerm);
            })
            ->map(function ($page) use ($query, $locale, $searchTerm) {
                $title = $page->getTranslation('title', $locale, false) ?? '';
                $description = $page->getTranslation('meta_description', $locale, false) ?? '';

                return [
                    'type' => 'page',
                    'type_label' => 'Sayfa',
                    'title' => $title,
                    'description' => $this->generateSnippet($description, $searchTerm),
                    'url' => route('frontend.page.show', $page->slug),
                    'relevance' => $this->calculateRelevance($page, $searchTerm, $locale),
                    'breadcrumb' => 'Ana Sayfa / ' . $title,
                    'icon' => 'fas fa-file-alt',
                    'date' => $page->updated_at->format('d.m.Y'),
                ];
            });
    }

    /**
     * Page Sections içinde arama
     */
    protected function searchPageSections($query, $locale)
    {
        $searchTerm = strtolower($query);

        return PageSection::where('is_active', true)
            ->with('page')
            ->get()
            ->filter(function ($section) use ($searchTerm, $locale) {
                if (!$section->page || $section->page->status !== 'published') {
                    return false;
                }

                $content = $section->content ?? [];
                $searchableText = $this->extractTextFromContent($content, $locale);

                return Str::contains(strtolower($searchableText), $searchTerm);
            })
            ->map(function ($section) use ($query, $locale, $searchTerm) {
                $page = $section->page;
                $content = $section->content ?? [];
                $searchableText = $this->extractTextFromContent($content, $locale);

                return [
                    'type' => 'section',
                    'type_label' => 'Sayfa İçeriği',
                    'title' => $page->getTranslation('title', $locale, false) ?? '',
                    'description' => $this->generateSnippet($searchableText, $searchTerm),
                    'url' => route('frontend.page.show', $page->slug) . '#' . $section->section_key,
                    'relevance' => $this->calculateSectionRelevance($searchableText, $searchTerm),
                    'breadcrumb' => 'Ana Sayfa / ' . ($page->getTranslation('title', $locale, false) ?? ''),
                    'icon' => 'fas fa-paragraph',
                    'date' => $section->updated_at->format('d.m.Y'),
                ];
            });
    }

    /**
     * Services içinde arama (YENİ!)
     */
    protected function searchServices($query, $locale)
    {
        $searchTerm = strtolower($query);

        return Service::where('is_active', true)
            ->get()
            ->filter(function ($service) use ($searchTerm, $locale) {
                $title = strtolower($service->getTranslation('title', $locale, false) ?? '');
                $summary = strtolower($service->getTranslation('summary', $locale, false) ?? '');
                $content = strtolower(strip_tags($service->getTranslation('content', $locale, false) ?? ''));
                $expectationsContent = strtolower(strip_tags($service->getTranslation('expectations_content', $locale, false) ?? ''));

                // Benefits, support_items ve faqs içinde de ara
                $benefits = $service->getTranslation('benefits', $locale, false) ?? [];
                $supportItems = $service->getTranslation('support_items', $locale, false) ?? [];
                $faqs = $service->getTranslation('faqs', $locale, false) ?? [];

                $benefitsText = $this->extractTextFromArray($benefits, $locale);
                $supportText = $this->extractTextFromArray($supportItems, $locale);
                $faqsText = $this->extractTextFromArray($faqs, $locale);

                return Str::contains($title, $searchTerm) ||
                    Str::contains($summary, $searchTerm) ||
                    Str::contains($content, $searchTerm) ||
                    Str::contains($expectationsContent, $searchTerm) ||
                    Str::contains(strtolower($benefitsText), $searchTerm) ||
                    Str::contains(strtolower($supportText), $searchTerm) ||
                    Str::contains(strtolower($faqsText), $searchTerm);
            })
            ->map(function ($service) use ($query, $locale, $searchTerm) {
                $title = $service->getTranslation('title', $locale, false) ?? '';
                $summary = $service->getTranslation('summary', $locale, false) ?? '';
                $content = strip_tags($service->getTranslation('content', $locale, false) ?? '');

                $description = !empty($summary) ? $summary : $content;

                return [
                    'type' => 'service',
                    'type_label' => 'Hizmet',
                    'title' => $title,
                    'description' => $this->generateSnippet($description, $searchTerm),
                    'url' => route('frontend.services.show', $service->slug), // hizmetlerimiz/{slug} rotası
                    'relevance' => $this->calculateServiceRelevance($service, $searchTerm, $locale),
                    'breadcrumb' => 'Ana Sayfa / Hizmetlerimiz / ' . $title,
                    'icon' => 'fas fa-cogs',
                    'date' => $service->updated_at->format('d.m.Y'),
                    'image' => $service->cover_image,
                ];
            });
    }

    /**
     * Posts içinde arama
     */
    protected function searchPosts($query, $locale)
    {
        $searchTerm = strtolower($query);

        return Post::published()
            ->with('category')
            ->get()
            ->filter(function ($post) use ($searchTerm, $locale) {
                $title = strtolower($post->getTranslation('title', $locale, false) ?? '');
                $content = strtolower($post->getTranslation('content', $locale, false) ?? '');
                $excerpt = strtolower($post->getTranslation('excerpt', $locale, false) ?? '');

                return Str::contains($title, $searchTerm) ||
                    Str::contains($content, $searchTerm) ||
                    Str::contains($excerpt, $searchTerm);
            })
            ->map(function ($post) use ($query, $locale, $searchTerm) {
                $title = $post->getTranslation('title', $locale, false) ?? '';
                $excerpt = $post->getTranslation('excerpt', $locale, false) ?? '';
                $content = $post->getTranslation('content', $locale, false) ?? '';

                $description = !empty($excerpt) ? $excerpt : strip_tags($content);

                return [
                    'type' => 'post',
                    'type_label' => 'Blog Yazısı',
                    'title' => $title,
                    'description' => $this->generateSnippet($description, $searchTerm),
                    'url' => route('blog.show', $post->slug),
                    'relevance' => $this->calculatePostRelevance($post, $searchTerm, $locale),
                    'breadcrumb' => 'Blog / ' . ($post->category ? $post->category->getTranslation('name', $locale, false) : 'Genel'),
                    'icon' => 'fas fa-newspaper',
                    'date' => $post->published_at ? $post->published_at->format('d.m.Y') : $post->created_at->format('d.m.Y'),
                    'image' => $post->featured_image,
                ];
            });
    }

    /**
     * Categories içinde arama
     */
    protected function searchCategories($query, $locale)
    {
        $searchTerm = strtolower($query);

        return Category::active()
            ->get()
            ->filter(function ($category) use ($searchTerm, $locale) {
                $name = strtolower($category->getTranslation('name', $locale, false) ?? '');
                $description = strtolower($category->getTranslation('description', $locale, false) ?? '');

                return Str::contains($name, $searchTerm) ||
                    Str::contains($description, $searchTerm);
            })
            ->map(function ($category) use ($query, $locale, $searchTerm) {
                $name = $category->getTranslation('name', $locale, false) ?? '';
                $description = $category->getTranslation('description', $locale, false) ?? '';

                return [
                    'type' => 'category',
                    'type_label' => 'Kategori',
                    'title' => $name,
                    'description' => $this->generateSnippet($description, $searchTerm),
                    'url' => route('blog.category', $category->slug),
                    'relevance' => $this->calculateCategoryRelevance($category, $searchTerm, $locale),
                    'breadcrumb' => 'Blog / Kategoriler',
                    'icon' => 'fas fa-folder',
                    'date' => $category->updated_at->format('d.m.Y'),
                ];
            });
    }

    /**
     * PageSection content'inden text çıkar
     */
    protected function extractTextFromContent($content, $locale)
    {
        $text = '';

        if (!is_array($content)) {
            return $text;
        }

        foreach ($content as $key => $value) {
            if (is_array($value)) {
                // Çok dilli alan mı kontrol et
                if (isset($value[$locale])) {
                    $text .= ' ' . strip_tags($value[$locale]);
                } else {
                    // Repeater veya nested content
                    $text .= ' ' . $this->extractTextFromContent($value, $locale);
                }
            } else {
                $text .= ' ' . strip_tags($value);
            }
        }

        return trim($text);
    }

    /**
     * Array'den text çıkar (benefits, support_items, faqs için)
     */
    protected function extractTextFromArray($array, $locale)
    {
        $text = '';

        if (!is_array($array)) {
            return $text;
        }

        foreach ($array as $item) {
            if (is_array($item)) {
                foreach ($item as $key => $value) {
                    if (is_array($value)) {
                        // Çok dilli alan
                        if (isset($value[$locale])) {
                            $text .= ' ' . strip_tags($value[$locale]);
                        }
                    } else {
                        $text .= ' ' . strip_tags($value);
                    }
                }
            }
        }

        return trim($text);
    }

    /**
     * Snippet oluştur - arama kelimesi etrafındaki metni göster
     */
    protected function generateSnippet($text, $searchTerm, $length = 200)
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text); // Çoklu boşlukları temizle

        if (strlen($text) <= $length) {
            return $this->highlightSearchTerm($text, $searchTerm);
        }

        // Arama kelimesinin konumunu bul
        $pos = stripos($text, $searchTerm);

        if ($pos === false) {
            // Bulunamadıysa baştan al
            $snippet = Str::limit($text, $length);
        } else {
            // Arama kelimesi etrafındaki metni al
            $start = max(0, $pos - intval($length / 2));
            $snippet = substr($text, $start, $length);

            // Başta veya sonda kesik kelime varsa düzelt
            if ($start > 0) {
                $snippet = '...' . ltrim($snippet);
            }

            if (strlen($text) > $start + $length) {
                $snippet = rtrim($snippet) . '...';
            }
        }

        return $this->highlightSearchTerm($snippet, $searchTerm);
    }

    /**
     * Arama kelimesini vurgula
     */
    protected function highlightSearchTerm($text, $searchTerm)
    {
        if (empty($searchTerm)) {
            return $text;
        }

        $pattern = '/(' . preg_quote($searchTerm, '/') . ')/iu';
        return preg_replace($pattern, '<mark>$1</mark>', $text);
    }

    /**
     * Page relevance hesapla
     */
    protected function calculateRelevance($page, $searchTerm, $locale)
    {
        $relevance = 0;
        $searchTerm = strtolower($searchTerm);

        $title = strtolower($page->getTranslation('title', $locale, false) ?? '');
        $seoTitle = strtolower($page->getTranslation('seo_title', $locale, false) ?? '');
        $metaDescription = strtolower($page->getTranslation('meta_description', $locale, false) ?? '');

        // Title'da tam eşleşme
        if ($title === $searchTerm) $relevance += 100;
        elseif (Str::contains($title, $searchTerm)) $relevance += 50;

        // Title başlangıcında eşleşme
        if (Str::startsWith($title, $searchTerm)) $relevance += 30;

        // SEO Title'da eşleşme
        if (Str::contains($seoTitle, $searchTerm)) $relevance += 20;

        // Meta description'da eşleşme
        if (Str::contains($metaDescription, $searchTerm)) $relevance += 10;

        // Kelime sayısına göre bonus
        $wordCount = substr_count(strtolower($title . ' ' . $metaDescription), $searchTerm);
        $relevance += $wordCount * 5;

        return $relevance;
    }

    /**
     * Section relevance hesapla
     */
    protected function calculateSectionRelevance($text, $searchTerm)
    {
        $relevance = 0;
        $searchTerm = strtolower($searchTerm);
        $text = strtolower($text);

        // Kelime sayısı
        $wordCount = substr_count($text, $searchTerm);
        $relevance += $wordCount * 10;

        // Başlangıçta mı?
        if (Str::startsWith($text, $searchTerm)) $relevance += 20;

        return $relevance;
    }

    /**
     * Service relevance hesapla (YENİ!)
     */
    protected function calculateServiceRelevance($service, $searchTerm, $locale)
    {
        $relevance = 0;
        $searchTerm = strtolower($searchTerm);

        $title = strtolower($service->getTranslation('title', $locale, false) ?? '');
        $summary = strtolower($service->getTranslation('summary', $locale, false) ?? '');
        $content = strtolower(strip_tags($service->getTranslation('content', $locale, false) ?? ''));

        // Title'da tam eşleşme
        if ($title === $searchTerm) $relevance += 100;
        elseif (Str::contains($title, $searchTerm)) $relevance += 60;

        // Title başlangıcında eşleşme
        if (Str::startsWith($title, $searchTerm)) $relevance += 40;

        // Summary'de eşleşme
        if (Str::contains($summary, $searchTerm)) $relevance += 30;

        // Content'te eşleşme
        if (Str::contains($content, $searchTerm)) $relevance += 20;

        // Aktif mi? (Aktif hizmetler daha üstte)
        if ($service->is_active) $relevance += 10;

        // Kelime sayısına göre bonus
        $wordCount = substr_count($title . ' ' . $summary . ' ' . $content, $searchTerm);
        $relevance += $wordCount * 5;

        return $relevance;
    }

    /**
     * Post relevance hesapla
     */
    protected function calculatePostRelevance($post, $searchTerm, $locale)
    {
        $relevance = 0;
        $searchTerm = strtolower($searchTerm);

        $title = strtolower($post->getTranslation('title', $locale, false) ?? '');
        $excerpt = strtolower($post->getTranslation('excerpt', $locale, false) ?? '');

        // Title'da tam eşleşme
        if ($title === $searchTerm) $relevance += 100;
        elseif (Str::contains($title, $searchTerm)) $relevance += 60;

        // Title başlangıcında eşleşme
        if (Str::startsWith($title, $searchTerm)) $relevance += 40;

        // Excerpt'te eşleşme
        if (Str::contains($excerpt, $searchTerm)) $relevance += 20;

        // Yayın tarihi - yeni içerikler öncelikli
        if ($post->published_at) {
            $daysSincePublished = now()->diffInDays($post->published_at);
            if ($daysSincePublished < 30) $relevance += 15;
            elseif ($daysSincePublished < 90) $relevance += 10;
            elseif ($daysSincePublished < 180) $relevance += 5;
        }

        return $relevance;
    }

    /**
     * Category relevance hesapla
     */
    protected function calculateCategoryRelevance($category, $searchTerm, $locale)
    {
        $relevance = 0;
        $searchTerm = strtolower($searchTerm);

        $name = strtolower($category->getTranslation('name', $locale, false) ?? '');
        $description = strtolower($category->getTranslation('description', $locale, false) ?? '');

        // Name'de tam eşleşme
        if ($name === $searchTerm) $relevance += 100;
        elseif (Str::contains($name, $searchTerm)) $relevance += 70;

        // Name başlangıcında eşleşme
        if (Str::startsWith($name, $searchTerm)) $relevance += 40;

        // Description'da eşleşme
        if (Str::contains($description, $searchTerm)) $relevance += 15;

        return $relevance;
    }
}