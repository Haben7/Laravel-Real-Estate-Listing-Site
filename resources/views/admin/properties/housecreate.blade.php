@extends('layouts.create')

@section('content')

    <h1 id="house">Add New House</h1>

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

    <form method="POST" action="{{ route('admin.properties.store', $site->id) }}" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <!-- Location Dropdown with Custom City Option -->
        <div class="form-group">
            <label for="location">Location</label>
            <select class="form-control" name="location" id="location" required onchange="toggleCustomCity(this)" style="width: 100%;">
                <option value="">Select City</option>
                <option value="Addis Ababa">Addis Ababa</option>
                <option value="Dire Dawa">Dire Dawa</option>
                <option value="Hawassa">Hawassa</option>
                <option value="Adama">Adama</option>
                <option value="Mekelle">Mekelle</option>
                <option value="Nazret">Nazret</option>
                <option value="Bahir Dar">Bahirdar</option>
                <option value="Kombolcha">Kombolcha</option>
                <option value="Bonga">Bonga</option>
                <option value="Debre Markos">Debre Markos</option>
                <option value="Gonder">Gonder</option>
                <option value="Jimma">Jimma</option>

            </select>
        </div>

        <!-- Price -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" required style="width: 100%; border: 2px solid black;"
>
        </div>

        <!-- Property Type Dropdown -->
        <div class="form-group">
            <label for="property_type">Property Type</label>
            <select class="form-control" name="property_type" id="property_type" required style="width: 100%; border: 2px solid black;"
>
                <option value="House">House</option>
                <option value="Apartment">Apartment</option>
                <option value="Condo">Condo</option>
                <option value="Land">Land</option>
                <option value="Commercial Space">Commercial Space</option>
            </select>
        </div>

        <!-- Negotiable Checkbox -->
        <div class="form-group">
            <label for="negotiable">Negotiable</label>
            <select class="form-control" id="negotiable" name="negotiable"style="width: 100%; border: 2px solid black;"
>
                <option value="1" {{ old('negotiable') == '1' ? 'selected' : '' }}>Negotiable</option>
                <option value="0" {{ old('negotiable') == '0' ? 'selected' : '' }}>Fixed</option>
            </select>
        </div>

        <!-- Bedrooms -->
        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" class="form-control" name="bedrooms" id="bedrooms" min="0" style="width: 100%; border: 2px solid black;"
>
        </div>

        <!-- Bathrooms -->
        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" class="form-control" name="bathrooms" id="bathrooms" min="0" style="width: 100%; border: 2px solid black;"
>
        </div>

        <!-- House Images -->
       
        <!-- Owner Contact (Phone and Email) -->
        <div class="form-group">
            <label for="owner_contact">Owner Contact (Phone)</label>
            <input type="text" class="form-control" name="owner_contact" id="owner_contact" maxlength="20" style="width: 100%; border: 2px solid black;"
>
        </div>
        <div class="form-group">
            <label for="owner_email">Owner Email</label>
            <input type="email" class="form-control" name="owner_email" id="owner_email" style="width: 100%; border: 2px solid black;"
>
        </div>

        <!-- Size -->
        <div class="form-group">
            <label for="size">Size (sq meters)</label>
            <input type="number" step="0.01" class="form-control" name="size" id="size" style="width: 100%; border: 2px solid black;"
            >
        </div>

        <!-- Area -->
        <div class="form-group">
            <label for="area">Area</label>
            <input type="text" class="form-control" name="area" id="area" style="width: 100%; border: 2px solid black;"
>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="images">House Images</label>
            <input type="file" class="form-control" name="images[]" id="images" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Add House</button>
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
