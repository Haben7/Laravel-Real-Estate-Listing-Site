@extends('layouts.site')

@section('content')
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<div class="container">

    <h1>Houses for {{ $site->name }}</h1>
    <a href="{{ route('owner.houses.create', $site->id) }}"style="display: block; text-align: center; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; margin: 20px auto; width: 150px; transition: background-color 0.3s; font-size: 1em;margin-left:10px;"class="bg-indigo-900">Add House</a>

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
                        <div class="d-flex justify-content-between" id="modal">
                            <a href="{{ route('owner.houses.edit', [$house->site_id, $house->id]) }}" class="btn btn-warning">Edit</a>

<form action="{{ route('owner.houses.destroy', [$house->site_id, $house->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this property?');">Delete</button>
</form>

                        </div>
                    </div>            
                </div>       
            @endforeach       
        </div>                  
    @endif
</div>
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
            </tr> --}}