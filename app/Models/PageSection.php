<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    /**
     * Mass assignment için doldurulabilir alanlar.
     */
    protected $fillable = [
        'page_id',
        'section_key',
        'content',
        'order',
        'is_active', // EKLENDİ
    ];

    /**
     * Belirtilen sütunların veri tiplerini otomatik olarak dönüştürür.
     * Bu, hatanın çözümüdür.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array', // Bu satır, veritabanındaki JSON'ı otomatik olarak PHP dizisine çevirir.
    ];

    /**
     * Sayfa ile olan ilişkiyi tanımlar.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
