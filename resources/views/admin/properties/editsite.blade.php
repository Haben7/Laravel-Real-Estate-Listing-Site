@extends('layouts.create')

@section('content')
    <h1 style="margin-bottom: 20px; font-family: 'Arial', sans-serif; margin-left:10px; font-size: 2em;">Edit Site</h1>
    
    <form action="{{ route('sites.update', $site->id) }}" method="POST" style="margin-left:10px;">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">Site Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $site->name) }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="{{ old('description', $site->description) }}" required>
        </div>

        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="{{ old('location', $site->location) }}" required>
        </div>

        <button type="submit" class="bg-indigo-900 text-white px-4 py-2 rounded">Update Site</button>
    </form>

    <a href="{{ route('sites.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Back to Sites</a>
@endsection
