<?php
namespace App\Providers;

use App\Models\Board;
use App\Models\Permission;
use App\Policies\BoardPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Board::class => BoardPolicy::class,
    ];

    public function boot(): void
    {
        // Önce tüm Gate ve Policy'leri kaydet
        $this->registerPolicies();

        // Super Admin Kuralı: Bu role sahip kullanıcılar TÜM izinlere sahip sayılır.
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super-admin')) {
                return true;
            }
        });

        // Veritabanındaki tüm izinleri dinamik olarak Gate'e tanımla
        try {
            Permission::all()->each(function ($permission) {
                Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission->slug);
                });
            });
        } catch (\Exception $e) {
            // Migration çalışmadığında hata vermemesi için
        }
    }
}
