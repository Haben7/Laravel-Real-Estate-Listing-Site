@extends('layouts.sidebar')
@section('content')
    <h1>{{ $site->name }}</h1>
    <a href="{{ route('sites.edit', [$site->id]) }}">Edit</a>

    <h2>Houses</h2>
    <a href="{{ route('sites.houses.create', $site->id) }}">Add House</a>
    <ul>
        @foreach ($site->houses as $house)
            <li>
                <a href="{{ route('sites.houses.show', [$site->id, $house->id]) }}">{{ $house->address }}</a>
            </li>
        @endforeach
    </ul>
@endsection