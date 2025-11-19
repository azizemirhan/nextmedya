<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Media extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['title', 'alt', 'caption', 'tags'];

    protected $table = 'media';
    protected $fillable = [
        'uuid',
        'filename',
        'path',
        'disk',
        'storage_profile_id',
        'folder_id',
        'folder_path',
        'extension',
        'mime',
        'type',
        'size_bytes',
        'width',
        'height',
        'duration_ms',
        'orientation',
        'checksum_sha256',
        'visibility',
        'status',
        'is_active',
        'is_favorite',
        'order',
        'title',
        'alt',
        'caption',
        'tags',
        'variants',
        'exif',
        'dominant_color',
        'url',
        'cdn_url',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'title' => 'array',
        'alt' => 'array',
        'caption' => 'array',
        'tags' => 'array',
        'variants' => 'array',
        'exif' => 'array',
        'is_active' => 'boolean',
        'is_favorite' => 'boolean',
        'width' => 'integer',
        'height' => 'integer',
        'size_bytes' => 'integer',
        'duration_ms' => 'integer',
        'order' => 'integer',
    ];

    protected $dates = [
        'deleted_at',
    ];

    // Relationships
    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }

    public function storageProfile()
    {
        return $this->belongsTo(StorageProfile::class, 'storage_profile_id');
    }

    public function collections()
    {
        return $this->belongsToMany(GalleryCollection::class, 'gallery_collection_media', 'media_id', 'collection_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
