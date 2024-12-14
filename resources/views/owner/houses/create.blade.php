@extends('layouts.sidebar')

@section('content')
    <h1 id="house" class="text-3xl font-semibold text-gray-800 mb-6" style="margin-left: 30px;">Add New House</h1>

    @if(session('success'))
        <div class="alert alert-success bg-green-200 text-green-800 p-3 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger bg-red-200 text-red-800 p-3 mb-4 rounded-md">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('owner.houses.store', $site->id) }}" enctype="multipart/form-data" class="space-y-6" style="margin-left: 30px;margin-right:30px">
        @csrf

        <!-- Title -->
        <div class="form-group">
            <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
            <input type="text" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="title" id="title" required>
        </div>

        <!-- Location Dropdown with Custom City Option -->
        <div class="form-group">
            <label for="location" class="block text-lg font-medium text-gray-700">Location</label>
            <select class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="location" id="location" required onchange="toggleCustomCity(this)">
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
            <label for="price" class="block text-lg font-medium text-gray-700">Price</label>
            <input type="number" step="0.01" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="price" id="price" required>
        </div>

        <!-- Property Type Dropdown -->
        <div class="form-group">
            <label for="property_type" class="block text-lg font-medium text-gray-700">Property Type</label>
            <select class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="property_type" id="property_type" required>
                <option value="House">House</option>
                <option value="Apartment">Apartment</option>
                <option value="Condo">Condo</option>
                <option value="Land">Land</option>
                <option value="Commercial Space">Commercial Space</option>
            </select>
        </div>

        <!-- Negotiable Checkbox -->
        <div class="form-group">
            <label for="negotiable" class="block text-lg font-medium text-gray-700">Negotiable</label>
            <select class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" id="negotiable" name="negotiable">
                <option value="1" {{ old('negotiable') == '1' ? 'selected' : '' }}>Negotiable</option>
                <option value="0" {{ old('negotiable') == '0' ? 'selected' : '' }}>Fixed</option>
            </select>
        </div>

        <!-- Bedrooms -->
        <div class="form-group">
            <label for="bedrooms" class="block text-lg font-medium text-gray-700">Bedrooms</label>
            <input type="number" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="bedrooms" id="bedrooms" min="0">
        </div>

        <!-- Bathrooms -->
        <div class="form-group">
            <label for="bathrooms" class="block text-lg font-medium text-gray-700">Bathrooms</label>
            <input type="number" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="bathrooms" id="bathrooms" min="0">
        </div>

        <!-- Owner Contact (Phone and Email) -->
        <div class="form-group">
            <label for="owner_contact" class="block text-lg font-medium text-gray-700">Owner Contact (Phone)</label>
            <input type="text" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="owner_contact" id="owner_contact" maxlength="20">
        </div>
        <div class="form-group">
            <label for="owner_email" class="block text-lg font-medium text-gray-700">Owner Email</label>
            <input type="email" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="owner_email" id="owner_email">
        </div>

        <!-- Size -->
        <div class="form-group">
            <label for="size" class="block text-lg font-medium text-gray-700">Size (sq meters)</label>
            <input type="number" step="0.01" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="size" id="size">
        </div>

        <!-- Area -->
        <div class="form-group">
            <label for="area" class="block text-lg font-medium text-gray-700">Area</label>
            <input type="text" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="area" id="area">
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
            <textarea class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="description" id="description" rows="3"></textarea>
        </div>

        <!-- House Images -->
        <div class="form-group">
            <label for="images" class="block text-lg font-medium text-gray-700">House Images</label>
            <input type="file" class="form-control mt-2 p-2 border border-gray-300 rounded-lg w-full" name="images[]" id="images" multiple>
        </div>

        <button type="submit" class="btn btn-primary bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700">Add House</button>
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
