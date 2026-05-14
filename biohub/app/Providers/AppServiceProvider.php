<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\ProviderProfile;
use App\Models\Service;
use App\Models\Booking;

use App\Policies\ProviderProfilePolicy;
use App\Policies\ServicePolicy;
use App\Policies\BookingPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
{
    // Register Policies
    Gate::policy(ProviderProfile::class, ProviderProfilePolicy::class);
    Gate::policy(Service::class, ServicePolicy::class);
    Gate::policy(Booking::class, BookingPolicy::class);

    // Gate — only providers can access provider area
    Gate::define('access-provider-dashboard', function (User $user) {
        return $user->isProvider();
    });

    // Gate — only customers can access customer area
    Gate::define('access-customer-dashboard', function (User $user) {
        return $user->isCustomer();
    });

    // Gate — only providers who have set up their profile
    Gate::define('manage-own-business', function (User $user) {
        return $user->isProvider() && $user->providerProfile !== null;
    });
}
}