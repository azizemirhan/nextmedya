<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    use ImageUploadTrait;

    /**
     * Tüm yazıları listeler ve filtreleme yapar.
     */
    private function getActiveLanguages(): array
    {
        $activeLanguageCodes = setting('active_languages', ['tr', 'en']);
        if (!is_array($activeLanguageCodes)) {
            $activeLanguageCodes = json_decode($activeLanguageCodes, true) ?? ['tr', 'en'];
        }
        $supportedLanguages = config('languages.supported', []);
        return collect($supportedLanguages)
            ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
            ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes))
            ->toArray();
    }

    public function index(Request $request)
    {
        $query = Post::with(['author', 'category'])->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('author')) {
            $query->where('user_id', $request->author);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)->get();
        $authors = User::all();

        return view('admin.posts.index', compact('posts', 'categories', 'authors'));
    }

    /**
     * Yeni yazı oluşturma formunu gösterir.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $post = new Post(['status' => 'draft', 'published_at' => now()]);
        // Aktif dilleri alıp view'e gönderiyoruz.
        $activeLanguages = $this->getActiveLanguages();

        return view('admin.posts.create', compact('post', 'categories', 'activeLanguages'));
    }

    /**
     * Yeni bir yazıyı veritabanına kaydeder.
     */

    public function store(Request $request)
    {
        // 1. Veriyi doğrulamadan önce hazırla (slug oluşturma vb.)
        $this->prepareForValidation($request);
        // 2. Veriyi doğrula
        $validatedData = $this->validatePost($request);

        // 3. Etiketler hariç diğer veriyi al
        $postData = Arr::except($validatedData, ['tags']);
        // 4. Resim yükleme gibi ek işlemleri yap
        $this->handlePostData($postData, $request);
        // 5. Yazıyı oluştur
        $post = Post::create($postData);
        // 6. Etiketleri senkronize et
        $this->syncTags($request, $post);

        return redirect()->route('admin.posts.index')->with('success', 'Yazı başarıyla oluşturuldu.');
    }

    /**
     * Mevcut bir yazıyı düzenleme formunu gösterir.
     */
    public function edit(Post $post)
    {
        $categories = Category::where('is_active', true)->get();
        // Aktif dilleri alıp view'e gönderiyoruz.
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.posts.edit', compact('post', 'categories', 'activeLanguages'));
    }

    public function update(Request $request, Post $post)
    {
        $this->prepareForValidation($request);
        $validatedData = $this->validatePost($request, $post);

        $this->syncTags($request, $post);
        $postData = Arr::except($validatedData, ['tags']);
        $this->handlePostData($postData, $request, $post);
        $post->update($postData);

        return redirect()->route('admin.posts.index')->with('success', 'Yazı başarıyla güncellendi.');
    }
    /**
     * Yazıyı çöpe taşır (Soft Delete).
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Yazı başarıyla çöpe taşındı.');
    }

    /**
     * Çöpteki yazıları listeler.
     */
    public function trash()
    {
        $posts = Post::onlyTrashed()->with(['author', 'category'])->latest()->paginate(15);
        return view('admin.posts.trash', compact('posts'));
    }

    /**
     * Çöpteki bir yazıyı geri yükler.
     */
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.trash')->with('success', 'Yazı başarıyla geri yüklendi.');
    }

    /**
     * Bir yazıyı kalıcı olarak siler.
     */
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $this->deleteImage($post->featured_image); // Yazıya ait öne çıkan görseli de sil
        $post->forceDelete();
        return redirect()->route('admin.posts.trash')->with('success', 'Yazı kalıcı olarak silindi.');
    }

    /**
     * Liste ve çöp kutusu sayfalarındaki toplu işlemleri yönetir.
     */
    public function bulkAction(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');

        if (empty($ids) || empty($action)) {
            return redirect()->back()->with('error', 'Lütfen işlem ve en az bir öğe seçin.');
        }

        switch ($action) {
            case 'delete':
                Post::whereIn('id', $ids)->get()->each->delete();
                return redirect()->route('admin.posts.index')->with('success', 'Seçilen yazılar çöpe taşındı.');
            case 'restore':
                Post::onlyTrashed()->whereIn('id', $ids)->restore();
                return redirect()->route('admin.posts.trash')->with('success', 'Seçilen yazılar geri yüklendi.');
            case 'force-delete':
                $posts = Post::onlyTrashed()->whereIn('id', $ids)->get();
                foreach ($posts as $post) {
                    $this->deleteImage($post->featured_image);
                    $post->forceDelete();
                }
                return redirect()->route('admin.posts.trash')->with('success', 'Seçilen yazılar kalıcı olarak silindi.');
        }
        return redirect()->back()->with('error', 'Geçersiz işlem.');
    }

    /**
     * Quill editöründen gelen resim yüklemelerini işler.
     */
    public function uploadEditorImage(Request $request)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048']);
        $path = $this->uploadImage($request, 'image', 'uploads/posts/editor');
        return response()->json(['location' => asset($path)]);
    }

    // ==========================================================
    // YARDIMCI METOTLAR
    // ==========================================================

    /**
     * store ve update için ortak veri işleme mantığı.
     */
    private function handlePostData(array &$validatedData, Request $request, ?Post $post = null): void
    {
        // Öne çıkan görseli yükle/güncelle
        if ($request->hasFile('featured_image')) {
            $validatedData['featured_image'] = $this->uploadImage($request, 'featured_image', 'uploads/posts/featured', $post->featured_image ?? null);
        }

        // Yazar ve son düzenleyen bilgilerini ata
        if (!$post) { // Sadece yeni yazı oluştururken
            $validatedData['user_id'] = auth('admin')->id();
        }
        $validatedData['last_modified_by'] = auth('admin')->id();
    }

    /**
     * Gelen etiketleri yazı ile senkronize eder.
     */
    private function syncTags(Request $request, Post $post): void
    {
        $tagNames = json_decode($request->input('tags', '[]'), true);
        if (empty($tagNames)) {
            $post->tags()->sync([]);
            return;
        }
        $tagNames = array_column($tagNames, 'value');

        $tagIds = [];
        foreach ($tagNames as $tagName) {
            // Çok dilli yapı için etiketin Türkçe adını varsayılan olarak kabul ediyoruz.
            // Eğer etiketler de tam çok dilli olacaksa bu mantık geliştirilebilir.
            $tag = Tag::firstOrCreate(
                ['name' => ['tr' => $tagName]],
                ['slug' => Str::slug($tagName)]
            );
            $tagIds[] = $tag->id;
        }
        $post->tags()->sync($tagIds);
    }

    /**
     * store ve update için ortak validasyon kuralları.
     */
    private function validatePost(Request $request, ?Post $post = null): array
    {
        $activeLanguages = $this->getActiveLanguages();
        $activeLanguageCodes = array_keys($activeLanguages);
        $defaultLocale = $activeLanguageCodes[0] ?? config('app.fallback_locale', 'tr');

        $rules = [
            'title' => 'required|array',
            "title.{$defaultLocale}" => 'required|string|max:255',
            'content' => 'required|array',
            "content.{$defaultLocale}" => 'required|string',
            // Slug için unique kuralını dinamik olarak ayarla
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts')->ignore($post)],
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft,scheduled',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'featured_image_alt_text' => 'nullable|array',
            'seo_title' => 'nullable|array',
            'meta_description' => 'nullable|array',
            'keywords' => 'nullable|array',
            'canonical_url' => 'nullable|url',
            'index_status' => 'required|in:index,noindex',
            'follow_status' => 'required|in:follow,nofollow',
            'tags' => 'nullable|string',
        ];

        foreach ($activeLanguageCodes as $code) {
            $rules['title.' . $code] = 'nullable|string|max:255';
            $rules['content.' . $code] = 'nullable|string';
            $rules['excerpt.' . $code] = 'nullable|string';
            $rules['featured_image_alt_text.' . $code] = 'nullable|string|max:255';
            $rules['seo_title.' . $code] = 'nullable|string|max:255';
            $rules['meta_description.' . $code] = 'nullable|string';
            $rules['keywords.' . $code] = 'nullable|string';
        }

        return $request->validate($rules);
    }
    protected function prepareForValidation(Request $request)
    {
        // Quill editöründen gelen boş içerikleri 'null' yap
        if ($request->has('content')) {
            $contentData = $request->input('content');
            foreach ($contentData as $locale => $content) {
                if (in_array($content, ['<p><br></p>', '<p></p>', '', null], true)) {
                    $contentData[$locale] = null;
                }
            }
            $request->merge(['content' => $contentData]);
        }

        // === YENİ EKLENEN KISIM ===
        // Eğer slug boş gönderildiyse, Türkçe başlığa göre otomatik oluştur.
        if (empty($request->input('slug')) && !empty($request->input('title')['tr'])) {
            $request->merge([
                'slug' => Str::slug($request->input('title')['tr'])
            ]);
        }
    }
}
