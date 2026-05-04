<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // These fields can be saved to database
    protected $fillable = [
        'user_id',
        'username',
        'bio',
        'avatar',
        'theme'
    ];

    // A profile belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A profile has many links
    public function links()
    {
        return $this->hasMany(Link::class);
    }
}