<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // View all users
    public function index()
    {
        $users = User::paginate(7); 
        return view('admin.users.index', compact('users'));
    }

    // Create new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,owner',
            'real_estate_name' => 'required_if:role,owner|string|max:255',  // Required if role is owner
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'real_estate_name' => $request->input('real_estate_name'),  
        ]);

        return redirect()->route('users.index')->with('success', ucfirst($user->role) . ' created successfully.');
    }

    // Edit user form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,owner',
            'real_estate_name' => 'required_if:role,owner|string|max:255',
        ]);

        // Update user data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->real_estate_name = $validatedData['real_estate_name'];

        // Check if password is provided and update if so
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Save the updated user information
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
