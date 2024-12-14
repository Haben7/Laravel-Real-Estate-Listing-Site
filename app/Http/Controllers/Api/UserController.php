<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

    // Login existing user
    public function login(Request $request)
{
    // Validate login request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);
 
    // Check if the user exists
    $user = User::where('email', $request->email)->first();
 
    if (!$user) {
        \Log::error('No user found with email: ' . $request->email);
        return response()->json(['message' => 'No user found with this email'], 404);
    }
 
    // Check password validity
    if (!Hash::check($request->password, $user->password)) {
        \Log::error('Invalid password for user: ' . $request->email);
        return response()->json(['message' => 'Invalid email or password'], 401);
    }
 
    // Log user in
    Auth::login($user);
 
    // Generate token
    try {
        $token = $user->createToken('auth_token')->plainTextToken;
    } catch (\Exception $e) {
        \Log::error('Token creation failed: ' . $e->getMessage());
        return response()->json(['message' => 'Token creation failed'], 500);
    }
 
    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'user' => $user,
    ], 200);
}
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Successfully logged out'], 200);
}

    // Add this method to the UserController
    public function update(Request $request, $id)
    {
        // Check if the user exists
        $user = User::find($id);
        if (!$user || $request->user()->id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Validate incoming data
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        }
    
        // Update user data
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
    
            return response()->json(['user' => $user, 'message' => 'User updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update user: ' . $e->getMessage()], 500);
        }
    }
    
// Add this method to the UserController
public function destroy($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Delete the user
    $user->delete();

    return response()->json([
        'message' => 'User deleted successfully',
    ], 200);
}

}
