<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\UploadedFile;

trait ImageUploadTrait
{
    /**
     * Gelen isteği ve dosya bilgilerini kullanarak dosyayı 'public' klasörüne taşır ve WebP'ye dönüştürür.
     *
     * @param Request $request
     * @param string $fieldName Formdaki input adı (örn: 'featured_image')
     * @param string $directory Public klasörü altındaki hedef dizin (örn: 'uploads/posts')
     * @param string|null $existingImagePath Veritabanında kayıtlı eski dosya yolu
     * @return string|null Kaydedilen dosyanın public yolu veya mevcut yol
     */
    public function uploadImage(Request $request, $fieldName, $directory, $existingImagePath = null)
    {
        if ($request->hasFile($fieldName)) {
            // Eğer mevcut bir resim varsa, önce sunucudan onu sil
            if ($existingImagePath) {
                $this->deleteImage($existingImagePath);
            }

            $file = $request->file($fieldName);
            return $this->processAndSaveImage($file, $directory);
        }

        // Yeni resim yüklenmediyse mevcut yolu koru
        return $existingImagePath;
    }

    /**
     * Public klasöründen belirtilen yoldaki dosyayı siler.
     *
     * @param string|null $path
     */
    public function deleteImage($path)
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    /**
     * Tek bir dosya nesnesini yükler ve WebP'ye dönüştürür.
     *
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    public function uploadSingleFile($file, $path): string
    {
        return $this->processAndSaveImage($file, $path);
    }

    /**
     * Upload helper for localized files or direct file uploads
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $namePrefix
     * @return string
     */
    public function uploadFile($file, $directory, $namePrefix = null): string
    {
        return $this->processAndSaveImage($file, $directory, $namePrefix);
    }

    protected function uploadLocalizedSet(Request $request, string $baseDir, string $uid, array $fieldNames): array
    {
        $out = [];
        foreach ($fieldNames as $field) {
            foreach (['tr', 'en'] as $lang) {
                $key = "files.$uid.$field.$lang";
                if ($request->hasFile($key)) {
                    $out[$field][$lang] = $this->uploadFile($request->file($key), $baseDir, $field . '_' . $lang);
                }
            }
        }
        return $out;
    }

    protected function uploadLocalizedLegacy(Request $request, string $baseDir, array $fieldNames): array
    {
        $out = [];
        foreach ($fieldNames as $field) {
            foreach (['tr', 'en'] as $lang) {
                $key = "$field.$lang";
                if ($request->hasFile($key)) {
                    $out[$field][$lang] = $this->uploadFile($request->file($key), $baseDir, $field . '_' . $lang);
                }
            }
        }
        return $out;
    }

    /**
     * Core logic to process image: Resize -> Convert to WebP -> Save
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $namePrefix
     * @return string
     */
    private function processAndSaveImage(UploadedFile $file, string $directory, $namePrefix = null): string
    {
        // Klasör yoksa oluştur
        if (!file_exists(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        // Dosya adı oluşturma
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($namePrefix ? $namePrefix . '_' . $originalName : $originalName);
        $fileName = time() . '_' . $safeName . '.webp';
        
        $targetPath = public_path($directory . '/' . $fileName);

        // Intervention Image ile oku
        $image = Image::read($file);

        // Max genişlik 1920px olacak şekilde boyutlandır (oranı koruyarak)
        if ($image->width() > 1920) {
            $image->scaleDown(width: 1920);
        }

        // WebP formatında kaydet (Kalite: 80)
        $image->toWebp(quality: 80)->save($targetPath);

        return $directory . '/' . $fileName;
    }
}
