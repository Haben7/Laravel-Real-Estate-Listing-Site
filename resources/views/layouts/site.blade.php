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
            border-radius: 20px
        }
        #li{
            margin-top: 36px
        }
        ul{
            width: 100%
            margin-top: 2px;        }      
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
        #user{
            margin-bottom: 23px
        }
        hr{
            width: 100%;
            padding-bottom: 7px
        }
        #graph{
            width: 95%;
        }
        #owner{
            margin-top: 40px;
            padding: 8px 8px 8px 18px;

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
                    <li id="li"><a href="{{ route('owner.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-home"></i> Home</a></li>
                    <li id="li"><a href="{{ route('sites.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-building"></i> Manage Properties</a></li>
                    <li id="li"><a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-credit-card"></i> Subscription</a></li>
                    <li id="li"><a href="/admin/reports" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-envelope"></i> Inquries </a></li>
                    <li id="li"><a href="/admin/content" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-bell"></i> View Notifications</a></li>
                    <li id="li"><a href="/admin/settings" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-cogs"></i> Settings</a></li>
                </ul>
                
            </div>
            
        </aside>

        <main class="ml-64 flex-1" id="main">
            @yield('content')        </main>
        
    </div>

</body>
</html>































