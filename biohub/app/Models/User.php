<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>    
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user has one profile
    // User has one provider profile
public function providerProfile()
{
    return $this->hasOne(ProviderProfile::class);
}

// User has many bookings as customer
public function bookings()
{
    return $this->hasMany(Booking::class, 'customer_id');
}

// Check if user is a provider
public function isProvider()
{
    return $this->role === 'provider';
}

// Check if user is a customer
public function isCustomer()
{
    return $this->role === 'customer';
}
}
