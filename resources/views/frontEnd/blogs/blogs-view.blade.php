@extends('frontEnd.forntEnd_layout.main')
@section('title','Blogs')
@section('main-container')

        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area overlay-dark d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- text-center">
                            <h2 class="text-white mb-3">Blogs (News Feed)</h2>
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
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

            <!-- Begin: Pagination Links -->
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    {{-- {{ $blogs->links() }} --}}
                    {{ $blogs->links('pagination::bootstrap-5') }}
                    {{-- {{ $blogs->links('pagination::bootstrap-4') }} --}}
                </div>
            </div>
            <!-- End:   Pagination Links -->

        </div>
        {{-- End: View Blogs Area --}}


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
