@extends('frontEnd.forntEnd_layout.main')
@section('main-container')

        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area overlay-dark d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- text-center">
                            <h2 class="text-white mb-3">FAQ's</h2>
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item text-white active">FAQ's</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->
 
        <!--Begin:  Section: FAQ-->
        <section class="container my-5">
            <h1 class="text-center mb-4 pb-2 text-primary fw-bold">FAQ's</h1>
            <p class="text-center mb-5">
                Find the answers for the most frequently asked questions below
            </p>
            <div class="accordion" id="faqAccordion">
                @foreach ($faqs as $key => $faq)
                <div class="card">
                    <div class="card-header" id="faqHeading{{ $key }}">
                        <h5 class="mb-0">
                            <button class="btn text-primary" data-toggle="collapse"
                                data-target="#faqCollapse{{ $key }}" aria-expanded="true" aria-controls="faqCollapse{{ $key }}">
                                {{ $faq->question }}
                            </button>
                        </h5>
                    </div>
        
                    <div id="faqCollapse{{ $key }}" class="collapse" aria-labelledby="faqHeading{{ $key }}"
                        data-parent="#faqAccordion">
                        <div class="card-body text-justify">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <!--End:  Section: FAQ-->


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
@section('frontEnd-js')

@endsection
