<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderProfile;
use App\Models\Availability;
use App\Models\Booking;
use App\Models\Service;
use App\Http\Requests\StoreProviderProfileRequest;
use App\Http\Requests\StoreAvailabilityRequest;

class ProviderController extends Controller
{
    // Provider dashboard
    public function dashboard()
    {
        $provider = auth()->user()->providerProfile;
        $services = collect();
        $bookings = collect();

        if ($provider) {
            $services = Service::where('provider_id', $provider->id)->get();
            $bookings = Booking::where('provider_id', $provider->id)
                ->with(['customer', 'service'])
                ->latest()
                ->get();
        }

        return view('provider.dashboard', compact('provider', 'services', 'bookings'));
    }

    // Show create profile form
    public function createProfile()
    {
        return view('provider.profile-create');
    }

    // Save provider profile — validation handled by StoreProviderProfileRequest
    public function storeProfile(StoreProviderProfileRequest $request)
    {
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

    // Save availability — validation handled by StoreAvailabilityRequest
    public function storeAvailability(StoreAvailabilityRequest $request)
    {
        $provider = auth()->user()->providerProfile;

        Availability::create([
            'provider_id'  => $provider->id,
            'day_of_week'  => $request->day_of_week,
            'start_time'   => $request->start_time,
            'end_time'     => $request->end_time,
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
        return view('provider.bookings', compact('provider', 'bookings'));
    }

    // Show edit profile form
    public function editProfile()
    {
        $provider = auth()->user()->providerProfile;
        return view('provider.profile-edit', compact('provider'));
    }

    // Update provider profile — validation handled by StoreProviderProfileRequest
    public function updateProfile(StoreProviderProfileRequest $request)
    {
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