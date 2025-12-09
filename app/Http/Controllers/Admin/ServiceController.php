<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == 'active' ? 1 : 0);
        }

        $services = $query->latest()->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $service = new Service();
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.services.create', compact('service', 'activeLanguages'));
    }

    /**
     * Yeni bir hizmeti, update ile aynı mantığı kullanarak kaydeder.
     */
    public function store(Request $request)
    {
        // Validasyonu merkezi metottan çağır
        $validatedData = $this->validateService($request);

        // Veri işlemeyi (repeater temizleme, resim yükleme) merkezi metottan çağır
        $this->handleServiceData($validatedData, $request);

        // Veriyi kaydet
        Service::create($validatedData);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla oluşturuldu.');
    }


    public function edit(Service $service)
    {
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.services.edit', compact('service', 'activeLanguages'));
    }

    /**
     * Mevcut bir hizmeti günceller.
     */
    public function update(Request $request, Service $service)
    {
        // Validasyonu merkezi metottan çağır
        $validatedData = $this->validateService($request, $service->id);

        // Veri işlemeyi (repeater temizleme, resim yükleme) merkezi metottan çağır
        $this->handleServiceData($validatedData, $request, $service);

        // Veriyi güncelle
        $service->update($validatedData);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }

    private function getActiveLanguages(): array
    {
        try {
            // `setting` zaten dizi döndürüyor.
            $activeLanguageCodes = setting('active_languages', ['tr', 'en']);

            if (!is_array($activeLanguageCodes) || empty($activeLanguageCodes)) {
                $activeLanguageCodes = ['tr', 'en'];
            }

            $supportedLanguages = config('languages.supported', []);

            return collect($supportedLanguages)
                ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
                ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes))
                ->toArray();
        } catch (\Exception $e) {
            return [
                'tr' => ['name' => 'Turkish', 'native' => 'Türkçe'],
                'en' => ['name' => 'English', 'native' => 'English']
            ];
        }
    }

    /**
     * Hem store hem de update için merkezi validasyon kuralları.
     */
    /**
     * Hem store hem de update için merkezi validasyon kuralları.
     */
    private function validateService(Request $request, $id = null): array
    {
        $activeLanguages = $this->getActiveLanguages();
        $languageCodes = array_keys($activeLanguages);

        $rules = [
            'title' => 'nullable|array',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $id,
            'summary' => 'nullable|array',
            'content' => 'nullable|array',
            'expectations_content' => 'nullable|array',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:50048',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'benefits' => 'nullable|array',
            'support_items' => 'nullable|array',
            'faqs' => 'nullable|array',
        ];

        // Tüm dillerin başlıkları opsiyonel
        foreach ($languageCodes as $code) {
            $rules["title.{$code}"] = 'nullable|string|max:255';
            $rules["summary.{$code}"] = 'nullable|string';
            $rules["content.{$code}"] = 'nullable|string';
            $rules["expectations_content.{$code}"] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        // Varsayılan değerler ata
        $validated['is_active'] = $validated['is_active'] ?? 1;
        $validated['order'] = $validated['order'] ?? 0;

        return $validated;
    }
    /**
     * Hem store hem de update için repeater ve resim verilerini işler.
     */
    /**
     * Hem store hem de update için TÜM metin, repeater ve resim verilerini işler.
     * (NİHAİ GÜNCELLENMİŞ METOT)
     */
    private function handleServiceData(array &$validatedData, Request $request, ?Service $service = null): void
    {
        $languageCodes = array_keys($this->getActiveLanguages());

        // 1. TÜM Çevrilebilir Metin Alanlarını Temizle
        // (title, summary, content, expectations_content)
        // Boş string veya boş HTML (<p><br></p>) ise veritabanına NULL olarak kaydet.

        $textFieldsToClean = ['title', 'summary', 'content', 'expectations_content'];

        foreach ($textFieldsToClean as $field) {
            if (isset($validatedData[$field]) && is_array($validatedData[$field])) {
                foreach ($languageCodes as $code) {
                    if (isset($validatedData[$field][$code])) {
                        $value = $validatedData[$field][$code];

                        // HTML etiketlerini kaldır, baştaki/sondaki boşlukları sil
                        $cleanedValue = trim(strip_tags((string) $value));

                        // Eğer sonuç tamamen boşsa, bu dil için değeri null yap
                        if (empty($cleanedValue)) {
                            $validatedData[$field][$code] = null;
                        }
                    }
                }
            }
        }

        // 2. Çevrilemeyen Metin Alanlarını Temizle (Örn: slug)
        // Boş string "" ise NULL yap
        if (isset($validatedData['slug']) && trim((string) $validatedData['slug']) === '') {
            $validatedData['slug'] = null;
        }

        // 3. Repeater'lardan gelen boş satırları (boş HTML içerenler dahil) temizle

        // 3a. Benefits Temizleme
        $validatedData['benefits'] = array_values(array_filter($validatedData['benefits'] ?? [], function($item) {
            // 'text' dizisindeki tüm değerleri strip_tags/trim'den geçir
            $cleanedTexts = array_map(function($text) {
                return trim(strip_tags((string) $text));
            }, $item['text'] ?? []);

            // Temizlenmiş dizide hala dolu bir değer var mı? (Boş değilse koru)
            return !empty(array_filter($cleanedTexts));
        }));

        // 3b. Support Items Temizleme
        $validatedData['support_items'] = array_values(array_filter($validatedData['support_items'] ?? [], function($item) {
            $cleanedTexts = array_map(function($text) {
                return trim(strip_tags((string) $text));
            }, $item['text'] ?? []);

            // Temizlenmiş dizide hala dolu bir değer var mı? (Boş değilse koru)
            return !empty(array_filter($cleanedTexts));
        }));

        // 3c. FAQs Temizleme (Soru VEYA Cevap dolu olmalı)
        $validatedData['faqs'] = array_values(array_filter($validatedData['faqs'] ?? [], function($item) {
            // Soruyu temizle
            $cleanedQuestions = array_map(function($q) {
                return trim(strip_tags((string) $q));
            }, $item['question'] ?? []);

            // Cevabı temizle (Cevap da HTML olabilir)
            $cleanedAnswers = array_map(function($a) {
                // Cevaplar HTML içerebilir, ancak tamamen boş HTML ise (<p><br></p>)
                // strip_tags onu da temizleyecektir.
                return trim(strip_tags((string) $a));
            }, $item['answer'] ?? []);

            // Soru VEYA cevap doluysa satırı koru
            return !empty(array_filter($cleanedQuestions)) || !empty(array_filter($cleanedAnswers));
        }));


        // 4. Kapak Resmi Yükleme
        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $this->uploadImage($request, 'cover_image', 'uploads/services', $service->cover_image ?? null);
        }

        // 5. Galeri Resimleri Yükleme
        $existingGallery = $service->gallery_images ?? [];
        if ($request->has('delete_gallery_images')) {
            $imagesToDelete = $request->input('delete_gallery_images');
            foreach ($imagesToDelete as $imagePath) {
                $this->deleteImage($imagePath);
            }
            $existingGallery = array_diff($existingGallery, $imagesToDelete);
        }
        if ($request->hasFile('gallery_images')) {
            $newImages = [];
            foreach ($request->file('gallery_images') as $file) {
                $newImages[] = $this->uploadSingleFile($file, 'uploads/services/gallery');
            }
            $validatedData['gallery_images'] = array_merge($existingGallery, $newImages);
        } else {
            $validatedData['gallery_images'] = $existingGallery;
        }
    }
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:50048',
        ]);

        // ImageUploadTrait içindeki metodu kullanarak resmi yükle
        $path = $this->uploadImage($request, 'image', 'uploads/services/editor');

        if ($path) {
            // Başarılı olursa, resmin tam URL'sini JSON olarak döndür
            return response()->json(['url' => asset($path)]);
        }

        // Başarısız olursa hata döndür
        return response()->json(['error' => 'Resim yüklenemedi.'], 500);
    }

    /**
     * Hizmeti soft delete ile siler (çöp kutusuna taşır)
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('admin.services.index')
                ->with('success', 'Hizmet başarıyla çöp kutusuna taşındı.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hizmet silinirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Çöp kutusundaki hizmetleri listeler
     */
    public function trash()
    {
        $services = Service::onlyTrashed()->latest('deleted_at')->paginate(20);
        return view('admin.services.trash', compact('services'));
    }

    /**
     * Çöp kutusundan hizmeti geri yükler
     */
    public function restore($id)
    {
        try {
            $service = Service::onlyTrashed()->findOrFail($id);
            $service->restore();
            return redirect()->route('admin.services.trash')
                ->with('success', 'Hizmet başarıyla geri yüklendi.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hizmet geri yüklenirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Hizmeti kalıcı olarak siler
     */
    public function forceDelete($id)
    {
        try {
            $service = Service::onlyTrashed()->findOrFail($id);

            // İlgili resimleri sil
            if ($service->cover_image) {
                $this->deleteImage($service->cover_image);
            }

            if (!empty($service->gallery_images)) {
                foreach ($service->gallery_images as $image) {
                    $this->deleteImage($image);
                }
            }

            $service->forceDelete();

            return redirect()->route('admin.services.trash')
                ->with('success', 'Hizmet kalıcı olarak silindi.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hizmet silinirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Toplu işlemler (silme, geri yükleme, kalıcı silme)
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,restore,force-delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:services,id'
        ]);

        try {
            $ids = $request->ids;
            $action = $request->action;
            $count = count($ids);

            switch ($action) {
                case 'delete':
                    Service::whereIn('id', $ids)->delete();
                    $message = "{$count} hizmet çöp kutusuna taşındı.";
                    $route = 'admin.services.index';
                    break;

                case 'restore':
                    Service::onlyTrashed()->whereIn('id', $ids)->restore();
                    $message = "{$count} hizmet geri yüklendi.";
                    $route = 'admin.services.trash';
                    break;

                case 'force-delete':
                    $services = Service::onlyTrashed()->whereIn('id', $ids)->get();

                    foreach ($services as $service) {
                        // Resimleri sil
                        if ($service->cover_image) {
                            $this->deleteImage($service->cover_image);
                        }
                        if (!empty($service->gallery_images)) {
                            foreach ($service->gallery_images as $image) {
                                $this->deleteImage($image);
                            }
                        }
                        $service->forceDelete();
                    }

                    $message = "{$count} hizmet kalıcı olarak silindi.";
                    $route = 'admin.services.trash';
                    break;

                default:
                    return redirect()->back()->with('error', 'Geçersiz işlem.');
            }

            return redirect()->route($route)->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Toplu işlem sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }
}
