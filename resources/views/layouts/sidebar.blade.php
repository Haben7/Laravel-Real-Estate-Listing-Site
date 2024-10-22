<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #div{
            margin-top: 70px;
            border-radius: 20px;
        }
      ul{
            width: 100%
            margin-top: 2px;

      }
      #li{
        margin-top: -3%
      }
      #lli{
            margin-top: 36px
        }
        #owner{
            margin-top: 18%;
            padding: 8px 8px 8px 18px;

        }
#modal{
    margin-bottom: 15px;
}
/* Add these styles to your main CSS file or within a <style> tag in the Blade view */
 

h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: auto;
}

div {
    margin-bottom: 15px;
}
#main{
        margin-left: 22%;
        margin-top: 2%
        }
        #sear{
            margin-top: 10px;
            width: 95%;
        }
        #card{
            width: 95%;
            margin-top: 15px;
            margin-bottom: 20px;            
        }
        #id{
            height: 10px;
            padding-top: 20px;
            padding-bottom: 120px;
        }
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
}

#but {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

#but:hover {
    background-color: #0056b3;
}

.text-danger {
    color: red;
    font-size: 0.875em;
}

    </style>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-gray-800 text-white border-b border-gray-600 shadow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Real Estate</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class=" hover:bg-gray-600">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="flex">

        <!-- Sidebar -->
        <aside class="bg-indigo-900 text-gray-100 w-64 shadow h-screen fixed top-0 left-0">
            
            <div class="p-4" id="div">
                <ul class="mt-4 space-y-2">
                    <li id="lli"><a href="{{ route('owner.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-home"></i> Home</a></li>
                    <li id="lli"><a href="{{ route('sites.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-building"></i> Manage Properties</a></li>
                    <li id="lli"><a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-credit-card"></i> Subscription</a></li>
                    <li id="lli"><a href="/admin/reports" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-envelope"></i> Inquries </a></li>
                    <li id="lli"><a href="/admin/content" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-bell"></i> View Notifications</a></li>
                    <li id="lli"><a href="/admin/settings" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-cogs"></i> Settings</a></li>
                </ul>
                
            </div>
           
        </aside>

        <main class="ml-64 flex-1" id="main">
            @yield('content')        </main>
        
    </div>

</body>
</html>































{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
</head>
<body>
    <h1>Owner Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}!</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>--}}

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Owner Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <h3>Property Management</h3>
            <a href="{{ route('properties.index') }}" class="btn btn-primary">Manage Properties</a>
        </div>
        <div class="col-md-6">
            <h3>Inquiries Management</h3>
            <a href="{{ route('inquiries.index') }}" class="btn btn-primary">View Inquiries</a>
        </div>
        <div class="col-md-6">
            <h3>Subscription Management</h3>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-primary">Manage Subscription</a>
        </div>
        <div class="col-md-6">
            <h3>Notifications & Alerts</h3>
            <a href="{{ route('notifications.index') }}" class="btn btn-primary">View Notifications</a>
        </div>
    </div>
</div>
@endsection --}}


