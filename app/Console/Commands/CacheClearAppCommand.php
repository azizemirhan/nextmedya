<?php

namespace App\Console\Commands;

use App\Services\CacheService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheClearAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-app 
                            {--menu : Sadece menü cache\'lerini temizle}
                            {--sidebar : Sadece sidebar cache\'lerini temizle}
                            {--settings : Sadece settings cache\'ini temizle}
                            {--content : Sadece içerik (posts, pages, services) cache\'lerini temizle}
                            {--all : Tüm uygulama cache\'lerini temizle (varsayılan)}
                            {--warm : Temizledikten sonra yeniden ısıt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uygulama cache\'lerini temizler (Laravel\'in kendi cache\'ini değil)';

    /**
     * Execute the console command.
     */
    public function handle(CacheService $cacheService): int
    {
        $this->info('🧹 Cache temizleme başlatılıyor...');
        $this->newLine();

        $clearMenu = $this->option('menu');
        $clearSidebar = $this->option('sidebar');
        $clearSettings = $this->option('settings');
        $clearContent = $this->option('content');
        $clearAll = $this->option('all') || (!$clearMenu && !$clearSidebar && !$clearSettings && !$clearContent);
        $shouldWarm = $this->option('warm');

        // Menü cache'lerini temizle
        if ($clearAll || $clearMenu) {
            $this->line('📍 Menü cache\'leri temizleniyor...');
            $cacheService->clearMenu();
            $this->info('   ✅ Menü cache\'leri temizlendi');
        }

        // Sidebar cache'lerini temizle
        if ($clearAll || $clearSidebar) {
            $this->line('📍 Sidebar cache\'leri temizleniyor...');
            $cacheService->clearSidebar();
            $this->info('   ✅ Sidebar cache\'leri temizlendi');
        }

        // Settings cache'ini temizle
        if ($clearAll || $clearSettings) {
            $this->line('📍 Settings cache\'i temizleniyor...');
            $cacheService->clearSettings();
            $this->info('   ✅ Settings cache\'i temizlendi');
        }

        // Content cache'lerini temizle
        if ($clearAll || $clearContent) {
            $this->line('📍 Content cache\'leri temizleniyor...');
            $cacheService->clearContent();
            $this->info('   ✅ Content cache\'leri temizlendi');
        }

        $this->newLine();
        $this->info('🎉 Cache temizleme tamamlandı!');

        // Warm seçeneği varsa cache'leri yeniden ısıt
        if ($shouldWarm) {
            $this->newLine();
            $this->call('cache:warm');
        }

        return Command::SUCCESS;
    }
}
