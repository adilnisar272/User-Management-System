<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_admin_can_create_users()
    {
        $admin = User::factory()->create();
        $admin->role->permissions()->attach(Permission::where('slug', 'create-user')->first());

        $this->actingAs($admin)
            ->get('/users/create')
            ->assertStatus(200);
    }
}
