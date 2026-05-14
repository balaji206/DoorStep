<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    // Only the provider can confirm their booking
    public function confirm(User $user, Booking $booking): bool
    {
        return $user->providerProfile?->id === $booking->provider_id;
    }

    // Only the provider can reject their booking
    public function reject(User $user, Booking $booking): bool
    {
        return $user->providerProfile?->id === $booking->provider_id;
    }

    // Only the customer who made the booking can cancel it
    public function cancel(User $user, Booking $booking): bool
    {
        return $user->id === $booking->customer_id;
    }
}