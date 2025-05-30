<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCreationTest
{
    use RefreshDatabase;

    public function test_user_can_be_created()
    {
        $this->actingAs(User::factory()->create(['email' => 'admin@example.com']));

        $response = $this->post(route('users.store'), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'Password123!',
            'role' => 1,
            'unit_id' => 1,
            'department_id' => 1,
        ]);

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);
    }
}
