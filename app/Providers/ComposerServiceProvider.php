<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 'admin.' ile başlayan TÜM view dosyalarına bu veriyi otomatik olarak gönder.
        View::composer('admin.*', function ($view) {
            if (auth('admin')->check()) {
                $loggedInUser = auth('admin')->user()->load('roles'); // 'roles' ilişkisini eager load yap
                $view->with('loggedInUser', $loggedInUser);
            }
        });
    }
}
