<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\CacheService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected CacheService $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Blog yazılarını listeler. Kategori, etiket ve arama filtrelerini de yönetir.
     */
    public function index(Request $request, Category $category = null, Tag $tag = null)
    {
        // Ana sorguyu başlat: Sadece 'published' durumundaki ve yayınlanma tarihi geçmiş yazıları al.
        // N+1 problemini önlemek için ilişkileri (kategori, yazar, etiketler) eager load yap.
        // Sadece gerekli kolonları çek
        $postsQuery = Post::with(['category:id,name,slug', 'author:id,name', 'tags:id,name,slug'])
            ->select(['id', 'title', 'slug', 'excerpt', 'featured_image', 'featured_image_alt_text', 'user_id', 'category_id', 'published_at', 'status'])
            ->published();

        $pageTitle = 'Blog'; // Varsayılan sayfa başlığı

        // Kategoriye göre filtreleme
        if ($category?->exists) {
            $postsQuery->where('category_id', $category->id);
            $pageTitle = "Kategori: " . $category->name;
        }

        // Etikete göre filtreleme
        if ($tag?->exists) {
            $postsQuery->whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            });
            $pageTitle = "Etiket: " . $tag->name;
        }

        // Arama terimine göre filtreleme
        if ($request->filled('q')) {
            $postsQuery->where('title', 'like', '%' . $request->q . '%');
            $pageTitle = "Arama Sonuçları: '" . $request->q . "'";
        }

        // Sorguyu çalıştır ve sonuçları sayfala
        $posts = $postsQuery->latest('published_at')->paginate(9);

        // --- KENAR ÇUBUĞU (SIDEBAR) İÇİN VERİLER - CACHE'Lİ ---
        $sidebarData = $this->getSidebarData();

        return view('frontend.blog.index', array_merge([
            'posts' => $posts,
            'pageTitle' => $pageTitle,
        ], $sidebarData));
    }

    /**
     * Tek bir blog yazısını gösterir.
     */
    public function show(Post $post)
    {
        // Yazının yayınlanmış olduğundan emin ol
        if ($post->status !== 'published' || $post->published_at > now()) {
            abort(404);
        }

        // İlişkileri eager load et
        $post->load(['category:id,name,slug', 'author:id,name', 'tags:id,name,slug']);

        $pageTitle = $post->title;

        // Sonraki ve önceki yazıları bul (sadece gerekli alanları çek)
        $previousPost = Post::published()
            ->select(['id', 'title', 'slug', 'featured_image'])
            ->where('published_at', '<', $post->published_at)
            ->latest('published_at')
            ->first();

        $nextPost = Post::published()
            ->select(['id', 'title', 'slug', 'featured_image'])
            ->where('published_at', '>', $post->published_at)
            ->oldest('published_at')
            ->first();

        // --- KENAR ÇUBUĞU (SIDEBAR) İÇİN VERİLER - CACHE'Lİ ---
        $sidebarData = $this->getSidebarData($post->id);

        return view('frontend.blog.show', array_merge([
            'post' => $post,
            'pageTitle' => $pageTitle,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost,
        ], $sidebarData));
    }

    /**
     * Sidebar verilerini cache'den al veya oluştur
     */
    protected function getSidebarData(?int $excludePostId = null): array
    {
        // Categories - 1 saat cache
        $categories = $this->cacheService->getSidebar('categories', function () {
            return Category::where('is_active', true)
                ->withCount('posts')
                ->orderBy('name')
                ->get();
        });

        // Tags - 1 saat cache
        $tags = $this->cacheService->getSidebar('tags', function () {
            return Tag::withCount('posts')
                ->having('posts_count', '>', 0)
                ->orderByDesc('posts_count')
                ->take(20)
                ->get();
        });

        // Recent Posts - 1 saat cache
        // Post detay sayfasında mevcut postu hariç tutma ihtiyacı var
        // Bu durumda cache'i biraz farklı yönetmeliyiz
        $recentPosts = $this->cacheService->getSidebar('recent_posts', function () {
            return Post::published()
                ->select(['id', 'title', 'slug', 'featured_image', 'published_at'])
                ->latest('published_at')
                ->take(6) // 1 fazla çek, hariç tutma durumu için
                ->get();
        });

        // Eğer bir post hariç tutulacaksa, filtreleme yap
        if ($excludePostId) {
            $recentPosts = $recentPosts->filter(fn($p) => $p->id !== $excludePostId)->take(5);
        } else {
            $recentPosts = $recentPosts->take(5);
        }

        return [
            'categories' => $categories,
            'tags' => $tags,
            'recentPosts' => $recentPosts,
        ];
    }
}
