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
            margin-top: 30%;
            border-radius: 20px;
        }
      ul{
            width: 100%
            margin-top: 2px;

      }
      #li{
        margin-top: 20%
      }
       
        #owner{
            margin-top: 70px;
            padding: 8px 8px 8px 18px;

        }
#modal{
    margin-bottom: 15px
}
    </style>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-purple-900 text-white border-b border-indigo-900 shadow sticky top-0 z-50">
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
        <aside class="bg-purple-800 text-gray-100 w-64 shadow h-screen fixed top-0 left-0">
            
            <div class="p-4" id="div">
              <ul class="mt-4 space-y-2">
                <li id="li"><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4 text-gray-100" ><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li id="li"><a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4 text-gray-100"><i class="fas fa-users"></i> User Management</a></li>
                <li id="li"><a href="{{ route('admin.properties.owners') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4 text-gray-100"><i class="fas fa-home"></i> Property </a></li>
                
                <li id="li"><a href="{{ route('admin.setting.update') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4 text-gray-100"><i class="fas fa-cogs"></i> Settings</a></li>
            </ul>
                
            </div>
            <div id="owner" class="bg-purple-700 ">Logged in as:<br>
                An Admin</div>
        </aside>

        <main class="ml-64 flex-1" id="main">
            @yield('content')        </main>
        
    </div>

</body>
</html>

