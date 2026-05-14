<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\BrevoMailService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;
    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('confirm', $booking);

        $booking->update(['status' => 'confirmed']);

        // Load relationships for email
        $booking->load(['customer', 'service', 'provider']);

        // Email to Customer
        BrevoMailService::send(
            $booking->customer->email,
            $booking->customer->name,
            'Booking Confirmed — Doorstep',
            "
            <h1>Booking Confirmed! ✅</h1>
            <p>Hi <strong>{$booking->customer->name}</strong>,</p>
            <p>Your booking has been confirmed.</p>
            <table>
                <tr><td><strong>Business:</strong></td><td>{$booking->provider->business_name}</td></tr>
                <tr><td><strong>Service:</strong></td><td>{$booking->service->name}</td></tr>
                <tr><td><strong>Date:</strong></td><td>{$booking->booking_date}</td></tr>
                <tr><td><strong>Time:</strong></td><td>{$booking->start_time} - {$booking->end_time}</td></tr>
                <tr><td><strong>Location:</strong></td><td>{$booking->provider->location}</td></tr>
                <tr><td><strong>Phone:</strong></td><td>{$booking->provider->phone}</td></tr>
            </table>
            <p>Please arrive on time!</p>
            <br>
            <p>— Doorstep Team 🚪</p>
            "
        );

        return redirect()->route('provider.bookings')
            ->with('success', 'Booking confirmed !');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('reject', $booking);

        $booking->update(['status' => 'rejected']);

        // Load relationships for email
        $booking->load(['customer', 'service', 'provider']);

        // Email to Customer
        BrevoMailService::send(
            $booking->customer->email,
            $booking->customer->name,
            'Booking Update — Doorstep',
            "
            <h1>Booking Not Available ❌</h1>
            <p>Hi <strong>{$booking->customer->name}</strong>,</p>
            <p>Unfortunately your booking request could not be confirmed.</p>
            <table>
                <tr><td><strong>Business:</strong></td><td>{$booking->provider->business_name}</td></tr>
                <tr><td><strong>Service:</strong></td><td>{$booking->service->name}</td></tr>
                <tr><td><strong>Date:</strong></td><td>{$booking->booking_date}</td></tr>
                <tr><td><strong>Time:</strong></td><td>{$booking->start_time} - {$booking->end_time}</td></tr>
            </table>
            <p>Please try booking a different time slot.</p>
            <br>
            <p>— Doorstep Team 🚪</p>
            "
        );

        return redirect()->route('provider.bookings')
            ->with('success', 'Booking rejected !');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorize('cancel', $booking);

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('customer.bookings')
            ->with('success', 'Booking cancelled successfully!');
    }
}