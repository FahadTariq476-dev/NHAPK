@extends('frontEnd.forntEnd_layout.main')
@section('main-container')


        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area d-flex align-items-center" style="background-image: url('{{ asset($blogs[0]->image_path) }}'); background-size: cover; background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- text-center">
                            <h2 class="text-white mb-3">Blogs (News Feed)</h2>
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="#">More</a></li>
                                <li class="breadcrumb-item text-white active">Blogs (News Feed)</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->

       {{-- Begin: View Blogs Area --}}
<div class="container mt-5">
    <div class="row">
        @if ($blogs->count() > 0)
        <!-- Display only the first blog -->
        <div class="col-md-12 mb-4">
            <div class="card">
                {{-- <img
                    src="{{ asset($blogs[0]->image_path) }}"
                    class="card-img-top img-fluid" 
                    alt="Thumbnail Image" 
                    onerror="this.onerror=null; this.src='{{ asset('no-image-icon.png') }}';"
                > --}}
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="">Title:</span><br>
                        {{$blogs[0]->title}}
                    </h5>
                    <p class="card-text text-justify">
                        <span class=""><h5>Short Description:</h5></span><br>
                        {{$blogs[0]->short_description}}
                    </p>
                    <p class="card-text text-justify">
                        <span class=""><h5>Content:</h5></span><br>
                        {!! $blogs[0]->editor_content !!}
                    </p>
                    <p class="card-text text-muted text-right">
                        <span class="">Posted at:</span><br>
                        {{ \Carbon\Carbon::parse($blogs[0]->created_at)->format('d-M-Y \a\t h:i A') }}
                    </p>
                    {{-- <a href="{{ route('frontEnd.viewFullBlogById', ['id' => $blogs[0]->id]) }}" class="btn btn-primary">View Details</a> --}}
                </div>
            </div>
        </div>
        @else
        <p>No blogs available.</p>
        @endif
    </div>
</div>
{{-- End: View Blogs Area --}}


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
