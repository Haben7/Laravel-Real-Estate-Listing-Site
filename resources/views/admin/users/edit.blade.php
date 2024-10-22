@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" value="{{ $user->name }}" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" value="{{ $user->email }}" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password (Leave blank if not changing):</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role:</label>
                <select name="role" id="role" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update User</button>
        </form>
    </div>
@endsection
