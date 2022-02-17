<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class SuperAdminTest extends TestCase
{
  
    use RefreshDatabase;

  public function setUp(): void
  {

    parent::setUp();
    $this->artisan('db:seed --class=LaratrustSeeder');
    $this->superAdmin = User::factory()->create()->attachRole('superadministrator');

  }

  public function test_super_admin_can_assign_role()
  {

    $user = User::factory()->create([
        'name' => 'Jacob',
      ]);
  
      $this->assertDatabaseHas('users',['role' => 'user']);
  
      $response = $this->actingAs($this->superAdmin)->put('/users/'.$user->id, [
        "role" => "administrator",
      ]);
  
      $response->assertStatus(302);
      $this->assertDatabaseHas('users',['role_id' => 2]);

  }

  public function test_super_admin_can_access_dashboard_page()
  {

    $response = $this->actingAs($this->superAdmin)->get('/dashboard');
    $response->assertStatus(200);

  }

}
