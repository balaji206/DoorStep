<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // Confirm a booking (provider)
    public function confirm($id)
    {
        $provider = auth()->user()->providerProfile;
        $booking = Booking::where('id', $id)
            ->where('provider_id', $provider->id)
            ->firstOrFail();

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('provider.bookings')
            ->with('success', 'Booking confirmed!');
    }

    // Reject a booking (provider)
    public function reject($id)
    {
        $provider = auth()->user()->providerProfile;
        $booking = Booking::where('id', $id)
            ->where('provider_id', $provider->id)
            ->firstOrFail();

        $booking->update(['status' => 'rejected']);

        return redirect()->route('provider.bookings')
            ->with('success', 'Booking rejected!');
    }

    // Cancel a booking (customer)
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('customer_id', auth()->id())
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('customer.bookings')
            ->with('success', 'Booking cancelled!');
    }
}