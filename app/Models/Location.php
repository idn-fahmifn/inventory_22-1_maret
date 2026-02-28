<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'user_id', 'location_name', 'uuid', 'size', 'is_available', 'description'
    ];

    // one hasmany dengan item
    public function item()
    {
        return $this->hasMany(Item::class, 'location_id');
    }

    // one many dengan user
    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
