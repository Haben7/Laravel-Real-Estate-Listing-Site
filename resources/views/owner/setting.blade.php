@extends('layouts.sidebar')

@section('content')
<div class="container-fluid px-4 py-5">
    <h1 class="display-6 mb-4 text-center">Account Information</h1>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="h5 mb-0">Profile Information</h2>
        </div>
        <div class="card-body">
            <p class="mb-2"><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p class="mb-2"><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p class="mb-2"><strong>Real Estate Name:</strong> {{ auth()->user()->real_estate_name }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h2 class="h5 mb-0">Update Information</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('owner.setting.update') }}" method="POST">
                @csrf
                @method('PUT')
              
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"  required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"  required>
                    @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control"  placeholder="Leave blank to keep current password">
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="real_estate_name" class="form-label">Real Estate Name</label>
                    <input type="text" name="real_estate_name" id="real_estate_name" class="form-control" >
                    @error('real_estate_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success w-100">Update Information</button>
            </form>
        </div>
    </div>
</div>
@endsection
