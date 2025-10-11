<?php

namespace App\Observers;


use App\Models\Media;
use Illuminate\Support\Facades\Storage;


class GalleryObserver
{
    public function forceDeleted(Media $g): void
    {
        $disk = $g->disk ?: 'public';
// ana dosya
        if($g->path && Storage::disk($disk)->exists($g->path)){
            Storage::disk($disk)->delete($g->path);
        }
// varyantlar
        foreach(($g->variants ?? []) as $key => $v){
            if(is_array($v) && !empty($v['path']) && Storage::disk($disk)->exists($v['path'])){
                Storage::disk($disk)->delete($v['path']);
            }
        }
    }
}
