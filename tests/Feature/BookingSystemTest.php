<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_book_a_table()
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $restaurant = Restaurant::factory()->create();
        $table = Table::factory()->create(['restaurant_id' => $restaurant->id, 'seating_capacity' => 4]);
        $response = $this->actingAs($customer)->post('/bookings', [
            'restaurant_id' => $restaurant->id,
            'branch_id' => $table->branch_id,
            'table_id' => $table->id,
            'date' => now()->format('Y-m-d'),
            'time_slot' => '18:00-19:00',
            'seating_capacity' => 2,
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $customer->id,
            'restaurant_id' => $restaurant->id,
            'table_id' => $table->id,
        ]);
    }

    public function test_admin_can_approve_and_reject_booking()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $booking = Booking::factory()->create(['status' => 'Pending']);
        $this->actingAs($admin)->put('/admin/booking/approve/' . $booking->id);
        $this->assertEquals('Approved', $booking->fresh()->status);
        $this->actingAs($admin)->put('/admin/booking/reject/' . $booking->id);
        $this->assertEquals('Rejected', $booking->fresh()->status);
    }

    public function test_only_admin_can_create_restaurant()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'customer']);
        $data = [
            'name' => 'Test Restaurant',
            'description' => 'Desc',
            'location' => 'Loc',
            'contact_info' => 'Contact',
        ];
        $this->actingAs($admin)->post('/restaurants', $data)->assertRedirect();
        $this->assertDatabaseHas('restaurants', ['name' => 'Test Restaurant']);
        $this->actingAs($customer)->post('/restaurants', $data)->assertStatus(403);
    }

    public function test_customer_cannot_access_admin_routes()
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $this->actingAs($customer)->get('/admin/dashboard')->assertStatus(403);
    }

    public function test_admin_cannot_access_customer_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get('/customer/dashboard')->assertStatus(403);
    }
}
