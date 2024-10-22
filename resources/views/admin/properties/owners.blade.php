
@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">All Registered Owners</h1>
        <table class="min-w-full mt-6 bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b"><button>Real Estate Name</button></th>
                    <th class="px-6 py-3 border-b" id="th">Name</th>
                    <th class="px-6 py-3 border-b">Email</th>
                    <th class="px-6 py-3 border-b"><button>Sites</button></th>
                </tr>
            </thead>
            <tbody>
                @foreach($owners as $owner)
                <tr>
                    <td class="px-6 py-4 border-b">{{ $owner->real_estate_name }}</td>
                    <td class="px-6 py-4 border-b">{{ $owner->name }}</td>
                    <td class="px-6 py-4 border-b">{{ $owner->email }}</td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('admin.properties.site', $owner->id) }}">View</a>
                          
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
