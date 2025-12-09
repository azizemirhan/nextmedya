<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUploadTrait;

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
    public function index()
    {
        $sliders = Slider::query()
            // Arama parametresi 'q' varsa başlıkta ara
            ->when(request('q'), function ($query, $q) {
                // 'title' JSON olduğu için ham arama yapıyoruz.
                // Daha gelişmiş arama için: ->where('title->tr', 'like', "%{$q}%")
                return $query->where('title', 'like', "%{$q}%");
            })
            // Durum filtresi 'status' varsa uygula
            ->when(request()->filled('status'), function ($query) {
                return $query->where('is_active', request('status'));
            })
            ->orderBy('order') // Sıralamaya göre getir
            ->paginate(10); // Sonuçları sayfalara böl

        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Yeni slider oluşturma formunu gösterir.
     */
    public function create()
    {
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.sliders.create', compact('activeLanguages'));
    }
    /**
     * Yeni slider'ı veritabanına kaydeder.
     */
    public function store(Request $request)
    {
        $activeLanguages = $this->getActiveLanguages();
        $languageCodes = array_keys($activeLanguages);
        $firstLanguage = $languageCodes[0] ?? 'tr';

        // Dinamik validasyon kuralları
        $validationRules = [
            'title' => 'required|array',
            "title.{$firstLanguage}" => 'required|string|max:255',
            'subtitle' => 'nullable|array',
            'button_text' => 'nullable|array',
            'button_url' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'order' => 'required|integer',
            'is_active' => 'nullable',
        ];

        $validatedData = $request->validate($validationRules);

        $slider = new Slider;
        $slider->setTranslations('title', $validatedData['title']);
        $slider->setTranslations('subtitle', $validatedData['subtitle'] ?? []);
        $slider->setTranslations('button_text', $validatedData['button_text'] ?? []);
        $slider->button_url = $validatedData['button_url'];
        $slider->order = $validatedData['order'];
        $slider->is_active = $request->has('is_active');
        $slider->image_path = $this->uploadImage($request, 'image', 'uploads/sliders');
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider başarıyla oluşturuldu.');
    }
    /**
     * Belirtilen slider'ı düzenleme formunu gösterir.
     */
    public function edit(Slider $slider)
    {
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.sliders.edit', compact('slider', 'activeLanguages'));
    }

    /**
     * Belirtilen slider'ı günceller.
     */
    public function update(Request $request, Slider $slider)
    {
        $activeLanguages = $this->getActiveLanguages();
        $languageCodes = array_keys($activeLanguages);

        // Dinamik validasyon kuralları
        $validationRules = [
            'title' => 'required|array',
            "title.*" => 'required|string|max:255',
            'subtitle' => 'nullable|array',
            "subtitle.*" => 'required|string|max:255',
            'button_text' => 'nullable|array',
            'button_text.*' => 'required|string|max:255',
            'button_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:50048',
            'order' => 'required|integer',
            'is_active' => 'nullable',
        ];

        $validatedData = $request->validate($validationRules);

        $slider->setTranslations('title', $validatedData['title']);
        $slider->setTranslations('subtitle', $validatedData['subtitle'] ?? []);
        $slider->setTranslations('button_text', $validatedData['button_text'] ?? []);
        $slider->button_url = $validatedData['button_url'];
        $slider->order = $validatedData['order'];
        $slider->is_active = $request->has('is_active');
        if ($request->hasFile('image')) {
            $slider->image_path = $this->uploadImage($request, 'image', 'uploads/sliders', $slider->image_path);
        }
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider başarıyla güncellendi.');
    }
    /**
     * Belirtilen slider'ı siler.
     */
    public function destroy(Slider $slider)
    {
        // Resim sunucuda kalır, sadece kayıt çöpe taşınır.
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider çöpe taşındı.');
    }
    // ... destroy metodundan sonra ...

    /**
     * Çöpe atılmış slider'ları listeler.
     */
    public function trash()
    {
        $sliders = Slider::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);

        return view('admin.sliders.trash', compact('sliders'));
    }

    /**
     * Çöpe atılmış bir slider'ı geri yükler.
     *
     * @param  int  $id
     */
    public function restore($id)
    {
        $slider = Slider::onlyTrashed()->findOrFail($id);
        $slider->restore();

        return redirect()->route('admin.sliders.trash')->with('success', 'Slider başarıyla geri yüklendi.');
    }

    /**
     * Bir slider'ı kalıcı olarak siler.
     *
     * @param  int  $id
     */
    public function forceDelete($id)
    {
        $slider = Slider::onlyTrashed()->findOrFail($id);

        // Kalıcı olarak silmeden önce ilişkili resmi de sunucudan sil.
        $this->deleteImage($slider->image_path);

        $slider->forceDelete();

        return redirect()->route('admin.sliders.trash')->with('success', 'Slider kalıcı olarak silindi.');
    }
}
