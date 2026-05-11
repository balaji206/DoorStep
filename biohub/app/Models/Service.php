<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'provider_id',
        'name',
        'duration_minutes',
        'price'
    ];

    // Service belongs to a provider
    public function provider()
    {
        return $this->belongsTo(ProviderProfile::class, 'provider_id');
    }

    // Service has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}