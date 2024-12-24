@extends('layouts.sidebar')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <!-- Sites Created Per Year Chart -->
        <div class="col-md-6 col-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">Sites Created Per Year</div>
                <div class="card-body">
                    <canvas id="sitesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Number of Houses Chart -->
        <div class="col-md-6 col-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">Number of Houses per Site</div>
                <div class="card-body">
                    <canvas id="housesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Sites Created Per Year Chart
    document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ route('sites.perYearForOwner') }}")
            .then(response => response.json())
            .then(data => {
                const years = data.map(item => item.year);
                const totals = data.map(item => item.total);

                const ctx = document.getElementById('sitesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: years,
                        datasets: [{
                            label: 'Sites Created',
                            data: totals,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: true, position: 'top' }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: { display: true, text: 'Number of Sites' }
                            },
                            x: {
                                title: { display: true, text: 'Year' }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });

    // Number of Houses Chart
    const houseCtx = document.getElementById('housesChart').getContext('2d');
    const siteLabels = @json($sites->pluck('name'));
    const houseCounts = @json($sites->pluck('houses_count'));

    new Chart(houseCtx, {
        type: 'bar',
        data: {
            labels: siteLabels,
            datasets: [{
                label: 'Number of Houses',
                data: houseCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
