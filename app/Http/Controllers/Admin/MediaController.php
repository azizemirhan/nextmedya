<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaUploadRequest;
use App\Http\Requests\MediaUpdateRequest;
use App\Jobs\ExtractExifAndPalette;
use App\Jobs\GenerateMediaVariants;
use App\Models\Media;
use App\Models\GalleryCollection;
use App\Models\MediaFolder;
use App\Models\StorageProfile;
use App\Services\MediaUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class MediaController extends Controller
{
    /**
     * Medya listesi - view veya JSON döndürür
     */
    public function index(Request $request)
    {
        // Eğer tarayıcıdan normal bir GET isteği geliyorsa view döndür
        // Ajax veya JSON bekleyen istekler için veri döndür
        if (!$request->ajax() && !$request->wantsJson()) {
            return view('admin.media.index');
        }

        // API response için veri hazırla
        $query = Media::query();

        // Filtreleme
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('filename', 'like', "%{$search}%")
                    ->orWhereJsonContains('title', $search)
                    ->orWhereJsonContains('alt', $search)
                    ->orWhereJsonContains('tags', $search);
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('folder_id')) {
            $query->where('folder_id', $request->input('folder_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->boolean('favorites_only')) {
            $query->where('is_favorite', true);
        }

        // Sıralama
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        if (in_array($sortBy, ['created_at', 'updated_at', 'size_bytes', 'filename', 'order'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Sayfalama
        $perPage = $request->input('per_page', 24);
        $media = $query->with(['folder', 'storageProfile'])->paginate($perPage);

        // URL'leri hidrate et
        $media->getCollection()->transform(function ($item) {
            return MediaUrlService::hydrateCdnUrl($item);
        });

        return response()->json($media);
    }

    /**
     * API için medya listesi
     */
    public function apiList(Request $request)
    {
        $query = Media::query();

        // Filtreleme
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('filename', 'like', "%{$search}%")
                    ->orWhereJsonContains('title', $search)
                    ->orWhereJsonContains('alt', $search)
                    ->orWhereJsonContains('tags', $search);
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('folder_id')) {
            $query->where('folder_id', $request->input('folder_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->boolean('favorites_only')) {
            $query->where('is_favorite', true);
        }

        // Sıralama
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        if (in_array($sortBy, ['created_at', 'updated_at', 'size_bytes', 'filename', 'order'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Sayfalama
        $perPage = $request->input('per_page', 24);
        $media = $query->with(['folder', 'storageProfile'])->paginate($perPage);

        // URL'leri hidrate et
        $media->getCollection()->transform(function ($item) {
            return MediaUrlService::hydrateCdnUrl($item);
        });

        return response()->json($media);
    }

    /**
     * Tek medya detayı
     */
    public function show($id)
    {
        $media = Media::with(['folder', 'storageProfile', 'collections'])->findOrFail($id);
        $media = MediaUrlService::hydrateCdnUrl($media);

        // İlişkili medyalar (aynı klasördeki diğerleri)
        $related = Media::where('folder_id', $media->folder_id)
            ->where('id', '!=', $media->id)
            ->limit(12)
            ->get();

        return response()->json([
            'media' => $media,
            'related' => $related,
            'variants' => $media->variants ?? [],
            'exif' => $media->exif ?? [],
        ]);
    }

    /**
     * Dosya yükleme
     */
    /**
     * Dosya yükleme
     */
    public function upload(MediaUploadRequest $request)
    {
        try {
            DB::beginTransaction();

            $uploadedFiles = [];
            $files = $request->file('files');

            if (!$files || !is_array($files)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dosya bulunamadı.',
                ], 400);
            }

            $folderPath = $request->input('folder', 'uploads');
            $autoWebp = $request->boolean('auto_webp', false);

            // Public klasörü altında tam yol
            $publicPath = public_path($folderPath);

            // Klasör yoksa oluştur
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            // Klasör kontrolü
            $folder = $this->ensureFolder($folderPath);

            foreach ($files as $file) {
                if (!$file || !$file->isValid()) {
                    continue;
                }

                // Benzersiz dosya adı
                $originalName = $file->getClientOriginalName();
                $extension = strtolower($file->getClientOriginalExtension());
                $filename = $this->generateUniqueFilename($originalName, $extension);

                // Dosya tipini tespit et (move'dan ÖNCE)
                $type = $this->detectType($file);
                $mimeType = $file->getMimeType();
                $fileSize = $file->getSize();

                // Resim boyutlarını al (move'dan ÖNCE)
                $dimensions = $this->getImageDimensions($file, $type);

                // Checksum hesapla (move'dan ÖNCE)
                $checksum = hash_file('sha256', $file->getRealPath());

                // Dosyayı public klasörüne taşı
                $file->move($publicPath, $filename);

                // Veritabanı için relative path
                $relativePath = trim($folderPath, '/') . '/' . $filename;

                // Video süresi (artık dosya yeni konumda)
                $duration = null;
                if ($type === 'video') {
                    $duration = $this->getVideoDuration(public_path($relativePath));
                }

                // Veritabanına kaydet
                $media = Media::create([
                    'uuid' => Str::uuid(),
                    'filename' => $filename,
                    'path' => $relativePath,
                    'disk' => 'public',
                    'storage_profile_id' => null,
                    'folder_id' => $folder?->id,
                    'folder_path' => $folderPath,
                    'extension' => $extension,
                    'mime' => $mimeType,
                    'type' => $type,
                    'size_bytes' => $fileSize,
                    'width' => $dimensions['width'] ?? null,
                    'height' => $dimensions['height'] ?? null,
                    'duration_ms' => $duration,
                    'orientation' => $this->getOrientation($dimensions),
                    'checksum_sha256' => $checksum,
                    'visibility' => 'public',
                    'status' => 'active',
                    'is_active' => true,
                    'is_favorite' => false,
                    'order' => 0,
                    'title' => ['tr' => pathinfo($originalName, PATHINFO_FILENAME)],
                    'alt' => ['tr' => ''],
                    'caption' => ['tr' => ''],
                    'tags' => [],
                    'created_by' => auth()->id(),
                ]);

                // URL'leri set et
                $this->setMediaUrls($media);

                // Resim işlemleri (artık dosya yeni konumda)
                if ($type === 'image') {
                    try {
                        GenerateMediaVariants::dispatch($media)->onQueue('media');
                        ExtractExifAndPalette::dispatch($media)->onQueue('media');
                    } catch (\Exception $e) {
                        \Log::warning('Media job error: ' . $e->getMessage());
                    }

                    if ($autoWebp) {
                        try {
                            $this->generateWebpVersion($media);
                        } catch (\Exception $e) {
                            \Log::warning('WebP generation failed: ' . $e->getMessage());
                        }
                    }

                    try {
                        $this->extractDominantColor($media);
                    } catch (\Exception $e) {
                        \Log::warning('Dominant color extraction failed: ' . $e->getMessage());
                    }
                }

                $uploadedFiles[] = $this->formatMediaResponse($media);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => count($uploadedFiles) . ' dosya başarıyla yüklendi.',
                'files' => $uploadedFiles,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Media upload error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except('files'),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Dosya yükleme hatası: ' . $e->getMessage(),
                'debug' => config('app.debug') ? $e->getTraceAsString() : null,
            ], 500);
        }
    }

    /**
     * Medya güncelleme
     */
    public function update(MediaUpdateRequest $request, $id)
    {
        $media = Media::findOrFail($id);

        $updateData = [];

        // Çok dilli alanlar
        foreach (['title', 'alt', 'caption', 'tags'] as $field) {
            if ($request->has($field)) {
                $updateData[$field] = $request->input($field);
            }
        }

        // Tekil alanlar
        if ($request->has('visibility')) {
            $updateData['visibility'] = $request->input('visibility');
        }

        if ($request->has('status')) {
            $updateData['status'] = $request->input('status');
            $updateData['is_active'] = $request->input('status') === 'active';
        }

        if ($request->has('is_favorite')) {
            $updateData['is_favorite'] = $request->boolean('is_favorite');
        }

        if (!empty($updateData)) {
            $updateData['updated_by'] = auth()->id();
            $media->update($updateData);
        }

        return response()->json([
            'success' => true,
            'message' => 'Medya güncellendi.',
            'media' => $this->formatMediaResponse($media->fresh()),
        ]);
    }

    /**
     * Toplu işlemler
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,archive,activate,favorite,unfavorite,move',
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:galleries,id',
            'folder_id' => 'required_if:action,move|exists:media_folders,id',
        ]);

        $action = $request->input('action');
        $ids = $request->input('ids');

        switch ($action) {
            case 'delete':
                Media::whereIn('id', $ids)->delete();
                $message = count($ids) . ' dosya silindi.';
                break;

            case 'archive':
                Media::whereIn('id', $ids)->update([
                    'status' => 'archived',
                    'is_active' => false,
                    'updated_by' => auth()->id(),
                ]);
                $message = count($ids) . ' dosya arşivlendi.';
                break;

            case 'activate':
                Media::whereIn('id', $ids)->update([
                    'status' => 'active',
                    'is_active' => true,
                    'updated_by' => auth()->id(),
                ]);
                $message = count($ids) . ' dosya aktifleştirildi.';
                break;

            case 'favorite':
                Media::whereIn('id', $ids)->update([
                    'is_favorite' => true,
                    'updated_by' => auth()->id(),
                ]);
                $message = count($ids) . ' dosya favorilere eklendi.';
                break;

            case 'unfavorite':
                Media::whereIn('id', $ids)->update([
                    'is_favorite' => false,
                    'updated_by' => auth()->id(),
                ]);
                $message = count($ids) . ' dosya favorilerden çıkarıldı.';
                break;

            case 'move':
                $folderId = $request->input('folder_id');
                $folder = MediaFolder::findOrFail($folderId);

                Media::whereIn('id', $ids)->update([
                    'folder_id' => $folderId,
                    'folder_path' => $folder->path,
                    'updated_by' => auth()->id(),
                ]);
                $message = count($ids) . ' dosya taşındı.';
                break;

            default:
                $message = 'Geçersiz işlem.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    /**
     * Medya silme
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Soft delete
        $media->deleted_by = auth()->id();
        $media->save();
        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dosya silindi.',
        ]);
    }

    /**
     * Kalıcı silme
     */
    public function forceDelete($id)
    {
        $media = Media::withTrashed()->findOrFail($id);

        // Fiziksel dosyayı sil
        if ($media->path && file_exists(public_path($media->path))) {
            unlink(public_path($media->path));
        }

        // Variant'ları da sil
        if ($media->variants) {
            foreach ($media->variants as $variant) {
                if (isset($variant['path']) && file_exists(public_path($variant['path']))) {
                    unlink(public_path($variant['path']));
                }
            }
        }

        $media->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Dosya kalıcı olarak silindi.',
        ]);
    }

    /**
     * Geçici URL oluştur
     */
    public function temporaryUrl($id)
    {
        $media = Media::findOrFail($id);

        $url = MediaUrlService::temporaryUrl($media);

        return response()->json([
            'url' => $url,
            'expires_in' => config('media.signed_urls.default_ttl'),
        ]);
    }

    /**
     * Klasörleri listele
     */
    public function folders(Request $request)
    {
        $folders = MediaFolder::withCount('galleries')
            ->when($request->filled('parent_id'), function ($query) use ($request) {
                $query->where('parent_id', $request->input('parent_id'));
            })
            ->orderBy('name')
            ->get();

        return response()->json($folders);
    }

    /**
     * Klasör oluştur
     */
    public function createFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:media_folders,id',
        ]);

        $parentPath = '';
        if ($request->filled('parent_id')) {
            $parent = MediaFolder::findOrFail($request->input('parent_id'));
            $parentPath = $parent->path . '/';
        }

        $slug = Str::slug($request->input('name'));
        $path = $parentPath . $slug;

        $folder = MediaFolder::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'parent_id' => $request->input('parent_id'),
            'path' => $path,
            'visibility' => 'public',
        ]);

        return response()->json([
            'success' => true,
            'folder' => $folder,
        ], 201);
    }

    /**
     * Koleksiyonlar
     */
    public function collections()
    {
        $collections = GalleryCollection::with('coverMedia')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($collections);
    }

    // ===== YARDIMCI METODLAR =====

    /**
     * Klasörü kontrol et ve oluştur
     */
    private function ensureFolder($path)
    {
        if (empty($path) || $path === '/' || $path === 'uploads') {
            return null;
        }

        $folder = MediaFolder::where('path', $path)->first();

        if (!$folder) {
            $parts = explode('/', trim($path, '/'));
            $name = end($parts);

            $folder = MediaFolder::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'path' => $path,
                'visibility' => 'public',
            ]);
        }

        return $folder;
    }

    /**
     * Benzersiz dosya adı oluştur
     */
    private function generateUniqueFilename($originalName, $extension)
    {
        $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
        $timestamp = now()->format('YmdHis');
        $random = Str::random(6);

        return "{$baseName}-{$timestamp}-{$random}.{$extension}";
    }

    /**
     * Dosya tipi tespiti
     */
    private function detectType($file)
    {
        if (is_string($file)) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return $this->detectTypeByStringExtension($extension);
        }

        $mimeType = $file->getMimeType();

        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        }

        if ($mimeType === 'application/pdf' || str_contains($mimeType, 'document')) {
            return 'document';
        }

        return 'other';
    }

    /**
     * String uzantısına göre tip tespiti
     */
    private function detectTypeByStringExtension($extension)
    {
        $typeMap = [
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp', 'ico', 'avif'],
            'video' => ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', '3gp'],
            'audio' => ['mp3', 'wav', 'ogg', 'flac', 'aac', 'wma', 'm4a'],
            'document' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt'],
        ];

        foreach ($typeMap as $type => $extensions) {
            if (in_array($extension, $extensions)) {
                return $type;
            }
        }

        return 'other';
    }

    /**
     * Resim boyutlarını al
     */
    private function getImageDimensions($file, $type)
    {
        if ($type !== 'image') {
            return ['width' => null, 'height' => null];
        }

        try {
            // Eğer $file bir UploadedFile nesnesi ise
            if (is_object($file) && method_exists($file, 'getRealPath')) {
                $image = Image::read($file->getRealPath());
            } else {
                // Eğer string path ise
                $image = Image::read($file);
            }

            return [
                'width' => $image->width(),
                'height' => $image->height(),
            ];
        } catch (\Exception $e) {
            \Log::warning('Image dimensions error: ' . $e->getMessage());
            return ['width' => null, 'height' => null];
        }
    }

    /**
     * Yönlendirmeyi belirle
     */
    private function getOrientation($dimensions)
    {
        if (!$dimensions['width'] || !$dimensions['height']) {
            return null;
        }

        $ratio = $dimensions['width'] / $dimensions['height'];

        if ($ratio > 1.2) {
            return 'landscape';
        } elseif ($ratio < 0.8) {
            return 'portrait';
        } else {
            return 'square';
        }
    }

    /**
     * Video süresi (milisaniye)
     */
    private function getVideoDuration($file)
    {
        // FFMpeg veya getID3 kullanarak süre alınabilir
        // Şimdilik null dönüyoruz
        return null;
    }

    /**
     * WebP versiyonu oluştur
     */
    private function generateWebpVersion($media)
    {
        try {
            $originalPath = public_path($media->path);

            if (!file_exists($originalPath)) {
                throw new \Exception("Original file not found: {$originalPath}");
            }

            $image = Image::read($originalPath);
            $webpContent = (string)$image->toWebp(85);

            $webpPath = str_replace(
                '.' . $media->extension,
                '.webp',
                $media->path
            );

            // WebP'yi public'e kaydet
            file_put_contents(public_path($webpPath), $webpContent);

            $variants = $media->variants ?? [];
            $variants['webp_original'] = [
                'path' => $webpPath,
                'w' => $image->width(),
                'h' => $image->height(),
                'mime' => 'image/webp',
            ];

            $media->variants = $variants;
            $media->save();

        } catch (\Exception $e) {
            \Log::warning('WebP generation error: ' . $e->getMessage());
        }
    }

    /**
     * Dominant renk çıkar
     */
    private function extractDominantColor($media)
    {
        try {
            $originalPath = public_path($media->path);

            if (!file_exists($originalPath)) {
                throw new \Exception("Original file not found: {$originalPath}");
            }

            $image = Image::read($originalPath);
            $image->resize(50, 50);

            // Basit dominant renk tespiti
            $media->dominant_color = '#' . substr(md5($media->filename), 0, 6);
            $media->save();

        } catch (\Exception $e) {
            \Log::warning('Dominant color error: ' . $e->getMessage());
        }
    }
    /**
     * Medya URL'lerini set et
     */
    /**
     * Medya URL'lerini set et
     */
    private function setMediaUrls($media)
    {
        // Public klasöründen URL oluştur
        $url = asset($media->path);

        $media->url = $url;
        $media->cdn_url = $url; // CDN kullanmıyorsanız aynı
        $media->save();
    }
    /**
     * Medya response formatı
     */
    /**
     * Medya response formatı
     */
    private function formatMediaResponse($media)
    {
        return [
            'id' => $media->id,
            'uuid' => $media->uuid,
            'filename' => $media->filename,
            'path' => $media->path,
            'url' => asset($media->path),
            'cdn_url' => $media->cdn_url ?? asset($media->path),
            'type' => $media->type,
            'mime' => $media->mime,
            'extension' => $media->extension,
            'size' => $this->formatFileSize($media->size_bytes),
            'size_bytes' => $media->size_bytes,
            'dimensions' => [
                'width' => $media->width,
                'height' => $media->height,
            ],
            'orientation' => $media->orientation,
            'title' => $media->title,
            'alt' => $media->alt,
            'is_favorite' => $media->is_favorite,
            'status' => $media->status,
            'created_at' => $media->created_at,
            'variants' => $media->variants ?? [],
        ];
    }

    /**
     * Dosya boyutunu formatla
     */
    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
