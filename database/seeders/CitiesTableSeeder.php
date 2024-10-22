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
    public function run()
    {
        $cities = [
            'Addis Ababa',
            'Bahirdar',
            'Gonder',
            'Jimma',
            'Adama',
            'Hawassa',
            'Mekelle',
            'Dire Dawa',
            'Nazret',
            'Kombolcha',
            'Bonga',
            'Debre Markos'
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert(['name' => $city]);
        }
    }
}
