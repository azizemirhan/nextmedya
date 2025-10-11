<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    use ImageUploadTrait;

    // Trait'i controller'a dahil ediyoruz

    /**
     * Tüm sayfaları listeler.
     */
    public function index()
    {
        $pages = Page::latest()->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Yeni sayfa oluşturma formunu gösterir.
     */
    public function create()
    {
        $page = new Page();
        // YENİ EKLENEN KISIM: Şablonları config dosyasından alıp view'e gönderiyoruz.
        $templates = config('page_templates', []);
        return view('admin.pages.create', compact('page', 'templates'));
    }


    /**
     * Yeni bir sayfayı veritabanına kaydeder.
     */
    public function store(Request $request)
    {
        // Gelen verileri doğrula
        $validatedData = $request->validate([
            'title' => 'required|array',
            'title.tr' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'banner_title' => 'nullable|array',      // YENİ EKLENDİ
            'banner_subtitle' => 'nullable|array',   // YENİ EKLENDİ
            'slug' => 'required|string|max:255|unique:pages,slug',
            'template' => 'nullable|string|in:' . implode(',', array_keys(config('page_templates', []))), // template'in geçerli olup olmadığını kontrol et
        ]);

        // Sayfayı oluştur
        $page = Page::create($request->only('title', 'slug', 'banner_title', 'banner_subtitle'));

        // YENİ EKLENEN KISIM: Eğer bir şablon seçildiyse, ilgili bölümleri oluştur.
        if ($request->filled('template')) {
            $templateKey = $request->input('template');
            $templateSections = config("page_templates.{$templateKey}.sections", []);

            foreach ($templateSections as $order => $sectionKey) {
                PageSection::create([
                    'page_id' => $page->id,
                    'section_key' => $sectionKey,
                    'order' => $order,
                    'is_active' => true,
                    'content' => [] // Başlangıçta içerik boş olacak
                ]);
            }
        }

        // Sayfa oluştuktan sonra düzenleme ekranına yönlendir.
        return redirect()->route('admin.pages.edit', $page)->with('success', 'Sayfa başarıyla oluşturuldu. Şimdi içeriğini düzenleyebilirsiniz.');
    }


    /**
     * Belirtilen sayfayı gösterir (Genellikle admin panelinde kullanılmaz).
     */
    public function show(Page $page)
    {
        // Ön yüze yönlendirmek daha mantıklı olabilir.
        return redirect()->route('frontend.page.show', $page->slug);
    }

    /**
     * Sayfayı ve section'larını düzenleme formunu gösterir.
     */
    // app/Http/Controllers/Admin/PageController.php

    /**
     * Sayfayı ve section'larını düzenleme formunu gösterir.
     */
    public function edit(Page $page)
    {
        // Config dosyasından tüm olası section'ları al
        $availableSections = config('sections');

        // Mevcut sayfanın section'larını yükle
        $page->load('sections');

        // ================================================================= //
        // DÜZELTİLMİŞ KISIM BAŞLANGICI
        // ================================================================= //

        // 1. `setting()` fonksiyonu zaten bize bir PHP dizisi veriyor.
        $activeLanguageCodes = setting('active_languages', ['tr', 'en']);

        // Güvenlik önlemi: Gelen değerin dizi olduğundan emin olalım.
        if (!is_array($activeLanguageCodes)) {
            $activeLanguageCodes = ['tr', 'en']; // Beklenmedik bir durumda varsayılanı kullan.
        }

        // 2. config/languages.php dosyasından tüm dilleri al
        $allLanguages = config('languages.supported', []);

        // 3. Sadece aktif olan dilleri filtrele ve sırala
        $activeLanguages = collect($allLanguages)
            ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
            ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes));

        // ================================================================= //
        // DÜZELTİLMİŞ KISIM BİTİŞİ
        // ================================================================= //

        return view('admin.pages.edit', compact('page', 'availableSections', 'activeLanguages'));
    }

    // app/Http/Controllers/Admin/PageController.php

    //    public function update(Request $request, Page $page)
//    {
//        // 1. ADIM: Sayfa ve SEO ayarlarını doğrula
//        $validatedPageData = $request->validate([
//            'title' => 'required|array',
//            'title.tr' => 'required|string|max:255',
//            'title.en' => 'nullable|string|max:255',
//            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
//            'status' => 'required|in:draft,published',
//            'seo_title' => 'nullable|array',
//            'meta_description' => 'nullable|array',
//            'keywords' => 'nullable|array',
//            'index_status' => 'required|in:index,noindex',
//            'follow_status' => 'required|in:follow,nofollow',
//            'canonical_url' => 'nullable|url',
//            'og_title' => 'nullable|array',
//            'og_description' => 'nullable|array',
//            'og_image' => 'nullable|url',
//        ]);
//
//        // 2. ADIM: Sayfanın temel bilgilerini (Başlık, slug vb.) güncelle
//        // Bu kısım artık doğru çalışacak çünkü JS buna müdahale etmeyecek.
//        $page->update($validatedPageData);
//
//        // 3. ADIM: Gelen section ID'lerini ve mevcut section ID'lerini alarak silinecekleri bul
//        $incomingSectionIds = collect($request->input('sections', []))->pluck('id')->filter()->toArray();
//        $sectionsToDelete = $page->sections()->whereNotIn('id', $incomingSectionIds)->get();
//
//        // Silinecek section'ları ve onlara ait resimleri temizle
//        foreach ($sectionsToDelete as $section) {
//            $sectionConfig = config('sections.' . $section->section_key, []);
//            if (isset($section->content) && !empty($sectionConfig['fields'])) {
//                foreach ($sectionConfig['fields'] as $field) {
//                    if ($field['type'] === 'file' && !empty($section->content[$field['name']])) {
//                        $this->deleteImage($section->content[$field['name']]);
//                    }
//                }
//            }
//            $section->delete();
//        }
//
//        // 4. ADIM: Gelen section'ları döngüye alarak güncelle veya oluştur
//        if ($request->has('sections')) {
//            foreach ($request->sections as $order => $sectionData) {
//                // Mevcut bölümü bul veya yeni bir tane oluştur
//                $section = PageSection::findOrNew($sectionData['id'] ?? null);
//                $content = $section->content ?? []; // Eski content'i koru
//
//                // Formdan gelen metin içeriklerini mevcut content ile birleştir
//                $formContent = $sectionData['content'] ?? [];
//                $content = array_merge($content, $formContent);
//
//                // Eğer yeni resimler yüklenmişse, onları işle
//                if ($request->hasFile("sections.{$order}.files")) {
//                    foreach ($request->file("sections.{$order}.files") as $fieldName => $uploadedFile) {
//                        // Eski resmi sil (varsa)
//                        if (!empty($content[$fieldName])) {
//                            $this->deleteImage($content[$fieldName]);
//                        }
//                        // Yeni resmi yükle ve yolunu content'e ekle
//                        $imagePath = $this->uploadImage($request, "sections.{$order}.files.{$fieldName}", 'uploads/sections');
//                        $content[$fieldName] = $imagePath;
//                    }
//                }
//
//                // Bölümü veritabanına kaydet
//                $section->fill([
//                    'page_id' => $page->id,
//                    'section_key' => $sectionData['section_key'],
//                    'order' => $order,
//                    'is_active' => $sectionData['is_active'] ?? false,
//                    'content' => $content,
//                ]);
//                $section->save();
//            }
//        }
//
//        return redirect()->back()->with('success', 'Sayfa başarıyla güncellendi.');
//    }

    public function update(Request $request, Page $page)
    {
        \Log::info('Request files structure:', $request->allFiles());

        // 1. ADIM: Sayfa ve SEO ayarlarını doğrula
        $validatedPageData = $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'status' => 'required|in:draft,published',
            'banner_title' => 'nullable|array',
            'banner_subtitle' => 'nullable|array',
            'seo_title' => 'nullable|array',
            'meta_description' => 'nullable|array',
            'keywords' => 'nullable|array',
            'index_status' => 'required|in:index,noindex',
            'follow_status' => 'required|in:follow,nofollow',
            'canonical_url' => 'nullable|url',
            'og_title' => 'nullable|array',
            'og_description' => 'nullable|array',
            'og_image' => 'nullable|url',
            'sections.*.files.*.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:50048',
        ]);
        // 2. ADIM: Sayfanın temel bilgilerini güncelle
        $page->update($validatedPageData);

        // 3. ADIM: Silinecek section'ları yönet
        $incomingSectionIds = collect($request->input('sections', []))->pluck('id')->filter()->toArray();
        $sectionsToDelete = $page->sections()->whereNotIn('id', $incomingSectionIds)->get();

        foreach ($sectionsToDelete as $section) {
            $this->deleteSectionImages($section);
            $section->delete();
        }

        // 4. ADIM: Gelen section'ları işle
        if ($request->has('sections')) {
            foreach ($request->sections as $order => $sectionData) {
                $section = PageSection::findOrNew($sectionData['id'] ?? null);
                $oldContent = $section->content ?? [];

                // Gelen içeriği temel al
                $content = $sectionData['content'] ?? [];

                $sectionConfig = config('sections.' . $sectionData['section_key'], []);

                // Multi-image alanlarını işle
                // Multi-image alanlarını işle
                foreach ($sectionConfig['fields'] as $field) {
                    if ($field['type'] === 'multi_image') {
                        $fieldName = $field['name'];
                        $uploadedImages = [];

                        // Mevcut resimleri koru
                        if (isset($content[$fieldName]) && is_array($content[$fieldName])) {
                            $uploadedImages = $content[$fieldName];
                        }

                        // Yeni resimleri yükle
                        if ($request->hasFile("sections.{$order}.files.{$fieldName}")) {
                            $files = $request->file("sections.{$order}.files.{$fieldName}");

                            // Dosyaları işle
                            if (is_array($files)) {
                                foreach ($files as $index => $file) {
                                    if ($file && $file->isValid()) {
                                        // Dosyayı yükle - uploadImage trait'ini kullan
                                        $tempRequest = new \Illuminate\Http\Request();
                                        $tempRequest->files->set('image', $file);

                                        $fileName = time() . '_' . $index . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                                        $file->move(public_path('uploads/sections'), $fileName);
                                        $filePath = 'uploads/sections/' . $fileName;

                                        $uploadedImages[$index] = $filePath;

                                        \Log::info("Multi-image uploaded: {$filePath}");
                                    }
                                }
                            }
                        }

                        // Sıralamayı koru ve boş değerleri temizle
                        ksort($uploadedImages);
                        $uploadedImages = array_values(array_filter($uploadedImages));

                        $content[$fieldName] = $uploadedImages;

                        \Log::info("Final images for {$fieldName}:", $uploadedImages);
                    }
                }

                // Ana section için dosya yüklemelerini işle (normal file alanları)
                $mainFilePathPrefix = "sections.{$order}.files";
                if ($request->hasFile($mainFilePathPrefix)) {
                    foreach ($request->file($mainFilePathPrefix) as $fieldName => $uploadedFile) {
                        // Multi-image alanlarını atla (yukarıda işlendi)
                        $fieldConfig = collect($sectionConfig['fields'])->firstWhere('name', $fieldName);
                        if ($fieldConfig && $fieldConfig['type'] === 'multi_image') {
                            continue;
                        }

                        // Eğer array ise atla (multi-image)
                        if (is_array($uploadedFile)) {
                            continue;
                        }

                        // Normal file alanı
                        if (isset($oldContent[$fieldName])) {
                            $this->deleteImage($oldContent[$fieldName]);
                        }
                        $imagePath = $this->uploadImage($request, "{$mainFilePathPrefix}.{$fieldName}", 'uploads/sections');
                        $content[$fieldName] = $imagePath;
                    }
                } else {
                    // Eğer yeni dosya gelmediyse, eski dosya yolunu koru
                    foreach ($sectionConfig['fields'] as $field) {
                        if ($field['type'] === 'file' && isset($oldContent[$field['name']])) {
                            $content[$field['name']] = $oldContent[$field['name']];
                        }
                    }
                }

                // Repeater alanlarındaki dosya yüklemelerini işle
                foreach ($sectionConfig['fields'] as $field) {
                    if ($field['type'] === 'repeater' && isset($content[$field['name']])) {
                        $repeaterName = $field['name'];
                        foreach ($content[$repeaterName] as $itemIndex => &$item) {
                            $repeaterFilePathPrefix = "sections.{$order}.content.{$repeaterName}.{$itemIndex}.files";
                            if ($request->hasFile($repeaterFilePathPrefix)) {
                                foreach ($request->file($repeaterFilePathPrefix) as $repeaterFieldName => $uploadedFile) {
                                    // Eski resmi sil
                                    if (isset($oldContent[$repeaterName][$itemIndex][$repeaterFieldName])) {
                                        $this->deleteImage($oldContent[$repeaterName][$itemIndex][$repeaterFieldName]);
                                    }
                                    // Yeni resmi yükle
                                    $imagePath = $this->uploadImage($request, "{$repeaterFilePathPrefix}.{$repeaterFieldName}", 'uploads/sections');
                                    $item[$repeaterFieldName] = $imagePath;
                                }
                            } else {
                                // Yeni resim gelmediyse, eski repeater item resim yolunu koru
                                foreach ($field['fields'] as $repeaterField) {
                                    if ($repeaterField['type'] === 'file' && isset($oldContent[$repeaterName][$itemIndex][$repeaterField['name']])) {
                                        $item[$repeaterField['name']] = $oldContent[$repeaterName][$itemIndex][$repeaterField['name']];
                                    }
                                }
                            }
                        }
                    }
                }

                $section->fill([
                    'page_id' => $page->id,
                    'section_key' => $sectionData['section_key'],
                    'order' => $order,
                    'is_active' => $sectionData['is_active'] ?? false,
                    'content' => $content,
                ]);
                $section->save();
            }
        }

        return redirect()->back()->with('success', 'Sayfa başarıyla güncellendi.');
    }
    /**
     * Bir section ve içeriğindeki tüm resimleri siler.
     * @param PageSection $section
     */
    private function deleteSectionImages(PageSection $section)
    {
        $sectionConfig = config('sections.' . $section->section_key, []);
        if (!empty($section->content) && !empty($sectionConfig['fields'])) {
            foreach ($sectionConfig['fields'] as $field) {
                // Ana alanlardaki dosyalar
                if ($field['type'] === 'file' && !empty($section->content[$field['name']])) {
                    $this->deleteImage($section->content[$field['name']]);
                }
                // Repeater içindeki dosyalar
                if ($field['type'] === 'repeater' && !empty($section->content[$field['name']])) {
                    foreach ($section->content[$field['name']] as $item) {
                        foreach ($field['fields'] as $repeaterField) {
                            if ($repeaterField['type'] === 'file' && !empty($item[$repeaterField['name']])) {
                                $this->deleteImage($item[$repeaterField['name']]);
                            }
                        }
                    }
                }
            }
        }
    }
    public function reorderSections(Request $request)
    {
        $data = $request->validate([
            'orders' => 'required|array',           // [section_id => newOrder, ...]
            'orders.*' => 'integer|min:1'
        ]);

        foreach ($data['orders'] as $id => $order) {
            \App\Models\PageSection::whereKey($id)->update(['order' => $order]);
        }

        return response()->json(['ok' => true]);
    }


    public function toggleStatus(PageSection $section)
    {
        $section->is_active = !$section->is_active;
        $section->save();

        return response()->json(['ok' => true, 'is_active' => $section->is_active]);
    }

    /**
     * Belirtilen sayfayı siler.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla silindi.');
    }
}
