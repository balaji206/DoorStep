<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\Request;
use App\Models\ProviderProfile;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Availability;
use App\Services\BrevoMailService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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

    // Store booking — validation handled by StoreBookingRequest
    public function storeBooking(StoreBookingRequest $request, $id)
{
    $provider = ProviderProfile::findOrFail($id);
    $service  = Service::findOrFail($request->service_id);

    $startTime = \Carbon\Carbon::parse($request->start_time);
    $endTime   = $startTime->copy()->addMinutes($service->duration_minutes);

    // Check double booking
    $exists = Booking::where('provider_id', $provider->id)
        ->where('booking_date', $request->booking_date)
        ->where('start_time', $request->start_time)
        ->where('status', '!=', 'cancelled')
        ->where('status', '!=', 'rejected')
        ->exists();

    if ($exists) {
        return back()->with('error', 'This slot is already booked! Please choose another time.');
    }

    $booking = Booking::create([
        'customer_id'  => auth()->id(),
        'provider_id'  => $provider->id,
        'service_id'   => $service->id,
        'booking_date' => $request->booking_date,
        'start_time'   => $startTime->format('H:i'),
        'end_time'     => $endTime->format('H:i'),
        'status'       => 'pending',
        'notes'        => $request->notes,
    ]);

    // Email to Customer — booking request sent
   BrevoMailService::send(
        "balajier2006@gmail.com",
        auth()->user()->name,
        'Booking Request Sent — Doorstep',
        "
        <h1>Booking Request Sent! 🎉</h1>
        <p>Hi <strong>" . auth()->user()->name . "</strong>,</p>
        <p>Your booking request has been sent successfully.</p>
        <table>
            <tr><td><strong>Business:</strong></td><td>{$provider->business_name}</td></tr>
            <tr><td><strong>Service:</strong></td><td>{$service->name}</td></tr>
            <tr><td><strong>Date:</strong></td><td>{$request->booking_date}</td></tr>
            <tr><td><strong>Time:</strong></td><td>{$startTime->format('g:i A')} - {$endTime->format('g:i A')}</td></tr>
            <tr><td><strong>Status:</strong></td><td>Pending</td></tr>
        </table>
        <p>We will notify you once the provider confirms your booking.</p>
        <br>
        <p>— Doorstep Team 🚪</p>
        "
    );

    // Email to Provider — new booking received
    BrevoMailService::send(
        $provider->user->email,
        $provider->business_name,
        'New Booking Request — Doorstep',
        "
        <h1>New Booking Request! 📅</h1>
        <p>Hi <strong>{$provider->business_name}</strong>,</p>
        <p>You have received a new booking request.</p>
        <table>
            <tr><td><strong>Customer:</strong></td><td>" . auth()->user()->name . "</td></tr>
            <tr><td><strong>Service:</strong></td><td>{$service->name}</td></tr>
            <tr><td><strong>Date:</strong></td><td>{$request->booking_date}</td></tr>
            <tr><td><strong>Time:</strong></td><td>{$startTime->format('g:i A')} - {$endTime->format('g:i A')}</td></tr>
        </table>
        <p>Please login to your dashboard to confirm or reject this booking.</p>
        <br>
        <p>— Doorstep Team 🚪</p>
        "
    );

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

    // Show edit profile form
    public function editProfile()
    {
        $user = auth()->user();
        return view('customer.edit-profile', compact('user'));
    }

    // Update customer profile
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}