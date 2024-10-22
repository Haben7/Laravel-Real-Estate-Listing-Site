@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Create New User</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role:</label>
                <select name="role" id="role" class="w-full p-2 border border-gray-300 rounded" required onchange="toggleRealEstateField()">
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
            <div class="mb-4" id="real_estate_field" style="display:none;">
                <label for="real_estate_name" class="block text-gray-700">Real Estate Name:</label>
                <input type="text" name="real_estate_name" id="real_estate_name" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create User</button>
        </form>
    </div>

    <script>
        function toggleRealEstateField() {
            const roleSelect = document.getElementById('role');
            const realEstateField = document.getElementById('real_estate_field');

            if (roleSelect.value === 'owner') {
                realEstateField.style.display = 'block';
                document.getElementById('real_estate_name').required = true;
            } else {
                realEstateField.style.display = 'none';
                document.getElementById('real_estate_name').required = false;
            }
        }

        // Call the function on page load in case the form reloads
        window.onload = toggleRealEstateField;
    </script>
@endsection
