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
        // Şablonları config dosyasından al
        $templates = config('page_templates', []);

        // Aktif dilleri al
        $activeLanguageCodes = setting('active_languages', ['tr', 'en']);
        if (!is_array($activeLanguageCodes)) {
            $activeLanguageCodes = ['tr', 'en'];
        }
        $allLanguages = config('languages.supported', []);
        $activeLanguages = collect($allLanguages)
            ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
            ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes));

        return view('admin.pages.create', compact('page', 'templates', 'activeLanguages'));
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
            'banner_title' => 'nullable|array',
            'banner_subtitle' => 'nullable|array',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'status' => 'nullable|in:draft,published',
            'template' => 'nullable|string|in:' . implode(',', array_keys(config('page_templates', []))),

            // SEO Alanları
            'seo_title' => 'nullable|array',
            'meta_description' => 'nullable|array',
            'keywords' => 'nullable|array',
            'focus_keyword' => 'nullable|array',
            'index_status' => 'nullable|in:index,noindex',
            'follow_status' => 'nullable|in:follow,nofollow',
            'canonical_url' => 'nullable|url',

            // Open Graph
            'og_title' => 'nullable|array',
            'og_description' => 'nullable|array',
            'og_image' => 'nullable|image|max:2048',

            // Twitter Card
            'twitter_card_type' => 'nullable|in:summary,summary_large_image',
            'twitter_title' => 'nullable|array',
            'twitter_description' => 'nullable|array',
            'twitter_image' => 'nullable|image|max:2048',

            // Meta Robots
            'meta_noindex' => 'nullable|boolean',
            'meta_nofollow' => 'nullable|boolean',
            'meta_noarchive' => 'nullable|boolean',
            'meta_nosnippet' => 'nullable|boolean',

            // Redirect
            'redirect_url' => 'nullable|url',
            'redirect_enabled' => 'nullable|boolean',
            'redirect_type' => 'nullable|integer|in:301,302,307,308',
        ]);

        // Varsayılan değerleri ayarla
        $validatedData['status'] = $validatedData['status'] ?? 'draft';
        $validatedData['index_status'] = $validatedData['index_status'] ?? 'index';
        $validatedData['follow_status'] = $validatedData['follow_status'] ?? 'follow';
        $validatedData['redirect_type'] = $validatedData['redirect_type'] ?? 301;

        // Resim yüklemelerini işle
        if ($request->hasFile('og_image')) {
            $validatedData['og_image'] = $this->uploadImage($request, 'og_image', 'uploads/seo');
        }

        if ($request->hasFile('twitter_image')) {
            $validatedData['twitter_image'] = $this->uploadImage($request, 'twitter_image', 'uploads/seo');
        }

        // Boolean alanları doğru şekilde işle
        $validatedData['meta_noindex'] = $request->has('meta_noindex');
        $validatedData['meta_nofollow'] = $request->has('meta_nofollow');
        $validatedData['meta_noarchive'] = $request->has('meta_noarchive');
        $validatedData['meta_nosnippet'] = $request->has('meta_nosnippet');
        $validatedData['redirect_enabled'] = $request->has('redirect_enabled');

        // Sayfayı oluştur
        $page = Page::create($validatedData);

        // Eğer bir şablon seçildiyse, ilgili bölümleri oluştur
        if ($request->filled('template')) {
            $templateKey = $request->input('template');
            $templateSections = config("page_templates.{$templateKey}.sections", []);

            foreach ($templateSections as $order => $sectionKey) {
                PageSection::create([
                    'page_id' => $page->id,
                    'section_key' => $sectionKey,
                    'order' => $order,
                    'is_active' => true,
                    'content' => []
                ]);
            }
        }

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Sayfa başarıyla oluşturuldu. Şimdi içeriğini düzenleyebilirsiniz.');
    }
    /**
     * Belirtilen sayfayı gösterir (Genellikle admin panelinde kullanılmaz).
     */
    public function show(Page $page)
    {
        return redirect()->route('frontend.page.show', $page->slug);
    }

    /**
     * Sayfayı ve section'larını düzenleme formunu gösterir.
     */
    public function edit(Page $page)
    {
        // Config dosyasından tüm olası section'ları al
        $availableSections = config('sections');

        // Mevcut sayfanın section'larını yükle
        $page->load('sections');

        // Aktif dilleri al
        $activeLanguageCodes = setting('active_languages', ['tr', 'en']);

        if (!is_array($activeLanguageCodes)) {
            $activeLanguageCodes = ['tr', 'en'];
        }

        $allLanguages = config('languages.supported', []);
        $activeLanguages = collect($allLanguages)
            ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
            ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes));

        return view('admin.pages.edit', compact('page', 'availableSections', 'activeLanguages'));
    }

    /**
     * Sayfayı günceller - Tüm yeni SEO alanları dahil
     */
    public function update(Request $request, Page $page)
    {
        // 1. ADIM: Sayfa ve tüm SEO ayarlarını doğrula
        $validatedPageData = $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'status' => 'required|in:draft,published',
            'banner_title' => 'nullable|array',
            'banner_subtitle' => 'nullable|array',

            // Basic SEO
            'seo_title' => 'nullable|array',
            'meta_description' => 'nullable|array',
            'keywords' => 'nullable|array',
            'focus_keyword' => 'nullable|array',
            'index_status' => 'required|in:index,noindex',
            'follow_status' => 'required|in:follow,nofollow',
            'canonical_url' => 'nullable|url',

            // Open Graph
            'og_title' => 'nullable|array',
            'og_description' => 'nullable|array',
            'og_image' => 'nullable|image|max:2048',

            // Twitter Card
            'twitter_card_type' => 'nullable|in:summary,summary_large_image',
            'twitter_title' => 'nullable|array',
            'twitter_description' => 'nullable|array',
            'twitter_image' => 'nullable|image|max:2048',

            // Meta Robots
            'meta_noindex' => 'nullable|boolean',
            'meta_nofollow' => 'nullable|boolean',
            'meta_noarchive' => 'nullable|boolean',
            'meta_nosnippet' => 'nullable|boolean',
            'meta_max_snippet' => 'nullable|integer|min:-1|max:320',
            'meta_max_image_preview' => 'nullable|in:none,standard,large',

            // Schema.org
            'schema_article_type' => 'nullable|in:Article,WebPage,Product,Service,FAQPage,LocalBusiness',
            'schema_faq_items' => 'nullable|json',
            'schema_product_price' => 'nullable|numeric|min:0',
            'schema_product_currency' => 'nullable|string|size:3',
            'schema_product_availability' => 'nullable|in:InStock,OutOfStock,PreOrder,Discontinued',
            'schema_product_rating' => 'nullable|numeric|min:1|max:5',
            'schema_product_review_count' => 'nullable|integer|min:0',
            'schema_service_area' => 'nullable|array',
            'schema_service_provider' => 'nullable|array',

            // Redirect
            'redirect_url' => 'nullable|url',
            'redirect_enabled' => 'nullable|boolean',
            'redirect_type' => 'nullable|integer|in:301,302,307,308',

            // Section dosyaları
            'sections.*.files.*' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,mp4|max:100048',
            'sections.*.content.*.files.*' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,mp4|max:100048',
            'sections.*.content.*.*.files.*' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,mp4|max:100048',
            'sections.*.content.*.*.*.files.*' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,mp4|max:100048',
        ]);

        // Resim yüklemelerini işle
        if ($request->hasFile('og_image')) {
            // Eski OG resmi sil
            if ($page->og_image) {
                $this->deleteImage($page->og_image);
            }
            $validatedPageData['og_image'] = $this->uploadImage($request, 'og_image', 'uploads/seo');
        }

        if ($request->hasFile('twitter_image')) {
            // Eski Twitter resmi sil
            if ($page->twitter_image) {
                $this->deleteImage($page->twitter_image);
            }
            $validatedPageData['twitter_image'] = $this->uploadImage($request, 'twitter_image', 'uploads/seo');
        }

        // Boolean alanları doğru şekilde işle
        $validatedPageData['meta_noindex'] = $request->has('meta_noindex');
        $validatedPageData['meta_nofollow'] = $request->has('meta_nofollow');
        $validatedPageData['meta_noarchive'] = $request->has('meta_noarchive');
        $validatedPageData['meta_nosnippet'] = $request->has('meta_nosnippet');
        $validatedPageData['redirect_enabled'] = $request->has('redirect_enabled');

        // FAQ JSON'unu parse et
        if ($request->filled('schema_faq_items')) {
            $faqItems = json_decode($request->input('schema_faq_items'), true);
            $validatedPageData['schema_faq_items'] = $faqItems ?: null;
        }

        // Schema otomatik oluştur (eğer SchemaGeneratorService varsa)
        if (class_exists('\App\Services\SchemaGeneratorService')) {
            $schemaService = app(\App\Services\SchemaGeneratorService::class);
            $generatedSchema = $schemaService->generate($page, app()->getLocale());
            $validatedPageData['generated_schema_json'] = $generatedSchema;
        }

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

                // Ana section için dosya yüklemelerini işle
                $mainFilePathPrefix = "sections.{$order}.files";
                if ($request->hasFile($mainFilePathPrefix)) {
                    foreach ($request->file($mainFilePathPrefix) as $fieldName => $uploadedFile) {
                        // Eski resmi sil
                        if (isset($oldContent[$fieldName])) {
                            $this->deleteImage($oldContent[$fieldName]);
                        }
                        // Yeni resmi yükle
                        $imagePath = $this->uploadImage($request, "{$mainFilePathPrefix}.{$fieldName}", 'uploads/sections');
                        $content[$fieldName] = $imagePath;
                    }
                } else {
                    // Eski dosya yolunu koru
                    $sectionConfig = config('sections.' . $sectionData['section_key'], []);
                    if (!empty($sectionConfig['fields'])) {
                        foreach ($sectionConfig['fields'] as $field) {
                            if ($field['type'] === 'file' && isset($oldContent[$field['name']])) {
                                $content[$field['name']] = $oldContent[$field['name']];
                            }
                        }
                    }
                }

                // Repeater alanlarındaki dosya yüklemelerini işle
                $sectionConfig = config('sections.' . $sectionData['section_key'], []);
                if (!empty($sectionConfig['fields'])) {
                    $content = $this->processRepeaterFields(
                        $request,
                        $order,
                        $content,
                        $oldContent,
                        $sectionConfig['fields'],
                        ''
                    );
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
     * Section sıralamasını güncelle
     */
    public function reorderSections(Request $request)
    {
        try {
            $validated = $request->validate([
                'orders' => 'required|array',
                'orders.*' => 'integer|min:1'
            ]);

            \Log::info('Section sıralama isteği alındı:', $validated);

            $updatedCount = 0;
            foreach ($validated['orders'] as $sectionId => $newOrder) {
                $updated = \App\Models\PageSection::where('id', $sectionId)
                    ->update(['order' => $newOrder]);

                if ($updated) {
                    $updatedCount++;
                }
            }

            \Log::info("$updatedCount section güncellendi");

            return response()->json([
                'ok' => true,
                'message' => "$updatedCount section sıralaması güncellendi",
                'updated_count' => $updatedCount
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation hatası:', ['errors' => $e->errors()]);

            return response()->json([
                'ok' => false,
                'message' => 'Geçersiz veri',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Section sıralama hatası:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'ok' => false,
                'message' => 'Bir hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Section durumunu değiştir
     */
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
        // Sayfa silinmeden önce tüm section'ların resimlerini sil
        foreach ($page->sections as $section) {
            $this->deleteSectionImages($section);
        }

        // Sayfa SEO resimlerini sil
        if ($page->og_image) {
            $this->deleteImage($page->og_image);
        }
        if ($page->twitter_image) {
            $this->deleteImage($page->twitter_image);
        }

        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla silindi.');
    }

    /**
     * Repeater alanlarını recursive olarak işle
     */
    private function processRepeaterFields($request, $sectionOrder, $content, $oldContent, $fields, $parentPath = '')
    {
        foreach ($fields as $field) {
            if ($field['type'] === 'repeater' && isset($content[$field['name']])) {
                $repeaterName = $field['name'];

                foreach ($content[$repeaterName] as $itemIndex => &$item) {
                    $currentPath = $parentPath ? "{$parentPath}.{$repeaterName}.{$itemIndex}" : "{$repeaterName}.{$itemIndex}";
                    $repeaterFilePathPrefix = "sections.{$sectionOrder}.content.{$currentPath}.files";

                    \Log::info("Checking files for path: {$repeaterFilePathPrefix}", [
                        'has_file' => $request->hasFile($repeaterFilePathPrefix),
                        'all_files' => $request->allFiles()
                    ]);

                    if ($request->hasFile($repeaterFilePathPrefix)) {
                        foreach ($request->file($repeaterFilePathPrefix) as $repeaterFieldName => $uploadedFile) {
                            \Log::info("Processing file: {$repeaterFieldName}", [
                                'file_name' => $uploadedFile->getClientOriginalName(),
                                'file_size' => $uploadedFile->getSize()
                            ]);

                            // Eski resmi sil
                            $oldValue = $this->getNestedValue($oldContent, "{$repeaterName}.{$itemIndex}.{$repeaterFieldName}");
                            if ($oldValue) {
                                $this->deleteImage($oldValue);
                            }

                            // Yeni resmi yükle
                            $imagePath = $this->uploadImage($request, "{$repeaterFilePathPrefix}.{$repeaterFieldName}", 'uploads/sections');
                            $item[$repeaterFieldName] = $imagePath;

                            \Log::info("File uploaded successfully", [
                                'field_name' => $repeaterFieldName,
                                'image_path' => $imagePath
                            ]);
                        }
                    } else {
                        // Yeni resim gelmediyse, eski resim yolunu koru
                        foreach ($field['fields'] as $repeaterField) {
                            if ($repeaterField['type'] === 'file') {
                                $oldValue = $this->getNestedValue($oldContent, "{$repeaterName}.{$itemIndex}.{$repeaterField['name']}");
                                if ($oldValue && !isset($item[$repeaterField['name']])) {
                                    $item[$repeaterField['name']] = $oldValue;
                                }
                            }
                        }
                    }

                    // İç içe repeater varsa işle (recursive)
                    $item = $this->processRepeaterFields(
                        $request,
                        $sectionOrder,
                        $item,
                        $this->getNestedValue($oldContent, "{$repeaterName}.{$itemIndex}", []),
                        $field['fields'],
                        $currentPath
                    );
                }
            }
        }

        return $content;
    }

    /**
     * Nested array'den değer al
     */
    private function getNestedValue($array, $path, $default = null)
    {
        $keys = explode('.', $path);
        $value = $array;

        foreach ($keys as $key) {
            if (!is_array($value) || !isset($value[$key])) {
                return $default;
            }
            $value = $value[$key];
        }

        return $value;
    }

    /**
     * Bir section ve içeriğindeki tüm resimleri siler
     */
    private function deleteSectionImages(PageSection $section)
    {
        $sectionConfig = config('sections.' . $section->section_key, []);
        if (!empty($section->content) && !empty($sectionConfig['fields'])) {
            $this->deleteFieldImages($section->content, $sectionConfig['fields']);
        }
    }

    /**
     * Field'lardaki resimleri recursive olarak sil
     */
    private function deleteFieldImages($content, $fields)
    {
        foreach ($fields as $field) {
            if ($field['type'] === 'file' && !empty($content[$field['name']])) {
                $this->deleteImage($content[$field['name']]);
            }

            if ($field['type'] === 'repeater' && !empty($content[$field['name']])) {
                foreach ($content[$field['name']] as $item) {
                    $this->deleteFieldImages($item, $field['fields']);
                }
            }
        }
    }
}