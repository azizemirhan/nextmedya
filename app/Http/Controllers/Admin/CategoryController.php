<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    use ImageUploadTrait; // <-- 2. Trait'i kullan

    /**
     * Tüm kategorileri listeler.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Yeni kategori oluşturma formunu gösterir.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except(['logo', 'banner']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['show_in_sidebar'] = $request->has('show_in_sidebar');
        $data['show_in_menu'] = $request->has('show_in_menu');

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $this->uploadImage($request, 'logo', 'tum-yuklemeler/categories/logos');
        }
        if ($request->hasFile('banner')) {
            $data['banner_path'] = $this->uploadImage($request, 'banner', 'tum-yuklemeler/categories/banners');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori başarıyla oluşturuldu.');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except(['logo', 'banner']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['show_in_sidebar'] = $request->has('show_in_sidebar');
        $data['show_in_menu'] = $request->has('show_in_menu');

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('tum-yuklemeler/categories/logos', 'public');
        }
        if ($request->hasFile('banner')) {
            $data['banner_path'] = $this->uploadImage($request, 'banner', 'tum-yuklemeler/categories/banners', $category->banner_path);
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori başarıyla güncellendi.');
    }

    /**
     * Belirtilen kategoriyi siler.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori başarıyla silindi.');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(15);

        return view('admin.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.trash')->with('success', 'Kategori başarıyla geri yüklendi.');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        // 5. Trait metodunu kullanarak resimleri kalıcı sil
        $this->deleteImage($category->logo_path);
        $this->deleteImage($category->banner_path);
        $category->forceDelete();

        return redirect()->route('admin.categories.trash')->with('success', 'Kategori kalıcı olarak silindi.');
    }

    public function bulkAction(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');

        if (! $ids || ! $action) {
            return redirect()->back()->with('error', 'İşlem veya kategori seçilmedi.');
        }

        $categories = Category::whereIn('id', $ids)->get();
        $trashedCategories = Category::onlyTrashed()->whereIn('id', $ids)->get();

        switch ($action) {
            case 'delete':
                foreach ($categories as $category) {
                    $category->delete();
                }

                return redirect()->route('admin.categories.index')->with('success', 'Seçilen kategoriler silindi.');
            case 'restore':
                foreach ($trashedCategories as $category) {
                    $category->restore();
                }

                return redirect()->route('admin.categories.trash')->with('success', 'Seçilen kategoriler geri yüklendi.');
            case 'force-delete':
                foreach ($trashedCategories as $category) {
                    // 6. Toplu kalıcı silmede de Trait'i kullan
                    $this->deleteImage($category->logo_path);
                    $this->deleteImage($category->banner_path);
                    $category->forceDelete();
                }

                return redirect()->route('admin.categories.trash')->with('success', 'Seçilen kategoriler kalıcı olarak silindi.');
        }

        return redirect()->back()->with('error', 'Geçersiz işlem.');
    }

    public function updateStatus(Request $request)
    {
        // Gelen verinin doğruluğundan emin olalım
        $request->validate([
            'id' => 'required|integer|exists:categories,id',
            'is_active' => 'required|boolean',
        ]);

        try {
            $category = Category::findOrFail($request->id);
            $category->is_active = $request->is_active;
            $category->save();

            // Başarılı olursa bir JSON yanıtı döndür
            return response()->json(['success' => true, 'message' => 'Durum başarıyla güncellendi.']);

        } catch (\Exception $e) {
            // Hata olursa bir JSON hata yanıtı döndür
            return response()->json(['success' => false, 'message' => 'Bir hata oluştu.'], 500);
        }
    }
}
