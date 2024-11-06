<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">

    <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
         <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




    <style>
        .list-unstyled {
            font-weight: bold;
            color: white;
            font-size: 17px;
        }

        .title {
            color: white;
        }

        .list-inline-item {
            color: white;
        }

        .h5 {
            font-size: 20px;
            margin-bottom: 10px;
            color: white;
        }

        .dropdown {
            padding: 0px 10px;
            /* Adjust the padding as per your need */
        }

        .page-content {
            background: #ffffff;
        }

        .text-primary {
            color: #dc3545 !important;
        }
        .list-unstyled{
            font-weight:bold;
        }

    </style>

</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="search-panel">
                <div class="search-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn">Close <i class="fa fa-close"></i></div>
                    <form id="searchForm" action="#">
                        <div class="form-group">
                            <input type="search" name="search" placeholder="What are you searching for...">
                            <button type="submit" class="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <!-- Navbar Header-->
                    <a href="{{ url('home') }}" class="navbar-brand">
                        <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Book</strong><strong>Haven</strong></div>
                        <div class="brand-text brand-sm"><strong class="text-primary">B</strong><strong>H</strong></div>
                    </a>
                    <!-- Sidebar Toggle Btn-->
                    <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
                </div>
                <div class="top-social-info text-right">
                    <div class="dropdown">
                        <a href="dashboard" data-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                            <span class="text-lg font-semibold text-white-800">{{ Auth::user()->role }}</span>
                            <img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" alt="Profile Icon" class="rounded-circle ml-2" style="width: 40px; height: 40px; object-fit: cover;">
                        </a>



                    </div>
                </div>

            </div>
        </nav>
    </header>




    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5">Ally</h1>
                    <p></p>
                </div>
            </div>
            <!-- Sidebar Navigation Menus-->
            {{-- <span class="heading">Main</span> --}}
            <ul class="list-unstyled">
                <li class=""><a href="{{ url('dashboard') }}"> <i class="icon-home"></i>Home </a></li>
                <li>
                    <a href="#categorydropdown" aria-expanded="false" data-toggle="collapse">
                        <i class="fas fa-folder"></i>Category
                    </a>
                    <ul id="categorydropdown" class="collapse list-unstyled ">
                        <li><a href="{{ url('category/categorylist') }}"><i class="fas fa-list"></i> Category List</a></li>
                        <li><a href="{{ url('category/addcategory') }}"><i class="fas fa-plus-circle"></i> Add Category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#authordropdown" aria-expanded="false" data-toggle="collapse">
                        <i class="fas fa-user"></i>Author
                    </a>
                    <ul id="authordropdown" class="collapse list-unstyled ">
                        <li><a href="{{ url('author/author_detail') }}"><i class="fas fa-list"></i> Author List</a></li>
                        <li><a href="{{ url('author/addauthor') }}"><i class="fas fa-plus-circle"></i> Add Author</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">
                        <i class="fas fa-book"></i>Books
                    </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{ url('book/showbook') }}"><i class="fas fa-list"></i> Books List</a></li>
                        <li><a href="{{ url('book/addbook') }}"><i class="fas fa-plus-circle"></i> Add Book</a></li>
                    </ul>
                </li>


                <li><a href="{{ url('records/record') }}"><i class="icon-contract"></i>Records</a></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ url('logout') }}">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="page-content">
            @yield('content')
        </div>
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
                , timer: 1500
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
        @if ($errors->any())
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
                , timer: 3000
                , timerProgressBar: true
            });

            Toast.fire({
                icon: 'error'
                , title: "{{ $errors->first() }}"
            });

        </script>
        @endif

    </div>

    <!-- Footer -->
    {{-- <footer class="footer">
        <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
                <p class="no-margin-bottom">2024 &copy; BookHaven</p>
            </div>
        </div>
    </footer> --}}

    <!-- JavaScript files-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/front.js') }}"></script>

</body>



</html>
