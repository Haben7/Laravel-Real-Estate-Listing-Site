<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';
    protected $fillable = [
        'title',
        'location',
        'property_type',
        'listing_type',
        'price',
        'negotiable',
        'lot_size',
        'bedrooms',
        'bathrooms',
        'floors',
        'garden',
        'has_pool',
        'heating_system',
        'cooling_system',
        'furnishing_status',
        'condition',
        'ownership_type',
        'title_status',
        'building_permits',
        'mortgage_status',
        'owner_id' 
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
