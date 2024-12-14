@extends('layouts.admin')

@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .custom-table {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .custom-table th {
            background-color: #4b5563; /* Dark indigo */
            color: white;
        }
        .custom-table tbody tr:hover {
            background-color: #f3f4f6; /* Light grey */
        }
        .custom-table td, .custom-table th {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        .custom-table-actions a, .custom-table-actions button {
            color: #007bff;
            transition: color 0.3s;
        }
        .custom-table-actions button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            text-decoration: underline;
        }
        .custom-table-actions button:hover, .custom-table-actions a:hover {
            color: #0056b3; /* Darker blue */
        }
    </style>
</head>

<div class="container mt-4">
    <h1 class="mb-4">Properties Posted by {{ $owner->real_estate_name }}</h1>

    @if ($sites->isEmpty())
        <div class="alert alert-info" role="alert">
            No properties found.
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Site Name</th>
                        <th>Actions</th>
                        <th>View Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sites as $site)
                        <tr>
                            <td>{{ $site->name }}</td>
                            <td class="custom-table-actions">
                                {{-- Edit option can be added if needed --}}
                                <form method="POST" action="{{ route('sites.destroy', [$site->id]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this site?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.properties.listhouse', [$site->id]) }}"><i class="fas fa-eye"></i>    View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
