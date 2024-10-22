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
        // 'maintenance_fees',
        // 'taxes',
        // 'utilities',
        'negotiable',
        // 'size',
        'lot_size',
        'bedrooms',
        'bathrooms',
        'floors',
        // 'garage', // Allow null values
        // 'balcony',
        'garden',
        'has_pool', // Changed swimming_pool to has_pool
        'heating_system',
        'cooling_system',
        'furnishing_status',
        // 'year_built',
        // 'renovation_year',
        'condition',
        'ownership_type',
        'title_status',
        // 'zoning',
        'building_permits',
        'mortgage_status',
        // 'documents',
        // 'owner_contact',
        'owner_id' // Ensure this is included for relational mapping
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
