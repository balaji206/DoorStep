<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    // Only the provider who owns the service can delete it
    public function delete(User $user, Service $service): bool
    {
        return $user->providerProfile?->id === $service->provider_id;
    }

    // Only the provider who owns the service can update it
    public function update(User $user, Service $service): bool
    {
        return $user->providerProfile?->id === $service->provider_id;
    }
}