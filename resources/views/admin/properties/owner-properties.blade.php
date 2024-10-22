@extends('layouts.propertysidebar')

@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        #display {
            line-height: 15px;
        }
        #modal{
            margin-top: 16px;
        }
        #owner{
            margin-top: -0.001%
        }
    </style>
</head>

<div class="container">
    <h1 id="owner">Properties posted by {{ $owner->real_estate_name }}</h1>

    @if ($properties->isEmpty())
        <div class="alert alert-info" role="alert">
            No properties found.
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
