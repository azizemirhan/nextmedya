<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Kategori ekleme formu
    public function create()
    {
        return view('admin.blogs.category-create');  // categories.create blade dosyasını yükler
    }

    // Kategori veritabanına kaydetme
    public function store(Request $request)
    {
        // Form verilerini doğrulama
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug|max:255',
        ]);

        // Yeni kategori ekleme
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        // Başarılı bir şekilde kategori eklendikten sonra yönlendirme
        return redirect()->route('admin.blog.index')->with('success', 'Kategori başarıyla eklendi!');
    }
}
