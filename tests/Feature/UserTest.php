<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Discount;
use App\Models\Role;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class=RoleSeeder');
        $this->user = User::factory()->create(['role_id'=>Role::IS_USER]);

    }

    public function test_user_can_not_assign_user_role()
    {

        $user = User::factory()->create(['role_id' => Role::IS_USER]);
        $this->assertTrue(User::all()->count() == 2);

        $response = $this->actingAs($this->user)->put('/users/' . $user->id, [
            "role_id" => Role::IS_ADMIN
        ]);

        $response->assertStatus(403);
    }

    
  public function test_user_can_not_access_the_dashboard()
  {
    $response = $this->actingAs($this->user)->get('/dashboard');
    $response->assertStatus(403);
  }
}
