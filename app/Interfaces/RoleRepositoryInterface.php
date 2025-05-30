<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function getRoleById($roleId);
    public function createRole(array $roleDetails);
    public function updateRole($roleId, array $newDetails);
    public function deleteRole($roleId);
    public function getRolePermissions($roleId);
    public function getPaginatedRoles($perPage = 15);
}
