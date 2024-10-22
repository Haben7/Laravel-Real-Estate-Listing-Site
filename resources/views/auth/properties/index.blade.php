@extends('layouts.sidebar')

@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        #display{
            line-height: 15px;
        }
        #modal{
            margin-top: 16px;

        }
    </style>
</head>

<div class="container">
    <h1>Properties</h1>

    <div class="mb-3">
        <a href="{{ route('properties.create') }}" class="btn btn-success">Create New Property</a>
    </div>

    @if ($properties->isEmpty())
        <div class="alert alert-info" role="alert">
            No properties found. Please add a new property.
        </div>
    @else
    <div class="row">
        @foreach ($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Carousel without auto-slide -->
                    <div id="carousel{{ $property->id }}" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($property->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <!-- Setting a fixed height for the images -->
                                    <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Property Image" style="height: 200px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>

                        <!-- Manual control buttons -->
                        <a class="carousel-control-prev" href="#carousel{{ $property->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $property->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="card-body" style="height: 250px;">
                        <h5 class="card-title" id="display">{{ $property->title }}</h5>
                        <p class="card-text" id="display"><strong>Location:</strong> {{ $property->location }}</p>
                        <p class="card-text" id="display"><strong>Property Type:</strong> {{ $property->property_type == '1' ? 'House' : 'Apartment' }}</p>
                        <p class="card-text" id="display"><strong>Price:</strong> ${{ number_format($property->price, 2) }} , {{$property->negotiable== '1' ? 'Negotiable' : 'Fixed'}}</p>

                        <!-- Trigger button for the modal with unique ID -->
                        <button id="modal{{ $property->id }}" type="button" class="btn btn-primary" data-toggle="modal" data-target="#moreDetailsModal{{ $property->id }}">
                            See More
                        </button>

                        <!-- Modal with unique ID -->
                        <div class="modal fade" id="moreDetailsModal{{ $property->id }}" tabindex="-1" role="dialog" aria-labelledby="moreDetailsModalLabel{{ $property->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="moreDetailsModalLabel{{ $property->id }}">Property Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="card-title">{{ $property->title }}</h5>
                                        <p class="card-text"><strong>Location:</strong> {{ $property->location }}</p>
                                        <p class="card-text"><strong>Property Type:</strong> {{ $property->property_type == '1' ? 'House' : 'Apartment' }}</p>
                                        <p class="card-text"><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
                                        <p class="card-text"><strong>Neighborhood:</strong> {{ $property->neighborhood }}</p>
                                        <p class="card-text"><strong>Landmarks:</strong> {{ $property->landmarks }}</p>
                                        <p class="card-text"><strong>GPS Coordinates:</strong> {{ $property->gps_coordinates }}</p>
                                        <p class="card-text"><strong>Listing Type:</strong> {{ $property->listing_type == '1' ? 'For Sale' : ($property->listing_type == '0' ? 'For Rent' : 'Lease') }}</p>
                                        <p class="card-text"><strong>Maintenance Fees:</strong> ${{ number_format($property->maintenance_fees, 2) }}</p>
                                        <p class="card-text"><strong>Taxes:</strong> ${{ number_format($property->taxes, 2) }}</p>
                                        <p class="card-text"><strong>Utilities:</strong> {{ $property->utilities }}</p>
                                        <p class="card-text"><strong>Size (sqft):</strong> {{ $property->size }}</p>
                                        <p class="card-text"><strong>Bedrooms:</strong> {{ $property->bedrooms }}</p>
                                        <p class="card-text"><strong>Bathrooms:</strong> {{ $property->bathrooms }}</p>
                                        <p class="card-text"><strong>Garage:</strong> {{ $property->garage }}</p>
                                        <p class="card-text"><strong>Balcony:</strong> {{ $property->balcony }}</p>
                                        <p class="card-text"><strong>Garden:</strong> {{ $property->garden }}</p>
                                        <p class="card-text"><strong>Swimming Pool:</strong> {{ $property->swimming_pool == '1' ? 'Yes' : 'No' }}</p>
                                        <p class="card-text"><strong>Condition:</strong> {{ $property->condition == '1' ? 'New' : ($property->condition == '0' ? 'Like New' : 'Needs Renovation') }}</p>
                                        <p class="card-text"><strong>Year Built:</strong> {{ $property->year_built }}</p>
                                        <p class="card-text"><strong>Furnishing Status:</strong> {{ $property->furnishing_status }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between" id="modal">
                            <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this property?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection




































































 {{-- <table style="width: 80%; border-collapse: collapse; margin-top: 20px;margin-left:10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <thead>
            <tr style=" color: white;" class="bg-indigo-900">
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">House Name</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">Address</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">Price</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">location</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">bedrooms</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">bathrooms</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($houses as $house)
                <tr style="background-color: white; border-bottom: 1px solid #dee2e6; transition: background-color 0.3s;">

                    <td style="padding: 12px; font-size: 1em;">{{ $house->title }}</td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->address }}</td>
                </td>

                <td style="padding: 12px; font-size: 1em;">{{ $house->price }}</td>
            </td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->location }}</td>
                    </td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->bedrooms }}</td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->bathrooms }}</td>
                </tr>
        </tbody>
    </table> --}}










    @extends('layouts.site')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <h1>Houses for {{ $site->name }}</h1>
    <a href="{{ route('owner.houses.create', $site->id) }}">Add House</a>

    @if ($houses->isEmpty())
    <div class="alert alert-info" role="alert">
        No properties found. Please add a new property.
    </div>
@else
 
<div class="row">
    @foreach ($houses as $house)
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Carousel without auto-slide -->
                <div id="carousel{{ $house->id }}" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($house->images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <!-- Setting a fixed height for the images -->
                                <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Property Image" style="height: 200px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>

                    <!-- Manual control buttons -->
                    <a class="carousel-control-prev" href="#carousel{{ $house->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel{{ $house->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body" style="height: 250px;">
                    <h5 class="card-title" id="display">{{ $house->title }}</h5>
                    <p class="card-text" id="display"><strong>Address:</strong> {{ $house->address }}</p>
                    <p class="card-text" id="display"><strong>Price:</strong> ${{ number_format($house->price) }} </p>
                    <p class="card-text" id="display"><strong>Location:</strong> {{ $house->location }}</p>
                    <p class="card-text" id="display"><strong>Bedrooms:</strong> {{ $house->bedrooms }}</p>
                    <p class="card-text" id="display"><strong>Bathrooms:</strong> {{ $house->bathrooms }}</p>
                </div></div></div></div>
            </div></div>    </div>    @endforeach
        </div>
        
        @endif
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection




    {{-- <table style="width: 80%; border-collapse: collapse; margin-top: 20px;margin-left:10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <thead>
            <tr style=" color: white;" class="bg-indigo-900">
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">House Name</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">Address</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">Price</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">location</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">bedrooms</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">bathrooms</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($houses as $house)
                <tr style="background-color: white; border-bottom: 1px solid #dee2e6; transition: background-color 0.3s;">

                    <td style="padding: 12px; font-size: 1em;">{{ $house->title }}</td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->address }}</td>
                </td>

                <td style="padding: 12px; font-size: 1em;">{{ $house->price }}</td>
            </td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->location }}</td>
                    </td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->bedrooms }}</td>

                    <td style="padding: 12px; font-size: 1em;">{{ $house->bathrooms }}</td>
                </tr>
        </tbody>
    </table> --}}


















    @extends('layouts.sidebar') 

@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>
    <h1>Add New House</h1>

    <form action="{{ route('owner.houses.store', $site->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" id="location" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" required>
        </div>

        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <input type="number" class="form-control" name="bedrooms" id="bedrooms" min="0">
        </div>

        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>
            <input type="number" class="form-control" name="bathrooms" id="bathrooms" min="0">
        </div>
        <div class="form-group">
            <label for="images">Upload Images (Min 1)</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple accept="image/*" required>
            @error('images[]')
              {{$message}}
            @enderror
            <small class="form-text text-muted">You must upload at least 1 images.</small>
        </div>

        <button type="submit" class="btn btn-primary">Add House</button>
    </form>
    @endsection
