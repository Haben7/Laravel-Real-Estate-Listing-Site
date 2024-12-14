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

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $house->title }}" required>
        </div>

        <!-- Location Dropdown with Custom City Option -->
        <div class="form-group">
            <label for="location">Location</label>
            <select class="form-control" name="location" id="location" required onchange="toggleCustomCity(this)">
                <option value="">Select City</option>
                <option value="Addis Ababa" {{ $house->location == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                <option value="Dire Dawa" {{ $house->location == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
                <option value="Hawassa" {{ $house->location == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                <option value="Adama" {{ $house->location == 'Adama' ? 'selected' : '' }}>Adama</option>
                <option value="Mekelle" {{ $house->location == 'Mekelle' ? 'selected' : '' }}>Mekelle</option>
                <option value="Bahirdar" {{ $house->location == 'Bahirdar' ? 'selected' : '' }}>Bahirdar</option>
                <option value="Gonder" {{ $house->location == 'Gonder' ? 'selected' : '' }}>Gonder</option>
                <option value="Jimma" {{ $house->location == 'Jimma' ? 'selected' : '' }}>Jimma</option>
                <option value="Nazret" {{ $house->location == 'Nazret' ? 'selected' : '' }}>Nazret</option>
                <option value="Kombolcha" {{ $house->location == 'Kombolcha' ? 'selected' : '' }}>Kombolcha</option>
                <option value="Bonga" {{ $house->location == 'Bonga' ? 'selected' : '' }}>Bonga</option>
                <option value="Debre Markos" {{ $house->location == 'Debre Markos' ? 'selected' : '' }}>Debre Markos</option>

            </select>
            <input type="text" class="form-control mt-2" name="custom_city" id="custom_city" value="{{ $house->custom_city }}" style="display: {{ $house->location == 'Custom' ? 'block' : 'none' }};" placeholder="Enter Custom City">
        </div>

        <!-- Price -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ $house->price }}" required>
        </div>

        <!-- Property Type Dropdown -->
        <div class="form-group">
            <label for="property_type">Property Type</label>
            <select class="form-control" name="property_type" id="property_type" required>
                <option value="House" {{ $house->property_type == 'House' ? 'selected' : '' }}>House</option>
                <option value="Apartment" {{ $house->property_type == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="Condo" {{ $house->property_type == 'Condo' ? 'selected' : '' }}>Condo</option>
                <option value="Land" {{ $house->property_type == 'Land' ? 'selected' : '' }}>Land</option>
                <option value="Commercial Space" {{ $house->property_type == 'Commercial Space' ? 'selected' : '' }}>Commercial Space</option>
            </select>
        </div>

        <!-- Negotiable Checkbox -->
        <div class="form-group">
            <label for="negotiable">Negotiable</label>
            <select class="form-control" id="negotiable" name="negotiable">
                <option value="1" {{ old('negotiable') == '1' ? 'selected' : '' }}>Negotiable</option>
                <option value="0" {{ old('negotiable') == '0' ? 'selected' : '' }}>Fixed</option>
            </select>        </div>

        <!-- Bedrooms -->
        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" class="form-control" name="bedrooms" id="bedrooms" value="{{ $house->bedrooms }}" min="0">
        </div>

        <!-- Bathrooms -->
        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" class="form-control" name="bathrooms" id="bathrooms" value="{{ $house->bathrooms }}" min="0">
        </div>

        <!-- House Images -->
        <div class="form-group">
            <label for="images">House Images</label>
            <input type="file" class="form-control" name="images[]" id="images" multiple>
        </div>

        <!-- Owner Contact (Phone and Email) -->
        <div class="form-group">
            <label for="owner_contact">Owner Contact (Phone)</label>
            <input type="text" class="form-control" name="owner_contact" id="owner_contact" value="{{ $house->owner_contact }}" maxlength="20">
        </div>
        <div class="form-group">
            <label for="owner_email">Owner Email</label>
            <input type="email" class="form-control" name="owner_email" id="owner_email" value="{{ $house->owner_email }}">
        </div>

        <!-- Size -->
        <div class="form-group">
            <label for="size">Size (sq meters)</label>
            <input type="number" step="0.01" class="form-control" name="size" id="size" value="{{ $house->size }}">
        </div>

        <!-- Area -->
        <div class="form-group">
            <label for="area">Area</label>
            <input type="text" class="form-control" name="area" id="area" value="{{ $house->area }}">
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ $house->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update House</button>
    </form>

    <script>
        function toggleCustomCity(select) {
            var customCityInput = document.getElementById('custom_city');
            if (select.value === 'Custom') {
                customCityInput.style.display = 'block';
            } else {
                customCityInput.style.display = 'none';
                customCityInput.value = ''; // Clear custom city input if not selected
            }
        }
    </script>
@endsection
