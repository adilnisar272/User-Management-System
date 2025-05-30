<?php
namespace App\Traits;

trait HasPermissions
{
    public function hasPermissionTo($permissionSlug) {
        return $this->hasPermission($permissionSlug);
    }

    public function hasPermission($permissionSlug) {
        // Check direct permissions first
        if ($this->permissions->contains('slug', $permissionSlug)) {
            return true;
        }

        // Check role permissions
        if ($this->role && $this->role->permissions->contains('slug', $permissionSlug)) {
            return true;
        }

        return false;
    }
}
