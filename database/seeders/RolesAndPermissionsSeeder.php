<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Spatie paketine ait olan ve bizim sistemimizde gereksiz olan satır kaldırıldı.

        // --- ROLleri Oluştur ---
        $superAdminRole = Role::create(['name' => 'Super Admin', 'slug' => 'super-admin']);
        $memberRole = Role::create(['name' => 'Member', 'slug' => 'member']);

        // --- İZİNleri Oluştur ---
        Permission::create(['name' => 'Create Board', 'slug' => 'create-board']);
        Permission::create(['name' => 'Update Board', 'slug' => 'update-board']);
        Permission::create(['name' => 'Delete Board', 'slug' => 'delete-board']);

        Permission::create(['name' => 'Create List', 'slug' => 'create-list']);
        Permission::create(['name' => 'Update List', 'slug' => 'update-list']);
        Permission::create(['name' => 'Delete List', 'slug' => 'delete-list']);

        Permission::create(['name' => 'Create Task', 'slug' => 'create-task']);
        Permission::create(['name' => 'Update Task', 'slug' => 'update-task']);
        Permission::create(['name' => 'Delete Task', 'slug' => 'delete-task']);
        Permission::create(['name' => 'Assign Task', 'slug' => 'assign-task']);

        // --- İzinleri Rollere Ata ---
        // Member rolü sadece temel işlemleri yapabilsin
        $memberRole->permissions()->attach(
            Permission::whereIn('slug', [
                'create-list', 'create-task', 'update-task'
            ])->pluck('id')
        );

        // --- Kullanıcılara Rol Ata ---
        // 1. Super Admin'i bul ve rolünü ata
        $adminUser = User::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->roles()->sync([$superAdminRole->id]);
        }

        // 2. Diğer tüm kullanıcılara 'Member' rolünü ata
        $otherUsers = User::where('email', '!=', 'admin@example.com')->get();
        foreach ($otherUsers as $user) {
            $user->roles()->sync([$memberRole->id]);
        }
    }
}
