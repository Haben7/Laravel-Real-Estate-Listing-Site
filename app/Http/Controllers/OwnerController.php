<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function dashboard()
    {
        // Get the authenticated owner
        $owner = Auth::user();

        // Pass the owner's data to the view
        return view('owner.dashboard', compact('owner'));
    }

    public function index()
{
    $properties = auth()->user()->properties;
    return view('owner.properties.index', compact('properties'));
}
public function create()
{
    return view('owner.properties.create');
}

}


