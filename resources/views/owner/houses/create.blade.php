@extends('layouts.sidebar') 


@section('content')
    <h1>Add New House</h1>

    @if(session('success'))
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

    <form method="POST" action="{{ route('owner.houses.store', $site->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" id="location" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" required>
        </div>

        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" class="form-control" name="bedrooms" id="bedrooms" min="0">
        </div>

        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" class="form-control" name="bathrooms" id="bathrooms" min="0">
        </div>
        <div class="form-group">
            <label for="images">House Images</label>
            <input type="file" class="form-control" name="images[]" id="images" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Add House</button>
    </form>
    @endsection
