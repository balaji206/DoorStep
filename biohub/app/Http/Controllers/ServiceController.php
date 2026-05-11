<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;

class ServiceController extends Controller
{
    // Show all services
    public function index()
    {
        $provider = auth()->user()->providerProfile;
        $services = $provider->services;
        return view('provider.services', compact('provider', 'services'));
    }

    // Show create service form
    public function create()
    {
        return view('provider.services');
    }

    // Save new service
    public function store(StoreServiceRequest $request)
    {

        $provider = auth()->user()->providerProfile;

        Service::create([
            'provider_id'      => $provider->id,
            'name'             => $request->name,
            'duration_minutes' => $request->duration_minutes,
            'price'            => $request->price,
        ]);

        return redirect()->route('provider.services.index')
            ->with('success', 'Service added successfully!');
    }

    // Delete a service
    public function destroy($id)
    {
        $provider = auth()->user()->providerProfile;
        $service = Service::where('id', $id)
            ->where('provider_id', $provider->id)
            ->firstOrFail();

        $service->delete();

        return redirect()->route('provider.services.index')
            ->with('success', 'Service deleted!');
    }
}