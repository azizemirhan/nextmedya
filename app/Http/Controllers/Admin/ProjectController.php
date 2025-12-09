<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
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
        $q = Project::query();

        if ($s = $request->get('s')) {
            $q->where(function ($qq) use ($s) {
                $qq->where('slug', 'like', "%{$s}%")
                    ->orWhere('title->tr', 'like', "%{$s}%")
                    ->orWhere('title->en', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status')) {
            $q->where('status', (int)$request->status);
        }
        if ($request->filled('is_featured')) {
            $q->where('is_featured', (bool)$request->is_featured);
        }

        $projects = $q->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $project = new Project();
        // Aktif dilleri alıp view'e gönderiyoruz.
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.projects.create', compact('project', 'activeLanguages'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        // Görsel yükleme
        if ($request->hasFile('image')) {
            // Yüklenen görselin yolunu 'image_path' anahtarına ata
            $data['image_path'] = $this->uploadImage($request, 'image', 'uploads/projects');
        }

        // Slug boş ise Türkçe başlığa göre oluştur
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']['tr'] ?? '');
        }

        // `is_featured` checkbox'ı işaretlenmemişse 0 olarak ayarla
        $data['is_featured'] = $request->has('is_featured');

        // 'image' anahtarını veriden kaldır (çünkü doğrulanan veri bir dosya objesi içeriyor)
        unset($data['image']);

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla oluşturuldu.');
    }

    public function edit(Project $project)
    {
        // Aktif dilleri alıp view'e gönderiyoruz.
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.projects.edit', compact('project', 'activeLanguages'));
    }


    // app/Http/Controllers/Admin/ProjectController.php




    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        // Görsel yükleme (TEK VE DOĞRU BLOK)
        if ($request->hasFile('image')) {
            // Yeni resmi yüklerken eski resmin yolunu da göndererek silinmesini sağla
            // Yüklenen görselin yolunu 'image_path' anahtarına ata
            $data['image_path'] = $this->uploadImage($request, 'image', 'uploads/projects', $project->image_path);
        }

        // `is_featured` checkbox'ı işaretlenmemişse 0, işaretlenmişse 1 olarak ayarla
        $data['is_featured'] = $request->has('is_featured');

        // 'image' anahtarını veriden kaldır
        unset($data['image']);

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla güncellendi.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Proje silindi.');
    }
}
