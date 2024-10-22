<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Site;
use App\Models\House;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Make sure this view exists
    }
     // List all owners
     public function listOwners()
     {
         // Get all users with the 'owner' role
         $owners = User::where('role', 'owner')->get();
         
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

}

