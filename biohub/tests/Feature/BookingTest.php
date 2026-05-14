<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\ProviderProfile;
use App\Models\Service;
use App\Models\Booking;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    // Test 1 — Customer can book an appointment
    public function test_customer_can_make_a_booking()
    {
        // Create a provider user
        $providerUser = User::factory()->create(['role' => 'provider']);
        $provider = ProviderProfile::create([
            'user_id'       => $providerUser->id,
            'business_name' => 'Test Salon',
            'category'      => 'Salon',
            'location'      => 'Chennai',
            'phone'         => '9876543210',
        ]);

        // Create a service
        $service = Service::create([
            'provider_id'      => $provider->id,
            'name'             => 'Haircut',
            'duration_minutes' => 30,
            'price'            => 200,
        ]);

        // Create a customer
        $customer = User::factory()->create(['role' => 'customer']);

        // Act as customer and book
        $response = $this->actingAs($customer)->post("/customer/providers/{$provider->id}/book", [
            'service_id'   => $service->id,
            'booking_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time'   => '10:00',
            'notes'        => 'Test booking',
        ]);

        // Assert booking exists in DB
        $this->assertDatabaseHas('bookings', [
            'customer_id' => $customer->id,
            'provider_id' => $provider->id,
            'service_id'  => $service->id,
            'status'      => 'pending',
        ]);
    }

    // Test 2 — Double booking is prevented
    public function test_double_booking_is_prevented()
    {
        $providerUser = User::factory()->create(['role' => 'provider']);
        $provider = ProviderProfile::create([
            'user_id'       => $providerUser->id,
            'business_name' => 'Test Salon',
            'category'      => 'Salon',
            'location'      => 'Chennai',
            'phone'         => '9876543210',
        ]);

        $service = Service::create([
            'provider_id'      => $provider->id,
            'name'             => 'Haircut',
            'duration_minutes' => 30,
            'price'            => 200,
        ]);

        $customer1 = User::factory()->create(['role' => 'customer']);
        $customer2 = User::factory()->create(['role' => 'customer']);

        // First booking
        Booking::create([
            'customer_id'  => $customer1->id,
            'provider_id'  => $provider->id,
            'service_id'   => $service->id,
            'booking_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time'   => '10:00',
            'end_time'     => '10:30',
            'status'       => 'pending',
        ]);

        // Second customer tries same slot
        $response = $this->actingAs($customer2)->post("/customer/providers/{$provider->id}/book", [
            'service_id'   => $service->id,
            'booking_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time'   => '10:00',
        ]);

        // Assert only one booking exists for that slot
        $this->assertEquals(1, Booking::where('start_time', '10:00')
            ->where('booking_date', now()->addDays(2)->format('Y-m-d'))
            ->where('status', '!=', 'cancelled')
            ->count());
    }

    // Test 3 — Provider can confirm a booking
    public function test_provider_can_confirm_booking()
    {
        $providerUser = User::factory()->create(['role' => 'provider']);
        $provider = ProviderProfile::create([
            'user_id'       => $providerUser->id,
            'business_name' => 'Test Salon',
            'category'      => 'Salon',
            'location'      => 'Chennai',
            'phone'         => '9876543210',
        ]);

        $service = Service::create([
            'provider_id'      => $provider->id,
            'name'             => 'Haircut',
            'duration_minutes' => 30,
            'price'            => 200,
        ]);

        $customer = User::factory()->create(['role' => 'customer']);

        $booking = Booking::create([
            'customer_id'  => $customer->id,
            'provider_id'  => $provider->id,
            'service_id'   => $service->id,
            'booking_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time'   => '10:00',
            'end_time'     => '10:30',
            'status'       => 'pending',
        ]);

        // Provider confirms booking
        $response = $this->actingAs($providerUser)
            ->post("/provider/bookings/{$booking->id}/confirm");

        // Assert status changed to confirmed
        $this->assertDatabaseHas('bookings', [
            'id'     => $booking->id,
            'status' => 'confirmed',
        ]);
    }

    // Test 4 — Customer cannot confirm a booking
    public function test_customer_cannot_confirm_booking()
    {
        $providerUser = User::factory()->create(['role' => 'provider']);
        $provider = ProviderProfile::create([
            'user_id'       => $providerUser->id,
            'business_name' => 'Test Salon',
            'category'      => 'Salon',
            'location'      => 'Chennai',
            'phone'         => '9876543210',
        ]);

        $service = Service::create([
            'provider_id'      => $provider->id,
            'name'             => 'Haircut',
            'duration_minutes' => 30,
            'price'            => 200,
        ]);

        $customer = User::factory()->create(['role' => 'customer']);

        $booking = Booking::create([
            'customer_id'  => $customer->id,
            'provider_id'  => $provider->id,
            'service_id'   => $service->id,
            'booking_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time'   => '10:00',
            'end_time'     => '10:30',
            'status'       => 'pending',
        ]);

        // Customer tries to confirm — should be forbidden
        $response = $this->actingAs($customer)
            ->post("/provider/bookings/{$booking->id}/confirm");

        $response->assertStatus(403);
    }

    // Test 5 — Customer can cancel their own booking
    public function test_customer_can_cancel_own_booking()
    {
        $providerUser = User::factory()->create(['role' => 'provider']);
        $provider = ProviderProfile::create([
            'user_id'       => $providerUser->id,
            'business_name' => 'Test Salon',
            'category'      => 'Salon',
            'location'      => 'Chennai',
            'phone'         => '9876543210',
        ]);

        $service = Service::create([
            'provider_id'      => $provider->id,
            'name'             => 'Haircut',
            'duration_minutes' => 30,
            'price'            => 200,
        ]);

        $customer = User::factory()->create(['role' => 'customer']);

        $booking = Booking::create([
            'customer_id'  => $customer->id,
            'provider_id'  => $provider->id,
            'service_id'   => $service->id,
            'booking_date' => now()->addDays(2)->format('Y-m-d'),
            'start_time'   => '10:00',
            'end_time'     => '10:30',
            'status'       => 'pending',
        ]);

        // Customer cancels their booking
        $response = $this->actingAs($customer)
            ->post("/customer/bookings/{$booking->id}/cancel");

        $this->assertDatabaseHas('bookings', [
            'id'     => $booking->id,
            'status' => 'cancelled',
        ]);
    }
}