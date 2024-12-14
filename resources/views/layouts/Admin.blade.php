<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Include any CSS files or libraries, such as Bootstrap or Tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
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
        h1{
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
            width: 95%;
        }
        #owner{
            margin-top: 70px;
            padding: 8px 8px 8px 18px;

        }
        
      th{
        margin-leftft: 2px
      }


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
        #owner{
            margin-top: 30%;
            padding: 8px 8px 8px 18px;

        }
#modal{
    margin-bottom: 15px;
}
/* Add these styles to your main CSS file or within a <> tag in the Blade view */
 

/* h1 {
    color: #333;
    text-align: center;
    margin-bottom: 10px;
    font-size: 40px;
    margin-top: -1%;
} */

/* form {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-right: 30px;
} */

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
              <li id="li"><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
              <li id="li"><a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-users"></i> User Management</a></li>
              <li id="li"><a href="{{ route('admin.properties.owners') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-home"></i> Property Management</a></li>
              <li id="li"><a href="{{ route('admin.setting.update') }}" class="block px-4 py-2 rounded hover:bg-indigo-600 p-4"><i class="fas fa-cogs"></i> Settings</a></li>
          </ul>
          
      </div>
      <div id="owner" class="bg-purple-700 ">Logged in as:<br>
          An Admin</div>
  </aside>
    <!-- Admin Sidebar (you can customize this as needed) -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-gray-800 text-white">
            <div class="px-4 py-4">
                <h2 class="text-2xl font-semibold">Admin Dashboard</h2>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Include any necessary JavaScript files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>
</div>
</body>
</html>
