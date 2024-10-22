@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">All Registered Users</h1>
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New User</a>

        <table class="min-w-full mt-6 bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b" id="th">Name</th>
                    <th class="px-6 py-3 border-b" id="th">Real Estate Name</th>
                    <th class="px-6 py-3 border-b">Email</th>
                    <th class="px-6 py-3 border-b">Actions</th>
                    <th class="px-6 py-3 border-b">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $user->name }}</td>
                        <td class="px-6 py-4 border-b">
                            {{ $user->role === 'owner' ? $user->real_estate_name : 'N/A' }}
                        </td>                        
                        <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                            <td class="px-6 py-4 border-b">{{ $user->role }}</td>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
