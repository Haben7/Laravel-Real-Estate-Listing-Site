@extends('layouts.sidebar')

@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>
<div class="container">
    <h1>Edit Property</h1>
    
    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This allows the form to use the PUT method for updates -->

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $property->title) }}" required>
        </div>

        <!-- Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $property->location) }}" required>
        </div>

        <!-- Neighborhood -->
        <div class="form-group">
            <label for="neighborhood">Neighborhood</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ old('neighborhood', $property->neighborhood) }}">
        </div>

        <!-- Landmarks -->
        <div class="form-group">
            <label for="landmarks">Landmarks</label>
            <input type="text" class="form-control" id="landmarks" name="landmarks" value="{{ old('landmarks', $property->landmarks) }}">
        </div>

        <!-- GPS Coordinates -->
        <div class="form-group">
            <label for="gps_coordinates">GPS Coordinates</label>
            <input type="text" class="form-control" id="gps_coordinates" name="gps_coordinates" value="{{ old('gps_coordinates', $property->gps_coordinates) }}">
        </div>

        <!-- Property Type -->
        <div class="form-group">
            <label for="property_type">Property Type</label>
            <select class="form-control" id="property_type" name="property_type">
                <option value="1" {{ old('property_type', $property->property_type) == '1' ? 'selected' : '' }}>House</option>
                <option value="0" {{ old('property_type', $property->property_type) == '0' ? 'selected' : '' }}>Apartment</option>
                <option value="0" {{ old('property_type', $property->property_type) == '0' ? 'selected' : '' }}>Condo</option>
                <option value="0" {{ old('property_type', $property->property_type) == '0' ? 'selected' : '' }}>Land</option>
                <option value="0" {{ old('property_type', $property->property_type) == '0' ? 'selected' : '' }}>Commercial Space</option>
            </select>
        </div>

        <!-- Listing Type -->
        <div class="form-group">
            <label for="listing_type">Listing Type</label>
            <select class="form-control" id="listing_type" name="listing_type">
                <option value="1" {{ old('listing_type', $property->listing_type) == '1' ? 'selected' : '' }}>For Sale</option>
                <option value="0" {{ old('listing_type', $property->listing_type) == '0' ? 'selected' : '' }}>For Rent</option>
                <option value="0" {{ old('listing_type', $property->listing_type) == '0' ? 'selected' : '' }}>Lease</option>
            </select>
        </div>

        <!-- Price and Negotiable -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $property->price) }}" required>
        </div>

        <div class="form-group">
            <label for="negotiable">Negotiable</label>
            <select class="form-control" id="negotiable" name="negotiable">
                <option value="1" {{ old('negotiable', $property->negotiable) == '1' ? 'selected' : '' }}>Negotiable</option>
                <option value="0" {{ old('negotiable', $property->negotiable) == '0' ? 'selected' : '' }}>Fixed</option>
            </select>
        </div>

        <!-- Maintenance Fees, Taxes, Utilities -->
        <div class="form-group">
            <label for="maintenance_fees">Maintenance Fees</label>
            <input type="number" class="form-control" id="maintenance_fees" name="maintenance_fees" value="{{ old('maintenance_fees', $property->maintenance_fees) }}">
        </div>

        <div class="form-group">
            <label for="taxes">Taxes</label>
            <input type="number" class="form-control" id="taxes" name="taxes" value="{{ old('taxes', $property->taxes) }}">
        </div>

        <div class="form-group">
            <label for="utilities">Utilities</label>
            <input type="text" class="form-control" id="utilities" name="utilities" value="{{ old('utilities', $property->utilities) }}">
        </div>

        <!-- Size, Bedrooms, Bathrooms -->
        <div class="form-group">
            <label for="size">Size (sqft)</label>
            <input type="number" class="form-control" id="size" name="size" value="{{ old('size', $property->size) }}" required>
        </div>

        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" class="form-control" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" required>
        </div>

        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" required>
        </div>

        <!-- Additional Fields like Floors, Garage, Balcony, Garden, etc. -->
        <!-- Repeat similar blocks for other fields, pre-filling the data from the $property object -->

        <!-- Image Upload Section -->
        <div class="form-group">
            <label for="images">Upload Images (Min 5)</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple accept="image/*">
            @error('images[]')
                {{$message}}
            @enderror
            <small class="form-text text-muted">You must upload at least 5 images.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Property</button>
    </form>
</div>
@endsection
