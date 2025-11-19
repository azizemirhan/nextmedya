<?php

namespace App\Jobs;


use App\Models\Media;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;


class ExtractExifAndPalette implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(public Media $media)
    {
    }


    public function handle(): void
    {
        $g = $this->media->fresh();
        if (!$g || $g->type !== 'image') return;
        $disk = $g->disk ?: 'public';
        if (!Storage::disk($disk)->exists($g->path)) return;


        $meta = $g->exif ?? [];
        try {
            if (function_exists('exif_read_data')) {
                $stream = Storage::disk($disk)->readStream($g->path);
                if ($stream) {
// exif_read_data stream desteklemeyebilir; bu nedenle geçici dosya kullanın
                    $tmp = tempnam(sys_get_temp_dir(), 'exif_');
                    file_put_contents($tmp, stream_get_contents($stream));
                    $meta = @exif_read_data($tmp) ?: [];
                    @unlink($tmp);
                }
            }
        } catch (\Throwable $e) {
        }


// Basit palet çıkarımı placeholder (gelişmiş için league/color-extractor)
        $palette = $g->palette ?? [];


        $g->exif = $meta;
        $g->palette = $palette;
        $g->save();
    }
}
