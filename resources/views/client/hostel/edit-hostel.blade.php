@extends('client.layouts.master')
@section('title','Add Hostel')

@section('css')
    <!-- Begin: DataTables CSS and JS -->
    @include('client.layouts.dataTables-links')
    <!-- End: DataTables CSS and JS -->

<!-- Include Select2 CSS without integrity -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

{{-- <!-- Include jQuery without integrity -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<!-- Include Select2 JS without integrity -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



@endsection

@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Add Hostel</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.dashboard.index') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('client.hostels.listHostels')}}">Hostel</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Add Hostel
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="#"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="#"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="#"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Begin: Add Hostel -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Hostel</h4>
                    </div>
                    <div class="card-body">
                        <div id="form-container">
                            <!-- Hostel Information -->
                            <div class="form-step" id="step1">
                                <h4>Hostel Information</h4>
                                <form class="row" id="formAddHostel" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Left Column -->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Name -->
                                        <div class="form-group">
                                            <label for="hostelName">Hostel Name:</label>
                                            <input type="text" class="form-control" id="hostelName" value="{{$properties->name}}" name="hostelName" minlength="3" maxlength="250" placeholder="Enter Your Hostel Name Here:">
                                        </div>
                            
                                        <!-- Hostel Description -->
                                        <div class="form-group">
                                            <label for="hostelDescription">Hostel Description:</label>
                                            <textarea class="form-control" id="hostelDescription" name="hostelDescription" rows="3" minlength="5" maxlength="400" placeholder="Enter Your Hostel Description Here:">{{$properties->description}}</textarea>
                                        </div>
                            
                                        <!-- Hostel Country -->
                                        <div class="form-group">
                                            <label for="hostelCountry">Country:</label>
                                            <select class="form-control" id="hostelCountryId" name="hostelCountryId">
                                                <option value="" selected disabled>Select Country</option>
                                                @if (count($countries)>0)
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" @if (old('hostelCountryId')==$country->id) selected @endif >
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>No Country Found</option>
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Hostel State -->
                                        <div class="form-group">
                                            <label for="hostelStatesId">State:</label>
                                            <select class="form-control" id="hostelStatesId" name="hostelStatesId">
                                                <option value="" selected disabled>Select State</option>
                                                @if (count($states)>0)
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}" @if ($properties->state_id==$state->id) selected @endif >
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                                @else
                                                    <option value="" disabled>No State Found</option>
                                                @endif
                                            </select>
                                        </div>
                            
                                        <!-- Hostel City -->
                                        <div class="form-group">
                                            <label for="hostelCityId">City:</label>
                                            <select class="form-control" id="hostelCityId" name="hostelCityId">
                                                <option value="" selected disabled>Select City</option>
                                                @if (count($cities)>0)
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" @if ($properties->city_id==$city->id) selected @endif >
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                                @else
                                                    <option value="" disabled>No City Found</option>
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Total Number of Rooms -->
                                        <div class="form-group">
                                            <label for="hostelTotalRooms">Total Number of Rooms:</label>
                                            <input type="number" class="form-control" value="{{$properties->number_bedroom}}" id="hostelTotalRooms" name="hostelTotalRooms" placeholder="Enter Total Number of Rooms Here:">
                                        </div>
                            
                                        
                                    </div>
                            
                                    <!-- Right Column -->
                                    <div class="col-md-6 mb-1">
                                         

                                         <!-- Hostel Address -->
                                         <div class="form-group">
                                            <label for="hostelAddress">Hostel Adress:</label>
                                            <textarea class="form-control" id="hostelAddress" name="hostelAddress" rows="3" minlength="5" maxlength="400" placeholder="Enter Your Hostel Address Here:">{{$properties->name}}</textarea>
                                        </div>
                            
                                       

                                        <!-- Hostel Nearest Landmark -->
                                        <div class="form-group">
                                            <label for="hostelNearestLandmark">Nearest Landmark:</label>
                                            <input type="text" class="form-control" value="{{$properties->name}}" id="hostelNearestLandmark" name="hostelNearestLandmark" placeholder="Enter Your Nearest Landmark Here:">
                                        </div>

                                        <!-- Total Number of Floors -->
                                        <div class="form-group">
                                            <label for="hostelTotalFloors">Total Number of Floors:</label>
                                            <input type="number" class="form-control" value="{{$properties->number_floor}}" id="hostelTotalFloors" name="hostelTotalFloors" placeholder="Enter Total Number of FLoors Here:">
                                        </div>

                                        <!-- Total Number of Bath Rooms -->
                                        <div class="form-group">
                                            <label for="hostelBathRooms">Total Number of Bath Rooms:</label>
                                            <input type="number" class="form-control" value="{{$properties->number_bathroom}}" id="hostelBathRooms" name="hostelBathRooms" placeholder="Enter Total Number of Bath Rooms Here:">
                                        </div>
                                        
                                        <!-- Hostel Categories-->
                                        <div class="form-group">
                                            <label for="hostelCategories">Select Hostel Categories:</label>
                                            <select class="form-control" id="hostelCategoryId" name="hostelCategoryId">
                                                <option value="" selected disabled >Select Hostel Category</option>
                                                @if (count($categories)>0)
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if ($properties->category_id==$category->id) selected @endif>
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>No Hostel Category Found</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="btnAddHostel">Next</button>
                                    </div>
                                    
                                </form>
                            </div>
        
                            <!-- Hostel Details -->
                            <div class="form-step" id="step2" style="display: none;">
                                <h4>Hostel Details</h4>
                                <form class="row" id="formHostelDetails">
                                    <!-- Left Column -->
                                    <div class="col-md-6 mb-1">
                                       

                                        <!-- Hostel Slogan -->
                                        <div class="form-group">
                                            <label for="hostelSlogan">Hostel Slogan:</label>
                                            <input type="text" class="form-control" value="{{$properties->name}}" id="hostelSlogan" name="hostelSlogan" placeholder="Enter Your Hostel Slogan Here:">
                                        </div>
                            
                                        <!-- Hostel For -->
                                        <div class="form-group">
                                            <label for="hostelGender">Hostel For:</label>
                                            <select class="form-control" name="hostelGender" id="hostelGender">
                                                <option value="" selected disabled>Hostel For</option>
                                                <option value="male">Boys</option>
                                                <option value="female">Girls</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Stay Type -->
                                        <div class="form-group">
                                            <label for="hostelStayType">Hostel Stay Type:</label>
                                            <select class="form-control" name="hostelStayType" id="hostelStayType">
                                                <option value="" selected disabled>Select Hostel Stay Type</option>
                                                <option value="short_stay">Short Stay</option>
                                                <option value="long_stay">Long Stay</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Guest Stay Allow -->
                                        <div class="form-group">
                                            <label for="hostelGuestStayAllow">Hostel Guest Stay Allow:</label>
                                            <select class="form-control" name="hostelGuestStayAllow" id="hostelGuestStayAllow">
                                                <option value="" selected disabled>Hostel Guest Stay Allow</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Rent Pay Schedule -->
                                        <div class="form-group">
                                            <label for="hostelRentPaySchedule">Hostel Rent Pay Schedule</label>
                                            <select class="form-control" name="hostelRentPaySchedule" id="hostelRentPaySchedule">
                                                <option value="" selected disabled>Select Hostel Rent Pay Schedule</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Yearly">Yearly</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Average Rent Per Seat (Monthly) -->
                                        <div class="form-group">
                                            <label for="hostelAvgRentPerMonth">Hostel Average Rent Per Seat (Monthly):</label>
                                            <input type="number" class="form-control" value="" id="hostelAvgRentPerMonth" name="hostelAvgRentPerMonth" placeholder="Enter Hostel Average Rent Per Seat (Monthly) Here:">
                                            <small class="form-text text-muted">Hostel Average Rent Per Seat (Monthly) Should be 10,000/Rs and greater.</small>
                                        </div>
                            
                                        <!-- Hostel Type -->
                                        <div class="form-group">
                                            <label for="hostelType">Hostel Type:</label>
                                            <select class="form-control" id="hostelTypeId" name="hostelTypeId">
                                                <option value="">Select Hostel Type</option>
                                                @if (count($property_types)>0)
                                                    @foreach ($property_types as $property_type)
                                                        <option value="{{$property_type->id}}">
                                                            {{$property_type->name}}
                                                        </option>    
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>No Hostel Type Found</option>
                                                @endif
                                            </select>
                                        </div>

                                       
                                        
                                    </div>
                            
                                    <!-- Right Column -->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Contact Number -->
                                        <div class="form-group">
                                            <label for="hostelContactNumber">Hostel Contact Number:</label>
                                            <div class="input-group" id="divHostelContactNumber">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+92</span>
                                                </div>
                                                <input type="tel" class="form-control" id="hostelContactNumber" value="" name="hostelContactNumber" pattern="[0-9]{10}" maxlength="10" minlength="10" placeholder="Enter Hostel Contact Number Here:"
                                                value="{{old('hostelContactNumber')}}" placeholder="Enter Your Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                                            </div>
                                            <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                        </div>

                                        <!-- Hostel Open Timing -->
                                        <div class="form-group">
                                            <label for="hostelOpenTiming">Hostel Open Timing:</label>
                                            <input type="time" class="form-control" value="08:00" id="hostelOpenTiming" name="hostelOpenTiming">
                                        </div>
                            
                                        <!-- Hostel Close Timing -->
                                        <div class="form-group">
                                            <label for="hostelCloseTiming">Hostel Close Timing:</label>
                                            <input type="time" class="form-control" value="21:00" id="hostelCloseTiming" name="hostelCloseTiming">
                                        </div>

                                        <!-- Hostel Room Occupancy -->
                                        <div class="form-group">
                                            <label for="hostelRoomOccupancy">Hostel Room Occupancy:</label>
                                            <input type="number" class="form-control" value="" id="hostelRoomOccupancy" name="hostelRoomOccupancy" placeholder="Enter Hostel Room Occupancy Here:">
                                        </div>
                                                                               
                                        <!-- Hostel Youtube Link -->
                                        <div class="form-group">
                                            <label for="hostelYoutubeLink">Hostel Youtube Link:</label>
                                            <input type="url" class="form-control" id="hostelYoutubeLink" name="hostelYoutubeLink" placeholder="Enter Hostel Youtube Link Here:">
                                        </div>
                            
                                        <!-- Hostel Facebook Link -->
                                        <div class="form-group">
                                            <label for="hostelFacebookLink">Hostel Facebook Link:</label>
                                            <input type="url" class="form-control" id="hostelFacebookLink" name="hostelFacebookLink" placeholder="Enter Hostel Facebook Link Here:">
                                        </div>
                            
                                        <!-- Hostel Instagram Link -->
                                        <div class="form-group">
                                            <label for="hostelInstagramLink">Hostel Instagram Link:</label>
                                            <input type="url" class="form-control" id="hostelInstagramLink" name="hostelInstagramLink" placeholder="Enter Hostel Instagram Link Here:">
                                        </div>

                                    </div>

                                    <!-- Buttons-->
                                    <div class="form-group mb-2">
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(2)">Previous</button>
                                        <button type="submit" class="btn btn-primary" id="btnHostelDetails">Next</button>
                                        {{-- <button type="button" class="btn btn-primary" onclick="nextStep(3)" id="btnHostelDetails">Next</button> --}}
                                        {{-- <a href="#" id="btnHostelDetails">Next</a> --}}
                                    </div>
                                    
                                </form>
                            </div>

                            <!-- Hostel Address With Map -->
                            <div class="form-step" id="step3" style="display: none">
                                <h4>Hostel Address Details</h4>
                                <form class="row" id="formHostelAdressDetails">
                                    <!-- Left Column-->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Location -->
                                        <div class="form-group">
                                            <label for="hostelLocation">Hostel Location:</label>
                                            <input type="text" class="form-control" value="" id="hostelLocation" name="hostelLocation" placeholder="Enter Your Hostel Location Here:">
                                            <span class="text-danger map_location_err"></span>
                                            <input type="hidden" class="form-control" name="latitude" id="latitude" placeholder="Latitude Here" readonly/>
                                            <input type="hidden" class="form-control" name="longitude" id="longitude" placeholder="Latitude Here" readonly/>
                                        </div>
                                         <!-- Hostel Zip Code -->
                                         <div class="form-group">
                                            <label for="hostelZipCode">Zip Code:</label>
                                            <input type="text" class="form-control" id="hostelZipCode" value="" name="hostelZipCode" minlength="4" maxlength="255" placeholder="Enter Your Zip Code Here:">
                                        </div>
                                        <!-- Hostel Recommended Place -->
                                        <div class="form-group">
                                            <label for="hostelRecommendedPlace">Hostel Recommended Place:</label>
                                            <input type="text" class="form-control" value="" id="hostelRecommendedPlace" name="hostelRecommendedPlace" placeholder="Enter Hostel Recommended Place Here:">
                                        </div>

                                    </div>
                                    
                                    <!-- Right Column-->
                                    <div class="col-md-6 mb-1">
                                         <!-- Hostel Area Name -->
                                         <div class="form-group">
                                            <label for="hostelAreaName">Hostel Area Name:</label>
                                            <input type="text" class="form-control" id="hostelAreaName" name="hostelAreaName" placeholder="Enter Hostel Area Name Here:">
                                        </div>
                                        
                                        <!-- Hostel Plot No -->
                                        <div class="form-group">
                                            <label for="hostelPlotNo">Hostel Plot No:</label>
                                            <input type="text"  class="form-control" id="hostelPlotNo" name="hostelPlotNo" placeholder="Enter Hostel Plot No Here:">
                                        </div>
                                        
                                        <!-- Hostel Street No -->
                                        <div class="form-group">
                                            <label for="hostelPlotNo">Hostel Street No:</label>
                                            <input type="text" class="form-control" id="hostelStreetNo" name="hostelStreetNo" placeholder="Enter Hostel Street No Here:">
                                        </div>
                                        <!-- Hostel Map Location -->
                                        <div class="form-group">
                                            <label for="hostelMapLocation">Hostel Map Location:</label>
                                            <input type="text" class="form-control" id="hostelMapLocation" name="hostelMapLocation" placeholder="Enter Hostel Map Location Here:">
                                            
                                        </div>

                                    </div>
                                    <div id="map" style="height: 450px;" class="mb-2"></div>
                                     <!-- Buttons-->
                                     <div class="form-group mb-2">
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(3)">Previous</button>
                                        <button type="submit" class="btn btn-primary" id="btnHostelAddresDetails">Next</button>
                                        {{-- <button type="button" class="btn btn-primary" onclick="nextStep(3)" id="btnHostelAddresDetails">Next</button> --}}
                                        {{-- <a href="#" id="btnHostelAddresDetails">Next</a> --}}
                                    </div>

                                </form>
                            </div>
                            
                            <!-- Hostel Metas -->
                            <div class="form-step" id="step4" style="display: none;">
                                <h4>Hostel Metas</h4>
                                
                                <form class="row" id="formHostelMetas">
                                    <!-- Left Column -->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Mess -->
                                        <div class="form-group">
                                            <label for="hostelMess">Hostel Mess:</label>
                                            <select class="form-control" name="hostelMess" id="hostelMess">
                                                <option value="" selected disabled>Select Hostel Mess</option>
                                                <option value="available">Available</option>
                                                <option value="unavailable">Unavailable</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Mess Type -->
                                        <div class="form-group" id="divHostelMessType" style="display: none">
                                            <label for="hostelMessType">Hostel Mess Type:</label>
                                            <select class="form-control" name="hostelMessType" id="hostelMessType">
                                                <option value="" selected disabled>Select Hostel Mess Type</option>
                                                <option value="one_time_mess">One Time Mess</option>
                                                <option value="two_time_mess">Two Time Mess</option>
                                                <option value="three_time_mess">Three Time Mess</option>
                                                <option value="buffay_time_mess">Buffay Type Mess</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Utility Bills -->
                                        <div class="form-group">
                                            <label for="hostelUtilityBills">Hostel Utility Bills:</label>
                                            <select class="form-control" name="hostelUtilityBills" id="hostelUtilityBills">
                                                <option value="" selected disabled>Select Hostel Utility Bills</option>
                                                <option value="included_in_rent">Included in rent</option>
                                                <option value="not_included_in_rent">Not Included in rent</option>
                                            </select>
                                        </div> 
                                        
                                        <!-- Hostel Security System -->
                                        <div class="form-group">
                                            <label for="hostelSecuritySystem">Hostel Security System:</label>
                                            <select class="form-control" name="hostelSecuritySystem" id="hostelSecuritySystem">
                                                <option value="" selected disabled>Select Hostel Security System</option>
                                                <option value="cctv">CCTV</option>
                                                <option value="bio_metric">Bio Metric</option>
                                                <option value="face_recognizer">Face Recognizer</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Security Guard -->
                                        <div class="form-group">
                                            <label for="hostelSecurityGuard">Hostel Security Guard:</label>
                                            <select class="form-control" name="hostelSecurityGuard" id="hostelSecurityGuard">
                                                <option value="" selected disabled>Select Hostel Security Guard</option>
                                                <option value="24/7">24/7</option>
                                                <option value="day_time">Day Time</option>
                                                <option value="night_watchman">Night Watchman</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Doorman Type -->
                                        <div class="form-group">
                                            <label for="hostelDoormanType">Hostel Doorman Type:</label>
                                            <select class="form-control" name="hostelDoormanType" id="hostelDoormanType">
                                                <option value="" selected disabled>Select Hostel Doorman Type</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Doorman Availability -->
                                        <div class="form-group">
                                            <label for="hostelDoormanAvailability">Hostel Doorman Availability:</label>
                                            <select class="form-control" name="hostelDoormanAvailability" id="hostelDoormanAvailability">
                                                <option value="" selected disabled>Select Hostel Doorman Availability</option>
                                                <option value="day_time">Day Time</option>
                                                <option value="IoT_Device">IoT Device</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Parking Availability -->
                                        <div class="form-group">
                                            <label for="hostelParkingAvailability">Hostel Parking Availability:</label>
                                            <select class="form-control" name="hostelParkingAvailability" id="hostelParkingAvailability">
                                                <option value="" selected disabled>Select Hostel Parking Availability</option>
                                                <option value="indoor">Indoor</option>
                                                <option value="outdoor">Outdoor</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                            
                                    <!-- Right Column -->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Made Type -->
                                        <div class="form-group">
                                            <label for="hostelMadeType">Hostel Made Type:</label>
                                            <select class="form-control" name="hostelMadeType" id="hostelMadeType">
                                                <option value="" selected disabled>Select Hostel Made Type</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Made Availability -->
                                        <div class="form-group">
                                            <label for="hostelMadeAvailability">Hostel Made Availability:</label>
                                            <select class="form-control" name="hostelMadeAvailability" id="hostelMadeAvailability">
                                                <option value="" selected disabled>Select Hostel Made Availability</option>
                                                <option value="24/7">24/7</option>
                                                <option value="office_time">Office Time</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Warden Type -->
                                        <div class="form-group">
                                            <label for="hostelWardenType">Hostel Warden Type:</label>
                                            <select class="form-control" name="hostelWardenType" id="hostelWardenType">
                                                <option value="" selected disabled>Select Hostel Warden Type</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Warden Availability -->
                                        <div class="form-group">
                                            <label for="hostelWardenAvailability">Hostel Warden Availability:</label>
                                            <select class="form-control" name="hostelWardenAvailability" id="hostelWardenAvailability">
                                                <option value="" selected disabled>Select Hostel Warden Availability</option>
                                                <option value="24/7">24/7</option>
                                                <option value="office_time">Office Time</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Common Room Availability -->
                                        <div class="form-group">
                                            <label for="hostelCommonRoomAvailability">Hostel Common Room Availability:</label>
                                            <select class="form-control" name="hostelCommonRoomAvailability" id="hostelCommonRoomAvailability">
                                                <option value="" selected disabled>Select Hostel Common Room Availability</option>
                                                <option value="24/7">24/7</option>
                                                <option value="n/a">N/A</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Study Room Availability -->
                                        <div class="form-group">
                                            <label for="hostelStudyRoomAvailability">Hostel Study Room Availability:</label>
                                            <select class="form-control" name="hostelStudyRoomAvailability" id="hostelStudyRoomAvailability">
                                                <option value="" selected disabled>Select Hostel Study Room Availability</option>
                                                <option value="24/7">24/7</option>
                                                <option value="n/a">N/A</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Prayer Area -->
                                        <div class="form-group">
                                            <label for="hostelPrayerArea">Hostel Prayer Area:</label>
                                            <select class="form-control" name="hostelPrayerArea" id="hostelPrayerArea">
                                                <option value="" selected disabled>Select Hostel Prayer Area</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

                                        <!-- Hostel Canteen Availability -->
                                        <div class="form-group">
                                            <label for="hostelCanteenAvailability">Hostel Canteen Availability:</label>
                                            <select class="form-control" name="hostelCanteenAvailability" id="hostelCanteenAvailability">
                                                <option value="" selected disabled>Select Hostel Canteen Availability</option>
                                                <option value="stand_alone">Stand Alone</option>
                                                <option value="attached">Attached</option>
                                                <option value="inside">Inside</option>
                                                <option value="outside">Outside</option>
                                                <option value="online">Online</option>
                                                <option value="pos">POS</option>
                                                <option value="n/a">N/A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="tagsId">Tags</label>
                                        <select class="form-control select2" name="tags[]" multiple="multiple" id="tagsId">
                                            <option value="" disabled>Select Property Tags</option>
                                            @if (count($tags) > 0)
                                                @foreach($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No Property Tags Found</option>
                                            @endif
                                        </select>
                                    </div>
                                    <script>
                                        var $jq = jQuery.noConflict();
                                        $jq(document).ready(function() {
                                            $jq('#tagsId').select2({
                                                placeholder: 'Select Property Tags',
                                                allowClear: true, // Add an option to clear the selection
                                                width: '100%', // Set the width to 100%
                                            });
                                        });
                                    </script>
                                    
                                    <!-- Buttons-->
                                    <div class="form-group mb-2">
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(4)">Previous</button>
                                        {{-- <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next</button> --}}
                                        <button type="submit" class="btn btn-primary" id="btnHostelMetas">Next</button>
                                        {{-- <a href="#" id="btnHostelMetas">Next</a> --}}
                                    </div>
                                    
                                </form>
                            </div>
                            
                            <!-- Partner Details -->
                            <div class="form-step" id="step5" style="display: none;">
                                <h4>Partner Details</h4>
                                <form>
                                    
                                </form>
                                <form id="formNewPartnerDetails">
                                    <div class="form-group mb-1" id="divPartnerRadioButton">
                                        <label for="partnerEmail">Do you have a partner:</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="partnerCnicRadioYes" name="partnerCnicRadio" value="Yes">
                                            <label class="form-check-label" for="partnerCnicRadioYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="partnerCnicRadioNo" name="partnerCnicRadio" value="No">
                                            <label class="form-check-label" for="partnerCnicRadioNo">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-1" id="divPartnerCnicCheck" style="display: none;">
                                        <div class="form-group mb-1">
                                            <label for="partnerCnicCheck">Partner Cnic:</label>
                                            <input type="email" class="form-control" id="partnerCnicCheck" name="partnerCnicCheck" minlength="15" maxlength="15" placeholder="Enter Partner Cnic Here:">
                                        </div>
                                    </div>
                                    <div id="divEnterPartnerDetails" style="display: none">
                                        <h4>Enter Partner Details</h4>
                                        <input type="hidden" class="form-control" id="partnerAuthorId" name="partnerAuthorId" placeholder="Enter Partner partnerAuthorId Here:" readonly>
                                        <!-- Partner First Name -->
                                        <div class="form-group">
                                            <label for="partnerFirstName">Partner First Name:</label>
                                            <input type="text" class="form-control" id="partnerFirstName" name="partnerFirstName" placeholder="Enter Partner First Name Here:">
                                        </div> 
                                        
                                        <!-- Partner Last Name -->
                                        <div class="form-group">
                                            <label for="partnerLastName">Partner Last Name:</label>
                                            <input type="text" class="form-control" id="partnerLastName" name="partnerLastName" placeholder="Enter Partner Last Name Here:">
                                        </div>
                                        
                                        <!-- Partner Email -->
                                        <div class="form-group">
                                            <label for="partnerEmail">Partner Email:</label>
                                            <input type="text" class="form-control" id="partnerEmail" name="partnerEmail" placeholder="Enter Partner Email Here:">
                                        </div> 
                                        
                                        <!-- Partner Mobile Number -->
                                        <div class="form-group" id="partnerMobileNumberDiv">
                                            <label for="partnerMobileNumber">Partner Mobile Number:</label>
                                            <div class="input-group" id="divPartnerMobileNumber">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+92</span>
                                                </div>
                                                <input type="tel" class="form-control" id="partnerMobileNumber" name="partnerMobileNumber" pattern="[0-9]{10}" maxlength="10" minlength="10" placeholder="Enter Partner Mobile Number Here:"
                                                value="{{old('partnerMobileNumber')}}" placeholder="Enter Your Partner Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                                            </div>
                                            <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                        </div> 
                                    </div>

                                    
                                </form>
                                <div class="form-group mb-1">
                                    <button type="button" class="btn btn-success" onclick="prevStep(5)">Previous</button>
                                    <button type="submit" class="btn btn-primary" id="btnNextPartner">Next</button>
                                    {{-- <button type="button" class="btn btn-primary" onclick="nextStep(5)">Next</button> --}}
                                    {{-- <a href="#" id="btnNextPartner">Next</a> --}}
                                </div>
                            </div>
        
                            <!-- Warden Details -->
                            <div class="form-step" id="step6" style="display: none;">
                                <h4>Warden Details</h4>
                                <form id="formNewWardenDetails">
                                    <div class="form-group mb-1" id="divWardenRadioButton">
                                        <label for="partnerEmail">Do you have Warden:</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="wardenCnicRadioYes" name="wardenCnicRadio" value="Yes">
                                            <label class="form-check-label" for="wardenCnicRadioYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" id="wardenCnicRadioNo" name="wardenCnicRadio" value="No">
                                            <label class="form-check-label" for="wardenCnicRadioNo">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-1" id="divWardenCnicCheck" style="display: none;">
                                        <div class="form-group mb-1">
                                            <label for="partnerCnicCheck">Warden Cnic:</label>
                                            <input type="email" class="form-control" id="wardenCnicCheck" name="wardenCnicCheck" minlength="15" maxlength="15" placeholder="Enter Partner Cnic Here:">
                                        </div>
                                    </div>
                                    <div id="divEnterWardenDetails" style="display: none;">
                                        <h4>Enter Warden Details</h4>
                                        <input type="hidden" class="form-control" id="wardenAuthorId" name="wardenAuthorId" placeholder="Enter Warden wardenAuthorId Here:" readonly>
                                        <!-- Warden First Name -->
                                        <div class="form-group">
                                            <label for="wardenFirstName">Warden First Name:</label>
                                            <input type="text" class="form-control" id="wardenFirstName" name="wardenFirstName" placeholder="Enter Warden First Name Here:">
                                        </div> 
                                        
                                        <!-- Warden Last Name -->
                                        <div class="form-group">
                                            <label for="wardenLastName">Warden Last Name:</label>
                                            <input type="text" class="form-control" id="wardenLastName" name="wardenLastName" placeholder="Enter Warden Last Name Here:">
                                        </div> 
                                        
                                        <!-- Warden Email -->
                                        <div class="form-group">
                                            <label for="wardenEmail">Warden Email:</label>
                                            <input type="text" class="form-control" id="wardenEmail" name="wardenEmail" placeholder="Enter Warden Email Here:">
                                        </div> 
                                        
                                        <!-- Warden Mobile Number -->
                                        <div class="form-group" id="divWardenMobileNumber">
                                            <label for="wardenMobileNumber">Warden Mobile Number:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+92</span>
                                                </div>
                                                <input type="tel" class="form-control" id="wardenMobileNumber" name="wardenMobileNumber" pattern="[0-9]{10}" maxlength="10" minlength="10" placeholder="Enter Warden Mobile Number Here:"
                                                value="{{old('wardenMobileNumber')}}" placeholder="Enter Your Warden Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                                            </div>
                                            <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                        </div> 
                                    </div>
                                </form>
                                <button type="button" class="btn btn-success" onclick="prevStep(6)">Previous</button>
                                {{-- <button type="button" class="btn btn-primary" onclick="nextStep(6)">Next</button> --}}
                                <button type="button" class="btn btn-primary" id="btnNextWarden">Next</button>
                                {{-- <a href="#" id="btnNextWarden">Next</a> --}}
                            </div>

                            <!--Hostel Features, Facilities, Amenities, Luxuries-->
                            <div class="form-step" id="step7" style="display: none;">
                                <h4>Hostel Features, Facilities, Amenities, Luxuries</h4>
                                <form action="#" method="POST" id="formAddFeaturesFacilitiesAmenitiesLuxuries">
                                    @csrf
                                    <div class="row">
                                        <!-- Block 1: Hostel Features -->
                                        <div class="col-md-3 border p-3">
                                            <h4>Select Hostel Features</h4>
                                            <!-- Hostel Features -->
                                            <div class="form-group">
                                                @if(count($features)>0)
                                                    @foreach($features as $feature)
                                                        <label for="feature{{ $feature->id }}">
                                                            <input type="checkbox" id="feature{{ $feature->id }}" name="features[]" value="{{ $feature->id }}"> {{ $feature->name }}
                                                        </label>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-info">No Features Exist</div>
                                                @endif
                                            </div>
                                        </div>
                                
                                        <!-- Block 2: Hostel Facilities -->
                                        <div class="col-md-3 border p-3">
                                            <h4>Select Hostel Facilities</h4>
                                            <!-- Hostel Facilities -->
                                            <div class="form-group">
                                                @if(count($facilities)>0)
                                                    @foreach($facilities as $facilitiy)
                                                        <label for="facilitiy{{ $facilitiy->id }}">
                                                            <input type="checkbox" id="facilitiy{{ $facilitiy->id }}" name="facilities[]" value="{{ $facilitiy->id }}"> {{ $facilitiy->name }}
                                                        </label>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-info">No Facilities Exist</div>
                                                @endif
                                            </div>
                                        </div>
                                
                                        <!-- Block 3: Hostel Amenities -->
                                        <div class="col-md-3 border p-3">
                                            <h4>Select Hostel Amenities</h4>
                                            <!-- Hostel Amenities -->
                                            <div class="form-group">
                                                @if(count($amenities)>0)
                                                    @foreach($amenities as $amenity)
                                                        <label for="amenity{{ $amenity->id }}">
                                                            <input type="checkbox" id="amenity{{ $amenity->id }}" name="amenities[]" value="{{ $amenity->id }}"> {{ $amenity->name }}
                                                        </label>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-info">No Amenities Exist</div>
                                                @endif
                                            </div>
                                        </div>
                                
                                        <!-- Block 4: Hostel Luxuries -->
                                        <div class="col-md-3 border p-3">
                                            <h4>Select Hostel Luxuries</h4>
                                            <!-- Hostel Luxuries -->
                                            <div class="form-group">
                                                @if(count($luxuries)>0)
                                                    @foreach($luxuries as $luxury)
                                                        <label for="luxury{{ $luxury->id }}">
                                                            <input type="checkbox" id="luxury{{ $luxury->id }}" name="luxuries[]" value="{{ $luxury->id }}"> {{ $luxury->name }}
                                                        </label>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-info">No Luxuries Exist</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-info" >Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(7)">Previous</button>
                                        <button type="submit" class="btn btn-primary" id="btnSaveHostelAllFroms">Save Hostel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Add Hostel -->

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> Use this layout to set menu (navigation) default collapsed. Please check the&nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-collapsed-menu.html" target="_blank">Layout collapsed menu documentation</a>&nbsp; for more details.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content   -->

@endsection

@section('scripts')
    <script>
        function nextStep(step) {
            document.getElementById('step' + (step - 1)).style.display = 'none';
            document.getElementById('step' + step).style.display = 'block';
        }

        function prevStep(step) {
            document.getElementById('step' + step).style.display = 'none';
            document.getElementById('step' + (step - 1)).style.display = 'block';
        }

        // Format the URL
        function isValidUrl(url) {
            // Regular expression for a simple URL validation
            // It checks if the URL starts with http://, https://, or www.
            const urlRegex = /^(http:\/\/www\.|https:\/\/www\.|www\.){1}([0-9A-Za-z]+\.)+[A-Za-z]{2,3}(\/[0-9A-Za-z]+\/?)*(\/?[^\s]*)?$/;
            return urlRegex.test(url);
        }
    </script>

    <!--    Begin:  To Validate Mobile Number   -->
        <script>
            function validateMobileNumber(input) {
                // Remove any non-digit characters
                let sanitizedValue = input.value.replace(/\D/g, '');
            
                // Ensure the first digit is 3
                if (sanitizedValue.length > 0 && sanitizedValue[0] !== '3') {
                    // If the first digit is not 3, remove it
                    sanitizedValue = sanitizedValue.slice(1);
                }
            
                // Update the input value with the sanitized value
                input.value = sanitizedValue;
            }
        </script>
    <!--    End:  To Validate Mobile Number   -->

    <!--  Start of the Script to Verify that Transaction id is uniqe or not -->
    <script>
        $(document).ready(function(){
            $('#transactionNumber').focusout(function(){
                let transactionNumber = $('#transactionNumber').val();
                $("#transactionNumberAlertDanger").remove();
                if(transactionNumber.length>0){
                    $.ajax({
                        url:'/checkTransaction_no/'+transactionNumber,
                        type:"GET",
                        success:function(response){
                            if(response==1){    // 1 means true transsction id exist
                                $("#transactionNumber").after('<div class="alert alert-danger" id="transactionNumberAlertDanger">Transaction Id is already used. Kindly use the new and unique transaction id</div>');
                                $('#transactionNumber').focus();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        },
                    });
                }
            });
        });
    </script>
    <!--  End of the Script to Verify that Transaction id is uniqe or not -->

    <!--    Begin:  Script to Validate Hostel Mess: Availability    -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#hostelMess").change(function(){
                $("#alertHostelMessAvailability").remove();
                let checkHostelMessAvail = $("#hostelMess").val();
                if(checkHostelMessAvail.trim() === '' || checkHostelMessAvail=== null || (checkHostelMessAvail !== 'available' && checkHostelMessAvail !== 'unavailable') ){
                    // Focus on the element causing the error
                    $("#hostelMess").focus();
                    // Select the first option using prop
                    $("#hostelMess").prop('selectedIndex', 0);
                    $("#hostelMess").after('<div class="alert alert-danger" id="alertHostelMessAvailability">Hostel Messs Availability Should be Provided.</div>');
                    $("#divHostelMessType").hide();
                    $("#hostelMessType").prop('selectedIndex', 0);
                    return;
                }
                else{
                    if(checkHostelMessAvail=='available'){
                        $("#divHostelMessType").show();
                        $("#hostelMessType").prop('selectedIndex', 0);
                    }
                    else{
                        $("#divHostelMessType").hide();
                        $("#hostelMessType").prop('selectedIndex', 0);
                    }
                }
            });
        });
    </script>
    <!--    End:  Script to Validate Hostel Mess: Availability    -->

    <!-- Begin: Script to Validate the Open and Close Timing of Hostels -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#hostelOpenTiming').change(function () {
                let openTiming = $('#hostelOpenTiming').val();
                let closeTiming = $('#hostelCloseTiming').val();
                $("#alertTimingOpenClose").remove();
                // Check if timings are empty
                if (openTiming.trim() === '' ) {
                    $("#hostelOpenTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Open Timings are required.</div>');
                    $("#hostelOpenTiming").focus();
                } 
                else if (closeTiming.trim() === '') {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Close Timings are required.</div>');
                    $("#hostelCloseTiming").focus();
                } 
                else if (openTiming === closeTiming) {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Close timing should be different from open timing.</div>');
                    $("#hostelCloseTiming").focus();
                    $('#hostelCloseTiming').val(''); // Clear the close timing input
                } 
                else if (closeTiming < openTiming) {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Close timing should be after open timing.</div>');
                    $("#hostelCloseTiming").focus();
                    $('#hostelCloseTiming').val(''); // Clear the close timing input
                }
            });
            
            $('#hostelCloseTiming').change(function () {
                let openTiming = $('#hostelOpenTiming').val();
                let closeTiming = $('#hostelCloseTiming').val();
                $("#alertTimingOpenClose").remove();
                // Check if timings are empty
                if (openTiming.trim() === '' ) {
                    $("#hostelOpenTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Open Timings are required.</div>');
                    $("#hostelOpenTiming").focus();
                } 
                else if (closeTiming.trim() === '') {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Close Timings are required.</div>');
                    $("#hostelCloseTiming").focus();
                } 
                else if (openTiming === closeTiming) {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Close timing should be different from open timing.</div>');
                    $("#hostelCloseTiming").focus();
                    $('#hostelCloseTiming').val(''); // Clear the close timing input
                } 
                else if (closeTiming < openTiming) {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger" id="alertTimingOpenClose">Hostel Close timing should be after open timing.</div>');
                    $("#hostelCloseTiming").focus();
                    $('#hostelCloseTiming').val(''); // Clear the close timing input
                }
            });
        });

    </script>
    <!-- End: Script to Validate the Open and Close Timing of Hostels -->

    <!-- Begin: Script for CNIC formatting -->
        <script>
            $(document).ready(function() {
                // Begin:   Toggle password visibility of partner
                    $("#showPasswordPartner").click(function() {
                        var partnerPasswordInput = $("#partnerPassword");
                        var partnerConfirmPasswordInput = $("#partnerConfirmPassword");
                        partnerPasswordInput.attr("type", partnerPasswordInput.attr("type") === "password" ? "text" : "password");
                        partnerConfirmPasswordInput.attr("type", partnerConfirmPasswordInput.attr("type") === "password" ? "text" : "password");
                    });
                // End:   Toggle password visibility of partner
                
                // Begin:   Toggle password visibility of warden
                    $("#showPasswordWarden").click(function() {
                        var wardenPasswordInput = $("#wardenPassword");
                        var wardenConfirmPasswordInput = $("#wardenConfirmPassword");
                        wardenPasswordInput.attr("type", wardenPasswordInput.attr("type") === "password" ? "text" : "password");
                        wardenConfirmPasswordInput.attr("type", wardenConfirmPasswordInput.attr("type") === "password" ? "text" : "password");
                    });
                // End:   Toggle password visibility of warner

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

                // Format Hostel Partner CNIC Check on input
                $('#partnerCnicCheck').on('input', function() {
                    formatField($(this));
                });
                
                // Format Hostel Wanrden CNIC Check on input
                $('#wardenCnicCheck').on('input', function() {
                    formatField($(this));
                });
                
                // Format Refferal CNIC Check on input
                $('#refferalCnic').on('input', function() {
                    formatField($(this));
                });

            });
        </script>
    <!-- Begin: Script for CNIC formatting -->

    <!-- /////////////// -->
    <!-- Start of script tag of get states from country id -->
        <script>
            $(document).ready(function(){
                $('#hostelCountryId').change(function(){
                    $('#hostelStatesId').empty();
                    $('#hostelStatesId').append('<option value="null" selected disabled>Select State</option>');
                    $('#hostelCityId').empty();
                    $('#hostelCityId').append('<option value="" disabled selected>Select City</option>');
                    var hostelCountryId = $(this).val();
                    if(hostelCountryId == "null"){  // Check if the selected value is "Select Country"
                        alert("No country selected!");
                        return;  // Exit the function early
                    }
                    $.ajax({
                        url: '/get-states/' + hostelCountryId,
                        type: 'GET',
                        success: function(response) {
                            // Populate the state dropdown with the fetched data
                            if(response.length === 0 || response === null){
                                $('#hostelStatesId').append('<option value="" disabled>No States Found</option>');
                            }else{
                                $.each(response, function(key, value) {
                                    $('#hostelStatesId').append('<option value="' + value.id + '">' + value.name + '</option>');
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
    <!-- End of script tag of get states from country id -->

    <!-- Start of script tag of get cities from state id -->
        <script>
            $(document).ready(function(){
                $('#hostelStatesId').change(function(){
                    $('#hostelCityId').empty();
                    $('#hostelCityId').append('<option value="" disabled selected>Select City</option>');
                    var hostelStatesId = $(this).val();
                    if(hostelStatesId == "null"){  // Check if the selected value is "Select Country"
                    alert("No state selected!");
                        return false;  // Exit the function early
                    }
                    // Your existing code for the selected country
                    // alert(country_id);
                    $.ajax({
                        url: '/get-cities/' + hostelStatesId,
                        type: 'GET',
                        success: function(response) {
                            // Populate the state dropdown with the fetched data
                            if(response.length === 0 || response === null){
                                $('#hostelCityId').append('<option value="" disabled>No City Found</option>');
                            }else{
                                $.each(response, function(key, value) {
                                    $('#hostelCityId').append('<option value="' + value.id + '">' + value.name + '</option>');
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
    <!-- End of script tag of get cities from state id -->

    <!-- Start of script to verify the Name of the Hostel -->
        <script>
            $(document).ready(function(){
                $('#hostelName').focusout(function(){
                    let hostelName = $('#hostelName').val();
                    $("#divHostelName").remove();
                    if(hostelName.length>3){
                        $.ajax({
                            url:'/hostelRegistration/hostelName/' + hostelName,
                            type:'GET',
                            success:function(response){
                                if(response==1){
                                    $("#hostelName").after('<div class="alert alert-danger" id="divHostelName">Hostel Name Already Exist. Kindly Provide the unique Hostel Name.</div>');
                                    $("#hostelName").focus();
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });
        </script>
    <!-- End of script to verify the Name of the Hostel -->
    
    <!-- Start of script to verify the refferalCnic -->
        <script>
            $(document).ready(function(){
                $('#refferalCnic').focusout(function(){
                    let refferalCnic = $('#refferalCnic').val();
                    $("#refferalCnicAlertDanger").remove();
                    if(refferalCnic.length == 15){
                        $.ajax({
                            url:'/checkCNIC/' + refferalCnic,
                            type:'GET',
                            success:function(response){
                                if(response==0){
                                    $("#refferalCnic").after('<div class="alert alert-danger" id="refferalCnicAlertDanger">Refferal Cnic does not exist in our record. kindly provide the valid cnic.</div>');
                                    $("#refferalCnic").focus();
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    } else if(refferalCnic.length==0){
                        return;
                    }
                    else{
                        $("#refferalCnic").after('<div class="alert alert-danger" id="refferalCnicAlertDanger">Refferal Cnic should be provided completely.</div>');
                        $("#refferalCnic").focus();
                    }
                });
            });
        </script>
    <!-- End of script to verify the refferalCnic -->


    <!--  Start of Script to check that given email is unique or not -->
        <script>
            function isValidEmail(email) {
                // Regular expression for a simple email validation
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            function checkEmail(inputFieldId) {
                let email = $(inputFieldId).val();
                if(email.length!=0){
                    if (isValidEmail(email)) {
                        $.ajax({
                            url: '/checkEmail/' + email,
                            type: 'GET',
                            success: function(response){
                                if (response == 1) {
                                    $(inputFieldId).after('<div class="alert alert-danger">'+email+': Email already exists. Kindly use the unique email.</div>');
                                    // alert(email+": Email already exists");
                                    $(inputFieldId).val('');
                                    $(inputFieldId).focus();
                                    return false;
                                }
                                else{
                                    return true;
                                }
                            }
                        });
                    }
                    else {
                        $(inputFieldId).after('<div class="alert alert-danger">Kindly provide the email in the correct format</div>');
                        $(inputFieldId).focus();
                        return false;
                    }
                }
            }
            $(document).ready(function(){
                $('#partnerEmail').focusout(function(){
                    $(".alert-danger").remove();
                    checkEmail('#partnerEmail');
                });
                $('#wardenEmail').focusout(function(){
                    $(".alert-danger").remove();
                    checkEmail('#wardenEmail');
                });
            });
        </script>
    <!--  End of Script to check that given email is unique or not -->

    <!--    Begin: To Verify the Selected Hostel Images -->
    <script>
        $(document).ready(function() {
            $('#hostelImages').change(function() {
                // Get the selected files
                let files = $("#hostelImages")[0].files;
        
                // Reset validation message
                $('.alertDivImages').remove('');
        
                // Check if files are selected
                if (files.length > 0) {
                    // Check file size and type for each selected file
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];
                        
                        // Check file size (2 MB limit)
                        if (file.size > 2 * 1024 * 1024) {
                            $('#divImages').after('<div class="alert alert-danger alertDivImages">Image size should not exceed 2 MB.</div>');
                            $(this).val('');  // Clear the file input to prevent submitting oversized files
                            return;
                        }
        
                        // Check file type (allow only images)
                        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                        if (!allowedExtensions.exec(file.name)) {
                            $('#divImages').after('<div class="alert alert-danger alertDivImages">Invalid file type. Please select only JPG, JPEG, or PNG images.</div>');
                            $(this).val('');  // Clear the file input to prevent submitting non-image files
                            return;
                        }
                    }
                } else {
                    // No files selected
                    $('#divImages').after('<div class="alert alert-danger alertDivImages">Please select at least one image.</div>');
                }
            });
        });
    </script>
    <!--    End: To Verify the Selected Hostel Images -->
    
    <!-- Start of script to verify the cnic of the partner -->
        <script>
            $(document).ready(function(){
                // $('#btnSubmitChkCnic').click(function(e){
                // $('#partnerCnicCheck').focusout(function(e){
                $('#partnerCnicCheck').on('keyup', function(e){
                    e.preventDefault();
                    let partnerCnicCheck = $('#partnerCnicCheck').val();
                    $("#divAlertPartnerCnicCheck").remove();
                    $("#PartnerRegisterAlert").remove();
                    $("#divEnterPartnerDetails").hide();
                    $("#partnerFirstName").val('');
                    $("#partnerLastName").val('');
                    $("#partnerEmail").val('');
                    $("#partnerMobileNumber").val('');
                    $("#partnerAuthorId").val('');
                    // $("#formNewPartnerDetails").hide();
                    // $("#formNewPartnerDetails")[0].reset();
                    if(partnerCnicCheck.length!=0){
                        if(partnerCnicCheck.length == 15){
                            $.ajax({
                                type:'GET',
                                url:'/checkCnicWithData/' + partnerCnicCheck,
                                success:function(response){
                                    $("#divEnterPartnerDetails").show();
                                    if(response==0){
                                        $("#partnerCnicCheck").after('<div class="alert alert-info" id="divAlertPartnerCnicCheck">Partner CNIC does not exist in our record. Kindly Provide the Details to Rgister Your Partner.</div>');
                                        $("#partnerCnic").val(partnerCnicCheck).prop('readonly', true);
                                        $("#partnerAuthorId").val('').prop('readonly', true);
                                        $("#partnerFirstName").prop('readonly', false);
                                        $("#partnerLastName").prop('readonly', false);
                                        $("#partnerEmail").prop('readonly', false);
                                        $("#partnerMobileNumber").prop('readonly', false);
                                        return;
                                    }
                                    else{
                                        $("#partnerCnicCheck").after('<div class="alert alert-success" id="divAlertPartnerCnicCheck">Partner CNIC exist in our record.</div>');
                                        $("#partnerAuthorId").val(response.id).prop('readonly', true);
                                        $("#partnerFirstName").val(response.firstname).prop('readonly', true);
                                        $("#partnerLastName").val(response.lastname).prop('readonly', true);
                                        $("#partnerEmail").val(response.email).prop('readonly', true);
                                        // Extracting phone number and skipping first two characters
                                        let phoneNumber = response.phone_number || '';
                                        phoneNumber = phoneNumber.length > 2 ? phoneNumber.slice(3) : '';
                                        $("#partnerMobileNumber").val(phoneNumber).prop('readonly', true);
                                        return;
                                    }
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        }
                        else{
                            $("#partnerCnicCheck").after('<div class="alert alert-danger" id="divAlertPartnerCnicCheck">Partner CNIC length should be provided correctly.</div>');
                            $("#partnerCnicCheck").focus();
                            return false;
                        }
                    }
                    else{
                        return false;
                    }
                });
            });
        </script>
    <!-- End of script to verify the cnic of the partner -->
    
    <!-- Start of script to verify the cnic of the warden -->
        <script>
            $(document).ready(function(){
                // $('#btnSubmitChkCnicWarden').click(function(e){
                $('#wardenCnicCheck').on('keyup',function(e){
                    e.preventDefault();
                    let wardenCnicCheck = $('#wardenCnicCheck').val();
                    $("#divAlertWardenCnicCheck").remove();
                    $("#WardenRegisterAlert").remove();
                    $("#divEnterWardenDetails").hide();
                    $("#wardenAuthorId").val('')
                    $("#wardenFirstName").val('');
                    $("#wardenLastName").val('');
                    $("#wardenEmail").val('');
                    $("#wardenMobileNumber").val('');
                    // $("#formNewWardenDetails")[0].reset();
                    if(wardenCnicCheck.length!=0){
                        if(wardenCnicCheck.length == 15){
                            $.ajax({
                                type:'GET',
                                // url:'/checkCNIC/' + wardenCnicCheck,
                                url:'/checkCnicWithData/' + wardenCnicCheck,
                                success:function(response){
                                    if(response==0){
                                        $("#wardenCnicCheck").after('<div class="alert alert-info" id="divAlertWardenCnicCheck">Warden CNIC does not exist in our record. Kindly Provide the Details to Rgister Your Partner.</div>');
                                        $("#wardenAuthorId").val('').prop('readonly', true);
                                        $("#wardenFirstName").prop('readonly', false);
                                        $("#wardenLastName").prop('readonly', false);
                                        $("#wardenEmail").prop('readonly', false);
                                        $("#wardenMobileNumber").prop('readonly', false);
                                    }
                                    else{
                                        $("#wardenCnicCheck").after('<div class="alert alert-success" id="divAlertWardenCnicCheck">Warden CNIC exist in our record. Kindly Go to Next Form</div>');
                                        $("#wardenAuthorId").val(response.id).prop('readonly', true);
                                        $("#wardenFirstName").val(response.firstname).prop('readonly', true);
                                        $("#wardenLastName").val(response.lastname).prop('readonly', true);
                                        $("#wardenEmail").val(response.email).prop('readonly', true);
                                        // Extracting phone number and skipping first three characters
                                        let phoneNumber = response.phone_number || '';
                                        phoneNumber = phoneNumber.length > 2 ? phoneNumber.slice(3) : '';
                                        $("#wardenMobileNumber").val(phoneNumber).prop('readonly', true);
                                    }
                                    $("#divEnterWardenDetails").show();
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        }
                        else{
                            $("#wardenCnicCheck").after('<div class="alert alert-danger" id="divAlertWardenCnicCheck">Partner CNIC length should be provided correctly.</div>');
                            $("#wardenCnicCheck").focus();
                            return false;
                        }
                    }
                    else{
                        return false;
                    }
                });
            });
        </script>
    <!-- End of script to verify the cnic of the warden -->

    <!--    Begin:  Script to Show the Partner / Warden Cnic check button and deal with the new suer register form-->
        <script>
            $(document).ready(function() {
                // Partner
                $("input[name='partnerCnicRadio']").change(function() {
                    var selectedValue = $(this).val();
                    $("#partnerCnicCheck").val('');
                    $("#divAlertPartnerCnicCheck").remove();
                    $("#PartnerRegisterAlert").remove();
                    $("#divEnterPartnerDetails").hide();
                    $("#partnerAuthorId").val('');
                    $("#partnerFirstName").val('');
                    $("#partnerLastName").val('');
                    $("#partnerEmail").val('');
                    $("#partnerMobileNumber").val('');
                    if(selectedValue == "Yes"){
                        $("#divPartnerCnicCheck").show();
                    }
                    else if(selectedValue == "No"){
                        $("#divPartnerCnicCheck").hide();
                    }
                    else{
                        return false;
                    }
                });
                
                // Warden
                $("input[name='wardenCnicRadio']").change(function() {
                    var selectedValue = $(this).val();
                    $("#wardenCnicCheck").val('');
                    $("#divAlertWardenCnicCheck").remove();
                    $("#WardenRegisterAlert").remove();
                    $("#divEnterWardenDetails").hide();
                    $("#wardenAuthorId").val('')
                    $("#wardenFirstName").val('');
                    $("#wardenLastName").val('');
                    $("#wardenEmail").val('');
                    $("#wardenMobileNumber").val('');
                    if(selectedValue == "Yes"){
                        $("#divWardenCnicCheck").show();
                    }
                    else if(selectedValue == "No"){
                        $("#divWardenCnicCheck").hide();
                    }
                    else{
                        return false;
                    }
                });
            });
        </script>
    <!--    End:  Script to Show the Partner / Warden Cnic check button and deal with the new suer register form-->

    <!-- Begin: Script to Verfiy the Unique Mobile Number   -->
        <script type="text/javascript">
            // phone number validation function
            function validatePhoneNumberLengthType(phoneNumber) {
                // Check if the phone number starts with 3, consists of digits only, and has a length of 10
                return /^[3]\d{9}$/.test(phoneNumber) && phoneNumber.length == 10;
            }
            $(document).ready(function(){
                // Begin:   To Verify the Partner Mobile Number
                $('#partnerMobileNumber').focusout(function(){
                    let partnerMobileNumber = $('#partnerMobileNumber').val();
                    $("#divAlertPartnerMobNo").remove();
                    if(partnerMobileNumber.length!=0){
                        if(partnerMobileNumber.length == 10 && validatePhoneNumberLengthType(partnerMobileNumber)){
                            $.ajax({
                                type:'GET',
                                url:'/check-phone_number/' + partnerMobileNumber,
                                success:function(response){
                                    if(response==1){
                                        $("#partnerMobileNumberDiv").after('<div class="alert alert-danger" id="divAlertPartnerMobNo">Phone Number Should be Unique.</div>');
                                        $("#partnerMobileNumber").val('');
                                        $("#partnerMobileNumber").focus('');
                                        return true;
                                    }
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        }
                        else{
                            $("#partnerMobileNumberDiv").after('<div class="alert alert-danger" id="divAlertPartnerMobNo">Valid Phone Number Should be Provided.</div>');
                            $("#partnerMobileNumber").focus();
                            return false;
                        }
                    }
                    else{
                        return false;
                    }
                });
                
                // Begin:   To Verify the Warden Mobile Number
                $('#wardenMobileNumber').focusout(function(){
                    let wardenMobileNumber = $('#wardenMobileNumber').val();
                    $("#divAlertWardenMobNo").remove();
                    if(wardenMobileNumber.length!=0){
                        if(wardenMobileNumber.length == 10 && validatePhoneNumberLengthType(wardenMobileNumber)){
                            $.ajax({
                                type:'GET',
                                url:'/check-phone_number/' + wardenMobileNumber,
                                success:function(response){
                                    if(response==1){
                                        $("#divWardenMobileNumber").after('<div class="alert alert-danger" id="divAlertWardenMobNo">Phone Number Should be Unique.</div>');
                                        $("#wardenMobileNumber").val('');
                                        $("#wardenMobileNumber").focus('');
                                        return true;
                                    }
                                },
                                error: function(error) {
                                    console.log(error);
                                }
                            });
                        }
                        else{
                            $("#divWardenMobileNumber").after('<div class="alert alert-danger" id="divAlertWardenMobNo">Valid Phone Number Should be Provided.</div>');
                            $("#wardenMobileNumber").focus();
                            return false;
                        }
                    }
                    else{
                        return false;
                    }
                });
            });
            
        </script>
    <!-- End: Script to Verfiy the Unique Mobile Number   -->

    <!-- Start of the script to Validate the form (formAddHostel)-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnAddHostel").click(function(e){
                e.preventDefault();
                $(".addHostelAlert").remove();

                // To check the Hostel Name is empty or not
                let hostelName = $("#hostelName").val();
                if(hostelName.trim() === '' || hostelName == null ||hostelName.length == 0 || hostelName.length < 3 || hostelName.length > 255){
                    $("#hostelName").after('<div class="alert alert-danger addHostelAlert">Hostel Name & Unique Hostel Name Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Description is empty or not
                let hostelDescription = $("#hostelDescription").val();
                if(hostelDescription.trim() === '' || hostelDescription == null ||  hostelDescription.length < 5 || hostelDescription.length > 400){
                    $("#hostelDescription").after('<div class="alert alert-danger addHostelAlert">Hostel Description Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Country is empty or not
                let hostelCountryId = $("#hostelCountryId").val();
                if(hostelCountryId === null || hostelCountryId.trim() === '' ){
                    $("#hostelCountryId").after('<div class="alert alert-danger addHostelAlert">Hostel Country Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel State is empty or not
                let hostelStatesId = $("#hostelStatesId").val();
                if(hostelStatesId === null || hostelStatesId.trim() === ''){
                    $("#hostelStatesId").after('<div class="alert alert-danger addHostelAlert">Hostel State Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel City is empty or not
                let hostelCityId = $("#hostelCityId").val();
                if(hostelCityId === null || hostelCityId.trim() === '' ){
                    $("#hostelCityId").after('<div class="alert alert-danger addHostelAlert">Hostel City Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Total Number of Rooms is empty or not
                let hostelTotalRooms = $("#hostelTotalRooms").val();
                if(hostelTotalRooms.trim() === ''|| isNaN(hostelTotalRooms) || parseInt(hostelTotalRooms) < 0){
                    $("#hostelTotalRooms").after('<div class="alert alert-danger addHostelAlert">Hostel Total Number of Rooms Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Total Number of Bath Rooms is empty or not
                let hostelBathRooms = $("#hostelBathRooms").val();
                if(hostelBathRooms.trim() === '' ||isNaN(hostelBathRooms) || parseInt(hostelBathRooms) < 0){
                    $("#hostelBathRooms").after('<div class="alert alert-danger addHostelAlert">Hostel Total Number of Bath Rooms Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Address is empty or not
                let hostelAddress = $("#hostelAddress").val();
                if(hostelAddress.trim() === '' || hostelAddress == null ||  hostelAddress.length < 5 || hostelAddress.length > 400){
                    $("#hostelAddress").after('<div class="alert alert-danger addHostelAlert">Hostel Address Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Nearest Landmark is empty or not
                let hostelNearestLandmark = $("#hostelNearestLandmark").val();
                if(hostelNearestLandmark === null || hostelNearestLandmark.trim() === '' ||  hostelNearestLandmark.length < 5 || hostelNearestLandmark.length > 400){
                    $("#hostelNearestLandmark").after('<div class="alert alert-danger addHostelAlert">Hostel Nearest Landmark Should be Provided</div>');
                    e.preventDefault();
                }

                // To check the Hostel Total Number of Floors is empty or not
                let hostelTotalFloors = $("#hostelTotalFloors").val();
                if(hostelTotalFloors.trim() === ''|| isNaN(hostelTotalFloors) || parseInt(hostelTotalFloors) < 0){
                    $("#hostelTotalFloors").after('<div class="alert alert-danger addHostelAlert">Hostel Total Number of Floors Should be Provided</div>');
                    e.preventDefault();
                }

                // To check the Hostel Categories is empty or not
                let hostelCategoryId = $("#hostelCategoryId").val();
                if(hostelCategoryId === null || hostelCategoryId.trim() === '' ){
                    $("#hostelCategoryId").after('<div class="alert alert-danger addHostelAlert">Hostel Categories Should be Provided</div>');
                    e.preventDefault();
                }

                // To Check the Hostel Images
                let files = $("#hostelImages")[0].files;
                // Reset validation message
                $('.alertDivImages').remove('');
                // Check if files are selected
                if (files.length > 0) {
                    // Check file size and type for each selected file
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];
                        
                        // Check file size (2 MB limit)
                        if (file.size > 2 * 1024 * 1024) {
                            $('#divImages').after('<div class="alert alert-danger alertDivImages">Image size should not exceed 2 MB.</div>');
                            $(this).val('');  // Clear the file input to prevent submitting oversized files
                            return;
                        }
        
                        // Check file type (allow only images)
                        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                        if (!allowedExtensions.exec(file.name)) {
                            $('#divImages').after('<div class="alert alert-danger alertDivImages">Invalid file type. Please select only JPG, JPEG, or PNG images.</div>');
                            $(this).val('');  // Clear the file input to prevent submitting non-image files
                            return;
                        }
                    }
                } else {
                    // No files selected
                    $('#divImages').after('<div class="alert alert-danger alertDivImages">Please select at least one image.</div>');
                }
                

                // If there are no validation errors, proceed with next form request
                if ($(".addHostelAlert").length === 0 && $(".alertDivImages").length === 0) {
                    nextStep(2);
                }


            });
        });
    </script>
    <!-- End of the script to Validate the form (formAddHostel)-->
    
    <!-- Start of the script to Validate the form (formHostelDetails)-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnHostelDetails").click(function(e){
                e.preventDefault();
                $(".addHostelDetailsAlert").remove();

                // To check the Hostel Slogan is empty or not
                let hostelSlogan = $("#hostelSlogan").val();
                if(hostelSlogan.trim() === '' || hostelSlogan == null ||hostelSlogan.length == 0 || hostelSlogan.length < 3 || hostelSlogan.length > 255){
                    $("#hostelSlogan").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Slogan Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Gender is empty or not
                let hostelGender = $("#hostelGender").val();
                if(hostelGender === null || hostelGender.trim() === '' || (hostelGender !== 'male' && hostelGender !== 'female')){
                    $("#hostelGender").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Gender Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Stay Type is empty or not
                let hostelStayType = $("#hostelStayType").val();
                if(hostelStayType === null || hostelStayType.trim() === '' || (hostelStayType !== 'short_stay' && hostelStayType !== 'long_stay')){
                    $("#hostelStayType").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Stay Type Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Guest Stay Allow is empty or not
                let hostelGuestStayAllow = $("#hostelGuestStayAllow").val();
                if(hostelGuestStayAllow === null || hostelGuestStayAllow.trim() === '' || (hostelGuestStayAllow !== 'Yes' && hostelGuestStayAllow !== 'No')){
                    $("#hostelGuestStayAllow").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Guest Stay Allow Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Rent Pay Schedule is empty or not
                let hostelRentPaySchedule = $("#hostelRentPaySchedule").val();
                if(hostelRentPaySchedule === null || hostelRentPaySchedule.trim() === '' || (hostelRentPaySchedule !== 'Daily' && hostelRentPaySchedule !== 'Weekly' && hostelRentPaySchedule !== 'Monthly' && hostelRentPaySchedule !== 'Quarterly' && hostelRentPaySchedule !== 'Yearly')){
                    $("#hostelRentPaySchedule").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Rent Pay Schedule Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Type is empty or not
                let hostelTypeId = $("#hostelTypeId").val();
                if(hostelTypeId === null || hostelTypeId.trim() === ''){
                    $("#hostelTypeId").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Type Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Average Rent Per Seat (Monthly) is empty or not
                let hostelAvgRentPerMonth = $("#hostelAvgRentPerMonth").val();
                if(hostelAvgRentPerMonth.trim() === ''|| isNaN(hostelAvgRentPerMonth) || parseInt(hostelAvgRentPerMonth) < 10000){
                    $("#hostelAvgRentPerMonth").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Average Rent Per Seat (Monthly) Should be Provided. And Rent Should not be less than 10,000/Rs.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Room Occupancy is empty or not
                let hostelRoomOccupancy = $("#hostelRoomOccupancy").val();
                if(hostelRoomOccupancy.trim() === '' ||isNaN(hostelRoomOccupancy) || parseInt(hostelRoomOccupancy) < 0){
                    $("#hostelRoomOccupancy").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Room Occupancy Should be Provided.</div>');
                    e.preventDefault();
                }
 
                // To check the Hostel Contact Number is empty or not
                let hostelContactNumber = $("#hostelContactNumber").val();
                if(hostelContactNumber.trim() === '' || hostelContactNumber == null ||  hostelContactNumber.length != 10){
                    $("#divHostelContactNumber").after('<div class="alert alert-danger addHostelDetailsAlert">Valid Hostel Contact Number Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Open And Close Timing is empty or not
                let openTiming = $('#hostelOpenTiming').val();
                let closeTiming = $('#hostelCloseTiming').val();
                $(".alertTimingOpenClose").remove();
                // Check if timings are empty
                if (openTiming.trim() === '' ) {
                    $("#hostelOpenTiming").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Open Timings are required.</div>');
                    e.preventDefault();
                } 
                

                if (closeTiming.trim() === '') {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Close Timings are required.</div>');
                    e.preventDefault();
                } 
                else if (openTiming === closeTiming) {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Close timing should be different from open timing.</div>');
                    e.preventDefault();
                } 
                else if (closeTiming < openTiming) {
                    $("#hostelCloseTiming").after('<div class="alert alert-danger addHostelDetailsAlert">Hostel Close timing should be after open timing.</div>');
                    e.preventDefault();
                }
            
                // To check the Hostel Youtube Link is given if it is given then it should be valid url
                let hostelYoutubeLink = $("#hostelYoutubeLink").val();
                // Check if the input is not empty
                if (hostelYoutubeLink.trim() !== '' || hostelYoutubeLink.length > 1) {
                    // Validate the URL using a regular expression
                    if (!isValidUrl(hostelYoutubeLink)) {
                        $("#hostelYoutubeLink").after('<div class="alert alert-danger addHostelDetailsAlert">Valid Hostel Youtube Link Should be Provided.</div>');
                        e.preventDefault();
                    }
                }
                
                // To check the Hostel Facebook Link is given if it is given then it should be valid url
                let hostelFacebookLink = $("#hostelFacebookLink").val();
                // Check if the input is not empty
                if (hostelFacebookLink.trim() !== '' || hostelFacebookLink.length > 1) {
                    // Validate the URL using a regular expression
                    if (!isValidUrl(hostelFacebookLink)) {
                        $("#hostelFacebookLink").after('<div class="alert alert-danger addHostelDetailsAlert">Valid Hostel Facebook Link Should be Provided.</div>');
                        e.preventDefault();
                    }
                }

                // To check the Hostel Youtube Link is given if it is given then it should be valid url
                let hostelInstagramLink = $("#hostelInstagramLink").val();
                // Check if the input is not empty
                if (hostelInstagramLink.trim() !== '' || hostelInstagramLink.length > 1) {
                    // Validate the URL using a regular expression
                    if (!isValidUrl(hostelInstagramLink)) {
                        $("#hostelInstagramLink").after('<div class="alert alert-danger addHostelDetailsAlert">Valid Hostel Instagram Link Should be Provided.</div>');
                        e.preventDefault();
                    }
                }

                // If there are no validation errors, proceed with next form request
                if ($(".addHostelDetailsAlert").length === 0) {
                    nextStep(3);
                }

            });
        });
    </script>
    <!-- End of the script to Validate the form (formHostelDetails)-->
    <!-- Start of the script to Validate the form (formHostelAddressDetails)-->
    <script type="text/javascript">
        $(document).ready(function(){
            
            $("#btnHostelAddresDetails").click(function(e){
                e.preventDefault();
                $(".addHostelAddressDetailsAlert").remove();

                // To check the Hostel Location is empty or not
                let hostelLocation = $("#hostelLocation").val();
                if(hostelLocation.trim() === '' || hostelLocation == null ||  hostelDescription.length == 0){
                    $("#hostelLocation").after('<div class="alert alert-danger addHostelAddressDetailsAlert">Hostel Location Should be Provided</div>');
                    e.preventDefault();
                }

                // To check the Hostel Zip Code is empty or not
                let hostelZipCode = $("#hostelZipCode").val();
                if(hostelZipCode.trim() === '' || hostelZipCode == null){
                    $("#hostelZipCode").after('<div class="alert alert-danger addHostelAddressDetailsAlert">Hostel Zip Code Should be Provided</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel hostelRecommendedPlace is empty or not
                let hostelRecommendedPlace = $("#hostelRecommendedPlace").val();
                if(hostelRecommendedPlace.trim() === '' || hostelRecommendedPlace == null ||  hostelRecommendedPlace.length <3 ||  hostelRecommendedPlace.length > 255 ){
                    $("#hostelRecommendedPlace").after('<div class="alert alert-danger addHostelAddressDetailsAlert">Hostel Recommended Place Should be Provided</div>');
                    e.preventDefault();
                }

                // To check the Hostel Area Name is empty or not
                let hostelAreaName = $("#hostelAreaName").val();
                if(hostelAreaName === null || hostelAreaName.trim() === ''){
                    $("#hostelAreaName").after('<div class="alert alert-danger addHostelAddressDetailsAlert">Hostel Area Name Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Plot No is empty or not
                let hostelPlotNo = $("#hostelPlotNo").val();
                if(hostelPlotNo === null || hostelPlotNo.trim() === ''){
                    $("#hostelPlotNo").after('<div class="alert alert-danger addHostelAddressDetailsAlert">Hostel Plot No Should be Provided.If Plot Number is not available then enter N/A.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Street No is empty or not
                let hostelStreetNo = $("#hostelStreetNo").val();
                if(hostelStreetNo === null || hostelStreetNo.trim() === ''){
                    $("#hostelStreetNo").after('<div class="alert alert-danger addHostelAddressDetailsAlert">Hostel Street No Should be Provided.If Street Number is not available then enter N/A.</div>');
                    e.preventDefault();
                }

                // To check the Hostel Map Location Link is given & it should be valid url
                let hostelMapLocation = $("#hostelMapLocation").val();
                // Check if the input is not empty
                if (hostelMapLocation.trim() === '' || hostelMapLocation.trim() === null) {
                    $("#hostelMapLocation").after('<div class="alert alert-danger addHostelAddressDetailsAlert">Hostel Map Location Link Should be Provided.</div>');
                    e.preventDefault();
                }

                // If there are no validation errors, proceed with next form request
                if ($(".addHostelAddressDetailsAlert").length === 0) {
                    nextStep(4);
                }


            });
        });
    </script>
    <!-- End of the script to Validate the form (formHostelAddressDetails)-->


    
    
    <!-- Start of the script to Validate the form HostelMetas-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnHostelMetas").click(function(e){
                $(".HostelMetasAlert").remove();
                e.preventDefault();

                // To check the Hostel Mess Availability is empty or not
                let hostelMess = $("#hostelMess").val();
                if(hostelMess === null || hostelMess.trim() === '' || (hostelMess !== 'available' && hostelMess !== 'unavailable')){
                    $("#hostelMess").after('<div class="alert alert-danger HostelMetasAlert">Hostel Mess Availability Should be Selected.</div>');
                    e.preventDefault();
                }
                else{
                    if(hostelMess=='available'){
                        // To check the Hostel Mess Type is empty or not
                        let hostelMessType = $("#hostelMessType").val();
                        if(hostelMessType === null || hostelMessType.trim() === '' || (hostelMessType !== 'one_time_mess' && hostelMessType !== 'two_time_mess' && hostelMessType !== 'three_time_mess' && hostelMessType !== 'buffay_time_mess')){
                            $("#hostelMessType").after('<div class="alert alert-danger HostelMetasAlert">Hostel Mess Type  Should be Selected.</div>');
                            $("#divHostelMessType").show();
                            e.preventDefault();
                        }
                    }
                }

                // To check the Hostel Utility Bills is empty or not
                let hostelUtilityBills = $("#hostelUtilityBills").val();
                if(hostelUtilityBills === null || hostelUtilityBills.trim() === '' || (hostelUtilityBills !== 'included_in_rent' && hostelUtilityBills !== 'not_included_in_rent')){
                    $("#hostelUtilityBills").after('<div class="alert alert-danger HostelMetasAlert">Hostel Utility Bills Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Security System is empty or not
                let hostelSecuritySystem = $("#hostelSecuritySystem").val();
                if(hostelSecuritySystem === null || hostelSecuritySystem.trim() === '' || (hostelSecuritySystem !== 'cctv' && hostelSecuritySystem !== 'bio_metric' && hostelSecuritySystem !== 'face_recognizer')){
                    $("#hostelSecuritySystem").after('<div class="alert alert-danger HostelMetasAlert">Hostel Security System Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Security Guard is empty or not
                let hostelSecurityGuard = $("#hostelSecurityGuard").val();
                if(hostelSecurityGuard === null || hostelSecurityGuard.trim() === '' || (hostelSecurityGuard !== '24/7' && hostelSecurityGuard !== 'day_time' && hostelSecurityGuard !== 'night_watchman')){
                    $("#hostelSecurityGuard").after('<div class="alert alert-danger HostelMetasAlert">Hostel Security Guard Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Doorman Type is empty or not
                let hostelDoormanType = $("#hostelDoormanType").val();
                if(hostelDoormanType === null || hostelDoormanType.trim() === '' || (hostelDoormanType !== 'male' && hostelDoormanType !== 'female')){
                    $("#hostelDoormanType").after('<div class="alert alert-danger HostelMetasAlert">Hostel Doorman Type Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Doorman Availability  is empty or not
                let hostelDoormanAvailability = $("#hostelDoormanAvailability").val();
                if(hostelDoormanAvailability === null || hostelDoormanAvailability.trim() === '' || (hostelDoormanAvailability !== 'day_time' && hostelDoormanAvailability !== 'IoT_Device')){
                    $("#hostelDoormanAvailability").after('<div class="alert alert-danger HostelMetasAlert">Hostel Doorman Availability Should be Selected.</div>');
                    e.preventDefault();
                } 
                
                // To check the Hostel Parking Availability  is empty or not
                let hostelParkingAvailability = $("#hostelParkingAvailability").val();
                if(hostelParkingAvailability === null || hostelParkingAvailability.trim() === '' || (hostelParkingAvailability !== 'indoor' && hostelParkingAvailability !== 'outdoor')){
                    $("#hostelParkingAvailability").after('<div class="alert alert-danger HostelMetasAlert">Hostel Parking Availability Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Made Type is empty or not
                let hostelMadeType = $("#hostelMadeType").val();
                if(hostelMadeType === null || hostelMadeType.trim() === '' || (hostelMadeType !== 'male' && hostelMadeType !== 'female')){
                    $("#hostelMadeType").after('<div class="alert alert-danger HostelMetasAlert">Hostel Made Type Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Made Availability is empty or not
                let hostelMadeAvailability = $("#hostelMadeAvailability").val();
                if(hostelMadeAvailability === null || hostelMadeAvailability.trim() === '' || (hostelMadeAvailability !== '24/7' && hostelMadeAvailability !== 'office_time')){
                    $("#hostelMadeAvailability").after('<div class="alert alert-danger HostelMetasAlert">Hostel Made Availability Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Warden Type is empty or not
                let hostelWardenType = $("#hostelWardenType").val();
                if(hostelWardenType === null || hostelWardenType.trim() === '' || (hostelWardenType !== 'male' && hostelWardenType !== 'female')){
                    $("#hostelWardenType").after('<div class="alert alert-danger HostelMetasAlert">Hostel Warden Type Should be Selected.</div>');
                    e.preventDefault();
                }

                // To check the Hostel Warden Availability is empty or not
                let hostelWardenAvailability = $("#hostelWardenAvailability").val();
                if(hostelWardenAvailability === null || hostelWardenAvailability.trim() === '' || (hostelWardenAvailability !== '24/7' && hostelWardenAvailability !== 'office_time')){
                    $("#hostelWardenAvailability").after('<div class="alert alert-danger HostelMetasAlert">Hostel Warden Availability Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Common Room Availability is empty or not
                let hostelCommonRoomAvailability = $("#hostelCommonRoomAvailability").val();
                if(hostelCommonRoomAvailability === null || hostelCommonRoomAvailability.trim() === '' || (hostelCommonRoomAvailability !== '24/7' && hostelCommonRoomAvailability !== 'n/a')){
                    $("#hostelCommonRoomAvailability").after('<div class="alert alert-danger HostelMetasAlert">Hostel Common Room Availability Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Study Room Availability is empty or not
                let hostelStudyRoomAvailability = $("#hostelStudyRoomAvailability").val();
                if(hostelStudyRoomAvailability === null || hostelStudyRoomAvailability.trim() === '' || (hostelStudyRoomAvailability !== '24/7' && hostelStudyRoomAvailability !== 'n/a')){
                    $("#hostelStudyRoomAvailability").after('<div class="alert alert-danger HostelMetasAlert">Hostel Study Room Availability Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Prayer Area is empty or not
                let hostelPrayerArea = $("#hostelPrayerArea").val();
                if(hostelPrayerArea === null || hostelPrayerArea.trim() === '' || (hostelPrayerArea !== 'yes' && hostelPrayerArea !== 'no')){
                    $("#hostelPrayerArea").after('<div class="alert alert-danger HostelMetasAlert">Hostel Prayer Area Should be Selected.</div>');
                    e.preventDefault();
                }
                
                // To check the Hostel Canteen Availability is empty or not
                let hostelCanteenAvailability = $("#hostelCanteenAvailability").val();
                if(hostelCanteenAvailability === null || hostelCanteenAvailability.trim() === '' || (hostelCanteenAvailability !== 'stand_alone' && hostelCanteenAvailability !== 'attached'&& hostelCanteenAvailability !== 'inside' && hostelCanteenAvailability !== 'outside' && hostelCanteenAvailability !== 'online' && hostelCanteenAvailability !== 'pos' && hostelCanteenAvailability !== 'n/a')){
                    $("#hostelCanteenAvailability").after('<div class="alert alert-danger HostelMetasAlert">Hostel Canteen Availability Should be Selected.</div>');
                    e.preventDefault();
                }

                // If there are no validation errors, proceed with next form request
                if ($(".HostelMetasAlert").length === 0) {
                    nextStep(5);
                }
                
                

            });
        });
    </script>
    <!-- End of the script to Validate the form HostelMetas-->


    <!-- Start of the script to Validate the form of Register New Partner-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnNextPartner").click(function(e){
                e.preventDefault();
                $(".PartnerRegisterAlert").remove();

                // To check if either radio button is checked
                let partnerCnicRadio = $("input[name='partnerCnicRadio']:checked").val();
                if (!partnerCnicRadio) {
                    $("#divPartnerRadioButton").after('<div class="alert alert-danger PartnerRegisterAlert">Kindly select whether you have a partner or not.</div>');
                    e.preventDefault();
                } else {
                    // If 'Yes' is checked, show alert for 'Yes'
                    if (partnerCnicRadio === 'Yes') {
                        let partnerCnicCheck = $("#partnerCnicCheck").val();
                        if(partnerCnicCheck.trim()===''||partnerCnicCheck === null ||partnerCnicCheck.length!=15){
                            $("#partnerCnicCheck").after('<div class="alert alert-danger PartnerRegisterAlert">Partner Cnic Should be Provided.</div>');
                            e.preventDefault();
                        }
                        else{
                            let partnerAuthorId = $("#partnerAuthorId").val();
                            if(partnerAuthorId.trim() === '' || partnerAuthorId === null || partnerAuthorId.length==0){
                                // It means that partner is new

                                // To check First Name is empty or not
                                let partnerFirstName = $("#partnerFirstName").val();
                                if(partnerFirstName.trim() === ''|| partnerFirstName === null){
                                    $("#partnerFirstName").after('<div class="alert alert-danger PartnerRegisterAlert">Partner First Name Should be Provided.</div>');
                                    e.preventDefault();
                                }

                                // To check Last Name is empty or not
                                let partnerLastName = $("#partnerLastName").val();
                                if(partnerLastName.trim() === ''|| partnerLastName === null){
                                    $("#partnerLastName").after('<div class="alert alert-danger PartnerRegisterAlert">Partner Last Name Should be Provided.</div>');
                                    e.preventDefault();
                                }
                                
                                // To check Partner Email is empty or not
                                let partnerEmail = $("#partnerEmail").val();
                                if(partnerEmail.trim() === ''|| partnerEmail === null || !(isValidEmail(partnerEmail))){
                                    $("#partnerEmail").after('<div class="alert alert-danger PartnerRegisterAlert">Partner Valid Email Should be Provided.</div>');
                                    e.preventDefault();
                                }
                                
                                // To check Partner Mobile Number is empty or not
                                let partnerMobileNumber = $("#partnerMobileNumber").val();
                                if(partnerMobileNumber.trim() === ''|| partnerMobileNumber === null || partnerMobileNumber.length !=10){
                                    $("#partnerMobileNumberDiv").after('<div class="alert alert-danger PartnerRegisterAlert">Partner Valid Mobile Number Should be Provided.</div>');
                                    e.preventDefault();
                                }
                            }
                        }
                        
                    } else {
                        // If 'No' is checked, show alert for 'No'
                    }


                    // If there are no validation errors, proceed with next form request
                    if ($(".PartnerRegisterAlert").length === 0) {
                        nextStep(6);
                    }
                }
            });
        });
    </script>
    <!-- End of the script to Validate the form Register New Partner-->

    <!-- Start of the script to Validate the form Register New Warden -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnNextWarden").click(function(e){
                $(".WardenRegisterAlert").remove();

                // To check if either radio button is checked
                let wardenCnicRadio = $("input[name='wardenCnicRadio']:checked").val();
                if (!wardenCnicRadio) {
                    $("#divWardenRadioButton").after('<div class="alert alert-danger WardenRegisterAlert">Kindly select whether you have a Warden or not.</div>');
                    e.preventDefault();
                } else {
                    // If 'Yes' is checked, show alert for 'Yes'
                    if (wardenCnicRadio === 'Yes') {
                        let wardenCnicCheck =$("#wardenCnicCheck").val();
                        if(wardenCnicCheck.trim()=== '' || wardenCnicCheck === null || wardenCnicCheck.length != 15){
                            $("#wardenCnicCheck").after('<div class="alert alert-danger WardenRegisterAlert">Warden CnicShould be Provided.</div>');
                            $("#wardenCnicCheck").focus();
                            e.preventDefault();
                        }
                        else{
                            let wardenAuthorId = $("#wardenAuthorId").val();
                            if(wardenAuthorId.trim() === '' || wardenAuthorId === null || wardenAuthorId.length==0){
                                // It means that partner is new

                                // To check Warden First Name is empty or not
                                let wardenFirstName = $("#wardenFirstName").val();
                                if(wardenFirstName.trim() === ''|| wardenFirstName === null){
                                    $("#wardenFirstName").after('<div class="alert alert-danger WardenRegisterAlert">Warden First Name Should be Provided.</div>');
                                    e.preventDefault();
                                }

                                // To check Warden Last Name is empty or not
                                let wardenLastName = $("#wardenLastName").val();
                                if(wardenLastName.trim() === ''|| wardenLastName === null){
                                    $("#wardenLastName").after('<div class="alert alert-danger WardenRegisterAlert">Warden Last Name Should be Provided.</div>');
                                    e.preventDefault();
                                }
                                
                                // To check Warden Email is empty or not
                                let wardenEmail = $("#wardenEmail").val();
                                if(wardenEmail.trim() === ''|| wardenEmail === null || !(isValidEmail(wardenEmail))){
                                    $("#wardenEmail").after('<div class="alert alert-danger WardenRegisterAlert">Warden Valid Email Should be Provided.</div>');
                                    e.preventDefault();
                                }
                                
                                // To check Warden Mobile Number is empty or not
                                let wardenMobileNumber = $("#wardenMobileNumber").val();
                                if(wardenMobileNumber.trim() === ''|| wardenMobileNumber === null || wardenMobileNumber.length !=10){
                                    $("#divWardenMobileNumber").after('<div class="alert alert-danger WardenRegisterAlert">Warden Valid Mobile Number Should be Provided.</div>');
                                    e.preventDefault();
                                }
                            }
                        }
                        
                    } else {
                        // If 'No' is checked, show alert for 'No'
                    }

                    // If there are no validation errors, proceed with next form request
                    if ($(".WardenRegisterAlert").length === 0) {
                        nextStep(7);
                    }
                }
            });
        });
    </script>
    <!-- End of the script to Validate the form Register New Warden -->

    <!-- Start of the script to validate the Membership Form -->
    <!-- End of the script to validate the Membership Form -->
    
    <!-- Start of the script to Save all the btnSaveHostelAllFroms -->
    <script>
        $(document).ready(function(){
            $("#btnSaveHostelAllFroms").click(function(e){
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData1 = new FormData($('#formAddHostel')[0]); // Use FormData for file uploads

                // Collect data from Form 2
                var formData2 = $('#formHostelDetails').serializeArray();
                
                // Collect data from Form 3
                var formData3 = $('#formHostelAdressDetails').serializeArray();

                // Collect data from Form 3 (Update the variable name to formData4 to avoid conflict)
                var formData4 = $('#formHostelMetas').serializeArray();

                // Collect data from Form 4
                var formData5 = $('#formNewPartnerDetails').serializeArray();

                // Collect data from Form 5
                var formData6 = $('#formNewWardenDetails').serializeArray();

                // Collect data from Form 6
                var formData7 = $('#formAddFeaturesFacilitiesAmenitiesLuxuries').serializeArray();

                // Append data from other forms to FormData
                $.each(formData2, function (index, field) {
                    formData1.append(field.name, field.value);
                });

                $.each(formData3, function (index, field) {
                    formData1.append(field.name, field.value);
                });

                $.each(formData4, function (index, field) {
                    formData1.append(field.name, field.value);
                });

                $.each(formData5, function (index, field) {
                    formData1.append(field.name, field.value);
                });

                $.each(formData6, function (index, field) {
                    formData1.append(field.name, field.value);
                });

                $.each(formData7, function (index, field) {
                    formData1.append(field.name, field.value);
                });

                // Add CSRF token to FormData
                formData1.append('_token', csrfToken);

                // To Save the Hostel Data
                var formAddHostelData = new FormData($("#formAddHostel")[0]);
                
                
                    $.ajax({
                        type: 'POST',  // Adjust the type as needed (e.g., 'GET' or 'POST')
                        url: '/client/hostels/storeHostel',    // Adjust the action
                        data: formData1,
                        contentType: false, // Important: prevent jQuery from setting content type
                        processData: false, // Important: prevent jQuery from processing the data
    
                        success: function(response) {
                            if (response.status === 'success') {
                                // Reset all forms
                                $('#formAddHostel')[0].reset();
                                $('#formHostelDetails')[0].reset();
                                $('#formHostelMetas')[0].reset();
                                $('#formNewPartnerDetails')[0].reset();
                                $('#formNewWardenDetails')[0].reset();
                                $('#formAddFeaturesFacilitiesAmenitiesLuxuries')[0].reset();

                                // Redirect to the home route
                                window.location.href = '/client/dashboard';
                                Swal.fire('Success', response.message, 'success');
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function (err) {
                            // If there is an error adding the user
                            let error = err.responseJSON;
                            $(".alert-danger").remove();
                            if (error.hasOwnProperty('errors')) {
                                document.getElementById('step7').style.display = 'none';
                                document.getElementById('step1').style.display = 'block';
                                $.each(error.errors, function (index, value) {
                                    $("#" + index).after('<div class="alert alert-danger">'+value+'</div>');
                                });
                            } else if (error.hasOwnProperty('message')) {
                                // Display a general error message
                                Swal.fire('Error', error.message, 'error');
                            }
                        }
                    });
            });
        });
    </script>
    <!-- End of the script to Save all the btnSaveHostelAllFroms -->

    <!-- Start of script for Location using google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrN1lnwhavrmfKr2HWruDFDdXJcIfAM1M&callback=initMap&libraries=places" async
        defer></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrN1lnwhavrmfKr2HWruDFDdXJcIfAM1M&libraries=places"></script> --}}
    {{-- <script>
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
    </script> --}}
    <!-- Start of script for Location using google map -->

    <script>
        function initAutocomplete() {
            const input = document.getElementById('hostelLocation');

            // Specify componentRestrictions to restrict to a city and state
            const options = {
                componentRestrictions: {
                    country: 'PK'
                }, // 'PK' is the country code for Pakistan
            };

            const autocomplete = new google.maps.places.Autocomplete(input, options);

            // Listen for the place_changed event using addEventListener
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();

                // Use the 'place' object to access address components, geometry, etc.
                if (!place.geometry) {
                    console.log('No geometry available for this place');
                    return;
                }

                // Access place details, such as address components
                console.log('Selected Place:', place);

                // Populate address input fields
                document.getElementById('hostelStreetNo').value = place.name;
                document.getElementById('hostelZipCode').value = place.address_components[6] ? place.address_components[6].long_name : '';
                document.getElementById('hostelMapLocation').value = place.url;

                // Populate latitude and longitude input fields
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();

                // Add Area Name and Plot Number
                var areaName = getAreaName(place.address_components);
                var plotNumber = getPlotNumber(place.address_components);

                // Populate additional input fields
                document.getElementById('hostelAreaName').value = areaName;
                document.getElementById('hostelPlotNo').value = plotNumber;
                // Example: Retrieve latitude and longitude values from cookies
                var latitudeValue = place.geometry.location.lat() ?? getCookieValue('latitude');
                var longitudeValue = place.geometry.location.lng() ?? getCookieValue('longitude');
                // Set initial map coordinates
                var initialLocation = {
                    lat: parseFloat(latitudeValue),
                    lng: parseFloat(longitudeValue)
                };
                // Create a map centered at the initial location
                map = new google.maps.Map(document.getElementById('map'), {
                    center: initialLocation,
                    zoom: 14
                });

                // Add a marker to the initial location
                marker = new google.maps.Marker({
                    position: initialLocation,
                    map: map,
                    draggable: true
                });

                // Add event listener to update marker position when dragged
                google.maps.event.addListener(marker, 'dragend', function(event) {
                    updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());
                });
            });
        }

        // Initialize the Autocomplete when the Google Maps API is loaded
        window.addEventListener('load', initAutocomplete);
    </script>
    
    <script>
        $(document).ready(function() {
            var latitudeValue = getCookieValue('latitude');
            var longitudeValue = getCookieValue('longitude');
            updateLatLng(parseFloat(latitudeValue), parseFloat(longitudeValue));
        });
    </script>
    <script>
        var map;
        var marker;

        function initMap() {
            // Example: Retrieve latitude and longitude values from cookies
            var latitudeValue = getCookieValue('latitude');
            var longitudeValue = getCookieValue('longitude');
            // Set initial map coordinates
            var initialLocation = {
                lat: parseFloat(latitudeValue),
                lng: parseFloat(longitudeValue)
            };
            // Create a map centered at the initial location
            map = new google.maps.Map(document.getElementById('map'), {
                center: initialLocation,
                zoom: 14
            });

            // Add a marker to the initial location
            marker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                draggable: true
            });

            // Add event listener to update marker position when dragged
            google.maps.event.addListener(marker, 'dragend', function(event) {
                updateLatLng(marker.getPosition().lat(), marker.getPosition().lng());
            });
        }

        function updateLatLng(lat, lng) {
            var latLng = new google.maps.LatLng(lat, lng);

            // Use the Geocoding API to get additional information
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'location': latLng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        console.log("results", results[0]);
                        var placeName = results[0].formatted_address;
                        var placeUrl = getPlaceUrl(lat, lng);
                        var placeZipcode = getZipcodeFromAddress(results[0].address_components);
                        var areaName = getAreaName(results[0].address_components);
                        var plotNumber = getPlotNumber(results[0].address_components);
                        // Populate address input fields
                        document.getElementById('hostelStreetNo').value = placeName;
                        document.getElementById('hostelLocation').value = placeName;
                        document.getElementById('hostelAreaName').value = areaName;
                        document.getElementById('hostelPlotNo').value = plotNumber;
                        document.getElementById('hostelZipCode').value = placeZipcode;
                        document.getElementById('hostelMapLocation').value = placeUrl;
                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;
                    } else {
                        alert('No results found');
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });
        }

        function getZipcodeFromAddress(addressComponents) {
            for (var i = 0; i < addressComponents.length; i++) {
                var types = addressComponents[i].types;
                if (types.includes('postal_code')) {
                    return addressComponents[i].long_name;
                }
            }
            return 'N/A';
        }

        function getAreaName(addressComponents) {
            // Extract the area name from address components
            for (var i = 0; i < addressComponents.length; i++) {
                var types = addressComponents[i].types;
                if (types.includes('neighborhood') || types.includes('sublocality')) {
                    return addressComponents[i].long_name;
                }
            }
            return 'N/A';
        }

        function getPlotNumber(addressComponents) {
            // Extract the plot number from address components
            for (var i = 0; i < addressComponents.length; i++) {
                var types = addressComponents[i].types;
                if (types.includes('street_number')) {
                    return addressComponents[i].long_name;
                }
            }
            return 'N/A';
        }

        function getPlaceUrl(lat, lng) {
            // Construct a Google Maps URL based on the latitude and longitude
            return 'https://www.google.com/maps/@' + lat + ',' + lng + ',15z';
        }

        function getCookieValue(key) {
            // Split the cookies into an array
            var cookies = document.cookie.split(';');

            // Iterate through the cookies to find the one with the specified key
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim(); // Remove leading and trailing spaces

                // Check if the cookie starts with the specified key
                if (cookie.indexOf(key + '=') === 0) {
                    // Return the value of the cookie
                    return cookie.substring(key.length + 1);
                }
            }

            // Return null if the cookie with the specified key is not found
            return null;
        }
    </script>

@endsection

