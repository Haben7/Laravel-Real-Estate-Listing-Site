@extends('layouts.sidebar')
@section('content')
    <h1>Images for {{ $house->address }}</h1>
    <a href="{{ route('houses.images.create', $house->id) }}">Add Image</a>
    <ul>
        @foreach ($images as $image)
            <li>
                <img src="{{ asset($image->path) }}" alt="House Image" style="width:100px;height:auto;">
                <form method="POST" action="{{ route('houses.images.destroy', [$house->id, $image->id]) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this image?');">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection