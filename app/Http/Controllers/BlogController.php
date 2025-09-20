<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with(['author', 'category', 'tags']);

        // Arama sorgusu
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Kategoriye göre filtreleme
        if ($categorySlug = $request->input('category')) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Etikete göre filtreleme
        if ($tagSlug = $request->input('tag')) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        $posts = Post::with('author')
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(5); // <-- EN ÖNEMLİ KISIM BURASI

        $featuredPosts = Post::published()->orderBy('published_at', 'desc')->take(5)->get();
        $categories = Category::active()->withCount('posts')->orderBy('name')->get();
        $recentPosts = Post::published()->orderBy('published_at', 'desc')->take(3)->get();
        $tags = Tag::has('posts')->orderBy('name')->get();
        $author = \App\Models\User::first(); // Örnek için ilk yazarı al, gerçekte dinamik olur

        return view('blog.index', compact(
            'posts', 'featuredPosts', 'categories', 'recentPosts', 'tags', 'author'
        ));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published' && !auth()->check()) {
            abort(404); // Yayınlanmamış yazıları sadece adminler görebilir
        }
        $categories = Category::active()->withCount('posts')->orderBy('name')->get();
        $recentPosts = Post::published()->orderBy('published_at', 'desc')->take(3)->get();
        $tags = Tag::has('posts')->orderBy('name')->get();

        return view('blog.show', compact('post', 'categories', 'recentPosts', 'tags'));
    }
}
