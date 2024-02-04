@extends('frontEnd.forntEnd_layout.main')
@section('title','Organogram - Members-Details')
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


        <!-- ***** Team Area Start ***** -->
        <section class="section team-area bg-light pt-5 pb-5">
            <!-- Shape Top -->
            <div class="shape shape-top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#FFFFFF">
                    <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
                c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
                c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
                </svg>
            </div>
        
            <!-- Content Here -->
            <div class="container">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Organogram Member</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-4">
                                <!-- form -->
                                <form action="#" method="POST" id="formViewOrganogramMember">
                                    <!-- Member Name -->
                                    <div class="form-group mb-3">
                                        <label for="memberName">Name of the Member:</label>
                                        <h3 class="mb-0">{{ $organogram->user->name ?? 'Null'}}</h3>
                                    </div>
        
                                    <!-- Member Mobile Number -->
                                    <div class="form-group mb-3">
                                        <label for="memberMobileNumber">Mobile Number of the Member:</label>
                                        <h3 class="mb-0">{{ $organogram->user->phone_number ?? 'Null'}}</h3>
                                    </div>
        
                                    <!-- Member State -->
                                    <div class="form-group mb-3">
                                        <label for="memberState">State of the Member:</label>
                                        <h3 class="mb-0">{{ $organogram->user->state->name ?? 'Null'}}</h3>
                                    </div>
        
                                    <!-- Member City -->
                                    <div class="form-group mb-3">
                                        <label for="memberCity">City of the Member:</label>
                                        <h3 class="mb-0">{{ $organogram->user->city->name ?? 'Null'}}</h3>
                                    </div>
        
                                    <!-- Member Address -->
                                    <div class="form-group mb-3">
                                        <label for="memberAddress">Address of the Member:</label>
                                        <h3 class="mb-0">{{ $organogram->user->address ?? 'Null'}}</h3>
                                    </div>
        
                                    <!-- Member Description -->
                                    <div class="form-group mb-3">
                                        <label for="memberDescription">Description of the Member:</label>
                                        <h3 class="mb-0">{{ $organogram->user->short_description ?? 'Null'}}</h3>
                                    </div>
        
                                    <!-- Member Picture -->
                                    <div class="form-group mb-3">
                                        <label for="memberPicture">Picture of the Member:</label>
                                        <img src="{{ Storage::url($organogram->user->picture_path) }}" alt="Member Image"
                                            class="img-fluid rounded"
                                            onerror="this.onerror=null; this.src='{{ asset('app-assets/images/no-image-icon.jpg') }}';">
                                    </div>
        
                                    <!-- Member Designation -->
                                    <div class="form-group mb-3">
                                        <label for="memberDesignationId">Designation of the Member:</label>
                                        <h3 class="mb-0">{{ $organogram->organogramDesignation->title ?? 'Null'}}</h3>
                                    </div>
                                </form>
                                <!-- form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Content Here -->
        
            <!-- Shape Bottom -->
            <div class="shape shape-bottom">
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

 {{-- <div class="container">
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
                </div>
            </div> --}}