<!--====== Preloader Area Start ======-->
<div id="preloader">
    <!-- Digimax Preloader -->
    <div id="digimax-preloader" class="digimax-preloader">
        <!-- Preloader Animation -->
        <div class="preloader-animation">
            <!-- Spinner -->
            <div class="spinner"></div>
            <!-- Loader -->
            <div class="loader">
                <span data-text-preloader="N" class="animated-letters">N</span>
                <span data-text-preloader="H" class="animated-letters">H</span>
                <span data-text-preloader="A" class="animated-letters">A</span>
                <span data-text-preloader="P" class="animated-letters">P</span>
                <span data-text-preloader="K" class="animated-letters">K</span>
            </div>
            <p class="fw-5 text-center text-uppercase">Loading</p>
        </div>
        <!-- Loader Animation -->
        <div class="loader-animation">
            <div class="row h-100">
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== Preloader Area End ======-->

<!--====== Scroll To Top Area Start ======-->
<div id="scrollUp" title="Scroll To Top">
    <i class="fas fa-arrow-up"></i>
</div>
<!--====== Scroll To Top Area End ======-->

<div class="main overflow-hidden">
    <!-- ***** Header Start ***** -->
    <header id="header">
        <!-- Navbar -->
        <nav data-aos="zoom-out" data-aos-delay="800" class="navbar navbar-expand fixed-top">
            <div class="container header">
                <!-- Navbar Brand-->
                <a class="navbar-brand" href="/">
                    <img class="navbar-brand-regular" src="{{ asset('front-end-asset/assets/img/logo/NHAPK.jpeg') }}"
                        alt="brand-logo" style="width:50px">
                    <img class="navbar-brand-sticky" src="{{ asset('front-end-asset/assets/img/logo/NHAPK.jpeg') }}"
                        alt="sticky brand-logo" style="width:50px">
                </a>
                <div class="ml-auto"></div>
                <!-- Navbar -->
                <ul class="navbar-nav items">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item"style="text-align:justify;">
                        <a href="{{ route('membershipRegister') }}" class="nav-link">Membership Registration</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('saveHostelForm') }}" class="nav-link">Register Hostel</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('forntEnd.showAbout') }}" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ContactUsForm') }}" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#">More<i class="fas fa-angle-down ml-1"></i></a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forntEnd.showComplaintForm') }}">Complaint</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontEnd.list-blogs') }}">Blogs</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('frontEnd.newsfeed.list-newsfeeds') }}">News &
                                    Media</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('frontEnd.faqs') }}">FAQ's</a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="nav-item">
                            <a href="{{route('front-end.client.login')}}" class="nav-link">Login</a>
                        </li> --}}
                    @if (auth()->check() &&
                            auth()->user()->hasRole('nhapk_client'))
                        <li class="nav-item">
                            <a href="{{ route('client.dashboard.index') }}" class="nav-link">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            {{-- <a href="{{ route('front-end.client.login') }}" class="nav-link">Login</a> --}}
                            <!-- Button trigger modal -->
                            @include('frontEnd.forntEnd_layout.loginmodal')
                        </li>
                    @endif
                </ul>
                <!-- Navbar Icons -->
                <ul class="navbar-nav icons">
                    <li class="nav-item social">
                        <a href="https://www.facebook.com/natioanalhostelsassociation" class="nav-link"
                            target="_blank"><i class="fab fa-facebook-f"></i></a>
                    </li>
                </ul>
                <!-- Navbar Toggler -->
                <ul class="navbar-nav toggle">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                            <i class="fas fa-bars toggle-icon m-0"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- ***** Header End ***** -->
   
