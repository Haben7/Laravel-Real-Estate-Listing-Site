@extends('layouts.admin')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="h5 mb-0">Create New User</h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <!-- Role Field -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" required onchange="toggleRealEstateField()">
                                <option value="admin">Admin</option>
                                <option value="owner">Owner</option>
                            </select>
                        </div>

                        <!-- Real Estate Name Field -->
                        <div class="mb-3" id="real_estate_field" style="display:none;">
                            <label for="real_estate_name" class="form-label">Real Estate Name</label>
                            <input type="text" name="real_estate_name" id="real_estate_name" class="form-control">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success w-100">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

    window.onload = toggleRealEstateField;
</script>
@endsection
