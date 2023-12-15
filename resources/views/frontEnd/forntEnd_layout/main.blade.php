<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Description -->
    <meta name="description" content="">
    <meta name="author" content="Themeland">

    <!-- Title  -->
    {{-- <title>NHA Pakistan | National Hostel Association of Pakistan</title>
    <title>@yield('title', 'Your Website Title')</title> --}}
    <!-- Title -->
    <title>
        @hasSection('title')
            @yield('title') | NHA Pakistan | National Hostel Association of Pakistan
        @else
            NHA Pakistan | National Hostel Association of Pakistan
        @endif
    </title>

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('front-end-asset/assets/img/logo/NHAPK.jpeg')}}">

    <!-- ***** All CSS Files ***** -->

    <!-- Style css -->
    
    <link rel="stylesheet" href="{{asset('front-end-asset/assets/css/style.css')}}">

    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('front-end-asset/assets/css/responsive.css')}}">


    {{-- Begin: SweetAlert Files --}}
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <!-- Include SweetAlert JS -->
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    {{-- End: SweetAlert Files --}}
    
    <!-- jQuery(necessary for all JavaScript plugins) -->
    <script src="{{asset('front-end-asset/assets/js/jquery/jquery-3.5.1.min.js')}}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front-end-asset/assets/js/bootstrap/bootstrap.min.js')}}">

    {{-- Additional CSS --}}
    @yield('css_additional')
</head>

<body>
    @include('frontEnd.forntEnd_layout.header')

    @yield('main-container')


    @include('frontEnd.forntEnd_layout.footer')


    </div>      <!-- CLose div of <div class="main overflow-hidden"> this statrs in header section -->

    <!-- ***** All jQuery Plugins ***** -->


    <!-- Bootstrap js -->
    <script src="{{asset('front-end-asset/assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('front-end-asset/assets/js/bootstrap/bootstrap.min.js')}}"></script>

    <!-- Plugins js -->
    <script src="{{asset('front-end-asset/assets/js/plugins/plugins.min.js')}}"></script>

    <!-- Active js -->
    <script src="{{asset('front-end-asset/assets/js/active.js')}}"></script>


    @yield('frontEnd-js')


</body>

</html>