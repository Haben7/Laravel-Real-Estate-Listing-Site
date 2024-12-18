<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Site;
use Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    public function dashboard()
    {
        // Get the authenticated owner
        $owner = Auth::user();
        $sites = Site::withCount('houses')->where('owner_id', Auth::id())->get();

        // Pass the owner's data to the view
        return view('owner.index', compact('owner'));
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
public function chat()
{
    
    return view('owner.emails.userToOwner'); // Make sure the 'owner.chat' view exists
}
public function showSettingForm()
{
    return view('owner.setting'); // Ensure this view exists
}

public function update(Request $request)
{
    Log::info('Incoming request method:', ['method' => $request->method()]);

    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8',
        'real_estate_name' => 'nullable|string|max:255',
    ]);

    // Update the owner settings logic here
    $owner = auth()->user();
    $owner->name = $request->input('name');
    $owner->email = $request->input('email');
    if ($request->filled('password')) {
        $owner->password = Hash::make($request->input('password'));
    }
    $owner->real_estate_name = $request->input('real_estate_name');
    $owner->save();

    // Redirect or return response
    return redirect()->route('owner.setting')->with('success', 'Information updated successfully.');
}


}


