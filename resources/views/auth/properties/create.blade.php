@extends('layouts.sidebar')

@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>
<div class="container">
    <h1>Create Property</h1>
    
    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
        </div>

        <div class="form-group">
            <label for="neighborhood">Neighborhood</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}">
        </div>

        <div class="form-group">
            <label for="landmarks">Landmarks</label>
            <input type="text" class="form-control" id="landmarks" name="landmarks" value="{{ old('landmarks') }}">
        </div>

        <div class="form-group">
            <label for="gps_coordinates">GPS Coordinates</label>
            <input type="text" class="form-control" id="gps_coordinates" name="gps_coordinates" value="{{ old('gps_coordinates') }}">
        </div>

        <div class="form-group">
            <label for="property_type">Property Type</label>
            <select class="form-control" id="property_type" name="property_type">
              <option value="1" {{ old('property_type') == '1' ? 'selected' : '' }}>House</option>
              <option value="0" {{ old('property_type') == '0' ? 'selected' : '' }}>Apartment</option>
              <option value="0" {{ old('property_type') == '0' ? 'selected' : '' }}>Condo</option>
              <option value="0" {{ old('property_type') == '0' ? 'selected' : '' }}>Land</option>
              <option value="0" {{ old('property_type') == '0' ? 'selected' : '' }}>Commercial Space</option>


          </select>
        </div>

        <div class="form-group">
            <label for="listing_type">Listing Type</label>
            <select class="form-control" id="listing_type" name="listing_type">
              <option value="1" {{ old('listing_type') == '1' ? 'selected' : '' }}>For Sale</option>
              <option value="0" {{ old('listing_type') == '0' ? 'selected' : '' }}>For Rent</option>
              <option value="0" {{ old('listing_type') == '0' ? 'selected' : '' }}>Lease</option>
          </select>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
            <div class="form-group">
                <label for="negotiable">Negotiable</label>
                <select class="form-control" id="negotiable" name="negotiable">
                    <option value="1" {{ old('negotiable') == '1' ? 'selected' : '' }}>Negotiable</option>
                    <option value="0" {{ old('negotiable') == '0' ? 'selected' : '' }}>Fixed</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="maintenance_fees">Maintenance Fees</label>
            <input type="number" class="form-control" id="maintenance_fees" name="maintenance_fees" value="{{ old('maintenance_fees') }}">
        </div>

        <div class="form-group">
            <label for="taxes">Taxes</label>
            <input type="number" class="form-control" id="taxes" name="taxes" value="{{ old('taxes') }}">
        </div>

        <div class="form-group">
            <label for="utilities">Utilities</label>
            <input type="text" class="form-control" id="utilities" name="utilities" value="{{ old('utilities') }}">
        </div>

        <div class="form-group">
            <label for="size">Size (sqft)</label>
            <input type="number" class="form-control" id="size" name="size" value="{{ old('size') }}" required>
        </div>

        <div class="form-group">
            <label for="lot_size">Lot Size (sqft)</label>
            <input type="number" class="form-control" id="lot_size" name="lot_size" value="{{ old('lot_size') }}">
        </div>

        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" class="form-control" id="bedrooms" name="bedrooms" value="{{ old('bedrooms') }}" required>
        </div>

        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}" required>
        </div>

        <div class="form-group">
            <label for="floors">Floors</label>
            <input type="number" class="form-control" id="floors" name="floors" value="{{ old('floors') }}">
        </div>

        <div class="form-group">
            <label for="garage">Garage</label>
            <input type="text" class="form-control" id="garage" name="garage" value="{{ old('garage') }}">
        </div>

        <div class="form-group">
            <label for="balcony">Balcony</label>
            <input type="text" class="form-control" id="balcony" name="balcony" value="{{ old('balcony') }}">
        </div>

        <div class="form-group">
            <label for="garden">Garden</label>
            <input type="text" class="form-control" id="garden" name="garden" value="{{ old('garden') }}">
        </div>

        <div class="form-group">
            <label for="swimming_pool">Swimming Pool</label>
            <select class="form-control" id="swimming_pool" name="swimming_pool">
                <option value="1" {{ old('swimming_pool') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('swimming_pool') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
          <label for="condition">Condition</label>
          <select class="form-control" id="condition" name="condition">
            <option value="1" {{ old('condition') == '1' ? 'selected' : '' }}>New</option>
            <option value="0" {{ old('condition') == '0' ? 'selected' : '' }}>Like New</option>
            <option value="0" {{ old('condition') == '0' ? 'selected' : '' }}>Needs Renovation</option>
        </select>
      </div>

        <div class="form-group">
            <label for="heating_cooling_system">Heating/Cooling System</label>
            <input type="text" class="form-control" id="heating_cooling_system" name="heating_cooling_system" value="{{ old('heating_cooling_system') }}">
        </div>

        <div class="form-group">
            <label for="furnishing_status">Furnishing Status</label>
            <input type="text" class="form-control" id="furnishing_status" name="furnishing_status" value="{{ old('furnishing_status') }}">
        </div>

        <div class="form-group">
            <label for="year_built">Year Built</label>
            <input type="number" class="form-control" id="year_built" name="year_built" value="{{ old('year_built') }}">
        </div>

        <div class="form-group">
            <label for="renovation_year">Renovation Year</label>
            <input type="number" class="form-control" id="renovation_year" name="renovation_year" value="{{ old('renovation_year') }}">
        </div>

      

        <div class="form-group">
            <label for="ownership_type">Ownership Type</label>
            <input type="text" class="form-control" id="ownership_type" name="ownership_type" value="{{ old('ownership_type') }}">
        </div>

        <div class="form-group">
            <label for="title_status">Title Status</label>
            <input type="text" class="form-control" id="title_status" name="title_status" value="{{ old('title_status') }}">
        </div>

        <div class="form-group">
            <label for="zoning">Zoning</label>
            <input type="text" class="form-control" id="zoning" name="zoning" value="{{ old('zoning') }}">
        </div>

        <div class="form-group">
            <label for="building_permits">Building Permits</label>
            <input type="text" class="form-control" id="building_permits" name="building_permits" value="{{ old('building_permits') }}">
        </div>

        <div class="form-group">
            <label for="mortgage_status">Mortgage Status</label>
            <input type="text" class="form-control" id="mortgage_status" name="mortgage_status" value="{{ old('mortgage_status') }}">
        </div>

        <div class="form-group">
            <label for="available_from">Available From</label>
            <input type="date" class="form-control" id="available_from" name="available_from" value="{{ old('available_from') }}">
        </div>
        <div class="form-group">
          <label for="images">Upload Images (Min 5)</label>
          <input type="file" class="form-control-file" id="images" name="images[]" multiple accept="image/*" required>
          @error('images[]')
            {{$message}}
          @enderror
          <small class="form-text text-muted">You must upload at least 5 images.</small>
      </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
