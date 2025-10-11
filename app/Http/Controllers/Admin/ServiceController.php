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

    // ... Diğer metodlar (destroy, trash, restore vb.) aynı kalabilir ...
    public function destroy(Service $service){ /* ... */ }
    public function trash(){ /* ... */ }
    public function restore($id){ /* ... */ }
    public function forceDelete($id){ /* ... */ }
    public function bulkAction(Request $request){ /* ... */ }


    /**
     * Aktif dilleri ayarlardan alır.
     * Hatalı json_decode kaldırıldı.
     */
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
    private function validateService(Request $request, $id = null): array
    {
        $activeLanguages = $this->getActiveLanguages();
        $languageCodes = array_keys($activeLanguages);
        $firstLanguage = $languageCodes[0] ?? 'tr';

        $rules = [
            'title' => 'required|array',
            "title.{$firstLanguage}" => 'required|string|max:255', // Sadece ilk dil zorunlu
            'slug' => 'required|string|max:255|unique:services,slug,' . $id,
            'summary' => 'nullable|array',
            'content' => 'nullable|array',
            'expectations_content' => 'nullable|array',
            'cover_image' => ($id ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,webp|max:2048', // Oluştururken zorunlu
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:50048',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'benefits' => 'nullable|array',
            'support_items' => 'nullable|array',
            'faqs' => 'nullable|array',
        ];

        // Diğer dillerin başlıkları opsiyonel
        foreach ($languageCodes as $code) {
            $rules["title.{$code}"] = 'nullable|string|max:255';
        }

        return $request->validate($rules);
    }

    /**
     * Hem store hem de update için repeater ve resim verilerini işler.
     */
    private function handleServiceData(array &$validatedData, Request $request, ?Service $service = null): void
    {
        // Repeater'lardan gelen boş satırları temizle
        $validatedData['benefits'] = array_values(array_filter($validatedData['benefits'] ?? [], function($item) {
            return !empty($item['text']) && array_filter($item['text']);
        }));

        $validatedData['support_items'] = array_values(array_filter($validatedData['support_items'] ?? [], function($item) {
            return !empty($item['text']) && array_filter($item['text']);
        }));

        $validatedData['faqs'] = array_values(array_filter($validatedData['faqs'] ?? [], function($item) {
            return (!empty($item['question']) && array_filter($item['question'])) ||
                (!empty($item['answer']) && array_filter($item['answer']));
        }));

        // Kapak Resmi Yükleme
        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $this->uploadImage($request, 'cover_image', 'uploads/services', $service->cover_image ?? null);
        }

        // Galeri Resimleri Yükleme
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
}
