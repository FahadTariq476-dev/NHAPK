@extends('frontEnd.forntEnd_layout.main')
@section('title','Home')
@section('main-container')

            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{{ session('error') }}',
                    });
                </script>
            @endif

        <!-- ***** Welcome Area Start ***** -->
        <section id="home" class="section welcome-area bg-overlay overflow-hidden d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Welcome Intro Start -->
                    <div class="col-12 col-md-7">
                        <div class="welcome-intro">
                            <h1 class="text-white">We are National Hostel Association of Pakistan</h1>
                            <p class="text-white my-4">A non-profit organization.
                                The hostel owners community named as National Hostels Association of Pakistan</p>
                            <!-- Buttons -->
                            <div class="button-group">
                                <a href="{{route('ContactUsForm')}}" class="btn btn-bordered-white d-none d-sm-inline-block">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <!-- Welcome Thumb -->
                        <div class="welcome-thumb-wrapper mt-5 mt-md-0">
                            <span class="welcome-thumb-1">
                                {{-- <img class="welcome-animation d-block ml-auto" src="assets/img/welcome/thumb_1.png" alt=""> --}}
                                <img class="welcome-animation d-block ml-auto" src="assets/img/welcome/h.jpg" alt="">
                            </span>
                            {{-- <span class="welcome-thumb-2">
                                <img class="welcome-animation d-block" src="assets/img/welcome/thumb_2.png" alt="">
                            </span>
                            <span class="welcome-thumb-3">
                                <img class="welcome-animation d-block" src="assets/img/welcome/thumb_3.png" alt="">
                            </span>
                            <span class="welcome-thumb-4">
                                <img class="welcome-animation d-block" src="assets/img/welcome/thumb_4.png" alt="">
                            </span>
                            <span class="welcome-thumb-5">
                                <img class="welcome-animation d-block" src="assets/img/welcome/thumb_5.png" alt="">
                            </span>
                            <span class="welcome-thumb-6">
                                <img class="welcome-animation d-block" src="assets/img/welcome/thumb_6.png" alt="">
                            </span> --}}
                        </div>
                    </div>
                </div>
                <form action="{{route('frontEnd.hostels.findHostelById')}}" method="POST" id="searchForm">
                    @csrf
                    <div class="row justify-content-center py-3 mx-5 bg-light mt-5" style="border-radius:100px;">
                        <div class="col-lg-3 col-md-3 col-12 align-self-center">
                            <input id="rd_reg_no" value="Reg_No" class="checkbox-custom px-1" name="search_type" type="radio" checked>
                            <label for="rd_reg_no" class="checkbox-custom-label px-1 pe-2">Reg. Number</label>
                            <input id="rd_by_name" value="Name" class="checkbox-custom px-1" name="search_type" type="radio">
                            <label for="rd_by_name" class="checkbox-custom-label px-1">By Name</label>
                        </div>
                        <div class="col-lg-5 col-md-5 col-12">
                            <input type="text" name="search_data" id="search_data" class="form-control "
                                placeholder="Search Hostel location"
                                {{-- style=" border:none !important; border-radius:0px !important;  height:55px !important; background-color:#eeeeee !important;"  --}}
                                />
                                <div id="nameSuggestions" class="suggestions dropdown-menu dropdown-menu-end" style="max-height: 200px; overflow-y: auto; position: absolute; width: 100%;">
                                {{-- Suggestion will diplayed here --}}
                                </div>
                                
                        </div>
                        <div class="col-lg-3 col-md-3 col-12 align-self-center">
                            <button type="submit" class="theme-btn-1 btn  mybtn text-light">Search Result</button>
                        </div>
                    </div>
                    <input type="hidden" name="selectedHostelId" id="selectedHostelId" value="" required>
                </form>
            </div>
            
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
        c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
        c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Welcome Area End ***** -->

        <script>
            $(document).ready(function () {
                // Function to handle keyup event on the name input
                $('#search_data').on('keyup', function () {
                    var inputVal = $(this).val();
                    if(inputVal.trim()==='' || inputVal ===null || inputVal.length==0){
                        $('#nameSuggestions').hide();
                        $('#nameSuggestions').html("");
                        $('#selectedHostelId').val("");
                    }
                    if ($('#rd_by_name').prop('checked')) {
                        if(!(inputVal.trim()==='' || inputVal ===null )){
                            // 
                            // Perform an AJAX request to get suggestions
                            $.ajax({
                                url: '/get-hostel-suggestions', // Change this to your actual route
                                method: 'GET',
                                data: { inputVal: inputVal },
                                success: function (data) {
                                    // Display the suggestions in the suggestions div
                                    $('#nameSuggestions').html(data);
                                    $('#nameSuggestions').show(); // Show the suggestions
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                        }else {
                            // Hide the suggestions if the input is empty
                            $('#nameSuggestions').hide();
                            $('#nameSuggestions').html("");
                            $('#selectedHostelId').val("");
                        }
                    }
                });


                // Handle click on a suggestion
                $(document).on('click', '.suggestion-item', function () {
                    var hostelName = $(this).text();
                    var hostelId = $(this).data('hostel-id');
            
                    // Set the selected value in the input field
                    $('#search_data').val(hostelName);

                    // Do something with the selected hostel ID (e.g., save it in a hidden input)
                    $('#selectedHostelId').val(hostelId);

                    // Hide the suggestions
                    $('#nameSuggestions').hide();
                });

            });
        </script>

        <script>
            $(document).ready(function(){
                $('input[name="search_type"]').on('change', function (){
                    var currentSelectedRadio = $(this).attr('id');
                    if (currentSelectedRadio === 'rd_by_name') {
                        $('#selectedHostelId').val("");
                    } else if (currentSelectedRadio === 'rd_reg_no') {
                        $('#selectedHostelId').val("");
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function(){
                // Handle form submission
        $('#searchForm').submit(function (e) {
            // Check if Reg. Number radio button is checked
            var isRegNoChecked = $('#rd_reg_no').prop('checked');

            // If Reg. Number is checked, submit the form as is
            if (isRegNoChecked) {
                let search_data = $("#search_data").val();
                if(search_data.trim() ==='' || search_data ===null || search_data.length==0){
                    e.preventDefault();
                    alert("Registration Number Should be provided");
                    return false;
                }
                return true;
            }

            // Extract the selected hostel ID
            var selectedHostelId = $('#selectedHostelId').val();

            // Perform any additional checks if needed
            if (selectedHostelId) {
                // Set the selected hostel ID in a hidden input and submit the form
                $('<input>').attr({
                    type: 'hidden',
                    name: 'selectedHostelId',
                    value: selectedHostelId
                }).appendTo('#searchForm');

                // Submit the form
                $('#searchForm').submit();
            } else {
                // Handle the case when no hostel is selected
                e.preventDefault();
                alert('Please select a hostel from the suggestions.');
            }
        });
            });
        </script>

        {{-- Begin: View Blogs Area --}}
        <div class="container mt-5">
            <h2>Blogs</h2>
            <div class="row">
                @foreach ($blogs as $blog)
                    <!-- Replace this with a loop through your blog data -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img
                                src="{{ asset($blog->thumbnail_image_path) }}"
                                class="card-img-top img-fluid" style=" height: 300px;  "
                                alt="Thumbnail Image" 
                                onerror="this.onerror=null; this.src='{{ asset('app-assets/images/no-image-icon.jpg') }}';"
                            >
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{$blog->title}}
                                </h5>
                                <p class="card-text text-justify">
                                    {{$blog->short_description}}
                                </p>
                                <p class="card-text text-muted text-right">
                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d-M-Y \a\t h:i A') }}
                                </p>
                                <a href="{{ route('frontEnd.viewFullBlogBySlug', ['slug' => $blog->slug]) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End loop -->
            </div>
        </div>
        {{-- End: View Blogs Area --}}


        <!-- ***** Content Area Start ***** -->
        <section class="section content-area bg-grey ptb_150">
            <!-- Shape Top -->
            <div class="shape shape-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
            {{-- Begin: View News & Feed Area --}}
        <div class="container mt-5">
            <h2>News & Feed</h2>
            <div class="row">
                @foreach ($news as $item)
                    <!-- Replace this with a loop through your blog data -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img
                                src="{{ asset($item->thumbnail_image_path) }}"
                                class="card-img-top img-fluid" style=" height: 300px;  "
                                alt="Thumbnail Image" 
                                onerror="this.onerror=null; this.src='{{ asset('app-assets/images/no-image-icon.jpg') }}';"
                            >
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{$item->title}}
                                </h5>
                                <p class="card-text text-justify">
                                    {{$item->short_description}}
                                </p>
                                <p class="card-text text-muted text-right">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y \a\t h:i A') }}
                                </p>
                                <a href="{{ route('frontEnd.newsfeed.viewFullNewsfeedBySlug', ['slug' => $item->slug]) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End loop -->
            </div>
        </div>
        {{-- End: View News & Feed Area --}}
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
        c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
        c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Content Area End ***** -->

        <!-- ***** Content Area Start ***** -->
        <section class="section content-area ptb_150">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-6">
                        <!-- Profile Circle Wrapper -->
                        <div class="profile-circle-wrapper circle-animation d-none d-sm-block">
                            <!-- Profile Inner -->
                            <div class="profile-inner">
                                <!-- Profile Circle -->
                                <div class="profile-circle circle-lg">
                                    <span class="profile-icon icon-1">
                                        <img class="icon-1-img" src="assets/img/content/profile-icons/profile_icon_1.svg" />
                                    </span>
                                    <span class="profile-icon icon-2">
                                        <img class="icon-2-img" src="assets/img/content/profile-icons/profile_icon_2.svg" />
                                    </span>
                                    <span class="profile-icon icon-3">
                                        <img class="icon-3-img" src="assets/img/content/profile-icons/profile_icon_1.svg" />
                                    </span>
                                    <span class="profile-icon icon-4">
                                        <img class="icon-4-img" src="assets/img/content/profile-icons/profile_icon_2.svg" />
                                    </span>
                                </div>

                                <!-- Profile Circle -->
                                <div class="profile-circle circle-md">
                                    <span class="profile-icon icon-5">
                                        <img class="icon-5-img" src="assets/img/content/profile-icons/profile_icon_3.svg" />
                                    </span>
                                    <span class="profile-icon icon-6">
                                        <img class="icon-6-img" src="assets/img/content/profile-icons/profile_icon_3.svg" />
                                    </span>
                                    <span class="profile-icon icon-7">
                                        <img class="icon-7-img" src="assets/img/content/profile-icons/profile_icon_3.svg" />
                                    </span>
                                </div>

                                <!-- Profile Circle -->
                                <div class="profile-circle circle-sm">
                                    <span class="profile-icon icon-8">
                                        <img class="icon-8-img" src="assets/img/content/profile-icons/profile_icon_4.svg" />
                                    </span>
                                    <span class="profile-icon icon-9">
                                        <img class="icon-9-img" src="assets/img/content/profile-icons/profile_icon_4.svg" />
                                    </span>
                                </div>
                            </div>
                            <img class="folder-img" src="assets/img/content/folders.png" />
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <!-- Content Inner -->
                        <div class="content-inner text-center pt-sm-4 pt-lg-0 mt-sm-5 mt-lg-0">
                            <!-- Section Heading -->
                            <div class="section-heading text-center mb-3">
                                <h2>Work smarter,<br> not harder.</h2>
                                <p class="d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                                <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p>
                            </div>
                            <!-- Content List -->
                            <ul class="content-list text-left">
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Digital Agency &amp; Marketing</b><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, distinctio.</span>
                                    </div>
                                </li>
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Planning To Startup</b><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, distinctio.</span>
                                    </div>
                                </li>
                                <!-- Single Content List -->
                                <li class="single-content-list media py-2">
                                    <div class="content-icon pr-4">
                                        <span class="color-2"><i class="fas fa-angle-double-right"></i></span>
                                    </div>
                                    <div class="content-text media-body">
                                        <span><b>Content Management</b><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, distinctio.</span>
                                    </div>
                                </li>
                            </ul>
                            <a href="{{route('forntEnd.showAbout')}}" class="btn btn-bordered mt-4">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Content Area End ***** -->

        <!-- ***** Service Area End ***** -->
        {{-- <section id="service" class="section service-area bg-grey ptb_150">
            <!-- Shape Top -->
            <div class="shape shape-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2>We provide the best digital services</h2>
                            <p class="d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                            <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-rocket-launch color-1 icon-bg-1"></span>
                            <h3 class="my-3">Data Analytics</h3>
                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt emit.</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-monitoring color-2 icon-bg-2"></span>
                            <h3 class="my-3">Website Growth</h3>
                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt emit.</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-web color-3 icon-bg-3"></span>
                            <h3 class="my-3">Seo Ranking</h3>
                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt emit.</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-smartphone color-4 icon-bg-4"></span>
                            <h3 class="my-3">App Development</h3>
                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt emit.</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-email color-5 icon-bg-5"></span>
                            <h3 class="my-3">Email Marketing</h3>
                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt emit.</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- Single Service -->
                        <div class="single-service p-4">
                            <span class="flaticon-affiliate color-6 icon-bg-6"></span>
                            <h3 class="my-3">Affiliate Marketing</h3>
                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt emit.</p>
                            <a class="service-btn mt-3" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
        c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
        c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section> --}}
        <!-- ***** Service Area End ***** -->


        <!-- ***** Portfolio Area Start ***** -->
        <section id="portfolio" class="portfolio-area overflow-hidden ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2>Our Recent Works</h2>
                            <p class="d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                            <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-12">
                        <!-- Portfolio Menu -->
                        <div class="portfolio-menu btn-group btn-group-toggle flex-wrap justify-content-center text-center mb-4 mb-md-5" data-toggle="buttons">
                            <label class="btn active d-table text-uppercase p-2">
                                <input type="radio" value="all" checked class="portfolio-btn">
                                <span>All</span>
                            </label>
                            <label class="btn d-table text-uppercase p-2">
                                <input type="radio" value="marketing" class="portfolio-btn">
                                <span>Marketing</span>
                            </label>
                            <label class="btn d-table text-uppercase p-2">
                                <input type="radio" value="agency" class="portfolio-btn">
                                <span>Agency</span>
                            </label>
                            <label class="btn d-table text-uppercase p-2">
                                <input type="radio" value="seo" class="portfolio-btn">
                                <span>SEO</span>
                            </label>
                            <label class="btn d-table text-uppercase p-2">
                                <input type="radio" value="development" class="portfolio-btn">
                                <span>App Development</span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Portfolio Items -->
                <div class="row items portfolio-items">
                    <div class="col-12 col-sm-6 col-lg-4 portfolio-item" data-groups='["marketing","development"]'>
                        <!-- Single Case Studies -->
                        <div class="single-case-studies">
                            <!-- Case Studies Thumb -->
                            <a href="#">
                                <img src="assets/img/case_studies/case_studies_1/thumb_1.jpg" alt="">
                            </a>
                            <!-- Case Studies Overlay -->
                            <a href="#" class="case-studies-overlay">
                                <!-- Overlay Text -->
                                <span class="overlay-text text-center p-3">
                                    <h3 class="text-white mb-3">Digital Marketing</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectet ur adipisicing elit.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 portfolio-item" data-groups='["seo","development"]'>
                        <!-- Single Case Studies -->
                        <div class="single-case-studies">
                            <!-- Case Studies Thumb -->
                            <a href="#">
                                <img src="assets/img/case_studies/case_studies_1/thumb_2.jpg" alt="">
                            </a>
                            <!-- Case Studies Overlay -->
                            <a href="#" class="case-studies-overlay">
                                <!-- Overlay Text -->
                                <span class="overlay-text text-center p-3">
                                    <h3 class="text-white mb-3">App Development</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectet ur adipisicing elit.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 portfolio-item" data-groups='["marketing","agency"]'>
                        <!-- Single Case Studies -->
                        <div class="single-case-studies">
                            <!-- Case Studies Thumb -->
                            <a href="#">
                                <img src="assets/img/case_studies/case_studies_1/thumb_4.jpg" alt="">
                            </a>
                            <!-- Case Studies Overlay -->
                            <a href="#" class="case-studies-overlay">
                                <!-- Overlay Text -->
                                <span class="overlay-text text-center p-3">
                                    <h3 class="text-white mb-3">Content Management</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectet ur adipisicing elit.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 portfolio-item" data-groups='["agency","development","seo"]'>
                        <!-- Single Case Studies -->
                        <div class="single-case-studies">
                            <!-- Case Studies Thumb -->
                            <a href="#">
                                <img src="assets/img/case_studies/case_studies_1/thumb_3.jpg" alt="">
                            </a>
                            <!-- Case Studies Overlay -->
                            <a href="#" class="case-studies-overlay">
                                <!-- Overlay Text -->
                                <span class="overlay-text text-center p-3">
                                    <h3 class="text-white mb-3">Data Analysis</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectet ur adipisicing elit.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 portfolio-item" data-groups='["development","marketing","development"]'>
                        <!-- Single Case Studies -->
                        <div class="single-case-studies">
                            <!-- Case Studies Thumb -->
                            <a href="#">
                                <img src="assets/img/case_studies/case_studies_1/thumb_5.jpg" alt="">
                            </a>
                            <!-- Case Studies Overlay -->
                            <a href="#" class="case-studies-overlay">
                                <!-- Overlay Text -->
                                <span class="overlay-text text-center p-3">
                                    <h3 class="text-white mb-3">SEO Marketing</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectet ur adipisicing elit.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 portfolio-item" data-groups='["agency","development","marketing","seo"]'>
                        <!-- Single Case Studies -->
                        <div class="single-case-studies">
                            <!-- Case Studies Thumb -->
                            <a href="#">
                                <img src="assets/img/case_studies/case_studies_1/thumb_6.jpg" alt="">
                            </a>
                            <!-- Case Studies Overlay -->
                            <a href="#" class="case-studies-overlay">
                                <!-- Overlay Text -->
                                <span class="overlay-text text-center p-3">
                                    <h3 class="text-white mb-3">Marketing Strategy</h3>
                                    <p class="text-white">Lorem ipsum dolor sit amet, consectet ur adipisicing elit.</p>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="#" class="btn btn-bordered mt-4">View More</a>
                </div>
            </div>
        </section>
        <!-- ***** Portfolio Area End ***** -->

        <!-- ***** Price Plan Area Start ***** -->
        {{-- <section id="pricing" class="section price-plan-area bg-grey overflow-hidden ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2>Our Price Plans</h2>
                            <p class="d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                            <p class="d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="row price-plan-wrapper">
                            <div class="col-12 col-md-6">
                                <!-- Single Price Plan -->
                                <div class="single-price-plan color-1 bg-hover hover-top text-center p-5">
                                    <!-- Plan Title -->
                                    <div class="plan-title mb-2 mb-sm-3">
                                        <h3 class="mb-2">Basic</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, nemo.</p>
                                    </div>
                                    <!-- Plan Price -->
                                    <div class="plan-price pb-2 pb-sm-3">
                                        <span class="color-primary fw-7">$</span>
                                        <span class="h1 fw-7">49</span>
                                        <sub class="validity text-muted fw-5">/mo</sub>
                                    </div>
                                    <!-- Plan Description -->
                                    <div class="plan-description">
                                        <ul class="plan-features">
                                            <li class="py-2">5GB Linux Web Space</li>
                                            <li class="py-2">5 MySQL Databases</li>
                                            <li class="py-2 text-muted">24/7 Tech Support</li>
                                            <li class="py-2 text-muted">Daily Backups</li>
                                        </ul>
                                    </div>
                                    <!-- Plan Button -->
                                    <div class="plan-button">
                                        <a href="#" class="btn btn-bordered mt-3">Get Started</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-4 mt-md-0">
                                <!-- Single Price Plan -->
                                <div class="single-price-plan color-2 bg-hover active hover-top text-center p-5">
                                    <!-- Plan Title -->
                                    <div class="plan-title mb-2 mb-sm-3">
                                        <h3 class="mb-2">Pro <sup><span class="badge badge-pill badge-warning ml-2">Save 20%</span></sup></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, nemo.</p>
                                    </div>
                                    <!-- Plan Price -->
                                    <div class="plan-price pb-2 pb-sm-3">
                                        <span class="color-primary fw-7">$</span>
                                        <span class="h1 fw-7">129</span>
                                        <sub class="validity text-muted fw-5">/mo</sub>
                                    </div>
                                    <!-- Plan Description -->
                                    <div class="plan-description">
                                        <ul class="plan-features">
                                            <li class="py-2">10GB Linux Web Space</li>
                                            <li class="py-2">50 MySQL Databases</li>
                                            <li class="py-2">Unlimited Email</li>
                                            <li class="py-2">Daily Backups</li>
                                        </ul>
                                    </div>
                                    <!-- Plan Button -->
                                    <div class="plan-button">
                                        <a href="#" class="btn btn-bordered mt-3">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center pt-5">
                    <p class="pt-4 fw-5">Not sure what to choose? <a class="service-btn" href="{{route('ContactUsForm')}}"><strong>Contact Us</strong></a></p>
                </div>
            </div>
        </section> --}}
        <!-- ***** Price Plan Area End ***** -->

        <!-- ***** Review Area Start ***** -->
        <section id="review" class="section review-area bg-overlay ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-7">
                        <!-- Section Heading -->
                        <div class="section-heading text-center">
                            <h2 class="text-white">Our clients says</h2>
                            <p class="text-white d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                            <p class="text-white d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Client Reviews -->
                    <div class="client-reviews owl-carousel">
                        <!-- Single Review -->
                        <div class="single-review p-5">
                            <!-- Review Content -->
                            <div class="review-content">
                                <!-- Review Text -->
                                <div class="review-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam est modi amet error earum aperiam, fuga labore facere rem ab nemo possimus cum excepturi expedita. Culpa rerum, quaerat qui non.</p>
                                </div>
                                <!-- Quotation Icon -->
                                <div class="quot-icon">
                                    <img class="avatar-sm" src="assets/img/quote.png" alt="">
                                </div>
                            </div>
                            <!-- Reviewer -->
                            <div class="reviewer media mt-3">
                                <!-- Reviewer Thumb -->
                                <div class="reviewer-thumb">
                                    <img class="avatar-lg radius-100" src="assets/img/avatar/avatar-1.png" alt="">
                                </div>
                                <!-- Reviewer Media -->
                                <div class="reviewer-meta media-body align-self-center ml-4">
                                    <h5 class="reviewer-name color-primary mb-2">Junaid Hasan</h5>
                                    <h6 class="text-secondary fw-6">CEO, Themeland</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Single Review -->
                        <div class="single-review p-5">
                            <!-- Review Content -->
                            <div class="review-content">
                                <!-- Review Text -->
                                <div class="review-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam est modi amet error earum aperiam, fuga labore facere rem ab nemo possimus cum excepturi expedita. Culpa rerum, quaerat qui non.</p>
                                </div>
                                <!-- Quotation Icon -->
                                <div class="quot-icon">
                                    <img class="avatar-sm" src="assets/img/quote.png" alt="">
                                </div>
                            </div>
                            <!-- Reviewer -->
                            <div class="reviewer media mt-3">
                                <!-- Reviewer Thumb -->
                                <div class="reviewer-thumb">
                                    <img class="avatar-lg radius-100" src="assets/img/avatar/avatar-2.png" alt="">
                                </div>
                                <!-- Reviewer Media -->
                                <div class="reviewer-meta media-body align-self-center ml-4">
                                    <h5 class="reviewer-name color-primary mb-2">Yasmin Akter</h5>
                                    <h6 class="text-secondary fw-6">Founder, Themeland</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Single Review -->
                        <div class="single-review p-5">
                            <!-- Review Content -->
                            <div class="review-content">
                                <!-- Review Text -->
                                <div class="review-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam est modi amet error earum aperiam, fuga labore facere rem ab nemo possimus cum excepturi expedita. Culpa rerum, quaerat qui non.</p>
                                </div>
                                <!-- Quotation Icon -->
                                <div class="quot-icon">
                                    <img class="avatar-sm" src="assets/img/quote.png" alt="">
                                </div>
                            </div>
                            <!-- Reviewer -->
                            <div class="reviewer media mt-3">
                                <!-- Reviewer Thumb -->
                                <div class="reviewer-thumb">
                                    <img class="avatar-lg radius-100" src="assets/img/avatar/avatar-3.png" alt="">
                                </div>
                                <!-- Reviewer Media -->
                                <div class="reviewer-meta media-body align-self-center ml-4">
                                    <h5 class="reviewer-name color-primary mb-2">Md. Arham</h5>
                                    <h6 class="text-secondary fw-6">CEO, Themeland</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Review Area End ***** -->

        

        <!--====== Call To Action Area Start ======-->
        <section class="section cta-area bg-overlay ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <!-- Section Heading -->
                        <div class="section-heading text-center m-0">
                            <h1 class="text-white">Looking for the best hostel registration &amp; marketing solution?</h1>
                            <p class="text-white d-block d-sm-block mt-4">We are National Hostel Association of Pakistan.</p>
                            <p class="text-white d-block d-sm-block mt-4">A non-profit organization. The hostel owners community named as National Hostels Association of Pakistan</p>
                            <a href="{{route('ContactUsForm')}}" class="btn btn-bordered-white mt-4">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Call To Action Area End ======-->

@endsection