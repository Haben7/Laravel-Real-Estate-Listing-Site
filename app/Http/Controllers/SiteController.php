<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller


{
    public function index()
    {
        $sites = Site::where('owner_id', Auth::id())->paginate(7);
        return view('owner.sites.index', compact('sites'));
    }
    
  
    public function create()
    {
        return view('owner.sites.create');
    }

    public function store(Request $request)
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

    public function edit(Site $site)
    {
        return view('owner.sites.edit', compact('site'));
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

    return redirect()->route('sites.index')->with('success', 'Site updated successfully!');
}


public function destroy($id)
{
    $site = Site::findOrFail($id);
    $site->delete();

    return redirect()->route('sites.index')->with('success', 'Site deleted successfully!');
}


public function sitesPerYear()
{
    $sitesPerYear = Site::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
        ->groupBy('year')
        ->orderBy('year', 'asc')
        ->get();

    return response()->json($sitesPerYear);
}

public function sitesPerYearForOwner()
{
    $sitesPerYear = Site::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
        ->where('owner_id', Auth::id()) // Filter by logged-in owner
        ->groupBy('year')
        ->orderBy('year', 'asc')
        ->get();

    return response()->json($sitesPerYear);
}


}

