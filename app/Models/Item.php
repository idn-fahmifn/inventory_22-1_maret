<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'uuid', 'location_id', 'item_name', 'condition', 'stock', 'image', 'description', 'category'
    ];

    // relasi ke model Location
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

}
