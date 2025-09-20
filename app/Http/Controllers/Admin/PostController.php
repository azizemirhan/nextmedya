<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Str;

class PostController extends Controller
{
    // app/Http/Controllers/Admin/PostController.php
    use ImageUploadTrait;

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $tags = Tag::all();
        $users = User::all();

        $defaultSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => 'YAZI BAŞLIĞI BURAYA GELECEK',
            'author' => ['@type' => 'Person', 'name' => auth()->guard('admin')->user()->name],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Site Adınız',
                'logo' => ['@type' => 'ImageObject', 'url' => url('/logo.png')],
            ],
            'datePublished' => now()->format('Y-m-d'),
            'dateModified' => now()->format('Y-m-d'),
        ];


        return view('admin.posts.create', compact('categories', 'tags', 'users', 'defaultSchema'));
    }

    public function edit(Post $post)
    {
        $categories = Category::where('is_active', true)->get();
        $tags = Tag::all();
        $users = User::all();

        $defaultSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->seo_title ?? $post->title,
            'author' => ['@type' => 'Person', 'name' => $post->user->name ?? auth()->guard('admin')->user()->name],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Site Adınız',
                'logo' => ['@type' => 'ImageObject', 'url' => url('/logo.png')],
            ],
            'datePublished' => $post->published_at ? $post->published_at->format('Y-m-d') : $post->created_at->format('Y-m-d'),
            'dateModified' => $post->updated_at->format('Y-m-d'),
        ];

        // Düzeltilmiş satır

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'users', 'defaultSchema'));
    }

    public function index(Request $request)
    {
        // Temel sorguyu başlatıyoruz
        $query = Post::with(['user', 'category'])->latest();

        // --- FİLTRELEME MANTIĞI ---
        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
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

        $posts = $query->paginate(15)->withQueryString(); // withQueryString filtrelerin paginasyonda korunmasını sağlar

        // Filtre formunda kullanılacak veriler
        $categories = Category::where('is_active', true)->get();
        $authors = User::all(); // Veya sadece yazar rolüne sahip olanlar

        return view('admin.posts.index', compact('posts', 'categories', 'authors'));
    }

    /**
     * Yeni yazıyı veritabanına kaydeder.
     * (Bu metodu bir sonraki adımda dolduracağız)
     */
    public function store(Request $request)
    {
        // 1. Gelen tüm veriyi doğrula
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:posts',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft,scheduled',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'featured_image_alt_text' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'index_status' => 'required|in:index,noindex',
            'follow_status' => 'required|in:follow,nofollow',
            'schema_type' => 'required|in:auto,manual,none',
            'manual_schema_json' => 'nullable|json|required_if:schema_type,manual',
        ]);

        // 2. Slug, yazar ve resim yolu gibi ek verileri hazırla
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['user_id'] = auth()->guard('admin')->id();
        $validatedData['featured_image'] = $this->uploadImage($request, 'featured_image', 'tum-yuklemeler/posts/featured');

        // 3. Yazıyı oluştur
        $post = Post::create($validatedData);

        // 4. Etiketleri işle ve yazıya bağla (senkronize et)
        if ($request->has('tags')) {
            $this->syncTags($request, $post);
        }

        // 5. Başarılı mesajıyla yönlendir
        return redirect()->route('admin.posts.index')->with('success', 'Yazı başarıyla oluşturuldu.');
    }

    private function syncTags(Request $request, Post $post)
    {
        // Tagify'dan gelen JSON string'ini bir diziye çevir
        $tagsInput = json_decode($request->input('tags'), true);

        if (is_null($tagsInput)) {
            // Hiç etiket girilmediyse veya format bozuksa, mevcut tüm etiketleri kaldır.
            $post->tags()->sync([]);

            return;
        }

        // Sadece 'value' anahtarındaki değerleri (etiket isimlerini) al
        $tagNames = collect($tagsInput)->pluck('value')->all();

        $tagIds = [];
        foreach ($tagNames as $tagName) {
            // Her bir etiket için, ya veritabanında bul ya da yenisini oluştur.
            $tag = Tag::firstOrCreate(
                ['name' => $tagName],
                ['slug' => Str::slug($tagName)]
            );
            $tagIds[] = $tag->id;
        }

        // Yazının etiketlerini bu diziyle senkronize et.
        // sync() metodu, listede olmayanları kaldırır, yenileri ekler.
        $post->tags()->sync($tagIds);
    }

    /**
     * Belirtilen yazıyı günceller.
     * (Bu metodu bir sonraki adımda dolduracağız)
     */
    public function update(Request $request, Post $post)
    {
        // 1. Gelen tüm veriyi doğrula
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('posts')->ignore($post->id)],
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:published,draft,scheduled',
            'published_at' => 'nullable|date',

            // --- DÜZELTİLMİŞ SATIR ---
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // --- DÜZELTME SONU ---

            'featured_image_alt_text' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'index_status' => 'required|in:index,noindex',
            'follow_status' => 'required|in:follow,nofollow',
            'schema_type' => 'required|in:auto,manual,none',
            'manual_schema_json' => 'nullable|json|required_if:schema_type,manual',
        ]);

        // 2. Slug'ı güncelle ve diğer verileri al
        $validatedData['slug'] = Str::slug($validatedData['title']);

        // 3. Trait'i kullanarak resmi güncelle (Bu kısım zaten doğruydu)
        $validatedData['featured_image'] = $this->uploadImage($request, 'featured_image', 'tum-yuklemeler/posts', $post->featured_image);

        // 4. Yazıyı güncelle
        $post->update($validatedData);

        // 5. Etiketleri senkronize et
        if ($request->has('tags')) {
            $this->syncTags($request, $post);
        }

        // 6. Başarılı mesajıyla yönlendir
        return redirect()->route('admin.posts.index')->with('success', 'Yazı başarıyla güncellendi.');
    }

    /**
     * Belirtilen yazıyı soft delete ile siler (çöpe taşır).
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Yazı başarıyla çöpe taşındı.');
    }

    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120',
        ]);

        $file = $request->file('file');
        $directory = 'uploads/editor'; // Public klasörü altındaki hedef

        // Benzersiz bir dosya adı oluştur
        $fileName = 'post_content_'.time().'_'.$file->getClientOriginalName();

        // Dosyayı public klasörüne taşı
        $file->move(public_path($directory), $fileName);

        // Quill'e tam URL olarak geri döndür
        $url = asset($directory.'/'.$fileName);

        return response()->json(['location' => $url]);
    }

    public function trash(Request $request)
    {
        // Sadece çöpteki yazıları listele
        $posts = Post::onlyTrashed()->with(['user', 'category'])->latest()->paginate(15);

        return view('admin.posts.trash', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('admin.posts.trash')->with('success', 'Yazı başarıyla geri yüklendi.');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        // İlgili resimleri de sil (Trait'i kullanıyorsak)
        // $this->deleteImage($post->featured_image_path);
        $post->forceDelete();

        return redirect()->route('admin.posts.trash')->with('success', 'Yazı kalıcı olarak silindi.');
    }

    public function bulkAction(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');

        if (! $ids || ! $action) {
            return redirect()->back()->with('error', 'İşlem veya kayıt seçilmedi.');
        }

        switch ($action) {
            case 'delete':
                // --- DÜZELTME BAŞLANGICI ---
                // Önce silinecek post'ları bir koleksiyon olarak alıyoruz.
                $posts = Post::whereIn('id', $ids)->get();

                // Her bir post'u döngüde tek tek siliyoruz.
                // Bu, SoftDeletes dahil tüm model olaylarının tetiklenmesini sağlar.
                foreach ($posts as $post) {
                    $post->delete();
                }
                // --- DÜZELTME SONU ---

                return redirect()->route('admin.posts.index')->with('success', 'Seçilen yazılar çöpe taşındı.');

            case 'restore':
                // Bu yöntem (toplu sorgu) restore işlemi için genellikle güvenlidir.
                Post::onlyTrashed()->whereIn('id', $ids)->restore();

                return redirect()->route('admin.posts.trash')->with('success', 'Seçilen yazılar geri yüklendi.');

            case 'force-delete':
                $posts = Post::onlyTrashed()->whereIn('id', $ids)->get();
                foreach ($posts as $post) {
                    // Resimleri de silmek için bu yöntem zaten doğruydu.
                    $this->deleteImage($post->featured_image_path);
                    $post->forceDelete();
                }

                return redirect()->route('admin.posts.trash')->with('success', 'Seçilen yazılar kalıcı olarak silindi.');
        }

        return redirect()->back()->with('error', 'Geçersiz işlem.');
    }
}
