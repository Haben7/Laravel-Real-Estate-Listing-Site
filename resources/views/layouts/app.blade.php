<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        {{-- @include('partials.navbar') <!-- If you have a navigation bar --> --}}
        @yield('content') <!-- This is where your page-specific content will be injected -->
    </div>
</body>
</html>
