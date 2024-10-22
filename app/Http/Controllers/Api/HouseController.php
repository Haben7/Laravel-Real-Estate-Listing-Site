<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\House;
use Illuminate\Http\Request;
use App\Http\Resources\HouseResource;

class HouseController extends Controller
{
    // Method to fetch houses by city
    public function getHousesByCity($cityName)
    {
        // Check if the city exists
        $city = City::where('name', $cityName)->first();

        // If the city does not exist, return a 404 response
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        // Fetch houses that belong to the specified city
        $houses = House::where('location', $cityName)->with('images')->get();

        // Log houses for debugging
        \Log::info($houses);

        // Return the houses in a JSON format
        return HouseResource::collection($houses);
    }

    // app/Http/Controllers/HouseController.php

    public function search(Request $request)
    {
        // Start querying the House model
        $query = House::query();
    
        // Apply filters based on request inputs
        if ($request->has('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }
        
        if ($request->has('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }
        
        if ($request->has('location')) {
            $query->where('location', 'LIKE', '%' . $request->input('location') . '%');
        }
    
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
    
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }
    
        // Fetch the filtered houses
        $houses = $query->with('images')->get();
    
        // Return the houses using HouseResource
        return HouseResource::collection($houses);
    }
    

}
