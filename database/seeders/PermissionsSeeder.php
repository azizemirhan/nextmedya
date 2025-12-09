<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Önceki rolleri ve izinleri temizle
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('role_user')->truncate();
        Permission::truncate();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        // İzinleri (Permissions) Tanımla
        $permissions = [
            'view_admin' => 'Admin Panelini Görüntüleme',

            // Posts
            'view_posts' => 'Yazıları Görüntüleme',
            'add_posts' => 'Yazı Ekleme',
            'edit_posts' => 'Yazı Düzenleme',
            'delete_posts' => 'Yazı Silme',

            // Categories
            'view_categories' => 'Kategorileri Görüntüleme',
            'add_categories' => 'Kategori Ekleme',
            'edit_categories' => 'Kategori Düzenleme',
            'delete_categories' => 'Kategori Silme',

            // Pages
            'view_pages' => 'Sayfaları Görüntüleme',
            'add_pages' => 'Sayfa Ekleme',
            'edit_pages' => 'Sayfa Düzenleme',
            'delete_pages' => 'Sayfa Silme',

            // Sliders
            'view_sliders' => 'Slider Görüntüleme',
            'add_sliders' => 'Slider Ekleme',
            'edit_sliders' => 'Slider Düzenleme',
            'delete_sliders' => 'Slider Silme',

            // Services
            'view_services' => 'Hizmetleri Görüntüleme',
            'add_services' => 'Hizmet Ekleme',
            'edit_services' => 'Hizmet Düzenleme',
            'delete_services' => 'Hizmet Silme',

            // Projects
            'view_projects' => 'Projeleri Görüntüleme',
            'add_projects' => 'Proje Ekleme',
            'edit_projects' => 'Proje Düzenleme',
            'delete_projects' => 'Proje Silme',

            // Testimonials
            'view_testimonials' => 'Müşteri Yorumlarını Görüntüleme',
            'add_testimonials' => 'Müşteri Yorumu Ekleme',
            'edit_testimonials' => 'Müşteri Yorumu Düzenleme',
            'delete_testimonials' => 'Müşteri Yorumu Silme',

            // Features
            'view_features' => 'Özellikleri Görüntüleme',
            'add_features' => 'Özellik Ekleme',
            'edit_features' => 'Özellik Düzenleme',
            'delete_features' => 'Özellik Silme',

            // Statistics
            'view_statistics' => 'İstatistikleri Görüntüleme',
            'add_statistics' => 'İstatistik Ekleme',
            'edit_statistics' => 'İstatistik Düzenleme',
            'delete_statistics' => 'İstatistik Silme',

            // Users
            'view_users' => 'Kullanıcıları Görüntüleme',
            'add_users' => 'Kullanıcı Ekleme',
            'edit_users' => 'Kullanıcı Düzenleme',
            'delete_users' => 'Kullanıcı Silme',

            // Roles
            'view_roles' => 'Rolleri Görüntüleme',
            'add_roles' => 'Rol Ekleme',
            'edit_roles' => 'Rol Düzenleme',
            'delete_roles' => 'Rol Silme',

            // Settings
            'manage_settings' => 'Site Ayarlarını Yönetme',
            'manage_menus' => 'Menüleri Yönetme',
        ];

        foreach ($permissions as $key => $value) {
            Permission::create([
                'name' => $value,
                'slug' => $key,
            ]);
        }

        // Rolleri (Roles) Oluştur
        $superAdminRole = Role::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin'
        ]);

        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'admin'
        ]);

        // Super Admin'e tüm izinleri ata
        $allPermissions = Permission::pluck('id');
        $superAdminRole->permissions()->attach($allPermissions);

        // Admin rolüne belirli izinleri ata
        $adminPermissions = Permission::whereNotIn('slug', [
            'view_users', 'add_users', 'edit_users', 'delete_users',
            'view_roles', 'add_roles', 'edit_roles', 'delete_roles',
            'manage_settings'
        ])->pluck('id');
        $adminRole->permissions()->attach($adminPermissions);

        // İlk kullanıcıyı Super Admin yap
        $user = User::first();
        if ($user) {
            $user->roles()->attach($superAdminRole->id);
        }
    }
}
