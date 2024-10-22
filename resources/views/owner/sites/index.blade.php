@extends('layouts.site')

@section('content')
    {{-- <h1 style="background-color: ; color: white;  margin-bottom: 20px;font-family: 'Arial', sans-serif; margin-left:10px;font-size: 2em;">Sites for</h1> --}}
    <a href="{{ route('sites.create') }}" style="display: block; text-align: center; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; margin: 20px auto; width: 150px; transition: background-color 0.3s; font-size: 1em;margin-left:10px;"class="bg-indigo-900">Add Site</a>
    
    <table style="width: 80%; border-collapse: collapse; margin-top: 20px;margin-left:10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <thead>
            <tr style=" color: white;" class="bg-indigo-900">
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">Site Name</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">Actions</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">Add House</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #dee2e6; font-size: 1.1em;">View Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $site)
                <tr style="background-color: white; border-bottom: 1px solid #dee2e6; transition: background-color 0.3s;">
                    <td style="padding: 12px; font-size: 1em;">{{ $site->name }}</td>
                    <td style="padding: 12px; font-size: 1em;">
                        <a href="{{ route('sites.edit', $site->id) }}" style="color: #007bff; text-decoration: none; transition: color 0.3s;">Edit</a> |
                        <form method="POST" action="{{ route('sites.destroy', $site->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc3545; text-decoration: underline; cursor: pointer;" onclick="return confirm('Are you sure you want to delete this site?');">Delete</button>
                        </form>
                    </td>
                    <td style="padding: 12px; font-size: 1em;">
                        <a href="{{ route('owner.houses.index', [$site->id]) }}" style="color: #007bff; text-decoration: none; transition: color 0.3s;">Add</a>
                    </td>
                    <td style="padding: 12px; font-size: 1em;">
                        <a href="{{ route('sites.edit', [$site->id]) }}" style="color: #007bff; text-decoration: none; transition: color 0.3s;">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection