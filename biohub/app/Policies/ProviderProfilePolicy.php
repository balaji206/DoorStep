<?php

namespace App\Policies;

use App\Models\ProviderProfile;
use App\Models\User;

class ProviderProfilePolicy
{
    // Only the owner can update their profile
    public function update(User $user, ProviderProfile $providerProfile): bool
    {
        return $user->id === $providerProfile->user_id;
    }

    // Only the owner can delete their profile
    public function delete(User $user, ProviderProfile $providerProfile): bool
    {
        return $user->id === $providerProfile->user_id;
    }
}