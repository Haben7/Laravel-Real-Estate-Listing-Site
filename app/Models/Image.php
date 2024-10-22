<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory; // Add this line to use the HasFactory trait
    
    protected $fillable = ['house_id', 'path']; // Update 'image_path' to 'path'

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
//house_id