<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderProfile extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'category',
        'description',
        'location',
        'phone'
    ];

    // Provider profile belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Provider profile has many services
    public function services()
    {
        return $this->hasMany(Service::class, 'provider_id');
    }

    // Provider profile has many availabilities
    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'provider_id');
    }

    // Provider profile has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'provider_id');
    }
}