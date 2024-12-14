@extends('layouts.admin')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="h5 mb-0">Edit User</h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <!-- Password Field (Optional) -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave blank if not changing)</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <!-- Role Field -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                            </select>
                        </div>

                        <!-- Real Estate Name Field (for Owners only) -->
                        <div class="mb-3" id="real_estate_field" style="{{ $user->role == 'owner' ? '' : 'display:none;' }}">
                            <label for="real_estate_name" class="form-label">Real Estate Name</label>
                            <input type="text" name="real_estate_name" id="real_estate_name" class="form-control" value="{{ $user->real_estate_name }}">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success w-100">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle real estate name field visibility based on role selection
    document.getElementById('role').addEventListener('change', function () {
        const realEstateField = document.getElementById('real_estate_field');
        if (this.value === 'owner') {
            realEstateField.style.display = '';
        } else {
            realEstateField.style.display = 'none';
        }
    });

    // Ensure real estate name field visibility on page load (in case the user is an owner)
    window.onload = function () {
        document.getElementById('role').dispatchEvent(new Event('change'));
    };
</script>
@endsection
