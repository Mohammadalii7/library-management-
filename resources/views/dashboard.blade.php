@extends('component/layout')

@section('title', 'Dashboard')

@section('content')


<style>

        .chart-container {
            width: 45%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .stats-container {
            width: 90%;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    .block{
        background:#ffffff;
    }
    .block .title strong:first-child {
        color:black;
        font-size: 24px;
        font-family:italic;
    }
    .page-header{
        background:#ffffff;
    }
    .h5{
        color:black;
        font-size: 24px;
        font-family:italic;
        font-weight:bold;
    }

    .statistic-block {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        margin-bottom: 20px; /* Space between blocks */
    }

    .statistic-block:hover {
        transform: translateY(-5px); /* Slight lift on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .progress-template {
        height: 8px; /* Height of the progress bar */
        background: #e9ecef; /* Background color for progress track */
        border-radius: 4px; /* Rounded corners */
    }

    .progress-bar {
        transition: width 0.6s ease; /* Smooth width transition */
    }

    /* Custom Colors for each progress bar */
    .dashbg-1 {
        background-color: #007bff; /* Blue for Users */
    }
    .dashbg-2 {
        background-color: #28a745; /* Green for Books */
    }
    .dashbg-3 {
        background-color: #ffc107; /* Yellow for Returned Books */
    }
    .dashbg-4 {
        background-color: #dc3545; /* Red for Borrowed Books */
    }

    .number {
        font-size: 2em; /* Increase font size for number display */
        font-weight: bold; /* Bold text */
    }

    .title {
        display: flex;
        align-items: center;
    }

    .icon {
        margin-right: 10px; /* Space between icon and title */
        font-size: 1.5em; /* Adjust icon size */
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
                            <div class="icon"><i class="icon-user-1"></i></div><strong class="stat-title">Users</strong>
                        </div>
                        <div class="number dashtext-1">{{$user}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong class="stat-title">Books</strong>
                        </div>
                        <div class="number dashtext-2">{{$book}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong class="stat-title">Borrow Books</strong>
                        </div>
                        <div class="number dashtext-4">{{$borrow}}</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
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
                        <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3 yellow-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="chart-container">
    <canvas id="barChart1"></canvas>
</div>
<div class="chart-container">
    <canvas id="barChart2"></canvas>
</div>

<!-- Container for Line Chart -->
<div class="chart-container" style="width: 90%;">
    <canvas id="lineChart"></canvas>
</div>

<!-- Container for Statistics -->
<div class="stats-container">
    <div class="stat-box">
        <div class="value">5,657</div>
        <div class="label">STANDARD SCANS</div>
    </div>
    <div class="stat-box">
        <div class="value">3,1459</div>
        <div class="label">TEAM SCANS</div>
    </div>
</div>
<script>
    // Data and configuration for Bar Chart 1
    const barChart1 = new Chart(document.getElementById('barChart1'), {
        type: 'bar',
        data: {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9'],
            datasets: [
                { label: 'Data Set 1', backgroundColor: '#b39ddb', data: [12, 19, 3, 5, 2, 3, 9, 6, 7] },
                { label: 'Data Set 2', backgroundColor: '#4e4e4e', data: [8, 11, 13, 7, 6, 4, 12, 10, 5] }
            ]
        },
        options: {
            plugins: { legend: { display: true } },
            responsive: true
        }
    });

    // Data and configuration for Bar Chart 2
    const barChart2 = new Chart(document.getElementById('barChart2'), {
        type: 'bar',
        data: {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9'],
            datasets: [
                { label: 'Data Set 1', backgroundColor: '#6a1b9a', data: [8, 15, 5, 3, 7, 6, 8, 9, 10] },
                { label: 'Data Set 2', backgroundColor: '#f48fb1', data: [5, 9, 13, 8, 12, 10, 11, 7, 4] }
            ]
        },
        options: {
            plugins: { legend: { display: true } },
            responsive: true
        }
    });

    // Data and configuration for Line Chart
    const lineChart = new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9'],
            datasets: [
                { label: 'Page Visitors', borderColor: '#8e24aa', backgroundColor: 'rgba(142, 36, 170, 0.2)', data: [25, 30, 35, 40, 45, 50, 45, 35, 30] },
                { label: 'Page Views', borderColor: '#f48fb1', backgroundColor: 'rgba(244, 143, 177, 0.2)', data: [20, 25, 30, 35, 40, 38, 34, 30, 28] }
            ]
        },
        options: {
            plugins: { legend: { display: true } },
            responsive: true
        }
    });
</script>



@endsection
