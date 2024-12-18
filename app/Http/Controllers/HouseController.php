<?php
namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\House;
use App\Models\Image;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HouseController extends Controller
{
    public function index($siteId)
    {
        $site = Site::where('id', $siteId)->where('owner_id', Auth::id())->firstOrFail();
        
        $houses = House::where('site_id', $siteId)->get();
        
        return view('owner.houses.index', compact('houses', 'site'));
    }
    
    

    public function create($siteId)
    {
        // Fetch the site based on the provided ID
        $site = Site::findOrFail($siteId); // Assuming you have a Site model
    
        return view('owner.houses.create', compact('site'));
    }

    public function store(Request $request, $siteId)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'property_type' => 'required|string',
        'price' => 'required|numeric',
        'negotiable' => 'nullable|boolean',
        'owner_contact' => 'required|string',
        'owner_email' => 'required|string',
        'size' => 'required|integer',
        'area' => 'required|string',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'bedrooms' => 'nullable|integer',
        'bathrooms' => 'nullable|integer',
        'images' => 'required|array|min:1',
    ]);

    // Create the house entry in the database
    $house = House::create([
        'title' => $request->input('title'),
        'location' => $request->input('location'),
        'price' => $request->input('price'),
        'bedrooms' => $request->input('bedrooms'),
        'bathrooms' => $request->input('bathrooms'),
        'property_type' => $request->input('property_type'),
        'negotiable' => $request->input('negotiable'),
        'owner_contact' => $request->input('owner_contact'),
        'owner_email' => $request->input('owner_email'),

        'size' => $request->input('size'),
        'area' => $request->input('area'),
        'description' => $request->input('description'),

        'site_id' => $siteId,
        'owner_id' => Auth::id(), // The currently authenticated user
    ]);

    // Handle image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('images', 'public'); // Store in the public directory
            Image::create([
                'house_id' => $house->id,
                'path' => $path,
            ]);
        }
    }

    return redirect()->route('owner.houses.index', $siteId)->with('success', 'House added successfully!');
}

public function edit($siteId, $houseId)
{
    $site = Site::findOrFail($siteId);
    $house = House::findOrFail($houseId);

    return view('owner.houses.edit', compact('site', 'house'));
}

public function update(Request $request, $siteId, $houseId)
{
    $house = House::findOrFail($houseId);

    // Validation
    $request->validate([
       'title' => 'required|string|max:255',
        'property_type' => 'required|string',
        'price' => 'required|numeric',
        'negotiable' => 'nullable|boolean',
        'owner_contact' => 'required|string',
        'size' => 'required|string',
        'area' => 'required|string',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'bedrooms' => 'nullable|integer',
        'bathrooms' => 'nullable|integer',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Updating the house
    $house->update($request->only(['title', 'location', 'address', 'price', 'bedrooms', 'bathrooms']));

    // If new images are uploaded
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('house_images', 'public');
            $house->images()->create(['image_path' => $imagePath]);
        }
    }

    return redirect()->route('owner.houses.index', $siteId)->with('success', 'House updated successfully.');
}


public function destroy($siteId, $houseId)
{
    // Fetch the house record based on siteId and houseId
    $house = House::where('site_id', $siteId)->findOrFail($houseId);

    // Delete the house record
    $house->delete();

    // Redirect with success message
    return redirect()->route('owner.houses.index', $siteId)->with('success', 'House deleted successfully');
}
public function getHousesByCity($cityName)
    {
        // Check if the city exists
        $city = City::where('name', $cityName)->first();

        // If the city does not exist, return a 404 response
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        // Fetch houses that belong to the specified city
        $houses = House::where('location', $cityName)->get();

        // Return the houses in a JSON format
        return response()->json($houses);
    }
}






