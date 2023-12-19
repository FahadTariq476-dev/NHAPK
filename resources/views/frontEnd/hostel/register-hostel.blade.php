@extends('frontEnd.forntEnd_layout.main')
@section('title','Hostel Registration')
@section('main-container')

        <!-- ***** Breadcrumb Area Start ***** -->
        <section class="section breadcrumb-area overlay-dark d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Breamcrumb Content -->
                        <div class="breadcrumb- text-center">
                            <h2 class="text-white mb-3">Hostel Register</h2>
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item"><a class="text text-white" href="/">Home</a></li>
                                <li class="breadcrumb-item text-white active">Hostel Register</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Breadcrumb Area End ***** -->

        <!-- ***** Hostel Registration Area Start ***** -->
        <section class="section mt-5">
            <div class="container">
                <h2>Hostel Registration</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div>
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
                        </div>
                        <!-- Begin: Left Column -->
                        <form action="{{route('hostelRegistration.save')}}" method="POST" id="hostelRegForm" enctype="multipart/form-data">
                            @csrf
                            <!-- Hostel Details -->
                            <div class="form-group">
                                <label for="country">Country:</label>
                                <select class="form-control" id="country_id" name="country_id">
                                    <option value="" selected disabled>Select Country</option>
                                    @if (count($countries)>0)
                                        @foreach($countries as $country)
                                        {{-- {{ old('country_id') == $country->id ? 'selected' : '' }} --}}
                                            <option value="{{ $country->id }}" @if (old('country_id')==$country->id) selected @endif >
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No Country Found</option>
                                    @endif
                                </select>
                            </div>
                            @error('country_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- State -->
                            <div class="form-group">
                                <label for="state">State:</label>
                                <select class="form-control" id="states_id" name="states_id">
                                    <option value="" selected disabled>Select State</option>
                                </select>
                            </div>
                            @error('states_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            <!-- City -->
                            <div class="form-group">
                                <label for="city">City:</label>
                                <select class="form-control" id="city_id" name="city_id">
                                    <option value="" selected disabled>Select City</option>
                                </select>
                            </div>
                            @error('city_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Hostel Location --}}
                            <div class="form-group">
                                <label for="hostelLocation">Select Hostel Location:</label>
                                <input type="text" class="form-control" name="hostelLocation" id="hostelLocation" value="{{old('hostelLocation')}}" placeholder="Select Hostel Location">
                                <input type="hidden" class="form-control" name="latitude" id="latitude" value="{{old('latitude')}}" placeholder="Latitude Here" readonly/>
                                <input type="hidden" class="form-control" name="longitude" id="longitude" value="{{old('longitude')}}" placeholder="Latitude Here" readonly/>
                            </div>
                            @error('hostelLocation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Hostel Owner Name --}}
                            <div class="form-group">
                                <label for="hostelOwnerName">Hostel Owner Name:</label>
                                <input type="text" class="form-control" name="hostelOwnerName" id="hostelOwnerName" value="{{old('hostelOwnerName')}}" placeholder="Name of Private Hostel Owner / Head of Govt. Hostel" >
                            </div>
                            @error('hostelOwnerName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- Hostel Owner Contact --}}
                            <div class="form-group">
                                <label for="hostelOwnerContact">Hostel Owner Contact:</label>
                                <div class="input-group" id="div-hostelOwnerContact">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+923</span>
                                    </div>
                                    <input type="text" class="form-control" name="hostelOwnerContact" id="hostelOwnerContact" value="{{old('hostelOwnerContact')}}"  pattern="[0-9]{9}" maxlength="9" minlength="9" value="{{old('hostelOwnerContact')}}" placeholder="Hostel Owner / Head Contact No">
                                </div>
                                <small class="form-text text-muted">Please enter a mobile number. Don't add +923</small>
                            </div>
                            @error('hostelOwnerContact')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Hostel Owner CNIC --}}
                            <div class="form-group">
                                <label for="hostelOwnerCnic">Hostel Owner Cnic:</label>
                                <input type="text" class="form-control" name="hostelOwnerCnic" id="hostelOwnerCnic" value="{{old('hostelOwnerCnic')}}" placeholder="Hostel Owner / Head CNIC No" minlength="15" maxlength="15">
                            </div>
                            @error('hostelOwnerCnic')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Begin: Get the email if the user is new --}}
                            {{-- Hostel Owner Email --}}
                            <div class="form-group" id="div-hostelOwnerEmail">
                                <label for="hostelOwnerEmail">Hostel Owner Email:</label>
                                <input type="email" class="form-control" name="hostelOwnerEmail" id="hostelOwnerEmail" value="{{old('hostelOwnerEmail')}}" placeholder="Enter email here">
                            </div>
                            @error('hostelOwnerEmail')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- End: Get the email if the user is new --}}

                            {{-- Hostel Onwer CNIC Verify --}}
                            <div class="form-group cnicverify">
                            </div>

                            {{-- Hostel Rooms --}}
                            <div class="form-group">
                                <label for="totalRooms">Total Hostel Rooms:</label>
                                <input type="number" class="form-control" name="totalRooms" id="totalRooms" placeholder="Total Rooms">
                            </div>
                            @error('totalRooms')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            {{-- Hostel Capacity --}}
                            <div class="form-group">
                                <label for="room_occupany">Total Hostel Capacity:</label>
                                <input type="number" class="form-control" name="room_occupany" id="room_occupany" placeholder="Total Hostel Capacity">
                            </div>
                            @error('room_occupany')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Hostel Gender --}}
                            <div class="form-group">
                                <label for="hostelGender">Hostel For:</label>
                                <select class="form-control" name="hostelGender" id="hostelGender">
                                    <option value="">Hostel For</option>
                                    <option value="male">Boys</option>
                                    <option value="female">Girls</option>
                                </select>
                            </div>
                            @error('hostelGender')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Hostel Type --}}
                            <div class="form-group">
                                <label for="hostelType">Hostel Type:</label>
                                <select class="form-control" id="hostelType" name="hostelType">
                                    <option value="">Select Hostel Type</option>
                                    @foreach ($property_types as $property_type)
                                    <option value="{{$property_type->id}}" @if (old('hostelType')==$property_type->id) selected @endif>{{$property_type->name}}</option>    
                                    @endforeach
                                </select>
                            </div>
                            @error('hostelType')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            <!-- End: Left Column -->
                    </div>
    
                    <div class="col-md-6">
                        <!-- Right Column -->
                            <!-- Hostel Details -->
                            <div class="form-group">
                                <label for="hostelName">Hostel Name:</label>
                                <input type="text" class="form-control" id="hostelName" name="hostelName" value="{{old('hostelName')}}" placeholder="Enter Hostel Name Here">
                            </div>
                            @error('hostelName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="samehostel" style="color:red;"></div>
                            <div class="form-group">
                                <label for="hostelAddress">Hostel Address:</label>
                                <textarea class="form-control" name="hostelAddress" id="hostelAddress" rows="3" placeholder="Hostel Address">{{old('hostelAddress')}}</textarea>
                            </div>
                            @error('hostelAddress')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="hostelContactNumber">Hostel Contact Number:</label>
                                <div class="input-group" id="div-hostelContactNumber">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+923</span>
                                    </div>
                                    <input type="text" class="form-control" name="hostelContactNumber" id="hostelContactNumber" value="{{old('hostelContactNumber')}}" pattern="[0-9]{9}" maxlength="9" minlength="9" value="{{old('hostelContactNumber')}}" placeholder="Hostel Contact Number">
                                </div>
                                <small class="form-text text-muted">Please enter a mobile number. Don't add +923</small>
                            </div>
                            @error('hostelContactNumber')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="hostelLandLine">Hostel Land Line Number:</label>
                                <input type="text" class="form-control" name="hostelLandLine" id="hostelLandLine" value="{{old('hostelLandLine')}}" placeholder="Hostel Land Line Number [Optional]">
                            </div>

                            <div class="form-group">
                                <label for="hostelPartnerName">Hostel Partner Name:</label>
                                <input type="text" class="form-control" name="hostelPartnerName" id="hostelPartnerName" value="{{old('hostelPartnerName')}}" placeholder="Hostel Partner Name [Optional]">
                            </div>
                            @error('hostelPartnerName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Start of Hostel Partner Details if any --}}
                            <div id="hostelPartnerDetails">
                                <div class="form-group">
                                    <label for="partnerContact">Hostel Partner Contact Number:</label>
                                    <div class="input-group" id="div-partnerContact">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+923</span>
                                        </div>
                                        <input type="text" name="partnerContact" id="partnerContact" value="{{old('partnerContact')}}" pattern="[0-9]{9}" maxlength="9" minlength="9" value="{{old('partnerContact')}}" placeholder="Hostel Partner Contact Number:" class="form-control">
                                    </div>
                                    <small class="form-text text-muted">Please enter a mobile number. Don't add +923</small>
                                </div>
                                @error('partnerContact')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                
                                <div class="form-group">
                                    <label for="partnerCnic">Hostel Partner Cnic:</label>
                                    <input type="text" name="partnerCnic" id="partnerCnic" value="{{old('partnerCnic')}}" placeholder="Hostel Partner CNIC#" class="form-control" minlength="15" maxlength="15" >
                                </div>
                                @error('partnerCnic')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- End of Hostel Partner Details if any --}}

                            <div class="form-group" id="div-hostelPartnerEmail">
                                <label for="hostelPartnerEmail">Hostel Partner Email:</label>
                                <input type="email" name="hostelPartnerEmail" id="hostelPartnerEmail" value="{{old('hostelPartnerEmail')}}" placeholder="Hostel Partner Email Here:" class="form-control">
                            </div>
                            @error('hostelPartnerEmail')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="PartnerCnicVerify"></div>
                            <div class="form-group">
                                <label for="hostelWardenName">Hostel Warden Name:</label>
                                <input type="text" class="form-control" name="hostelWardenName" id="hostelWardenName" value="{{old('hostelWardenName')}}" placeholder="Hostel Warden Name [Optional]">
                            </div>
                            @error('hostelWardenName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Start of Hostel Warden Detailas if any --}}
                            <div id="hostelWardenDetails">
                                <div class="form-group">
                                    <label for="hostelWardenContact">Hostel Warden Contact Number:</label>
                                    <div class="input-group" id="div-hostelWardenContact">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+923</span>
                                        </div>
                                        <input type="text" name="hostelWardenContact" id="hostelWardenContact" value="{{old('hostelWardenContact')}}" pattern="[0-9]{9}" maxlength="9" minlength="9" value="{{old('hostelWardenContact')}}" placeholder="Hostel Warden Contact Number:" class="form-control">
                                    </div>
                                    <small class="form-text text-muted">Please enter a mobile number. Don't add +923</small>
                                </div>   
                                @error('hostelWardenContact')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror   

                                <div class="form-group">
                                    <label for="hostelWardenCnic">Hostel Warden Cnic:</label>
                                    <input type="text" name="hostelWardenCnic" id="hostelWardenCnic" value="{{old('hostelWardenCnic')}}" placeholder="Hostel Warden CNIC#" class="form-control" minlength="15" maxlength="15">
                                </div>
                                @error('hostelWardenCnic')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- End of Hostel Warden Detailas if any --}}
                            <div class="wardenCnicVeryify"></div>
                            <div class="form-group" id="div-hostelWardenEmail">
                                <label for="hostelWardenEmail">Hostel Warden Email:</label>
                                <input type="email" class="form-control" name="hostelWardenEmail" id="hostelWardenEmail" value="{{old('hostelWardenEmail')}}" placeholder="Enter Hodtel Warden Email Here:" >
                            </div>
                            @error('hostelWardenEmail')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="referalCNIC">Referal Cnic:</label>
                                <input type="text" class="form-control" name="referalCNIC" id="referalCNIC" value="{{old('referalCNIC')}}" placeholder="Enter Your Referal CNIC [Optional]" minlength="15" maxlength="15">
                            </div>
                            @error('referalCNIC')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="hostelCategories">Hostel Categories:</label>
                                <select class="form-control" id="hostelCategories" name="hostelCategories">
                                    <option value="">Select Hostel Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if (old('hostelCategories')==$category->id) selected @endif>{{$category->name}}</option>    
                                        @endforeach   
                                </select>
                            </div>
                            @error('hostelCategories')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Attach Your Reg Fee Vochure / ScreenShot of Your Transaction</label>
                                <input type="file"  name="slip_image" id="slip_image" accept=".png, .jpg, .jpeg" class="form-control">
                            </div>
                            @error('slip_image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            {{-- Hostel Images --}}
                            <div class="form-group">
                                <label>Attach Your Images of the Hostel</label>
                                <input type="file"  name="hostel_images" id="hostel_images" accept=".png, .jpg, .jpeg" class="form-control" multiple>
                            </div>
                            @error('hostel_images')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group" id="div-terms">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input">
					            <a href="https://termsfeed.com/terms-conditions/f18d6159c88d21b6c392878b73562e24">Are You Agree with Terms & Conditions</a> 
                            </div>
                            @error('terms')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <!-- Agreement Checkbox -->
    
                            <!-- Submit and Reset Buttons -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Hostel Registration Area End ***** -->

        

        
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


    
    {{-- Begin: Script to Hide the div's on page load --}}
    <script>
        $(document).ready(function(){
            $("#div-hostelOwnerEmail").hide();
            $("#div-hostelPartnerEmail").hide();
            $("#div-hostelWardenEmail").hide();
        });
    </script>
    {{-- End: Script to Hide the div's on page load --}}


 <!-- Your script for CNIC and referal_cnic formatting -->
<script>
    $(document).ready(function() {
        // Function to format CNIC and referal_cnic dynamically
        function formatField(field) {
            var value = field.val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
            var formattedValue = formatCnic(value);
            field.val(formattedValue);
        }

        // Function to format CNIC dynamically (323226161887 => 32322-616188-7)
        function formatCnic(value) {
            if (value.length >= 5 && value.length < 12) {
                return value.slice(0, 5) + '-' + value.slice(5);
            } else if (value.length >= 12) {
                return value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12, 15);
            } else {
                return value;
            }
        }

        // Format Hostel Owner CNIC on input
        $('#hostelOwnerCnic').on('input', function() {
            formatField($(this));
        });

        // Format Hostel Partner CNIC on input
        $('#partnerCnic').on('input', function() {
            formatField($(this));
        });
        
        // Format Hostel Warden Cnin on input
        $('#hostelWardenCnic').on('input', function() {
            formatField($(this));
        });
        
        // Format referal cnic on input
        $('#referalCNIC').on('input', function() {
            formatField($(this));
        });

        // Set maximum and minimum values for both fields
        $('#hostelOwnerCnic', '#partnerCnic','#hostelWardenCnic','#referalCNIC').attr('maxlength', '15');
        $('#hostelOwnerCnic', '#partnerCnic','#hostelWardenCnic','#referalCNIC').attr('minlength', '15');
        $('#hostelOwnerContact', '#hostelContactNumber','#partnerContact','#hostelWardenContact').attr('minlength', '9');
    });
</script>

    <script>
        $(document).ready(function () {
            $("#hostelRegForm").submit(function(e){
                // Check the form validation
                $(".alert-danger").remove();

                // Check the country is selected or not
                let country_id = $("#country_id").val();
                if(country_id==="" || country_id === null){
                    e.preventDefault();
                    $("#country_id").after('<div class="alert alert-danger">County Should be selected.</div>');
                }

                // Check the state is selected or not
                let states_id = $("#states_id").val();
                if(states_id==="" || states_id === null){
                    e.preventDefault();
                    $("#states_id").after('<div class="alert alert-danger">County Should be selected.</div>');
                }

                // Check the city is selected or not
                let city_id = $("#city_id").val();
                if(city_id==="" || city_id === null){
                    e.preventDefault();
                    $("#city_id").after('<div class="alert alert-danger">County Should be selected.</div>');
                }

                // Check the Hostel Location is given or not
                let hostelLocation = $("#hostelLocation").val();
                if(hostelLocation.trim()==="" || hostelLocation.length == 0){
                    e.preventDefault();
                    $("#hostelLocation").after('<div class="alert alert-danger">Hostel Location Should be Given.</div>');
                }
                else{
                    let latitude = $("#latitude").val();
                    let longitude = $("#longitude").val();
                    if(longitude.trim()===""||latitude.trim()===""){
                        e.preventDefault();
                        $("#hostelLocation").after('<div class="alert alert-danger">Hostel Location Should be Given and Selected.</div>');
                    }
                }

                // Check the hostel owner name is empty or not
                let hostelOwnerName = $("#hostelOwnerName").val();
                if(hostelOwnerName.trim()===''){
                    e.preventDefault();
                    $("#hostelOwnerName").after('<div class="alert alert-danger">Hostel Owner Name Should be Given.</div>');
                }

                // Check the hostel owner contact number is empty or not
                let hostelOwnerContact = $("#hostelOwnerContact").val();
                if(hostelOwnerContact.length!=9){
                    e.preventDefault();
                    $("#div-hostelOwnerContact").after('<div class="alert alert-danger">Hostel Owner Contact Number Should be Given Properly.</div>');
                }

                // To check the hostel owner cnic
                let hostelOwnerCnic = $("#hostelOwnerCnic").val();
                if(hostelOwnerCnic.length==0 ||hostelOwnerCnic.length<15){
                    e.preventDefault();
                    $("#hostelOwnerCnic").after('<div class="alert alert-danger">Hostel Owner CNIC Should be Given.</div>');
                }
                else{
                    // Check email only if the div is visible
                    if ($("#div-hostelOwnerEmail").is(":visible")) {
                        let hostelOwnerEmail = $("#hostelOwnerEmail").val();
                        // Validate email format
                        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (hostelOwnerEmail.length == 0 || !emailRegex.test(hostelOwnerEmail)) {
                            e.preventDefault();
                            $("#div-hostelOwnerEmail").after('<div class="alert alert-danger">Please enter a valid email address.</div>');
                        }
                    }
                }

                // Validate totalRooms
                let totalRooms = $("#totalRooms").val();
                if (totalRooms <= 0 || !Number.isInteger(Number(totalRooms))) {
                    e.preventDefault();
                    $("#totalRooms").after('<div class="alert alert-danger">Please enter a valid positive integer greater than 0 for Total Hostel Rooms.</div>');
                }
                
                // Validate room_occupany
                let room_occupany = $("#room_occupany").val();
                if (room_occupany <= 0 || !Number.isInteger(Number(room_occupany))) {
                    e.preventDefault();
                    $("#room_occupany").after('<div class="alert alert-danger">Please enter a valid positive integer greater than 0 for Total Hostel Capacity.</div>');
                }

                // To check the valid hostel gender is selected or not
                let hostelGender = $("#hostelGender").val();
                if(hostelGender.length===0 || hostelGender===null){
                    e.preventDefault();
                    $("#hostelGender").after('<div class="alert alert-danger">Hostel Gender Should be Selected.</div>');
                }
                
                // To check the valid hostel hostelType is selected or not
                let hostelType = $("#hostelType").val();
                if(hostelType.length===0 || hostelType===null){
                    e.preventDefault();
                    $("#hostelType").after('<div class="alert alert-danger">Hostel Type Should be Selected.</div>');
                }

                // To Check the Hostel Name is given or not
                let hostelName = $("#hostelName").val();
                if(hostelName.trim()===''){
                    e.preventDefault();
                    $("#hostelName").after('<div class="alert alert-danger">Hostel Name Should be Given.</div>');
                }
                
                // To Check the Hostel Address is given or not
                let hostelAddress = $("#hostelAddress").val();
                if(hostelAddress.trim()===''){
                    e.preventDefault();
                    $("#hostelAddress").after('<div class="alert alert-danger">Hostel Adrees Should be GIven.</div>');
                }

                // Check the hostel contact number is empty or not
                let hostelContactNumber = $("#hostelContactNumber").val();
                if(hostelContactNumber.length!=9){
                    e.preventDefault();
                    $("#div-hostelContactNumber").after('<div class="alert alert-danger">Hostel Contact Number Should be Given Properly.</div>');
                }

                // Check the if hostel partner name is given and below fields are visible
                let hostelPartnerName = $("#hostelPartnerName").val();
                if(hostelPartnerName.length>2 && ($("#hostelPartnerDetails").is(":visible"))){
                    let partnerContact = $("#partnerContact").val();
                    if(partnerContact.length!=9){
                        e.preventDefault();
                        $("#div-partnerContact").after('<div class="alert alert-danger">Hostel Partner Contact Number Should be Given Properly.</div>');
                    }
                    // To check the hostel partnerCnic
                    let partnerCnic = $("#partnerCnic").val();
                    if(partnerCnic.length==0 ||partnerCnic.length<15){
                        e.preventDefault();
                        $("#partnerCnic").after('<div class="alert alert-danger">Hostel Partner CNIC Should be Given.</div>');
                    }
                    else{
                        // Check email only if the div is visible
                        if ($("#div-hostelPartnerEmail").is(":visible")) {
                            let hostelPartnerEmail = $("#hostelPartnerEmail").val();
                            // Validate email format
                            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (hostelPartnerEmail.length == 0 || !emailRegex.test(hostelPartnerEmail)) {
                                e.preventDefault();
                                $("#div-hostelPartnerEmail").after('<div class="alert alert-danger">Please enter a valid email address.</div>');
                            }
                        }
                    }
                }

                // Check the if hostel warden name is given and below fields are visible
                let hostelWardenName = $("#hostelWardenName").val();
                if(hostelWardenName.length>2 && ($("#hostelWardenName").is(":visible"))){
                    let hostelWardenContact = $("#hostelWardenContact").val();
                    if(hostelWardenContact.length!=9){
                        e.preventDefault();
                        $("#div-hostelWardenContact").after('<div class="alert alert-danger">Hostel Warden Contact Number Should be Given Properly.</div>');
                    }
                    // To check the hostel warden cnic
                    let hostelWardenCnic = $("#hostelWardenCnic").val();
                    if(hostelWardenCnic.length==0 || hostelWardenCnic.length<15){
                        e.preventDefault();
                        $("#hostelWardenCnic").after('<div class="alert alert-danger">Hostel Warden CNIC Should be Given.</div>');
                    }
                    else{
                        // Check email only if the div is visible
                        if ($("#div-hostelWardenEmail").is(":visible")) {
                            let hostelWardenEmail = $("#hostelWardenEmail").val();
                            // Validate email format
                            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (hostelWardenEmail.length == 0 || !emailRegex.test(hostelWardenEmail)) {
                                e.preventDefault();
                                $("#div-hostelWardenEmail").after('<div class="alert alert-danger">Please enter a valid email address.</div>');
                            }
                        }
                    }
                }

                // To check if the referal cnic is given then it's length will be 15
                let referalCNIC = $("#referalCNIC").val();
                if(referalCNIC.length>1 && referalCNIC.length<15){
                    e.preventDefault();
                    $("#referalCNIC").after('<div class="alert alert-danger">Referal CNIC Should be Given properly.</div>');
                }
                
                // To check if the hostelCategories is selected or not
                let hostelCategories = $("#hostelCategories").val();
                if(hostelCategories.length===0 || hostelCategories===null){
                    e.preventDefault();
                    $("#hostelCategories").after('<div class="alert alert-danger">Hostel Categories Should be Selected properly.</div>');
                }

                // Check the file slip_image
                let imageInput = $('#slip_image')[0];

                if (imageInput.files.length === 0) {
                    e.preventDefault();
                    $("#slip_image").after('<div class="alert alert-danger">Please select a file.</div>');
                }
                else{
                    // Check file extension
                    let allowedExtensions = ['png', 'jpg', 'jpeg'];
                    let fileName = imageInput.files[0].name;
                    let fileExtension = fileName.split('.').pop().toLowerCase();

                    if (!allowedExtensions.includes(fileExtension)) {
                        e.preventDefault();
                        $("#slip_image").after('<div class="alert alert-danger">Please select a file with a valid extension (PNG, JPG, JPEG).</div>');
                    }

                    // Check file size
                    let maxSize = 2 * 1024 * 1024; // 2 MB in bytes
                    if (imageInput.files[0].size > maxSize) {
                        e.preventDefault();
                        $("#slip_image").after('<div class="alert alert-danger">File size should not exceed 2 MB.</div>');
                    }
                }
                
                // Check the file hostel_images
                let imageInputHostelImages = $('#hostel_images')[0];

                if (imageInputHostelImages.files.length === 0) {
                    e.preventDefault();
                    $("#hostel_images").after('<div class="alert alert-danger">Please select at least one file.</div>');
                } else {
                    // Check each file
                    let allowedExtensions = ['png', 'jpg', 'jpeg'];
                    let maxSize = 2 * 1024 * 1024; // 2 MB in bytes

                    for (let i = 0; i < imageInputHostelImages.files.length; i++) {
                        let fileName = imageInputHostelImages.files[i].name;
                        let fileExtension = fileName.split('.').pop().toLowerCase();

                        // Check file extension
                        if (!allowedExtensions.includes(fileExtension)) {
                            e.preventDefault();
                            $("#hostel_images").after('<div class="alert alert-danger">Please select files with valid extensions (PNG, JPG, JPEG).</div>');
                            break; // Stop checking if an invalid extension is found
                        }

                        // Check file size
                        if (imageInputHostelImages.files[i].size > maxSize) {
                            e.preventDefault();
                            $("#hostel_images").after('<div class="alert alert-danger">File size should not exceed 2 MB.</div>');
                            break; // Stop checking if a file exceeds the size limit
                        }
                    }
                }

                // Check the terms checkbox is checked or not
                let terms = $("#terms").prop("checked");
                if(!(terms)){
                    e.preventDefault();
                    $("#div-terms").after('<div class="alert alert-danger">You must agree the terms and condition.</div>');
                }

            });
        });
    </script>



 {{-- Start of script tag of get states from country id --}}
 <script>
     $(document).ready(function(){
         $('#country_id').change(function(){
             $('#states_id').empty();
             $('#states_id').append('<option value="null">Select State</option>');
             var country_id = $(this).val();
             if(country_id == "null"){  // Check if the selected value is "Select Country"
             alert("No country selected!");
             return;  // Exit the function early
             }
             $.ajax({
                 url: '/get-states/' + country_id,
                 type: 'GET',
                 success: function(response) {
                    // Clear existing options
                    $('#states_id').empty();
                    $('#states_id').append('<option value="" disabled selected>Select State</option>');
                    // Populate the state dropdown with the fetched data
                    if(response.length === 0 || response === null){
                        $('#states_id').append('<option value="" disabled>No States Found</option>');
                    }else{
                        $.each(response, function(key, value) {
                            $('#states_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                    $('#city_id').empty();
                     $('#city_id').append('<option value="" disabled selected>Select City</option>');
                 },
                 error: function(error) {
                     console.log(error);
                 }
             });
         });
     });
 </script>
 {{-- End of script tag of get states from country id --}}

 {{-- Start of script tag of get cities from state id --}}
 <script>
     $(document).ready(function(){
         $('#states_id').change(function(){
             $('#city_id').empty();
             $('#city_id').append('<option value="null">Select City</option>');
             var states_id = $(this).val();
             if(states_id == "null"){  // Check if the selected value is "Select Country"
             alert("No state selected!");
             return;  // Exit the function early
             }
             // Your existing code for the selected country
             // alert(country_id);
             $.ajax({
                 url: '/get-cities/' + states_id,
                 type: 'GET',
                 success: function(response) {
                    // Clear existing options
                    $('#city_id').empty();
                    $('#city_id').append('<option value="" disabled selected>Select City</option>');
                    // Populate the state dropdown with the fetched data
                    if(response.length === 0 || response === null){
                        $('#city_id').append('<option value="" disabled>No City Found</option>');
                    }else{
                        $.each(response, function(key, value) {
                            $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                 },
                 error: function(error) {
                     console.log(error);
                 }
             });
         });
     });
 </script>
 {{-- End of script tag of get cities from state id --}}

 <script>
     $(document).ready(function(){
            $("#hostelPartnerDetails").hide();
            $("#hostelWardenDetails").hide();
         
         // Start of showing the Hostel Partner Details
         hostelPartnerName.onkeyup=function(){
             let partnerAvail = $('#hostelPartnerName').val();
             if(partnerAvail.length>2){
                 $("#hostelPartnerDetails").show(20);
                 $("#partnerContact").css({"border":"2px solid red"});
                 $("#partnerCnic").css({"border":"2px solid red"});
             }
             else{
                 $("#hostelPartnerDetails").slideUp(120);
                 $("#hostelPartnerDetails").hide();
             }
         };
         // End of showing the Hostel Partner Details


         // Start of showing the Hostel Warden Details
         hostelWardenName.onkeyup = function(){
             let hostelWardenAvail = $('#hostelWardenName').val();
             if(hostelWardenAvail.length>2){
                 $("#hostelWardenDetails").show(20);
                 $("#hostelWardenContact").css({"border":"2px solid red"});
                 $("#hostelWardenCnic").css({"border":"2px solid red"});
             }
             else{
                 $('#hostelWardenDetails').slideUp(120);
                 $('#hostelWardenDetails').hide();
             }
         };
         // End of showing the Hostel Warden Details
     });
 </script>

 {{-- Start of script to verify the cnic of the owner --}}
 <script>
     $(document).ready(function(){
         $('#hostelOwnerCnic').focusout(function(){
            //
            let hostelOwnerCnic = $('#hostelOwnerCnic').val();
            if(hostelOwnerCnic.length == 15){
                // alert(hostelOwnerCnic);
                $.ajax({
                    type:'GET',
                    url:'hostelRegistration/hostelOwnerCniccheck/' + hostelOwnerCnic,
                    success:function(response){
                        if(response==0){
                            $("#divCnic").remove();
                            $("#hostelOwnerCnic").after('<div class="alert alert-danger" id="divCnic">Hostel is Registered with this CNIC.</div>');
                            $("#hostelOwnerCnic").focus();
                            $('#div-hostelOwnerEmail').hide();
                            //  $('#hostelOwnerEmail').hide();
                            $('#hostelOwnerEmail').val('');
                            return;
                        }
                        else if(response==-1){
                            $("#divCnic").remove();
                            $("#hostelOwnerEmail").after('<div class="alert alert-success" id="divCnic">You are a new user kindly provide the email of the owner</div>');
                            $('#div-hostelOwnerEmail').show();
                            $("#hostelOwnerEmail").focus();
                            return;
                        }
                        else{
                            $("#divCnic").remove();
                            return;
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            else if(hostelOwnerCnic.length == 0){
                $("#divCnic").remove();
                $('#div-hostelOwnerEmail').hide();
                $('#hostelOwnerEmail').val('');
                return;
            }
            else if(hostelOwnerCnic.length > 0 && hostelOwnerCnic.length<15){
                $("#divCnic").remove();
                $("#hostelOwnerCnic").after('<div class="alert alert-danger" id="divCnic">Kindly use the valid cnic.</div>');
                $("#hostelOwnerCnic").focus();
                $('#div-hostelOwnerEmail').hide();
                $('#hostelOwnerEmail').val('');
                return;
            }
             
        });
    });
 </script>
 {{-- End of script to verify the cnic of the owner --}}

{{-- Start of script to verify the cnic of the refferal --}}
<script>
    $(document).ready(function(){
        $('#referalCNIC').focusout(function(){
           //
           let referalCNIC = $('#referalCNIC').val();
           if(referalCNIC.length == 15){
               // alert(hostelOwnerCnic);
               $.ajax({
                   type:'GET',
                   url:'/checkCNIC/' + referalCNIC,
                   success:function(response){
                       if(response==1){
                            $("#divReferalCNIC").remove();
                            return;
                       }
                       else{
                            $("#divReferalCNIC").remove();
                            $("#referalCNIC").after('<div class="alert alert-danger" id="divReferalCNIC">Referal CNIC does not exist in our record. Kindly use the valid cnic.</div>');
                            $("#referalCNIC").focus();
                            return;
                       }
                   },
                   error: function(error) {
                       console.log(error);
                   }
               });
           }
           else if(referalCNIC.length == 0){
                $("#divReferalCNIC").remove();
                return;
           }
           else if(referalCNIC.length > 0 && referalCNIC.length<15){
                $("#divReferalCNIC").remove();
                $("#referalCNIC").after('<div class="alert alert-danger" id="divReferalCNIC">Referal CNIC length should be provided correctly.</div>');
                $("#referalCNIC").focus();
                return;
           }
            
       });
   });
</script>
{{-- End of script to verify the cnic of the referral --}}
 
 {{-- Start of script to verify the cnic of the Hostel Partner --}}
 <script>
    $(document).ready(function(){
        $('#partnerCnic').focusout(function(){
             //
            let hostelPartnerCnic = $('#partnerCnic').val();
            if(hostelPartnerCnic.length == 15){
                $.ajax({
                    type:'GET',
                    url:'hostelRegistration/hostelPartnerCniccheck/' + hostelPartnerCnic,
                    success:function(response){
                        if(response==0){
                            $("#divPartnerCnic").remove();
                            $("#partnerCnic").after('<div class="alert alert-danger" id="divPartnerCnic">Hostel Partner is Registered with this CNIC.</div>');
                            $("#partnerCnic").focus();
                            $('#div-hostelPartnerEmail').hide();
                            $('#hostelPartnerEmail').val('');
                        }
                        else if(response==-1){
                            $("#divPartnerCnic").remove();
                            $("#hostelPartnerEmail").after('<div class="alert alert-success" id="divPartnerCnic">Hostel Partner is a new user kindly provide the email of the partner</div>');
                            $('#div-hostelPartnerEmail').show();
                            $("#hostelPartnerEmail").focus();
                        }
                        else{
                            $("#divPartnerCnic").remove();
                            $('#div-hostelPartnerEmail').hide();
                            $('#hostelPartnerEmail').val('');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            else if(hostelPartnerCnic.length==0){
                $("#divPartnerCnic").remove();
                $('#div-hostelPartnerEmail').hide();
                $('#hostelPartnerEmail').val('');
            }
            else{
                $("#divPartnerCnic").remove();
                $("#partnerCnic").after('<div class="alert alert-danger" id="divPartnerCnic">Kindly Provide the complete hostel partner cnic</div>');
                $('#div-hostelPartnerEmail').hide();
                $('#hostelPartnerEmail').val('');
                $("#partnerCnic").focus();
                return;
            }
             
        });
    });
 </script>
 {{-- End of script to verify the cnic of the Hostel Partner --}}

 {{-- Start of script to verify the cnic of the Hostel Warden --}}
 <script>
    $(document).ready(function(){
        $('#hostelWardenCnic').focusout(function(){
            //
            let hostelWardenCnic = $('#hostelWardenCnic').val();
            if(hostelWardenCnic.length ==15){
                $.ajax({
                    type:'GET',
                    url:'hostelRegistration/hostelWardenCniccheck/' + hostelWardenCnic,
                    success:function(response){
                        if(response==0){
                            $("#divWardenCnic").remove();
                            $("#hostelWardenCnic").after('<div class="alert alert-danger" id="divWardenCnic">Hostel Warden is Registered with this CNIC.</div>');
                            $("#partnerCnic").focus();
                            $('#div-hostelWardenEmail').hide();
                            $('#hostelWardenEmail').val('');
                        }
                        else if(response==-1){
                            $("#divWardenCnic").remove();
                            $("#hostelWardenEmail").after('<div class="alert alert-success" id="divWardenCnic">Hostel Warden is a new user kindly provide the email of the warden</div>');
                            $('#div-hostelWardenEmail').show();
                            $("#hostelWardenEmail").focus();
                        }
                        else{
                            $("#divWardenCnic").remove();
                            $('#div-hostelWardenEmail').hide();
                            $('#hostelWardenEmail').val('');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            else if(hostelWardenCnic.length==0){
                $("#divWardenCnic").remove();
                $('#div-hostelWardenEmail').hide();
                $('#hostelWardenEmail').val('');
            }
            else{
                $("#divWardenCnic").remove();
                $("#hostelWardenCnic").after('<div class="alert alert-danger" id="divWardenCnic">Kindly Provide the complete hostel warden cnic</div>');
                $('#div-hostelWardenEmail').hide();
                $('#hostelWardenEmail').val('');
                $("#hostelWardenCnic").focus();
                return;
            }
        });
    });
 </script>
 {{-- End of script to verify the cnic of the Hostel Warden --}}

 {{-- Start of script to verify the Name of the Hostel --}}
 <script>
    $(document).ready(function(){
        $('#hostelName').focusout(function(){
            let hostelName = $('#hostelName').val();
            if(hostelName.length>2){
                // alert("Yes");
                $.ajax({
                    url:'hostelRegistration/hostelName/' + hostelName,
                    type:'GET',
                    success:function(response){
                        if(response==1){
                            $("#divHostelName").remove();
                            $("#hostelName").after('<div class="alert alert-danger" id="divHostelName">Hostel Name Already Exist. Kindly Provide the unique Hostel Name.</div>');
                        }
                        else{
                            $("#divHostelName").remove();
                        }
                        // alert(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            else if(hostelName.length==0){
                $("#divHostelName").remove();
            }

        });
    });
 </script>
 {{-- End of script to verify the Name of the Hostel --}}
 <script>
     function isValidEmail(email) {
         // Regular expression for a simple email validation
         var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
         return emailRegex.test(email);
     }
 </script>
 {{-- Start of Script to check that given email is unique or not --}}
 <script>
     function checkEmail(inputFieldId) {
         let email = $(inputFieldId).val();
         if(email.length!=0){
             if (isValidEmail(email)) {
                 $.ajax({
                 url: '/checkEmail/' + email,
                 type: 'GET',
                 success: function(response){
                     if (response == 1) {
                         alert(email+": Email already exists");
                         $(inputFieldId).val('');
                         $(inputFieldId).focus();
                         return;
                     }
                 }
             });
         }
         else {
             alert("Kindly provide the email in the correct format");
             $(inputFieldId).focus();
             $(inputFieldId).val('');
         }
         }
     }
     $(document).ready(function(){
         $('#hostelOwnerEmail').focusout(function(){
             checkEmail('#hostelOwnerEmail');
         });
         $('#hostelPartnerEmail').focusout(function(){
             checkEmail('#hostelPartnerEmail');
         });
         $('#hostelWardenEmail').focusout(function(){
             checkEmail('#hostelWardenEmail');
         });
     });
 </script>
 {{-- End of Script to check that given email is unique or not --}}


 {{-- Start of script for Location using google map --}}
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrN1lnwhavrmfKr2HWruDFDdXJcIfAM1M&libraries=places"></script>
 <script>
     $(document).ready(function() {
        // Initialize Google Places Autocomplete
        var input = document.getElementById('hostelLocation');
        var autocomplete = new google.maps.places.Autocomplete(input);
        // Event listener for place selection
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            // Display latitude and longitude
            $('#latitude').val(place.geometry.location.lat());
            $('#longitude').val(place.geometry.location.lng());
        });
    });
 </script>
 {{-- Start of script for Location using google map --}}

@endsection