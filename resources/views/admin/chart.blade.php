@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-area me-1"></i> Dashboard Charts
        </div>
        <div class="card-body">
            <div class="container-fluid" id="graph">
                <!-- Row container for side-by-side display -->
                <div class="row g-4">
                    <!-- User Registration Over Time -->
                    <div class="col-12 col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-line me-1"></i> User Registration Over Time
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
                                <i class="fas fa-chart-bar me-1"></i> Sites Created Over Time
                            </div>
                            <div class="card-body">
                                <canvas id="sitesChart" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
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
@endsection
