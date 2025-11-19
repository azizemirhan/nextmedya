<?php

namespace App\Jobs;


use App\Models\Media;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class GenerateMediaVariants implements ShouldQueue
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

        $variants = $g->variants ?? [];
        $cfg = config('media.variants');
        $raw = Storage::disk($disk)->get($g->path);
        $jpegQ = 85; // kalite parametresi; isterseniz config'e taşıyın

        // 1) JPEG varyantları (thumb/small/medium/large)
        foreach (['thumb', 'small', 'medium', 'large'] as $key) {
            if (!isset($cfg[$key])) continue;

            $w = (int)($cfg[$key]['w'] ?? 0);
            $h = (int)($cfg[$key]['h'] ?? 0);
            $fit = $cfg[$key]['fit'] ?? 'contain';

            // Her varyant için orijinalden yeni bir Image instance
            $img = Image::read($raw);

            if ($fit === 'cover') {
                $img->cover($w, $h);
            } else {
                // contain benzeri; orana sadık kalarak maksimum W/H’e küçült
                $img->scaleDown($w, $h);
            }

            $target = self::targetPath($g->path, "-{$key}"); // .jpg uzantısı korunur
            // Boyutları dosyaya yazmadan önce okuyalım
            $vw = $img->width();
            $vh = $img->height();

            Storage::disk($disk)->put($target, (string)$img->toJpeg($jpegQ));

            $variants[$key] = [
                'path' => $target,
                'w' => $vw,
                'h' => $vh,
                'mime' => 'image/jpeg',
            ];
            unset($img);
        }

        // 2) Opsiyonel WEBP büyük varyant
        if (!empty($cfg['webp'])) {
            $img = Image::read($raw)->scaleDown(1600, 1600);
            $vw = $img->width();
            $vh = $img->height();

            $targetBase = self::targetPath($g->path, '-1600w');
            $targetWebp = $targetBase . '.webp';

            Storage::disk($disk)->put($targetWebp, (string)$img->toWebp(82));

            $variants['webp_1600'] = [
                'path' => $targetWebp,
                'w' => $vw,
                'h' => $vh,
                'mime' => 'image/webp',
            ];
            unset($img);
        }

        $g->variants = $variants;
        $g->save();
    }

    protected static function targetPath(string $path, string $suffix): string
    {
        $extPos = strrpos($path, '.');
        if ($extPos === false) return $path . $suffix;
        return substr($path, 0, $extPos) . $suffix . substr($path, $extPos);
    }
}
