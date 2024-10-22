@extends('layouts.sidebar')

@section('content')
    <h1>Edit Image</h1>
    <form method="POST" action="{{ route('houses.images.update', [$house->id, $image->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="file" name="path" required>
        <button type="submit">Update</button>
    </form>
@endsection