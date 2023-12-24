<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRolesPermissions
{
    /**
     * Assign permissions
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            return $this;
        }

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function detachPermissions(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function attachRole($role): static
    {
        $roles = Role::query()->where('slug', $role)->first();
        $this->roles()->save($roles);
        $this->permissions()->saveMany($roles->permissions);
        return $this;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission): bool
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission): bool
    {
        return (bool)$this->permissions()->where('slug', $permission->slug)->count();
    }

    /**
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();

    }

    /**
     * @return mixed
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'user_permission')->withTimestamps();
    }

    /**
     * @param array $permissions
     * @return mixed
     */
    protected function getAllPermissions(array $permissions): mixed
    {
        return Permission::query()->whereIn('slug', $permissions)->get();
    }
}
