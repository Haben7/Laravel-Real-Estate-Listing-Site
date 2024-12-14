<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run()
    // {
    //     $cities = [
    //         'Addis Ababa',
    //         'Bahirdar',
    //         'Gonder',
    //         'Jimma',
    //         'Adama',
    //         'Hawassa',
    //         'Mekelle',
    //         'Dire Dawa',
    //         'Nazret',
    //         'Kombolcha',
    //         'Bonga',
    //         'Debre Markos'
    //     ];

    //     foreach ($cities as $city) {
    //         DB::table('cities')->insert(['name' => $city]);
    //     }
    public function run()
{
    $cities = [
        ['name' => 'Addis Ababa', 'image' => 'addis-ababa.jpg'],
        ['name' => 'Bahirdar', 'image' => 'bahirdar.jpg'],
        ['name' => 'Gonder', 'image' => 'gonder.jpg'],
        ['name' => 'Jimma', 'image' => 'jimma.jpg'],
        ['name' => 'Adama', 'image' => 'adama.jpg'],
        ['name' => 'Hawassa', 'image' => 'hawassa.jpg'],
        ['name' => 'Mekelle', 'image' => 'mekelle.jpg'],
        ['name' => 'Dire Dawa', 'image' => 'dire-dawa.jpg'],
        ['name' => 'Nazret', 'image' => 'nazret.jpg'],
        ['name' => 'Kombolcha', 'image' => 'kombolcha.jpg'],
        ['name' => 'Bonga', 'image' => 'bonga.jpg'],
        ['name' => 'Debre Markos', 'image' => 'debre-markos.jpg']
    ];

    foreach ($cities as $city) {
        DB::table('cities')->insert($city);
    }
    }
}
