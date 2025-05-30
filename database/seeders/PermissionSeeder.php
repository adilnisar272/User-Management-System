<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private $permissions = [
        // User Permissions
        ['name' => 'View Users', 'slug' => 'view-users', 'group' => 'User'],
        ['name' => 'Create User', 'slug' => 'create-user', 'group' => 'User'],
        // Role Permissions
        ['name' => 'Assign Roles', 'slug' => 'assign-roles', 'group' => 'Role'],
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
