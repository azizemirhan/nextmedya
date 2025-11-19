<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class StorageProfile extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'disk', 'driver', 'base_url', 'bucket', 'region', 'endpoint',
        'use_signed_urls', 'signed_url_ttl', 'is_default', 'extra'
    ];


    protected $casts = [
        'use_signed_urls' => 'boolean',
        'is_default' => 'boolean',
        'signed_url_ttl' => 'integer',
        'extra' => 'array',
    ];


    public function galleries()
    {
        return $this->hasMany(Media::class);
    }
}
