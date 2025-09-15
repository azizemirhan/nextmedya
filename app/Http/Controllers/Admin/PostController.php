<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        // Tüm kategorileri alıyoruz
        $categories = Category::all();

        return view('admin.blogs.create', compact('categories'));
    }

    // Store post
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Eğer resim yüklenmişse, kaydediyoruz
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        } else {
            $imagePath = null;
        }

        // Yeni postu kaydediyoruz
        Post::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'category_id' => $validated['category_id'],
            'body' => $validated['body'],
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.create')->with('success', 'Post başarıyla oluşturuldu!');
    }
}
