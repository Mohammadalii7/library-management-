<!DOCTYPE html>
<html lang="en">

<head>

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

</head>
<style>
    .left-image img {
        width: 320px;
        height: 500px;

    }

    .grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        /* or center */
        gap: 20px;
    }

    .username {
        font-weight: bold;
        margin-left: 15px;
        /* Add some space from the logout link */
    }

    h5 {
        font-family: 'Arial', sans-serif;
        font-size: 25px;
        color: white;
        margin-Top: 10px;
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
                            <h5 style="margin: 0;">Welcome {{ Auth::user()->name }}</h5>
                        </a>


                        <ul class="nav">

                            <li><a href="home" class="active">Home</a></li>

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

    <div class="main-banner">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 align-self-center">
                    <div class="header-text">
                        <h6>Book is Knowledge</h6>
                        <h2>Knowledge is Power</h2>
                        <p>Library is a really cool and professional design for your websites. This HTML CSS template is based on Bootstrap v5 and it is designed for related web portals. Liberty can be freely downloaded from github</p>
                        <div class="buttons">
                            <div class="border-button">
                                {{-- <a href="explore">Explore Top Books</a> --}}
                            </div>
                            <div class="main-button">
                                {{-- <a href="" target="_blank">Watch Our Videos</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="">
                        <div class="item">
                            <img src="assets/images/banner.png" alt="">
                        </div>
                        <div class="item">
                            <img src="assets/images/banner2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <div class="categories-collections">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="categories">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <div class="line-dec"></div>
                                    <h2>Browse Through Book <em>Categories</em> Here.</h2>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-01.png" alt="">
                                    </div>
                                    <h4>Motivational</h4>

                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-02.png" alt="">
                                    </div>
                                    <h4>Money</h4>

                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-03.png" alt="">
                                    </div>
                                    <h4>Psychological</h4>

                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-04.png" alt="">
                                    </div>
                                    <h4>Story</h4>

                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-05.png" alt="">
                                    </div>
                                    <h4>Fictional</h4>

                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 ">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/ghost.png" alt="hello">
                                    </div>
                                    <h4>Horror</h4>

                                </div>
                                <br>
                            </div>

                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-06.png" alt="">
                                    </div>
                                    <h4>Romance</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="currently-market">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2><em>Items</em> Currently In The Market.</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="filters">
                        <ul>


                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row grid">
                        @foreach($data as $data)
                        @if($data->status==1)

                        <div class="col-lg-6 currently-market-item all msc">
                            <div class="item">
                                <div class="left-image">
                                    <img src="books/{{$data->image}}" alt="" style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>{{$data->title}}</h4>
                                    <span class="author">
                                        <img src="author/{{$data->author->image}}" alt="" style="max-width: 50px; border-radius: 50%;">
                                    </span>
                                    <h6>{{ $data->author->author_name }}</h6>
                                    <div class="line-dec"></div>
                                    <span class="bid">
                                        Copies Available<br><strong>{{$data->copies_available}}</strong><br>
                                    </span>

                                    <div class="text-button">
                                        <a href="{{ url('book_detail', $data->id) }}">View Item Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2024 BookHaven
                        &nbsp;&nbsp;

                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>

    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>







{{--
 @if($borrowedBooks->isEmpty())
                <tr>
                    <td colspan="4">No books borrowed.</td>
                </tr>
            @else
                @foreach($borrowedBooks as $record)
                    <tr>
                        <td>{{ $record->book->title }}</td>
<td>{{ $record->book->author->author_name }}</td> <!-- Assuming author relation -->
<td>{{ $record->borrowed_at }}</td> <!-- Adjust based on your column names -->
<td>{{ $record->returned_at }}</td> <!-- Adjust based on your column names -->
</tr>
@endforeach
@endif --}}
