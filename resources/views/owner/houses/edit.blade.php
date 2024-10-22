@extends('layouts.sidebar')

@section('content')
    <h1>Edit House</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('owner.houses.update', [$site->id, $house->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $house->title }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" id="location" value="{{ $house->location }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ $house->address }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ $house->price }}" required>
        </div>

        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" class="form-control" name="bedrooms" id="bedrooms" value="{{ $house->bedrooms }}" min="0">
        </div>

        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" class="form-control" name="bathrooms" id="bathrooms" value="{{ $house->bathrooms }}" min="0">
        </div>

        <div class="form-group">
            <label for="images">House Images</label>
            <input type="file" class="form-control" name="images[]" id="images" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Update House</button>
    </form>
@endsection
