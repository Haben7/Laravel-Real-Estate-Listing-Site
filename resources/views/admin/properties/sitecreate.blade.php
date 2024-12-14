@extends('layouts.sidebar')

@section('content')
    <h1>Add Site</h1>
    <form action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Site Name:</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description"  placeholder="Enter site description">{{ old('description') }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required value="{{ old('location') }}">
            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <button type="submit" id="but">Create Site</button>
    </form>
@endsection
