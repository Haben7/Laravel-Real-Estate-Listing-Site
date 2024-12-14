<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>Owner Dashboard</title>
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
            margin-top: 66px
        }
        ul{
            margin-top: 2px;
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
        #user{
            margin-bottom: 23px
        }
        hr{
            width: 100%;
            padding-bottom: 7px
        }
        #graph{
            width: 60%;
            margin: auto;}
        #owner{
            margin-top: 30%;
            padding: 18px 18px 18px 28px;

        }

#prop{
    margin-top: 20px;
}
    </style>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-purple-900 text-white border-b border-gray-600 shadow sticky top-0 z-50">
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
                <ul class="mt-4 space-y-2" id="div">
                    <li id="li"><a href="{{ route('owner.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-home"></i> Home</a></li>
                    <li id="li"><a href="{{ route('sites.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-building"></i> Manage Properties</a></li>
                    {{-- <li id="li"><a href="/admin/dashboard" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-credit-card"></i> Subscription</a></li>
                   
                    <li id="li"><a href="/admin/content" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-bell"></i> View Notifications</a></li> --}}
                    <li id="li"><a href="{{ route('owner.chat') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-envelope"></i> Inquries </a></li>
                    <li id="li"><a href="{{ route('owner.setting.form') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-cogs"></i> Settings</a></li>
                </ul>
                
            </div>
            <div id="owner" class="bg-purple-700 ">Welcome, {{ $owner->name }}
            </div>
        </aside>
        

        <main class="ml-64 flex-1" id="main">
            <h1 class="text-4xl">Dashboard</h1>
            <form action="{{ route('users.index') }}" method="GET">
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden"  id="sear" >
                    <!-- Search Input -->
                    <input type="text" name="search" placeholder="Search for..." value="{{ request('search') }}"
                           class="w-full px-4 py-2 focus:outline-none" />
                                    <button type="submit" class=" text-black px-4 py-2 flex items-center justify-center hover:bg-gray-200">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="flex justify-around" id="card">
                <div id="id" class="max-w-sm p-16 bg-gray-600 border border-gray-200 rounded-lg shadow dark:bg-purple-800 dark:border-gray-700">
                    <a href="{{ route('sites.index') }}" class="block px-4 py-2 rounded " id="user"><i class="fas fa-building"></i> Sites</a>    <hr class="w-100 border-t-2 border-gray-300" />
                
                    <a href="{{ route('sites.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        View Details        
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
                
                <div id="id" class="max-w-sm p-16 bg-purple-900 border border-gray-200 rounded-lg shadow dark:bg-purple-800 dark:border-gray-700">
                    <a href="{{ route('owner.chat') }}" class="block px-4 py-2 rounded "id="user"><i class="fas fa-envelope"></i> Inquries</a>    <hr class="w-100 border-t-2 border-gray-300" />
                
                    <a href="{{ route('owner.chat') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-900 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        View Details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
                
                <div id="id" class="max-w-sm p-16 bg-green-700 border border-gray-200 rounded-lg shadow dark:bg-purple-800 dark:border-gray-700">
                    <a href="{{ route('owner.setting.form') }}" class="block px-4 py-2 rounded "><i class="fas fa-cogs"id="user"></i> Settings</a>    <hr class="w-100 border-t-2 border-gray-300" />
                
                    <a href="{{ route('owner.setting.form') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        View Details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
                
                
                
                </div>
                <div class="container mx-auto" id="graph">
                    <h2 class="text-2xl font-semibold mb-4 text-center">Total Properties Listed On Each Site</h2>
                    <canvas id="totalPropertiesChart"></canvas>
                </div>
            
                <script>
                 
                    const totalPropertiesData = {
                        labels: ['Site A', 'Site B', 'Site C', 'Site D'],
                        datasets: [{
                            label: 'Number of Properties',
                            data: [12, 19, 7, 15],
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    };
            
                    // Config for Total Properties Chart
                    const totalPropertiesConfig = {
                        type: 'bar',
                        data: totalPropertiesData,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Properties Listed by Site'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                    };
            
                    // Create Total Properties Chart
                    const totalPropertiesChart = new Chart(
                        document.getElementById('totalPropertiesChart'),
                        totalPropertiesConfig
                    );
                </script>
        
        </main>
    </div>

</body>
</html>

