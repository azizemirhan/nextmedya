<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // --- ROLleri Oluştur ---
        $superAdminRole = Role::firstOrCreate(['slug' => 'super-admin'], ['name' => 'Super Admin']);
        $memberRole = Role::firstOrCreate(['slug' => 'member'], ['name' => 'Member']);

        // --- Tüm İzinleri Tek Bir Dizide Tanımla ---
        $permissions = [
            // User Management
            'view-users', 'create-users', 'update-users', 'delete-users',

            // Role & Permission Management
            'view-roles', 'create-roles', 'update-roles', 'delete-roles',

            // CRM - Accounts
            'view-accounts', 'create-accounts', 'update-accounts', 'delete-accounts',

            // CRM - Contacts
            'view-contacts', 'create-contacts', 'update-contacts', 'delete-contacts',

            // Project Management - Boards
            'view-boards', 'create-boards', 'update-boards', 'delete-boards',

            // Project Management - Lists
            'create-lists', 'update-lists', 'delete-lists',

            // Project Management - Tasks
            'view-tasks', 'create-tasks', 'update-tasks', 'delete-tasks', 'assign-tasks', 'move-tasks',

            // Blog - Posts
            'view-posts', 'create-posts', 'update-posts', 'delete-posts', 'publish-posts',

            // Blog - Taxonomies
            'manage-categories', 'manage-tags',

            // Services & Packages
            'manage-services',

            // System
            'access-terminal',
        ];

        // --- İzinleri Oluştur ---
        foreach ($permissions as $permissionSlug) {
            Permission::firstOrCreate(['slug' => $permissionSlug], [
                // 'delete-board' -> 'Delete Board'
                'name' => Str::of($permissionSlug)->replace('-', ' ')->title()
            ]);
        }

        // --- İzinleri Rollere Ata ---

        // 1. Super Admin'e TÜM izinleri ver.
        // (Not: AuthServiceProvider'daki Gate::before kuralı sayesinde bu aslında gereklidir,
        // ancak arayüzde görmek için atama yapmak iyi bir pratiktir.)
        $allPermissions = Permission::pluck('id');
        $superAdminRole->permissions()->sync($allPermissions);

        // 2. Member rolüne sadece belirli izinleri ver.
        $memberPermissions = Permission::whereIn('slug', [
            'view-boards', 'view-tasks', 'create-tasks', 'update-tasks', 'delete-tasks', 'move-tasks',
            'create-lists',
            'view-accounts', 'view-contacts',
        ])->pluck('id');
        $memberRole->permissions()->sync($memberPermissions);


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
