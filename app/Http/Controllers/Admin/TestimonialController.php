<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class TestimonialController extends Controller
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

    public function index(Request $request)
    {
        $q = Testimonial::query();

        // Arama: TR/EN JSON path'lerinde isim, şirket, içerik
        if ($s = $request->get('s')) {
            $q->where(function ($qq) use ($s) {
                $qq->where('name->tr', 'like', "%{$s}%")
                    ->orWhere('name->en', 'like', "%{$s}%")
                    ->orWhere('company->tr', 'like', "%{$s}%")
                    ->orWhere('company->en', 'like', "%{$s}%")
                    ->orWhere('content->tr', 'like', "%{$s}%")
                    ->orWhere('content->en', 'like', "%{$s}%");
            });
        }

        // Aktif/pasif filtre
        if ($request->filled('is_active')) {
            $q->where('is_active', (bool)$request->boolean('is_active'));
        }

        // Önce manual sıralama, sonra en yeni
        $testimonials = $q->orderBy('order')->latest()->paginate(15);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $testimonial = new Testimonial();
        // Aktif dilleri alıp view'e gönderiyoruz.
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.testimonials.create', compact('testimonial', 'activeLanguages'));
    }
    public function store(TestimonialRequest $request)
    {
        $data = $request->validated();

        // Zorunlu avatar (create): Trait yükler, relative path döndürür
        $data['image_path'] = $this->uploadImage($request, 'image', 'uploads/testimonials');

        // Switch
        $data['is_active'] = $request->boolean('is_active');

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Görüş başarıyla eklendi.');
    }

    public function edit(Testimonial $testimonial)
    {
        // Aktif dilleri alıp view'e gönderiyoruz.
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.testimonials.edit', compact('testimonial', 'activeLanguages'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->validated();

        // Avatar değiştiyse: eskiyi silerek yenisini yükle
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->uploadImage(
                $request,
                'image',
                'uploads/testimonials',
                $testimonial->image_path // Trait içi eski dosyayı siler
            );
        }

        $data['is_active'] = $request->boolean('is_active');

        $testimonial->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Görüş güncellendi.');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Önce dosyayı temizle, sonra kaydı sil
        $this->deleteImage($testimonial->image_path);
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Görüş silindi.');
    }
}
