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
    
        if ($request->has('property_type')) {
            $query->where('property_type', $request->input('property_type'));
        }
    
        if ($request->has('size_min')) {
            $query->where('size', '>=', $request->input('size_min'));
        }
    
        if ($request->has('size_max')) {
            $query->where('size', '<=', $request->input('size_max'));
        }
    
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
    
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }
    
        // New condition for area filter
        if ($request->has('area')) {
            $query->where('area', 'LIKE', '%' . $request->input('area') . '%');
        }
    
        // Fetch the filtered houses
        try {
            $houses = $query->with('images')->get();
    
            // Return the houses using HouseResource
            return HouseResource::collection($houses);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Search query error: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching house listings.'], 500);
        }    
    }
    

}
