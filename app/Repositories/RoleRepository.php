<?php
namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::with('permissions')->get();
    }

    public function getRoleById($roleId)
    {
        return Role::with('permissions')->findOrFail($roleId);
    }

    public function createRole(array $roleDetails)
    {
        $role = Role::create($roleDetails);
        if (isset($roleDetails['permissions'])) {
            $role->permissions()->sync($roleDetails['permissions']);
        }

        return $role->load('permissions');
    }

    public function updateRole($roleId, array $newDetails)
    {
        $role = Role::findOrFail($roleId);
        $role->update($newDetails);

        if (isset($newDetails['permissions'])) {
            $role->permissions()->sync($newDetails['permissions']);

        }

        return $role->refresh()->load('permissions');
    }

    public function deleteRole($role)
    {
        return $role->delete();
    }

    public function getRolePermissions($role)
    {
        return Role::with('permissions')->findOrFail($role->id)
            ->pluck('id')
            ->toArray();
    }

    public function getPaginatedRoles($perPage = 15)
    {
        return Role::with('permissions')->paginate($perPage);
    }

    public function getForDatatable()
    {
        return Role::with('permissions')->select('roles.*');
    }
}
