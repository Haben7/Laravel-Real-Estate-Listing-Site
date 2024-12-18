<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';     protected $fillable = [
        'owner_id', 
        'name',
        'description',
        'location',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'site_id');
    }
  
    public function houses()
{
    return $this->hasMany(House::class, 'site_id');
}

}
