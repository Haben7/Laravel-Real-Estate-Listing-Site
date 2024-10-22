@extends('layouts.sidebar')

@section('content')
    <h1>Image Details</h1>
    <img src="{{ asset($image->path) }}" alt="House Image" style="width:300px;height:auto;">
    <form method="POST" action="{{ route('houses.images.destroy', [$house->id, $image->id]) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this image?');">Delete</button>
    </form>
@endsection