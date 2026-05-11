<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'provider_id',
        'service_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'notes'
    ];

    // Booking belongs to a customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Booking belongs to a provider
    public function provider()
    {
        return $this->belongsTo(ProviderProfile::class, 'provider_id');
    }

    // Booking belongs to a service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}