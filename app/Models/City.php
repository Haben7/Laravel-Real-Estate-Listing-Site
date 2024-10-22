<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'cities'; 

    // If you want to allow mass assignment for specific fields, define them here
    protected $fillable = ['name'];
}
