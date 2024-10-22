<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'user_id', // assuming an activity belongs to a user
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
