<?php

namespace App\Console\Commands;

use App\Services\CacheService;
use Illuminate\Console\Command;

class CacheWarmCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm 
                            {--menu : Sadece menü cache\'lerini ısıt}
                            {--sidebar : Sadece sidebar cache\'lerini ısıt}
                            {--settings : Sadece settings cache\'ini ısıt}
                            {--all : Tüm cache\'leri ısıt (varsayılan)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uygulama cache\'lerini önceden ısıtır (warm up)';

    /**
     * Execute the console command.
     */
    public function handle(CacheService $cacheService): int
    {
        $this->info('🔥 Cache warming başlatılıyor...');
        $this->newLine();

        $warmMenu = $this->option('menu');
        $warmSidebar = $this->option('sidebar');
        $warmSettings = $this->option('settings');
        $warmAll = $this->option('all') || (!$warmMenu && !$warmSidebar && !$warmSettings);

        $results = [];

        // Menü cache'lerini ısıt
        if ($warmAll || $warmMenu) {
            $this->line('📍 Menü cache\'leri ısıtılıyor...');
            $results['menu'] = $cacheService->warmMenu();
            $this->info($results['menu'] ? '   ✅ Menü cache\'leri ısıtıldı' : '   ❌ Menü cache warming başarısız');
        }

        // Sidebar cache'lerini ısıt
        if ($warmAll || $warmSidebar) {
            $this->line('📍 Sidebar cache\'leri ısıtılıyor...');
            $results['sidebar'] = $cacheService->warmSidebar();
            $this->info($results['sidebar'] ? '   ✅ Sidebar cache\'leri ısıtıldı' : '   ❌ Sidebar cache warming başarısız');
        }

        // Settings cache'ini ısıt
        if ($warmAll || $warmSettings) {
            $this->line('📍 Settings cache\'i ısıtılıyor...');
            $results['settings'] = $cacheService->warmSettings();
            $this->info($results['settings'] ? '   ✅ Settings cache\'i ısıtıldı' : '   ❌ Settings cache warming başarısız');
        }

        $this->newLine();

        // Sonuç özeti
        $successCount = count(array_filter($results));
        $totalCount = count($results);

        if ($successCount === $totalCount) {
            $this->info("🎉 Tüm cache'ler başarıyla ısıtıldı! ({$successCount}/{$totalCount})");
            return Command::SUCCESS;
        } elseif ($successCount > 0) {
            $this->warn("⚠️  Bazı cache'ler ısıtılamadı. ({$successCount}/{$totalCount})");
            return Command::FAILURE;
        } else {
            $this->error("❌ Cache warming tamamen başarısız oldu.");
            return Command::FAILURE;
        }
    }
}
