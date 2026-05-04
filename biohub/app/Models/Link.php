<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    // These fields can be saved to database
    protected $fillable = [
        'profile_id',
        'title',
        'url',
        'order',
        'click_count'
    ];

    // A link belongs to a profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}