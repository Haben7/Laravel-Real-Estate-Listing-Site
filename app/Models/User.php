<?php

// namespace App\Models;

// // use Attribute;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
// use Spatie\Permission\Traits\HasRoles;
// use Illuminate\Database\Eloquent\Casts\Attribute;
// class User extends Authenticatable
// {
//     use HasFactory, Notifiable, HasApiTokens, HasRoles;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
    
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//         'role',
//         'real_estate_name', 
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }

//     public function sites()
//     {
//         return $this->hasMany(Site::class);
//     }

//     public function activities()
//     {
//         return $this->hasMany(Activity::class);
//     }
//     public function bookmarks()
// {
//     return $this->belongsToMany(House::class, 'bookmarks');
// }
// // In App\Models\User.php
// public function hasRole($roles)
// {
//     return $this->roles()->whereIn('name', (array) $roles)->exists();
// }

// protected function role(): Attribute{
//     return new Attribute(
//         get: fn ($value) => ["admin", "owner"][$value],
//     );
// }
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Constants for user roles
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_OWNER = 'owner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'real_estate_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function hasRole($roles)
    {
        return $this->roles()->whereIn('name', (array) $roles)->exists();
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value,
        );
    }
}
