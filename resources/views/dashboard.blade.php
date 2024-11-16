@extends('component/layout')

@section('title', 'Dashboard')

@section('content')

<style>
    .stats-container {
        width: 90%;
        display: flex;
        justify-content: space-between;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        flex-wrap: wrap;
    }

    .chart-container {
        width: 45%;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 10px;
        /* Adds spacing between charts */
        box-sizing: border-box;
    }

    .stat-box {
        text-align: center;
        font-size: 1.2em;
    }

    .stat-box .value {
        font-size: 1.8em;
        font-weight: bold;
    }

    .stat-box .label {
        color: #888;
        font-size: 0.9em;
    }

    .block {
        background: #ffffff;
    }

    .block .title strong:first-child {
        color: black;
        font-size: 24px;
        font-family: italic;
    }

    .page-header {
        background: #ffffff;
    }

    .h5 {
        color: black;
        font-size: 24px;
        font-family: italic;
        font-weight: bold;
    }

    .statistic-block {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        margin-bottom: 20px;
        /* Space between blocks */
    }

    .statistic-block:hover {
        transform: translateY(-5px);
        /* Slight lift on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .progress-template {
        height: 8px;
        /* Height of the progress bar */
        background: #e9ecef;
        /* Background color for progress track */
        border-radius: 4px;
        /* Rounded corners */
    }

    .progress-bar {
        transition: width 0.6s ease;
        /* Smooth width transition */
    }

    /* Custom Colors for each progress bar */
    .dashbg-1 {
        background-color: #007bff;
        /* Blue for Users */
    }

    .dashbg-2 {
        background-color: #28a745;
        /* Green for Books */
    }

    .dashbg-3 {
        background-color: #ffc107;
        /* Yellow for Returned Books */
    }

    .dashbg-4 {
        background-color: #dc3545;
        /* Red for Borrowed Books */
    }

    .number {
        font-size: 2em;
        /* Increase font size for number display */
        font-weight: bold;
        /* Bold text */
    }

    .title {
        display: flex;
        align-items: center;
    }

    .icon {
        margin-right: 10px;
        /* Space between icon and title */
        font-size: 1.5em;
        /* Adjust icon size */
    }


    /* Specific style for the returned books progress bar */

</style>



<div class="page-header">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Dashboard Overview</h2>
    </div>
</div>

<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="fas fa-user"></i></div><strong class="stat-title">Users</strong>
                        </div>
                        <div class="number dashtext-1">{{$user}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 40%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="fas fa-book"></i></div><strong class="stat-title">Books</strong>
                        </div>
                        <div class="number dashtext-2">{{$book}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 40%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><span style="position: relative; display: inline-block;">
                                    <i class="fas fa-hand-holding" style="font-size: 2rem;"></i>
                                    <i class="fas fa-book" style="font-size: 1rem; position: absolute; top: 10%; left: 40%;"></i>
                                </span></div><strong class="stat-title">Borrow Books</strong>
                        </div>
                        <div class="number dashtext-4">{{$borrow}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 40%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong class="stat-title">Return Books</strong>
                        </div>
                        <div class="number dashtext-3">{{$returnedBooks}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 40%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3 yellow-line"></div>
                    </div>
                </div>
            </div>
        </div>

      <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
          
            .chart-card {
                margin: 2rem auto;
                padding: 2rem;
                border-radius: 10px;
                background: #fff;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }

            .chart-header {
                font-weight: bold;
                font-size: 1.5rem;
                text-align: center;
                margin-bottom: 1rem;
                color: #333;
            }

            canvas {
                max-height: 400px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="chart-card">
                <div class="chart-header">Dashboard Analytics</div>
                <canvas id="dashboardChart"></canvas>
            </div>
        </div>

        <script>
            const chartLabels = ['Users', 'Books', 'Borrow Books', 'Return Books'];
            const chartData = [{{ $user }}, {{ $book }}, {{ $borrow }}, {{ $returnedBooks }}];

            const ctx = document.getElementById('dashboardChart').getContext('2d');
            const dashboardChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Counts',
                        data: chartData,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                },
                                color: '#555'
                            }
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleFont: { size: 14 },
                            bodyFont: { size: 12 },
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: 12,
                                },
                                color: '#555'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: {
                                    size: 12,
                                },
                                color: '#555'
                            },
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)'
                            }
                        }
                    }
                }
            });
        </script>

@endsection
