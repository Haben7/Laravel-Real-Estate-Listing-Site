<?php

// namespace Database\Seeders;

// use App\Models\User;
// // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         // User::factory(10)->create();

//         User::factory()->create([
//             'name' => 'Admin User',
//             'email' => 'admin@example.com',
//             'password' => Hash::make('adminpassword'),
//             'role' => 'admin',
//         ]);
//         User::factory()->create([
//             'name' => 'Owner User',
//             'email' => 'owner@example.com',
//             'role' => 'owner',
//         ]);
//         // $this->call(CitiesTableSeeder::class)
//     }
// }
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CitiesTableSeeder::class,
            UserSeeder::class,
        ]);
    }
}
