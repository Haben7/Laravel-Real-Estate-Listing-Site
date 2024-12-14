@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registered Owners</h1>

    <div class="mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add New Owner
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users"></i> Registered Owners List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Real Estate Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center">Sites</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($owners as $owner)
                            <tr>
                                <td>{{ $owner->real_estate_name }}</td>
                                <td>{{ $owner->name }}</td>
                                <td>{{ $owner->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.properties.site', $owner->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $owners->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
