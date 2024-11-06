<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>BookHaven </title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-liberty-market.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />


</head>
<style>
    h4 {
        text-decoration: underline;
        font-family: italic;
        font-size: 60px;
    }

    h5 {
        color: #673AB7;

        font-weight: bold;
        /* Deep purple */
    }

    .card {
        background-color: #1e1e1e;
        /* Dark background for card */
        border: 1px solid #333;
        /* Slightly lighter border */
        border-radius: 10px;
        /* Rounded corners */
        overflow: hidden;
        /* Prevents overflow of content */
        transition: transform 0.3s;
        /* Animation on hover */
    }

    .card:hover {
        transform: scale(1.05);
        /* Slight zoom on hover */
    }

    .card-content {
        padding: 20px;
        /* Padding inside the card */
        color: #ffffff;
        /* White text color */
    }

    .card-content h2 {
        font-size: 1.5em;
        /* Font size for heading */
        margin-bottom: 10px;
        /* Space below heading */
    }

    .card-content p {
        margin-bottom: 5px;
        /* Space between paragraphs */
    }

    .button {
        background-color: #007bff;
        /* Button color */
        color: #fff;
        /* Button text color */
        padding: 10px 20px;
        /* Button padding */
        border: none;
        /* No border */
        border-radius: 5px;
        /* Rounded corners for button */
        text-decoration: none;
        /* No underline */
        display: inline-flex;
        /* Aligns icon properly */
        align-items: center;
        /* Center icon vertically */
    }

    .button:hover {
        background-color: #0056b3;
        /* Darker color on hover */
    }

    .material-symbols-outlined {
        margin-left: 5px;
        /* Space between text and icon */
    }

</style>



<body>

    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">

                         <a href="dashboard" data-toggle="dropdown" aria-expanded="false" style="text-decoration: none; display: flex; align-items: center;">
                            <img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" alt="Profile Icon" class="rounded-circle ml-2" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
                            <h5 style="margin: 0;
        font-family: 'Arial', sans-serif;
        font-size: 25px;
        color: white;
        margin-Top: 10px;
    ">Welcome {{ Auth::user()->name }}</h5>
                        </a>

                        <ul class="nav">
                            <li><a href="home">Home</a></li>
                            <li><a href="borrow_book"> Borrow Book</a></li>
                            <li><a href="logout"> logout</a></li>

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>

                    </nav>

                </div>
            </div>
        </div>
    </header>


    <div class="item-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>View <em>Borrow Book</em> Here.</h2>
                    </div>
                </div>
                 

                 @if(session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                    @endif

                    
                @if($borrowedBooks->isEmpty())
                <div class="col-12">
                    <h2>No books borrowed.</h2>
                </div>
                @else
                @foreach($borrowedBooks as $record)
                @php
                $book = $record->book;
                @endphp
                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card">
                        <img src="{{ asset('books/'.$record->book->image) }}" alt="{{ $record->book->title }}" style="border-radius: 20px;height: 520px  ;max-height: 500px;width: 95%; margin-top:5px; object-fit: cover; margin-left:8px;">

                        <div class="card-content">
                            <h2>{{ $record->book->title }}</h2>
                            <p><strong>Author:</strong> {{ $record->book->author->author_name }}</p>
                            <p><strong>Borrow Date:</strong> {{ $record->borrowed_at }}</p>
                            <p><strong>Category: </strong> {{ $record->book->category->category_name }}</p>
                        <p><strong>Due Date: </strong> {{($record->due_date)->format('Y-m-d') }}</p>

                            <form id="toggleBorrowReturnForm" action="{{ url('return/' . $book->id) }}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-warning" onclick="confirmReturn()">Return Book</button>
                            </form>




                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>

    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        function confirmBorrow() {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?'
                , text: "Do you want to borrow this book?"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, borrow it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('toggleBorrowReturnForm').submit();
                }
            });
        }

        function confirmReturn() {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?'
                , text: "Do you want to return this book?"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, return it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('toggleBorrowReturnForm').submit();
                }
            });
        }

    </script>



    @if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true
            , position: 'top-right'
            , iconColor: 'green'
            , background: '#343a40'
            , color: 'white'
            , customClass: {
                popup: 'colored-toast'
            }
            , showConfirmButton: false
            , timer: 2000
            , timerProgressBar: true
        });

        Toast.fire({
            icon: 'success'
            , title: "{{ session('success') }}"
        });

    </script>
    @endif
    @if (session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true
            , position: 'top-right'
            , iconColor: 'red'
            , background: '#343a40'
            , color: 'white'
            , customClass: {
                popup: 'colored-toast'
            }
            , showConfirmButton: false
            , timer: 2000
            , timerProgressBar: true
        });

        Toast.fire({
            icon: 'error'
            , title: "{{ session('error') }}"
        });

    </script>
    @endif
</body>
</html>
