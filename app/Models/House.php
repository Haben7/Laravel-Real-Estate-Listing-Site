<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'houses'; 
    protected $fillable = [
        'site_id',
        'title',
        'price',
        'location',
        'bedrooms',
        'bathrooms',
        'property_type',          
        'negotiable',
        'owner_contact',
        'owner_email',
        'size',
        'area',
        'description'
        ];

    public function site()
    {
        return $this->belongsTo(Site::class,'site_id');
    }


    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
