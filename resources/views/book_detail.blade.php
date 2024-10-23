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

    h3 {
        color: gold;
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
                        <h2>View Details <em>For Item</em> Here.</h2>
                    </div>
                </div>



                <div class="col-lg-7">
                    <div class="left-image">
                        <img src="books/{{$data->image}}" alt="" style="border-radius: 20px; height: 600px; width: 500px;">
                    </div>
                </div>



                <div class="col-lg-5 align-self-center">



                    <h4>Book : {{ $data->title }}</h4>
                    <h6>Author : {{ $data->author->author_name }}</h6>
                    <br>
                    <p>Description : {{ $data->description }}</p>
                    <p>Category : {{ $data->category->category_name }}</p>
                    <p>Published Date : {{ $data->published_date }}</p>
                    <p>Copies Available : {{ $data->copies_available }}</p>



                    <h5>BookHaven Library - Late Return Fine Policy :-</h5>


                    <p><span style="color:  #FFC107;">Note:</span> When you borrow a book from the library, you are allowed to keep it for a period of one month (30 days). If the book is returned after the 30-day borrowing period, you will be subject to a late return fine.

                        The fine is calculated based on the number of days the book is returned late, with a fixed charge of $5 per day after the 30-day borrowing limit.</p>


                    <form id="toggleBorrowReturnForm" action="{{ url('borrow/' . $data->id) }}" method="POST">
                        @csrf
                        @if($data->copies_available == 0)
                        <h3>Book out of stock</h3>
                        @elseif($data->borrowingRecords->where('member_id', auth()->user()->id)->whereNull('returned_at')->count() == 0)
                        <button type="button" class="btn btn-primary" onclick="confirmBorrow()">Borrow Book</button>
                        @else
                        <h3>Book has been already borrowed</h3>
                        @endif

                    </form>

                </div>


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
            , timer: 2500
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
            , timer: 2500
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
