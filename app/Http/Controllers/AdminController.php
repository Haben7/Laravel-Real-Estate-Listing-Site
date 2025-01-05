<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Site;
use App\Models\House;
use App\Models\Image;
use App\Models\City;
use Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        // return view('admin.dashboard'); // User registrations by month for the current year
        $userRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->pluck('count', 'month');

      
        $userRegistrations = array_replace(array_fill(1, 12, 0), $userRegistrations->toArray()); // Fill missing months with 0
        // $propertiesListed = $propertiesListed->toArray();

        return view('admin.index', compact('userRegistrations'));
    }
     // List all owners
     public function listOwners()
     {
         // Get all users with the 'owner' role
         $owners = User::where('role', 'owner')->get();
         $owners = User::where('role', 'owner')->paginate(8);


         return view('admin.properties.owners', compact('owners'));
     }
 
     // Show properties for a specific owner
     public function ownerSites($ownerId)
     {
         // Get the owner by ID
         $owner = User::findOrFail($ownerId);
         
        
        $sites = Site::where('owner_id', $ownerId)->get();
 
         return view('admin.properties.site', compact('owner', 'sites'));
     }

     public function siteHouses($siteId)
{
    // Get the site (owner) by ID
    $site = Site::with('houses.images')->findOrFail($siteId);

    // Retrieve houses related to the site
    $houses = House::where('site_id', $siteId)->get();

    return view('admin.properties.listhouse', compact('site', 'houses'));
}

public function all($siteId)
{
    $site = Site::findOrFail($siteId); // Assuming you have a Site model
    $houses = House::where('site_id', $siteId)->get();
    
    return view('owner.houses.index', compact('houses', 'site'));
}



public function create($siteId)
{
    // Fetch the site based on the provided ID
    $site = Site::findOrFail($siteId); // Assuming you have a Site model

    return view('admin.properties.housecreate', compact('site'));
}

public function store(Request $request, $siteId)
{
$request->validate([
    'title' => 'required|string|max:255',
    'property_type' => 'required|string',
    'price' => 'required|numeric',
    'negotiable' => 'nullable|boolean',
    'owner_contact' => 'required|string',
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

return redirect()->route('admin.properties.all', $siteId)->with('success', 'House added successfully!');
}

public function houseedit($siteId, $houseId)
{
$site = Site::findOrFail($siteId);
$house = House::findOrFail($houseId);

return view('admin.properties.houseedit', compact('site', 'house'));
}

public function houseupdate(Request $request, $siteId, $houseId)
{
$house = House::findOrFail($houseId);

// Validation
$request->validate([
   'title' => 'required|string|max:255',
    'property_type' => 'required|string',
    'price' => 'required|numeric',
    'negotiable' => 'nullable|boolean',
    'owner_contact' => 'required|string',
    'size' => 'required|integer',
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

return redirect()->route('admin.properties.all', $siteId)->with('success', 'House updated successfully.');
}


public function housedestroy($siteId, $houseId)
{
// Fetch the house record based on siteId and houseId
$house = House::where('site_id', $siteId)->findOrFail($houseId);

// Delete the house record
$house->delete();

// Redirect with success message
return redirect()->route('admin.properties.all', $siteId)->with('success', 'House deleted successfully');
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


//about admin and site

 public function site()
    {
        $sites = Site::where('owner_id', Auth::id())->get();
    return view('admin.properties.site');
    }

    public function sitecreate()
    {
        return view('admin.properties.sitecreate');
    }

    public function storesite(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // Create the site with the authenticated user's ID as owner
        $site = Site::create($request->all() + ['owner_id' => Auth::id()]);

        // Redirect to the index route with a success message
        return redirect()->route('sites.index')->with('success', 'Site created successfully.');
    }

    public function editsite(Site $site)
    {
        return view('admin.properties.editsite', compact('site'));
    }
    
    

    public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
    ]);

    // Find the site and update
    $site = Site::findOrFail($id);
    $site->name = $request->name;
    $site->description = $request->description;
    $site->location = $request->location;
    $site->save();

    return redirect()->route('sites.site')->with('success', 'Site updated successfully!');
}


public function destroy($id)
{
    $site = Site::findOrFail($id);
    $site->delete();

    return redirect()->route('sites.site')->with('success', 'Site deleted successfully!');
}
public function showSettingForm()
{
    return view('admin.setting'); // Ensure this view exists
}

public function setting(Request $request)
{
    Log::info('Incoming request method:', ['method' => $request->method()]);

    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8',
    ]);

    // Update the owner settings logic here
    $admin = auth()->user();
    $admin->name = $request->input('name');
    $admin->email = $request->input('email');
    if ($request->filled('password')) {
        $admin->password = Hash::make($request->input('password'));
    }
    
    $admin->save();

    // Redirect or return response
    return redirect()->route('admin.setting.update')->with('success', 'Information updated successfully.');
}

public function chart()
{
    
    $userRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')
        ->toArray();

    // Fill missing months with 0
    $userRegistrations = array_replace(array_fill(1, 12, 0), $userRegistrations);

    return view('admin.chart', compact('userRegistrations'));
}


public function table()
{
    // Example data for table
    $users = User::paginate(10);

    return view('admin.table', compact('users'));
}


}

