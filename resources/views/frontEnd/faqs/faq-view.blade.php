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
        <br>
        <br>
        <br>

        <!--Section: FAQ-->
        <section class="container my-5">
            <h3 class="text-center mb-4 pb-2 text-primary fw-bold">FAQ's</h3>
            <p class="text-center mb-5">
                Find the answers for the most frequently asked questions below
            </p>
            <div class="row">
                @foreach ($faqs as $faq)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h6 class="card-title mb-3 text-primary"><i class="far fa-paper-plane text-primary pe-2"></i> {{ $faq->question }}</h6>
                                <p class="card-text">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!--Section: FAQ-->

        <br>
        <br>
        <br>

        <!--====== Call To Action Area Start ======-->
        <section class="section cta-area bg-overlay ptb_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <!-- Section Heading -->
                        <div class="section-heading text-center m-0">
                            <h2 class="text-white">Looking for the best digital agency &amp; marketing solution?</h2>
                            <p class="text-white d-none d-sm-block mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.</p>
                            <p class="text-white d-block d-sm-none mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati.</p>
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
