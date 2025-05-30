<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Unit;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === Create Roles ===
        $roleNames = ['Admin', 'Editor', 'Viewer'];
        $roles = collect($roleNames)->mapWithKeys(function ($name) {
            return [$name => Role::firstOrCreate(['name' => $name])];
        });

        // === Create Permissions ===
        $permNames = ['create user', 'update user', 'delete user', 'view users', 'create role', 'update role', 'delete role', 'view roles'];
        $permissions = collect($permNames)->map(function ($name) {
            return Permission::firstOrCreate([
                'name' => $name,
                'slug' => str_replace(' ', '-', $name)
            ]);
        });

        // Assign all permissions to Admin
        $roles['Admin']->permissions()->sync($permissions->pluck('id'));

        // === Bulk Create Units ===
        $unitNames = ['Finance', 'Operations', 'Marketing', 'IT', 'HR'];
        $units = collect($unitNames)->mapWithKeys(function ($name) {
            return [$name => Unit::firstOrCreate(['name' => $name])];
        });

        // === Bulk Create Departments ===
        $departments = collect();
        foreach ($units as $unitName => $unit) {
            foreach (['General', 'Support', 'Development'] as $suffix) {
                $deptName = "{$suffix} - {$unitName}";
                $department = Department::firstOrCreate([
                    'name' => $deptName,
                    'unit_id' => $unit->id
                ]);
                $departments->push($department);
            }
        }

        // === Create First Admin User ===
        $firstUnit = $units->first();
        $firstDept = $departments->where('unit_id', $firstUnit->id)->first();

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role_id' => $roles['Admin']->id,
                'unit_id' => $firstUnit->id,
                'department_id' => $firstDept->id,
            ]
        );

        // === Create Additional Users ===
        User::factory()->count(5)->make()->each(function ($user, $i) use ($roles, $units, $departments) {
            $unit = $units->random();
            $dept = $departments->where('unit_id', $unit->id)->random();

            $user->role_id = $i % 2 === 0 ? $roles['Editor']->id : $roles['Viewer']->id;
            $user->unit_id = $unit->id;
            $user->department_id = $dept->id;
            $user->save();
        });


    }
}
