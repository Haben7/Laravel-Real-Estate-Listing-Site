<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'adminn@example.com',
                'password' => Hash::make('adminpassword'),
                'role' => 'admin',
            ],
            [
                'name' => 'Owner User',
                'email' => 'ownerr@example.com',
                'password' => Hash::make('ownerpassword'),
                'role' => 'owner',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

    //    $admin = User::create([
    //         'name' => 'Admin User',
    //         'email' => 'admin@example.com',
    //         'password' => Hash::make('adminpassword'), 
    //         'role' => 'admin',
            
    //     ]);
    //     $admin->assignRole('admin');

    //     User::create([
    //         'name' => 'Owner User',
    //         'email' => 'owner@example.com',
    //         'password' => Hash::make('ownerpassword'),
    //         'role' => 'owner',
    //     ]);
