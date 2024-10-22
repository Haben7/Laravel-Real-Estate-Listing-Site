<?php

// app/Http/Controllers/CityController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::all(); // Fetch all cities
    }
}
