@extends('frontEnd.forntEnd_layout.main')
@section('main-container')

        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area overlay-dark d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- text-center">
                            <h2 class="text-white mb-3">Hostel Details</h2>
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item text-white active">List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->
 
        <!--Begin:  Section: Show Hostel Details-->
        <section class="container my-5">
            <div class="row">
                <div class="col-md-8">
                    <!-- Hostel Name -->
                    <div class="info-box bg-light p-4 mb-4 rounded">
                        <h2 class="text-success">{{ $properties->name }}</h2>
                    </div>
        
                    <!-- Address Details -->
                    <div class="info-box bg-light p-4 mb-4 rounded">
                        <h4 class="text-success">Address Details:</h4>
                        <p><strong>Address:</strong>{{ $propertyAddress->address }}</p>
                        <p><strong>Nearest Landmark:</strong>{{ $propertyAddress->nearest_landmark }}</p>
                        <p><strong>State:</strong>{{ $states->name }}</p>
                        <p><strong>City:</strong>{{ $cities->name }}</p>
                    </div>
        
                    {{-- <!-- Location -->
                    <div class="info-box bg-light p-4 mb-4 rounded">
                        <h4 class="text-success">Location:</h4>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $properties->location }}</span>
                        </div>
                    </div> --}}
        
                    <!-- Heading Description -->
                    <div class="info-box bg-light p-4 mb-4 rounded">
                        <h4 class="text-success">Description:</h4>
                        @if ($properties->description)
                            <p class="text-justify">{{ $properties->description }}</p>
                        @else
                            <p class="text-justify">
                                Welcome to <b>{{ $properties->name }}</b>, a vibrant and welcoming accommodation option for travelers
                                seeking comfort, affordability, and a sense of community.
                                While specific details may vary, here is a general overview of what you can expect at our hostel:
                            </p>
                        @endif
                    </div>
        
                    <!-- Property Details -->
                    <div class="info-box bg-light p-4 mb-4 rounded">
                        <h4 class="text-success">Property Details:</h4>
                        <div class="row">
                            <!-- Left side with Total Rooms and Year Built -->
                            <div class="col-md-4">
                                <ul>
                                    <li><strong>Total Rooms:</strong> {{ $properties->number_bedroom }}</li>
                                    <li><strong>Year Built:</strong> {{ $properties->created_at->format('Y') }}</li>
                                </ul>
                            </div>
                            
                            <!-- Vertical Divider -->
                            <div class="col-md-2 border-right"></div>
                            
                            <!-- Right side with Rent Price and Status -->
                            <div class="col-md-4">
                                <ul>
                                    <li><strong>Rent Price:</strong> {{ $properties->price }}</li>
                                    <li><strong>Status:</strong> {{ $properties->moderation_status }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Property Metas -->
                    <div class="info-box bg-light p-4 mb-4 rounded">
                        <h4 class="text-success">Property Metas:</h4>
                        <div class="row">
                            <!-- Left side with Total Rooms and Year Built -->
                            <div class="col-md-12">
                                <ul>
                                    <li><strong>Phone Number:</strong> {{ $propertyMetas->contact_number }}</li>
                                    <li><strong>Hostel For:</strong> {{ ucwords($propertyMetas->hostel_for) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
        
                    <!-- Luxuries, Amenities, Features, and Facilities -->
                    <div class="row">
                        
                        <!-- Features Section -->
                        <div class="col-md-3">
                            <div class="info-box bg-light p-4 mb-4 rounded">
                                <h4 class="text-success">Features:</h4>
                                <ul>
                                    @foreach ($features as $feature)
                                        {{-- <li><input type="checkbox" disabled> {{ $feature->name }}</li> --}}
                                        {{-- Check if the current luxury is in propertyFacilities --}}
                                        @php
                                            $isChecked = $propertyFeatures->contains('id', $feature->id);
                                        @endphp

                                        {{-- Use the $isChecked variable to set the 'checked' attribute --}}
                                        <li>
                                            <input type="checkbox" disabled {{ $isChecked ? 'checked' : '' }}> {{ $feature->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        
                        <!-- Facilities Section -->
                        <div class="col-md-3">
                            <div class="info-box bg-light p-4 mb-4 rounded">
                                <h4 class="text-success">Facilities:</h4>
                                <ul>
                                    @foreach ($facilities as $facility)
                                        {{-- <li><input type="checkbox" disabled> {{ $facility->name }}</li> --}}
                                        {{-- Check if the current luxury is in propertyFacilities --}}
                                        @php
                                            $isChecked = $propertyFacilities->contains('id', $facility->id);
                                        @endphp

                                        {{-- Use the $isChecked variable to set the 'checked' attribute --}}
                                        <li>
                                            <input type="checkbox" disabled {{ $isChecked ? 'checked' : '' }}> {{ $facility->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Amenities Section -->
                        <div class="col-md-3">
                            <div class="info-box bg-light p-4 mb-4 rounded">
                                <h4 class="text-success">Amenities:</h4>
                                <ul>
                                    @foreach ($amenities as $amenity)
                                        {{-- <li><input type="checkbox" disabled> {{ $amenity->name }}</li> --}}
                                        {{-- Check if the current luxury is in propertyAmenities --}}
                                        @php
                                            $isChecked = $propertyAmenities->contains('id', $amenity->id);
                                        @endphp

                                        {{-- Use the $isChecked variable to set the 'checked' attribute --}}
                                        <li>
                                            <input type="checkbox" disabled {{ $isChecked ? 'checked' : '' }}> {{ $amenity->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- $propertyLuxuries --}}
                        <!-- Luxuries Section -->
                        <div class="col-md-3">
                            <div class="info-box bg-light p-4 mb-4 rounded">
                                <h4 class="text-success">Luxuries:</h4>
                                <ul>
                                    @foreach ($luxuries as $luxury)
                                        {{-- <li><input type="checkbox" disabled> {{ $luxury->name }}</li> --}}
                                        {{-- Check if the current luxury is in propertyLuxuries --}}
                                        @php
                                            $isChecked = $propertyLuxuries->contains('id', $luxury->id);
                                        @endphp

                                        {{-- Use the $isChecked variable to set the 'checked' attribute --}}
                                        <li>
                                            <input type="checkbox" disabled {{ $isChecked ? 'checked' : '' }}> {{ $luxury->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- End Luxuries, Amenities, Features, and Facilities -->
        
                    <!-- Location Heading -->
            <div class="info-box bg-light p-4 mb-4 rounded">
                <h4 class="text-success">Location:</h4>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>{{ $properties->location }}</span>
                </div>
                <!-- Display Location Map using latitude and longitude -->
                <div id="map" class="bg-light p-4 rounded" style="height: 400px; width: 100%;">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Hostel Owner Details -->
            <div class="info-box bg-light p-4 mb-4 rounded">
                <h4 class="text-success">Hostel Owner Details:</h4>
                <p><strong>Name:</strong> {{ $hostelOwner->name }}</p>
                <p><strong>Email:</strong> {{ $hostelOwner->email }} </p>
                <p><strong>Phone:</strong> {{ $hostelOwner->phone_number }} </p>
            </div>

            <!-- Partner Details (if available) -->
            @if ($hostelPartners->isNotEmpty())
                <div class="info-box bg-light p-4 mb-4 rounded">
                    <h4 class="text-success">Partner Details:</h4>
                    @foreach ($hostelPartners as $partner)
                        <p><strong>Name:</strong> {{ $partner->name }}</p>
                        <p><strong>Email:</strong> {{ $partner->email }}</p>
                        <p><strong>Phone:</strong> {{ $partner->phone_number }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Warden Details (if available) -->
            @if ($hostelWardens->isNotEmpty())
                <div class="info-box bg-light p-4 mb-4 rounded">
                    <h4 class="text-success">Warden Details:</h4>
                    @foreach ($hostelWardens as $warden)
                        <p><strong>Name:</strong> {{ $warden->name }}</p>
                        <p><strong>Email:</strong> {{ $warden->email }}</p>
                        <p><strong>Phone:</strong> {{ $warden->phone_number }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Images Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-success">Images</h2>
            <img src="{{ asset($properties->images) }}" alt="Default Image" class="img-fluid rounded" onerror="this.onerror=null; this.src='{{ asset('app-assets/images/no-image-icon.jpg') }}';">
            {{-- <img src="{{ asset('app-assets/images/no-image-icon.jpg') }}" alt="Default Image" class="img-fluid rounded"> --}}
        </div>
    </div>
</section>
        
        <!--End:  Section: Show Hostel Details-->


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
<script>
    // Replace YOUR_API_KEY with your actual Google Maps API key
    const apiKey = 'AIzaSyDrN1lnwhavrmfKr2HWruDFDdXJcIfAM1M&libraries';
    // Replace latitude and longitude with actual values from your PHP variables
    const latitude = <?php echo json_encode($properties->latitude); ?>;
        const longitude = <?php echo json_encode($properties->longitude); ?>;

        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
                zoom: 15
            });

            // You can use the Places library features here
        }
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrN1lnwhavrmfKr2HWruDFDdXJcIfAM1M&libraries&libraries=places&callback=initMap">
</script>
@endsection
