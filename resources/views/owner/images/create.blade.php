@extends('layouts.sidebar')

@section('content')
    <h1>Add Image</h1>
    <form method="POST" action="{{ route('houses.images.store', $house->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="path" required>
        <button type="submit">Submit</button>
    </form>
@endsection