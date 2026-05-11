<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderProfile;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Availability;

class CustomerController extends Controller
{
    // Customer dashboard
    public function dashboard()
    {
        $bookings = Booking::where('customer_id', auth()->id())
            ->with(['provider', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('bookings'));
    }

    // Browse all providers
    public function providers()
    {
        $providers = ProviderProfile::with('services')->get();
        return view('customer.providers', compact('providers'));
    }

    // Show single provider profile
    public function showProvider($id)
    {
        $provider = ProviderProfile::with(['services', 'availabilities'])
            ->findOrFail($id);

        return view('customer.show-provider', compact('provider'));
    }

    // Show booking form
    public function book($id)
    {
        $provider = ProviderProfile::with(['services', 'availabilities'])
            ->findOrFail($id);

        return view('customer.book', compact('provider'));
    }

    // Store booking
    public function storeBooking(Request $request, $id)
    {
        $request->validate([
            'service_id'   => 'required|exists:services,id',
            'booking_date' => 'required|date|after:today',
            'start_time'   => 'required',
        ]);

        $provider = ProviderProfile::findOrFail($id);
        $service  = Service::findOrFail($request->service_id);

        // Calculate end time based on service duration
        $startTime = \Carbon\Carbon::parse($request->start_time);
        $endTime   = $startTime->copy()->addMinutes($service->duration_minutes);

        // Check if slot is already booked
        $exists = Booking::where('provider_id', $provider->id)
            ->where('booking_date', $request->booking_date)
            ->where('start_time', $request->start_time)
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($exists) {
            return back()->with('error', 'This slot is already booked! Please choose another time.');
        }

        Booking::create([
            'customer_id'  => auth()->id(),
            'provider_id'  => $provider->id,
            'service_id'   => $service->id,
            'booking_date' => $request->booking_date,
            'start_time'   => $startTime->format('H:i'),
            'end_time'     => $endTime->format('H:i'),
            'status'       => 'pending',
            'notes'        => $request->notes,
        ]);

        return redirect()->route('customer.bookings')
            ->with('success', 'Booking request sent successfully!');
    }

    // Customer bookings list
    public function bookings()
    {
        $bookings = Booking::where('customer_id', auth()->id())
            ->with(['provider', 'service'])
            ->latest()
            ->get();

        return view('customer.bookings', compact('bookings'));
    }
    // Show the form for editing the customer profile
public function editProfile()
{
    $user = auth()->user();
    return view('customer.edit-profile', compact('user'));
}

// Update the customer profile in the database
public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        // 'unique:users,email,'.$user->id ensures the user can keep their current email
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->back()->with('status', 'profile-updated');
}
}