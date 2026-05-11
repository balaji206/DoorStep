<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderProfile;
use App\Models\Availability;
use App\Models\Booking;
use App\Models\Service;

class ProviderController extends Controller
{
    // Provider dashboard
    public function dashboard()
    {
        $user = auth()->user();
        $provider = $user->providerProfile;

        // Initialize empty collections to prevent "Undefined Variable" errors
        $services = collect();
        $bookings = collect();

        if ($provider) {
            // Fetch services belonging to this provider
            $services = Service::where('provider_id', $provider->id)->get();
            
            // Fetch bookings belonging to this provider
            $bookings = Booking::where('provider_id', $provider->id)
                ->with(['customer', 'service'])
                ->latest()
                ->get();
        }

        // Pass all three variables to the view
        return view('provider.dashboard', compact('provider', 'services', 'bookings'));
    }

    // Show create profile form
    public function createProfile()
    {
        return view('provider.profile-create');
    }

    // Save provider profile
    public function storeProfile(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'category'      => 'required|string',
            'description'   => 'nullable|string',
            'location'      => 'required|string',
            'phone'         => 'required|string',
        ]);

        ProviderProfile::create([
            'user_id'       => auth()->id(),
            'business_name' => $request->business_name,
            'category'      => $request->category,
            'description'   => $request->description,
            'location'      => $request->location,
            'phone'         => $request->phone,
        ]);

        return redirect()->route('provider.dashboard')
            ->with('success', 'Profile created successfully!');
    }

    // Show availability page
    public function availability()
    {
        $provider = auth()->user()->providerProfile;
        $availabilities = $provider->availabilities;
        return view('provider.availability', compact('provider', 'availabilities'));
    }

    // Save availability
    public function storeAvailability(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required',
            'start_time'  => 'required',
            'end_time'    => 'required|after:start_time',
        ]);

        $provider = auth()->user()->providerProfile;

        Availability::create([
            'provider_id' => $provider->id,
            'day_of_week' => $request->day_of_week,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'is_available' => true,
        ]);

        return redirect()->route('provider.availability')
            ->with('success', 'Availability added!');
    }

    // Show provider bookings
    public function bookings()
    {
        $provider = auth()->user()->providerProfile;
        $bookings = Booking::where('provider_id', $provider->id)
            ->with(['customer', 'service'])
            ->latest()
            ->get();
        return view('provider.booking', compact('provider', 'bookings'));
    }

    // Show edit profile form
public function editProfile()
{
    $provider = auth()->user()->providerProfile;
    return view('provider.profile-edit', compact('provider'));
}

// Update provider profile
public function updateProfile(Request $request)
{
    $request->validate([
        'business_name' => 'required|string|max:255',
        'category'      => 'required|string',
        'description'   => 'nullable|string',
        'location'      => 'required|string',
        'phone'         => 'required|string',
    ]);

    $provider = auth()->user()->providerProfile;

    $provider->update([
        'business_name' => $request->business_name,
        'category'      => $request->category,
        'description'   => $request->description,
        'location'      => $request->location,
        'phone'         => $request->phone,
    ]);

    return redirect()->route('provider.dashboard')
        ->with('success', 'Profile updated successfully!');
}
}