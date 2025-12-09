<?php

namespace App\Services;


use App\Models\Media;
use App\Models\StorageProfile;
use Illuminate\Support\Facades\Storage;


class MediaUrlService
{
    public static function hydrateCdnUrl(Media $g): Media
    {
        $profile = $g->storageProfile; if(!$profile) return $g;
        if($profile->base_url){ $g->cdn_url = rtrim($profile->base_url,'/').'/'.ltrim($g->path,'/'); }
        return $g;
    }


    public static function temporaryUrl(Media $g, ?int $ttl = null): ?string
    {
        $profile = $g->storageProfile; if(!$profile) return $g->url;
        $disk = $g->disk ?: ($profile->disk ?? 'public');
        $ttl = $ttl ?: ($profile->signed_url_ttl ?: config('media.signed_urls.default_ttl'));
        try { return Storage::disk($disk)->temporaryUrl($g->path, now()->addSeconds($ttl)); }
        catch(\Throwable $e){ return $g->url; }
    }
}
