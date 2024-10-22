@extends('component/layout')

@section('title', 'Dashboard')

@section('content')


<style>
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


@endsection
