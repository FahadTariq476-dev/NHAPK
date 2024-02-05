<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="We are National Hostel Association of Pakistan.">
        <meta name="keywords" content="A non-profit organization. The hostel owners community named as National Hostels Association of Pakistan.">
        <meta name="author" content="NHAPK">
        <title>Home - NHAPK Admin Panel</title>
        <link rel="apple-touch-icon" href="{{asset('front-end-asset/assets/img/logo/NHAPK.jpeg')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('front-end-asset/assets/img/logo/NHAPK.jpeg')}}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
        <!-- END: Custom CSS-->
    
        {{-- Begin: SweetAlert Files --}}
        <!-- Include SweetAlert CSS -->
        <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
        <!-- Include SweetAlert JS -->
        <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
        {{-- End: SweetAlert Files --}}

        <!-- jQuery(necessary for all JavaScript plugins) -->
        <script src="{{asset('assets/js/jquery/jquery-3.5.1.min.js')}}"></script>

        <!-- ✅ Load CSS file for DataTables  -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
            integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <!-- ✅ load jQuery ✅ -->
        {{-- <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script> --}}

        @yield('css')
        
    </head>
    <!-- END: Head-->

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

        @include('admin.layouts.header')
        @include('admin.layouts.compulsory-sweetalert')

        @yield('main-container')


        @include('admin.layouts.footer')


        <!-- BEGIN: Vendor JS-->
        <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
        <script src="{{asset('app-assets/js/core/app.js')}}"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        @yield("js")
        <!-- END: Page JS-->
        <script>
            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            })
            // Scroll to top button
            $('.scroll-top').on('click', function() {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            });
        </script> 
    </body>
    <!-- END: Body-->

</html>