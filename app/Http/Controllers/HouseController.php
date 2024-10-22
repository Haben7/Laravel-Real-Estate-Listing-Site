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
        $site = Site::findOrFail($siteId); // Assuming you have a Site model
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
        'address' => 'required|string|max:255',
        'price' => 'required|numeric',
        'location' => 'required|string|max:255',
        'bedrooms' => 'nullable|integer',
        'bathrooms' => 'nullable|integer',
        'images' => 'required|array|min:1', // At least 1 image required
    ]);

    // Create the house entry in the database
    $house = House::create([
        'title' => $request->input('title'),
        'location' => $request->input('location'),
        'price' => $request->input('price'),
        'bedrooms' => $request->input('bedrooms'),
        'bathrooms' => $request->input('bathrooms'),
        'address' => $request->input('address'),
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
        'location' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'price' => 'required|numeric',
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












































// namespace App\Http\Controllers;

// use App\Models\Site;
// use App\Models\House;
// use App\Models\Image;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;


// class HouseController extends Controller
// {
//     public function index($siteId)
//     {
//         $site = Site::findOrFail($siteId); // Assuming you have a Site model
//         $houses = House::where('site_id', $siteId)->get();
        
//         return view('owner.houses.index', compact('houses', 'site'));
//     }
    
    

//     public function create($siteId)
//     {
//         // Fetch the site based on the provided ID
//         $site = Site::findOrFail($siteId); // Assuming you have a Site model
    
//         return view('owner.houses.create', compact('site'));
//     }

//     // public function store(Request $request, Site $site)
//     // {
//     //     // Validate the incoming data
//     //     $data = $request->validate([
//     //         'address' => 'required|string|max:255',
//     //         'images' => 'required|array|min:5', 
//     //         'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each file
//     //     ]);

//     //     $house = $site->houses()->create([
//     //         'address' => $data['address'],
//     //         'owner_id' => Auth::id(), // Authenticated user's ID
//     //     ]);

//     //     // Handle image uploads
//     //     if ($request->hasFile('images')) {
//     //         foreach ($request->file('images') as $image) {
//     //             $path = $image->store('images', 'public'); // Store image in 'public/images'
//     //             Image::create([
//     //                 'house_id' => $house->id, // Save image with house ID
//     //                 'path' => $path,
//     //             ]);
//     //         }
//     //     }

//         // Redirect back to the house listing for the site
//     //    return redirect()->route('owner.houses.index', $site->id);
//     //}


//     // public function store(Request $request, $siteId)
//     // {
//     //     // Validate incoming request data
//     //     $request->validate([
//     //         'title' => 'required|string|max:255', // Title is required
//     //         'address' => 'required|string|max:255', // Address is required
//     //         'price' => 'required|numeric', // Price is required
//     //         'location' => 'required|string|max:255', // Location is required
//     //         'bedrooms' => 'nullable|integer', // Bedrooms is optional
//     //         'bathrooms' => 'nullable|integer', // Bathrooms is optional
//     //     ]);
    
//     //     // Create a new house record
//     //     House::create([
//     //         'title' => $request->input('title'),
//     //         'location' => $request->input('location'),
//     //         'price' => $request->input('price'),
//     //         'bedrooms' => $request->input('bedrooms'),
//     //         'bathrooms' => $request->input('bathrooms'),
//     //         'site_id' => $siteId,
//     //     ]);
    
//     //     // Redirect back to the houses index or another page
//     //     return redirect()->route('owner.houses.index', $siteId)->with('success', 'House added successfully!');
//     // }
    
//     public function store(Request $request, $siteId)
//     {
//         $request->validate([
//             'title' => 'required|string|max:255', // Title is required
//             'address' => 'required|string|max:255', // Address is required
//             'price' => 'required|numeric', // Price is required
//             'location' => 'required|string|max:255', // Location is required
//             'bedrooms' => 'nullable|integer', // Bedrooms is optional
//             'bathrooms' => 'nullable|integer',
//             // 'images' => 'required|array|min:5', 
//         ]);

//         // Create the site with the authenticated user's ID as owner
//         // $house = House::create($request->all() + ['site_id' => Auth::id()]);

//         // if ($request->hasFile('images')) {
//         //     foreach ($request->file('images') as $image) {
//         //         $path = $image->store('images', 'public'); 
//         //         Image::create([
//         //             'house_id' => $house->id,
//         //             'path' => $path,
//         //         ]);
//         //     }
//         // }
//         // Redirect to the index route with a success message
//         return redirect()->route('owner.houses.index', $siteId)->with('success', 'House added successfully!');
//     }
    


   


//     // public function show(Site $site, House $house)
//     // {
//     //     return view('owner.houses.show', compact('house', 'site'));
//     // }

//     // public function edit(Site $site, House $house)
//     // {
//     //     return view('owner.houses.edit', compact('house', 'site'));
//     // }

//     public function update(Request $request, Site $site, House $house)
//     {
//         $data = $request->validate([
//             'address' => 'required|string|max:255',
//         ]);

//         $house->update($data);

//         return redirect()->route('owner.houses.index', $site->id);
//     }

//     public function destroy(Site $site, House $house)
//     {
//         $house->delete();

//         return redirect()->route('owner.houses.index', $site->id);
//     }
// }
