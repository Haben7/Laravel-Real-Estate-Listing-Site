<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HouseResource;
use App\Models\Property;
use App\Models\House;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $houses = House::with('images')->get(); // Fetch houses with images

        if ($houses->isNotEmpty()) { // Check if the collection is not empty
            return HouseResource::collection($houses);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    
}


