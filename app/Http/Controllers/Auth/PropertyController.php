<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index()
    {
        // Fetch properties for the authenticated owner
        $properties = Property::where('owner_id', Auth::id())->get();
        return view('owner.properties.index', compact('properties'));

    }
 
    public function create()
    {
        return view('owner.properties.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'landmarks' => 'nullable|string|max:255',
            'gps_coordinates' => 'nullable|string|max:255',
            'property_type' => 'required|string',
            'listing_type' => 'required|string',
            'price' => 'required|numeric',
            'maintenance_fees' => 'nullable|numeric',
            'taxes' => 'nullable|numeric',
            'utilities' => 'nullable|string',
            'negotiable' => 'nullable|boolean',
            'size' => 'required|integer',
            'lot_size' => 'nullable|integer',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'floors' => 'nullable|integer',
            'garage' => 'nullable|string|max:255',
            'balcony' => 'nullable|string|max:255',
            'garden' => 'nullable|string|max:255',
            'swimming_pool' => 'nullable|boolean',
            'heating_cooling_system' => 'nullable|string|max:255',
            'furnishing_status' => 'nullable|string|max:255',
            'year_built' => 'nullable|integer',
            'renovation_year' => 'nullable|integer',
            'condition' => 'nullable|string|max:255',
            'ownership_type' => 'nullable|string|max:255',
            'title_status' => 'nullable|string|max:255',
            'zoning' => 'nullable|string|max:255',
            'building_permits' => 'nullable|string|max:255',
            'mortgage_status' => 'nullable|string|max:255',
            'community_features' => 'nullable|string',
            'transportation' => 'nullable|string',
            'schools' => 'nullable|string',
            'shopping' => 'nullable|string',
            'energy_rating' => 'nullable|string|max:255',
            'solar_panels' => 'nullable|boolean',
            'water_conservation' => 'nullable|string|max:255',
            'utility_connections' => 'nullable|string',
            'utility_costs' => 'nullable|numeric',
            'security_system' => 'nullable|string',
            'fire_safety' => 'nullable|string',
            'documents' => 'nullable|string',
            'owner_contact' => 'nullable|string|max:255',
            'images' => 'required|array|min:5', 
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the property
       $property = Property::create(attributes: array_merge($request->all(), ['owner_id' => Auth::id()]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public'); 
                Image::create([
                    'property_id' => $property->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('owner.properties.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        // Validate the request
       $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'landmarks' => 'nullable|string|max:255',
            'gps_coordinates' => 'nullable|string|max:255',
            'property_type' => 'required|string',
            'listing_type' => 'required|string',
            'price' => 'required|numeric',
            'maintenance_fees' => 'nullable|numeric',
            'taxes' => 'nullable|numeric',
            'utilities' => 'nullable|string',
            'negotiable' => 'nullable|boolean',
            'size' => 'required|integer',
            'lot_size' => 'nullable|integer',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'floors' => 'nullable|integer',
            'garage' => 'nullable|string|max:255',
            'balcony' => 'nullable|string|max:255',
            'garden' => 'nullable|string|max:255',
            'swimming_pool' => 'nullable|boolean',
            'heating_cooling_system' => 'nullable|string|max:255',
            'furnishing_status' => 'nullable|string|max:255',
            'year_built' => 'nullable|integer',
            'renovation_year' => 'nullable|integer',
            'condition' => 'nullable|string|max:255',
            'ownership_type' => 'nullable|string|max:255',
            'title_status' => 'nullable|string|max:255',
            'zoning' => 'nullable|string|max:255',
            'building_permits' => 'nullable|string|max:255',
            'mortgage_status' => 'nullable|string|max:255',
            'community_features' => 'nullable|string',
            'transportation' => 'nullable|string',
            'schools' => 'nullable|string',
            'shopping' => 'nullable|string',
            'energy_rating' => 'nullable|string|max:255',
            'solar_panels' => 'nullable|boolean',
            'water_conservation' => 'nullable|string|max:255',
            'utility_connections' => 'nullable|string',
            'utility_costs' => 'nullable|numeric',
            'security_system' => 'nullable|string',
            'fire_safety' => 'nullable|string',
            'documents' => 'nullable|string',
            'owner_contact' => 'nullable|string|max:255',

        ]);

        // Update the property
        $property->update($request->all());

        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy($id)
    {
        Property::destroy($id);
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
}
