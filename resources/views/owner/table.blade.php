@extends('layouts.sidebar')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-2xl font-bold mb-4">All Sites</h1>
   
  

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-home"></i> Site List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatablesSimple" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Site Name</th>
                            <th class="text-center">Actions</th>
                            <th class="text-center">Houses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sites as $site)
                            <tr>
                                <td>{{ $site->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('sites.destroy', $site->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this site?');">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('owner.houses.index', [$site->id]) }}" class="btn btn-sm btn-primary">
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
        {{ $sites->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
