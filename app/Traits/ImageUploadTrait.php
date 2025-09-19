<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // Str::random() için eklendi

trait ImageUploadTrait
{
    /**
     * Gelen isteği ve dosya bilgilerini kullanarak dosyayı 'public' klasörüne taşır.
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
            // Benzersiz bir dosya adı oluşturuyoruz (örn: 164832482_benim-resmim.jpg)
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Dosyayı public klasörü içindeki hedef dizine taşı
            $file->move(public_path($directory), $fileName);

            // Veritabanına kaydedilecek olan yolu döndür (public_path olmadan)
            return $directory . '/' . $fileName;
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
        // Gelen yolun null veya boş olmadığını kontrol et
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}