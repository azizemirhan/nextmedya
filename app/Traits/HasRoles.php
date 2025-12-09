<?php

namespace App\Traits;

use App\Models\Role;

trait HasRoles {
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Kullanıcı belirli bir role sahip mi?
    public function hasRole($roleSlug) {
        return $this->roles->contains('slug', $roleSlug);
    }

    // Kullanıcı belirli bir izne sahip mi?
    public function hasPermissionTo($permissionSlug) {
        // Kullanıcının tüm rolleri üzerinden, o rollerin izinlerini kontrol et
        return $this->roles->flatMap->permissions->pluck('slug')->contains($permissionSlug);
    }
}
