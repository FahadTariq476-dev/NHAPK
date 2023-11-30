@include('frontEnd.forntEnd_layout.header')
@yield('main-container')
<!-- ***** All jQuery Plugins ***** -->

<!-- jQuery(necessary for all JavaScript plugins) -->
<script src="{{asset('assets/js/jquery/jquery-3.5.1.min.js')}}"></script>

<!-- Bootstrap js -->
<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>

<!-- Plugins js -->
<script src="{{asset('assets/js/plugins/plugins.min.js')}}"></script>

<!-- Active js -->
<script src="{{asset('assets/js/active.js')}}"></script>
@yield('frontEnd-js')
@include('frontEnd.forntEnd_layout.footer')