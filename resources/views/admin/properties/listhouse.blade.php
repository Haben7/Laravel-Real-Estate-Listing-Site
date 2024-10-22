@extends('layouts.propertysidebar')

@section('content')
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<div class="container">

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
                        <div id="carousel{{ $house->id }}"    class="carousel slide">
                            <div class="carousel-inner">
                                @foreach ($house->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <!-- Setting a fixed height for the images -->
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

                     

                        <div class="card-body" style="height: 250px;">
                            <h5 class="card-title" id="display">{{ $house->title }}</h5>
                            <p class="card-text" id="display"><strong>Address:</strong> {{ $house->address }}</p>
                            <p class="card-text" id="display"><strong>Location:</strong> {{ $house->location }}</p>
                            <p class="card-text" id="display"><strong>Price:</strong> {{ $house->price }}</p>
                            <p class="card-text" id="display"><strong>Bedrooms:</strong> {{ $house->bedrooms}}</p>
                            <p class="card-text" id="display"><strong>Bathrooms:</strong> {{ $house->bathrooms}}</p>
                        </div>
                    </div>            
                </div>       
            @endforeach       
        </div>                  
    @endif
</div>
@endsection