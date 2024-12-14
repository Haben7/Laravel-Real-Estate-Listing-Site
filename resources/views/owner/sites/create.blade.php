@extends('layouts.sidebar')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="h5 mb-0">Add Site</h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Site Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Site Name</label>
                            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                            @error('name') 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter site description" required>{{ old('description') }}</textarea>
                            @error('description') 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Location Field -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" id="location" class="form-control" required value="{{ old('location') }}">
                            @error('location') 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success w-100">Create Site</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
