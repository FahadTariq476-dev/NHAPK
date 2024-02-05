@extends('frontEnd.forntEnd_layout.main')
@section('title','Organogram - Members')
@section('main-container')
        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area overlay-dark d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- d-flex flex-column align-items-center text-center">
                            <h2 class="text-white mb-3">Members</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item text-white active">Members</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->


        <!-- ***** Our Goal Area Start ***** -->
        <section class="section our-goal ptb_100">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-6">
                        <!-- Goal Content -->
                        <div class="goal-content section-heading text-center text-lg-left pr-md-4 mb-0">
                            <h2 class="mb-3">Our Goal</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis tenetur maxime labore recusandae enim dolore, nesciunt, porro molestias ullam eum atque harum! Consectetur, facilis maxime ratione fugiat laborum omnis atque quae, molestiae rem perspiciatis veritatis cumque ex minima, numquam quis dicta impedit possimus tempore? Quo sequi labore, explicabo sit vitae.</p><br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto iure excepturi eos, tenetur minima dignissimos repellendus laudantium, rem, quo ipsam esse maiores sequi ex debitis quae facilis dolorum voluptates animi.</p>
                            <a href="#" class="btn btn-bordered mt-4">Read More</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <!-- Goal Thumb -->
                        <div class="goal-thumb mt-5 mt-lg-0">
                            <img src="assets/img/about/about_thumb_2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Our Goal Area End ***** -->

        <!-- ***** Team Area Start ***** -->
        <section class="section team-area bg-grey ptb_100">
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
                            <h2 style="text-transform: none">Our Members</h2>
                            <p class="d-none text-justify d-sm-block mt-4">
                                Enthusiastic learner and problem-solver, fueled by a curiosity for the unknown.
                                Creative soul navigating life's adventures with an open heart and a love for storytelling.
                                A tech enthusiast with a passion for innovation and a knack for turning ideas into reality.
                                Nature lover, constantly seeking tranquility in the great outdoors and the beauty of simplicity.
                                A coffee connoisseur and bibliophile who finds solace in the world of words and warm beverages.
                                Aspiring chef experimenting in the kitchen, blending flavors and creating culinary delights.
                                Fitness enthusiast on a journey to conquer personal goals and embrace a healthy lifestyle.
                                Globe-trotter with a suitcase full of dreams, exploring the world one destination at a time.
                                A music aficionado, finding inspiration and rhythm in the melodies that shape my day.
                                Advocate for positivity, spreading good vibes and encouraging a life filled with laughter and joy.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($organograms as $organogram)
                        <div class="col-12 col-md-6 col-lg-4">
                            <!-- Single Team -->
                            <div class="single-team">
                                <!-- Team Photo -->
                                <div class="team-photo">
                                    <a href="#">
                                        <img src="{{ Storage::url($organogram->user->picture_path) }}" alt="Member Image"
                                        onerror="this.onerror=null; this.src='{{ asset('app-assets/images/no-image-icon.jpg') }}';">
                                    </a>
                                </div>
                                <!-- Team Content -->
                                <div class="team-content p-3">
                                    <a href="{{route('frontEnd.viewOrganogramMemberDetails', ['organogramMemberId' => $organogram->id])}}">
                                        <h3 class="mb-1">{{ $organogram->user->name ?? 'Null'}}</h3>
                                    </a>
                                    <h5 class="">{{ $organogram->organogramDesignation->title ?? 'Null'}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Display pagination links -->
                    {{ $organograms->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- Shape Bottom -->
            <div class="shape shape-bottom" style="color: red; background-color:aqua">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
        c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
        c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        </section>
        <!-- ***** Team Area End ***** -->


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