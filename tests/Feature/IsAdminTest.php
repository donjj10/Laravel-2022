<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Discount;
use App\Models\Role;
use App\Models\User;

class IsAdminTest extends TestCase
{
    
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class=RoleSeeder');
        $this->isAdmin = User::factory()->create(['role_id'=>Role::IS_ADMIN]);

    }

    public function test_is_admin_can_update_discount()
    {
        $discount = Discount::factory()->create([
            'name' => 'coupon',
            'value' => 0.2
        ]);
        $this->assertDatabaseHas('discounts', ['name' => 'coupon']);

        $response = $this->actingAs($this->isAdmin)->put('/discounts/'.$discount->id, [
            'name' => $discount->name,
            'value' => 0.15
          ]);
      
          $response->assertStatus(302);
          $this->assertDatabaseHas('discounts',['value' => 0.15]);

    }
}
