<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <style>
              .bg-custom-blue {
        background-color: #28bba7; 
    }
    .bg-custom-bluee {
        background-color: white; 
    }
           .bg-custom-b {
            background-color: #082f49;
         }
            .bg-custom-bl {
                background-color: #042f2e; 
            }
            .bg-custom-blu {
                    background-color: #1e1b4b; 
    }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin.index') }}">Real Estate</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn bg-custom-bluee" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.setting.update') }}">Settings</a></li>
                       
                        <li><hr class="dropdown-divider" /></li>
                        <li><form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                User Management                   <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('users.create') }}">Create User</a>
                                    <a class="nav-link" href="{{ route('users.index') }}">All Users</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="{{ route('admin.properties.owners') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Property
                            </a>
                            <a class="nav-link" href="{{ route('admin.setting.update') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Settings
                            </a>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        An Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-custom-blue text-white mb-4">
                                    <div class="card-body"><i class="fas fa-users"></i>All Users</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('users.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-custom-b text-white mb-4">
                                    <div class="card-body"><i class="fas fa-home"></i> Property</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('admin.properties.owners') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-custom-bl text-white mb-4">
                                    <div class="card-body"><i class="fas fa-cogs"id="user"></i> Settings</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('admin.setting.update') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-custom-blu text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="container-fluid" id="graph">
                            <!-- Row container for side-by-side display -->
                            <div class="row g-4">
                                <!-- User Registration Over Time -->
                                <div class="col-12 col-xl-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-line me-1"></i>
                                            User Registration Over Time
                                        </div>
                                        <div class="card-body">
                                            <canvas id="userRegistrationChart" width="100%" height="40"></canvas>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Sites Created Over Time -->
                                <div class="col-12 col-xl-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-chart-bar me-1"></i>
                                            Sites Created Over Time
                                        </div>
                                        <div class="card-body">
                                            <canvas id="sitesChart" width="100%" height="40"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // User Registration Chart
                                const userRegistrationData = {
                                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                    datasets: [{
                                        label: 'New Users',
                                        data: @json(array_values($userRegistrations)),
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderWidth: 2,
                                        fill: true
                                    }]
                                };
                        
                                const userRegistrationConfig = {
                                    type: 'line',
                                    data: userRegistrationData,
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: { position: 'top' },
                                            title: { display: true, text: 'User Registration Over Time' }
                                        },
                                        scales: { y: { beginAtZero: true } }
                                    },
                                };
                        
                                new Chart(
                                    document.getElementById('userRegistrationChart'),
                                    userRegistrationConfig
                                );
                        
                                // Sites Created Chart
                                fetch("{{ route('sites.perYear') }}")
                                    .then(response => response.json())
                                    .then(data => {
                                        const years = data.map(item => item.year);
                                        const totals = data.map(item => item.total);
                        
                                        const sitesChartConfig = {
                                            type: 'bar',
                                            data: {
                                                labels: years,
                                                datasets: [{
                                                    label: 'Number of Sites',
                                                    data: totals,
                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: { position: 'top' },
                                                    title: { display: true, text: 'Sites Created Over Time' }
                                                },
                                                scales: { y: { beginAtZero: true } }
                                            }
                                        };
                        
                                        new Chart(
                                            document.getElementById('sitesChart'),
                                            sitesChartConfig
                                        );
                                    });
                            });
                        </script>
             <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2025</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>            
    </body>
</html>
