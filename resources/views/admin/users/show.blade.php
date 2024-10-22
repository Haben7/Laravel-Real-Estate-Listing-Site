<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>User Details</h1>

        <h2>Name: {{ $user->name }}</h2>
        <h3>Email: {{ $user->email }}</h3>
        <h4>Properties:</h4>
        <ul>
            @foreach ($user->properties as $property)
                <li>{{ $property->title }} - {{ $property->status }}</li>
            @endforeach
        </ul>
        <h4>Activity History:</h4>
        <ul>
            @foreach ($user->activities as $activity)
                <li>{{ $activity->description }} on {{ $activity->created_at }}</li>
            @endforeach
        </ul>

        <a href="{{ route('admin.users.index') }}">Back to Users</a>
    </div>
</body>
</html>
