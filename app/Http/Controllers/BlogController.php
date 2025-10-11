<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Blog yazılarını listeler. Kategori, etiket ve arama filtrelerini de yönetir.
     */
    public function index(Request $request, Category $category = null, Tag $tag = null)
    {
        // Ana sorguyu başlat: Sadece 'published' durumundaki ve yayınlanma tarihi geçmiş yazıları al.
        // N+1 problemini önlemek için ilişkileri (kategori, yazar, etiketler) eager load yap.
        $postsQuery = Post::with(['category', 'author', 'tags'])->published();

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

        // --- KENAR ÇUBUĞU (SIDEBAR) İÇİN VERİLER ---
        $categories = Category::where('is_active', true)->withCount('posts')->orderBy('name')->get();
        $tags = Tag::withCount('posts')->get()->sortByDesc('posts_count')->take(20);
        $recentPosts = Post::published()->latest('published_at')->take(5)->get();

        return view('frontend.blog.index', compact(
            'posts',
            'categories',
            'tags',
            'recentPosts',
            'pageTitle'
        ));
    }

    /**
     * Tek bir blog yazısını gösterir.
     */
    /**
     * Tek bir blog yazısını gösterir.
     */
    public function show(Post $post)
    {
        // Yazının yayınlanmış olduğundan emin ol
        if ($post->status !== 'published' || $post->published_at > now()) {
            abort(404);
        }

        $pageTitle = $post->title;

        // Sonraki ve önceki yazıları bul
        $previousPost = Post::published()->where('published_at', '<', $post->published_at)->latest('published_at')->first();
        $nextPost = Post::published()->where('published_at', '>', $post->published_at)->oldest('published_at')->first();

        // --- KENAR ÇUBUĞU (SIDEBAR) İÇİN VERİLER (YENİ EKLENDİ) ---
        $categories = Category::where('is_active', true)->withCount('posts')->orderBy('name')->get();
        $tags = Tag::withCount('posts')->get()->sortByDesc('posts_count')->take(20);
        $recentPosts = Post::published()->where('id', '!=', $post->id)->latest('published_at')->take(5)->get();

        return view('frontend.blog.show', compact(
            'post',
            'pageTitle',
            'previousPost',
            'nextPost',
            'categories',
            'tags',
            'recentPosts'
        ));
    }
}
