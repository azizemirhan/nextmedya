<?php

namespace App\PageBuilder;

use App\Models\PageSection;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class LatestPostsHandler implements DataHandlerInterface
{
    public function handle(PageSection $section): object
    {
        try {
            // Ayarları al
            $content = $section->content;
            $postsCount = $content['posts_count'] ?? 6;
            $filterType = $content['filter_by_category'] ?? 'all';
            $selectedCategories = $content['selected_categories'] ?? '';

            // Sorgu başlat
            $query = Post::with(['category', 'author', 'tags'])
                ->where('status', 'published')
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc');

            // Kategori filtresi
            if ($filterType === 'specific' && !empty($selectedCategories)) {
                $categoryIds = array_map('intval', array_filter(explode(',', $selectedCategories)));

                if (!empty($categoryIds)) {
                    $query->whereIn('category_id', $categoryIds);
                }
            }

            // Postları al
            $posts = $query->take((int)$postsCount)->get();

            // Okuma süresini hesapla
            $posts->each(function ($post) {
                $wordCount = str_word_count(strip_tags($post->content ?? ''));
                $post->reading_time = max(1, ceil($wordCount / 200));
            });

            return $posts;

        } catch (\Exception $e) {
            Log::error('LatestPostsHandler Error: ' . $e->getMessage());
            return collect();
        }
    }
}