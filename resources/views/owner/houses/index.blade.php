@extends('layouts.sidebar')

@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<div class="container">
    <h1>Houses for {{ $site->name }}</h1>
    <a href="{{ route('owner.houses.create', $site->id) }}" style="display: block; padding: 10px 15px; border-radius: 5px; text-decoration: none; margin: 20px auto; width: 150px; transition: background-color 0.3s; font-size: 1em; margin-left: 10px;" class="bg-indigo-900">Add House</a>

    @if ($houses->isEmpty())
        <div class="alert alert-info" role="alert">
            No properties found. Please add a new property.
        </div>
    @else
        <div class="row">
            @foreach ($houses as $house)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div id="carousel{{ $house->id }}" class="carousel slide">
                            <div class="carousel-inner">
                                @foreach ($house->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Property Image" style="height: 200px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel{{ $house->id }}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel{{ $house->id }}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <div class="card-body" style="height: 170px;">
                            <h5 class="card-title">{{ $house->title }}</h5>
                            <p class="card-text"><strong>Location:</strong> {{ $house->location }}</p>
                            <p class="card-text"><strong>Price:</strong> {{ $house->price }}$,
                            {{ $house->negotiable ? 'Negotiable' : 'Fixed' }}</p>
                            {{-- {{ $site->name }} --}}
                            <p>
                                <i class="fas fa-bed" style="margin-right: 10px;"></i>{{ $house->bedrooms }}
                                <i class="fas fa-shower" style="margin-left: 20px; margin-right: 10px;"></i>{{ $house->bathrooms }}
                                <i class="fas fa-ruler-combined" style="margin-left: 20px; margin-right: 10px;"></i>{{ $house->size }} sq ft
                            </p>
                        </div>

                        <div class="d-flex justify-content-between" style="margin: 10px">
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#houseModal{{ $house->id }}">View Details</a>
                            <a href="{{ route('owner.houses.edit', [$house->site_id, $house->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('owner.houses.destroy', [$house->site_id, $house->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this property?');">Delete</button>
                            </form>
                        </div>
                    </div>            
                </div>

                <!-- Modal for House Details -->
                <div class="modal fade" id="houseModal{{ $house->id }}" tabindex="-1" role="dialog" aria-labelledby="houseModalLabel{{ $house->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="houseModalLabel{{ $house->id }}">{{ $house->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="carouselModal{{ $house->id }}" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach ($house->images as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Property Image" style="height: 300px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselModal{{ $house->id }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselModal{{ $house->id }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="mt-3">
                                    <p><strong>Location:</strong> {{ $house->location }}</p>
                                    <p><strong>Price:</strong> {{ $house->price }}$</p>
                                    <p><strong>Bedrooms:</strong> {{ $house->bedrooms }}</p>
                                    <p><strong>Bathrooms:</strong> {{ $house->bathrooms }}</p>
                                    <p><strong>Property Type:</strong> {{ $house->property_type }}</p>
                                    <p><strong>Negotiable:</strong> {{ $house->negotiable ? 'Yes' : 'No' }}</p>
                                    <p><strong>Owner Contact:</strong> {{ $house->owner_contact }}</p>
                                    <p><strong>Owner Contact:</strong> {{ $house->owner_email }}</p>

                                    <p><strong>Size:</strong> {{ $house->size }} sq ft</p>
                                    <p><strong>Description:</strong> {{ $house->description }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach       
        </div>                  
    @endif
</div>

@endsection
