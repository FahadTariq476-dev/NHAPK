@extends('client.layouts.master')
@section('title','Add Hostel')

{{-- Begin: Addiitonal CSS Section starts Here --}}
@section('css')
    {{--  --}}
    <!-- Begin: DataTables CSS and JS -->
    @include('client.layouts.dataTables-links')
    <!-- End: DataTables CSS and JS -->

@endsection
{{-- End: Addiitonal CSS Section starts Here --}}

{{-- Begin: Main-Content Section  --}}
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
                                        <a href="#">Hostel</a>
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
                        <h4 class="card-title">Add Hostel</h4>
                    </div>
                    <div class="card-body">
                        <div id="form-container">
                            <!-- Hostel Information -->
                            <div class="form-step" id="step1">
                                <h4>Hostel Information</h4>
                                <form class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Name -->
                                        <div class="form-group">
                                            <label for="hostelName">Hostel Name:</label>
                                            <input type="text" class="form-control" id="hostelName" name="hostelName" required>
                                        </div>
                            
                                        <!-- Hostel Description -->
                                        <div class="form-group">
                                            <label for="hostelDescription">Hostel Description:</label>
                                            <textarea class="form-control" id="hostelDescription" name="hostelDescription" rows="3"></textarea>
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
                                            </select>
                                        </div>
                            
                                        <!-- Hostel City -->
                                        <div class="form-group">
                                            <label for="hostelCityId">City:</label>
                                            <select class="form-control" id="hostelCityId" name="hostelCityId">
                                                <option value="" selected disabled>Select City</option>
                                            </select>
                                        </div>

                                        <!-- Total Number of Rooms -->
                                        <div class="form-group">
                                            <label for="hostelTotalRooms">Total Number of Rooms:</label>
                                            <input type="number" class="form-control" id="hostelTotalRooms" name="hostelTotalRooms" required>
                                        </div>
                            
                                        <!-- Total Number of Bath Rooms -->
                                        <div class="form-group">
                                            <label for="hostelBathRooms">Total Number of Bath Rooms:</label>
                                            <input type="number" class="form-control" id="hostelBathRooms" name="hostelBathRooms" required>
                                        </div>
                            
                                        
                                        
                                    </div>
                            
                                    <!-- Right Column -->
                                    <div class="col-md-6 mb-1">
                                         <!-- Hostel Location -->
                                         <div class="form-group">
                                            <label for="hostelLocation">Hostel Location:</label>
                                            <input type="text" class="form-control" id="hostelLocation" name="hostelLocation" required>
                                        </div>

                                         <!-- Hostel Address -->
                                         <div class="form-group">
                                            <label for="hostelAddress">Hostel Adress:</label>
                                            <textarea class="form-control" id="hostelAddress" name="hostelAddress" rows="3"></textarea>
                                        </div>
                            
                                        <!-- Hostel Zip Code -->
                                        <div class="form-group">
                                            <label for="hostelZipCode">Zip Code:</label>
                                            <input type="text" class="form-control" id="hostelZipCode" name="hostelZipCode" required>
                                        </div>

                                        <!-- Hostel Nearest Landmark -->
                                        <div class="form-group">
                                            <label for="hostelNearestLandmark">Nearest Landmark:</label>
                                            <input type="text" class="form-control" id="hostelNearestLandmark" name="hostelNearestLandmark" required>
                                        </div>

                                        <!-- Total Number of Floors -->
                                        <div class="form-group">
                                            <label for="hostelTotalFloors">Total Number of Floors:</label>
                                            <input type="number" class="form-control" id="hostelTotalFloors" name="hostelTotalFloors" required>
                                        </div>
                                        
                                        <!-- Hostel Categories-->
                                        <div class="form-group">
                                            <label for="hostelCategories">Select Hostel Categories:</label>
                                            <select class="form-control" id="hostelCategoryId" name="hostelCategoryId">
                                                <option value="" selected disabled >Select Hostel Category</option>
                                                @if (count($categories)>0)
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if (old('hostelCategoryId')==$category->id) selected @endif>
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>No Hostel Category Found</option>
                                                @endif
                                            </select>
                                        </div>
                            
                                        <!-- Hostel Images -->
                                        <div class="form-group">
                                            <label for="hostelImages">Hostel Images:</label>
                                            <input type="file" class="form-control" id="hostelImages" name="hostelImages" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                                    </div>
                                    
                                </form>
                            </div>
        
                            <!-- Hostel Address -->
                            <div class="form-step" id="step2" style="display: none;">
                                <h4>Hostel Address & Details</h4>
                                <form class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6 mb-1">
                                       

                                        <!-- Hostel Slogan -->
                                        <div class="form-group">
                                            <label for="hostelSlogan">Hostel Slogan:</label>
                                            <input type="text" class="form-control" id="hostelSlogan" name="hostelSlogan" required>
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
                            
                                        <!-- Hostel Type -->
                                        <div class="form-group">
                                            <label for="hostelType">Hostel Type:</label>
                                            <select class="form-control" id="hostelTypeId" name="hostelTypeId">
                                                <option value="">Select Hostel Type</option>
                                                @if (count($property_types)>0)
                                                    @foreach ($property_types as $property_type)
                                                        <option value="{{$property_type->id}}" @if (old('hostelType')==$property_type->id) selected @endif>
                                                            {{$property_type->name}}
                                                        </option>    
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>No Hostel Type Found</option>
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Hostel Average Rent Per Seat (Monthly) -->
                                        <div class="form-group">
                                            <label for="hostelAvgRentPerMonth">Hostel Average Rent Per Seat (Monthly):</label>
                                            <input type="number" class="form-control" id="hostelAvgRentPerMonth" name="hostelAvgRentPerMonth" required>
                                        </div>
                                        
                                        <!-- Hostel Room Occupancy -->
                                        <div class="form-group">
                                            <label for="hostelRoomOccupancy">Hostel Room Occupancy:</label>
                                            <input type="number" class="form-control" id="hostelRoomOccupancy" name="hostelRoomOccupancy" required>
                                        </div>
                                        
                                        <!-- Hostel Recommended Place -->
                                        <div class="form-group">
                                            <label for="hostelRecommendedPlace">Hostel Recommended Place:</label>
                                            <input type="text" class="form-control" id="hostelRecommendedPlace" name="hostelRecommendedPlace" required>
                                        </div>
                                        
                                    </div>
                            
                                    <!-- Right Column -->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Contact Number -->
                                        <div class="form-group">
                                            <label for="hostelContactNumber">Hostel Contact Number:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+92</span>
                                                </div>
                                                <input type="tel" class="form-control" id="hostelContactNumber" name="hostelContactNumber" pattern="[0-9]{10}" maxlength="10" minlength="10" 
                                                value="{{old('hostelContactNumber')}}" placeholder="Enter Your Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                                            </div>
                                            <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                        </div>

                                        <!-- Hostel Open Timing -->
                                        <div class="form-group">
                                            <label for="hostelOpenTiming">Hostel Open Timing:</label>
                                            <input type="time" class="form-control" id="hostelOpenTiming" name="hostelOpenTiming" required>
                                        </div>
                            
                                        <!-- Hostel Close Timing -->
                                        <div class="form-group">
                                            <label for="hostelCloseTiming">Hostel Close Timing:</label>
                                            <input type="time" class="form-control" id="hostelCloseTiming" name="hostelCloseTiming" required>
                                        </div>
                                        
                                        <!-- Hostel Youtube Link -->
                                        <div class="form-group">
                                            <label for="hostelYoutubeLink">Hostel Youtube Link:</label>
                                            <input type="url" class="form-control" id="hostelYoutubeLink" name="hostelYoutubeLink" required>
                                        </div>
                            
                                        <!-- Hostel Facebook Link -->
                                        <div class="form-group">
                                            <label for="hostelFacebookLink">Hostel Facebook Link:</label>
                                            <input type="url" class="form-control" id="hostelFacebookLink" name="hostelFacebookLink" required>
                                        </div>
                            
                                        <!-- Hostel Instagram Link -->
                                        <div class="form-group">
                                            <label for="hostelInstagramLink">Hostel Instagram Link:</label>
                                            <input type="url" class="form-control" id="hostelInstagramLink" name="hostelInstagramLink" required>
                                        </div>
                                        
                                        <!-- Hostel Area Name -->
                                        <div class="form-group">
                                            <label for="hostelAreaName">Hostel Area Name:</label>
                                            <input type="text" class="form-control" id="hostelAreaName" name="hostelAreaName" required>
                                        </div>
                                        
                                        <!-- Hostel Plot No -->
                                        <div class="form-group">
                                            <label for="hostelPlotNo">Hostel Plot No:</label>
                                            <input type="text" class="form-control" id="hostelPlotNo" name="hostelPlotNo" required>
                                        </div>

                                        <!-- Hostel Location -->
                                        <div class="form-group">
                                            <label for="hostelLocation">Hostel Location:</label>
                                            <input type="text" class="form-control" id="hostelLocation" name="hostelLocation" required>
                                        </div>
                                        <!-- Hostel Map Location -->
                                        <div class="form-group">
                                            <label for="hostelMapLocation">Hostel Map Location:</label>
                                            <input type="text" class="form-control" id="hostelMapLocation" name="hostelMapLocation" required>
                                        </div>

                                    </div>


                                    <!-- Buttons-->
                                    <div class="form-group mb-2">
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(2)">Previous</button>
                                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                                    </div>
                                    
                                </form>
                            </div>
        
                            <!-- Hostel Metas -->
                            <div class="form-step" id="step3" style="display: none;">
                                <h4>Hostel Metas</h4>
                                
                                <form class="row">
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
                                        <div class="form-group">
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
                                                <option value="null">N/A</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hostel Study Room Availability -->
                                        <div class="form-group">
                                            <label for="hostelStudyRoomAvailability">Hostel Study Room Availability:</label>
                                            <select class="form-control" name="hostelStudyRoomAvailability" id="hostelStudyRoomAvailability">
                                                <option value="" selected disabled>Select Hostel Study Room Availability</option>
                                                <option value="24/7">24/7</option>
                                                <option value="null">N/A</option>
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
                                            </select>
                                        </div>

                                    </div>
                                    
                                    <!-- Buttons-->
                                    <div class="form-group mb-2">
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(3)">Previous</button>
                                        <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next</button>
                                    </div>
                                    
                                </form>
                            </div>
                            
                            <!-- Partner Details -->
                            <div class="form-step" id="step4" style="display: none;">
                                <h4>Partner Details</h4>
                                <form>
                                    <div class="form-group">
                                        <label for="partnerEmail">Do you have partner:</label>
                                        <input type="radio" class="" id="partnerCnicRadioYes" name="partnerCnicRadio" value="Yes">Yes
                                        <input type="radio" class="" id="partnerCnicRadioNo" name="partnerCnicRadio" value="No">No
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="partnerCnicCheck">Partner Cnic:</label>
                                        <input type="email" class="form-control" id="partnerCnicCheck" name="partnerCnicCheck" minlength="15" maxlength="15">
                                    </div>
                                    <div class="form-group mb-2">
                                        <button type="button" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                <form>
                                    <h4>Enter Partner Details</h4>
                                    <!-- Partner First Name -->
                                    <div class="form-group">
                                        <label for="partnerFirstName">Partner First Name:</label>
                                        <input type="text" class="form-control" id="partnerFirstName" name="partnerFirstName" required>
                                    </div> 
                                    
                                    <!-- Partner Last Name -->
                                    <div class="form-group">
                                        <label for="partnerLastName">Partner Last Name:</label>
                                        <input type="text" class="form-control" id="partnerLastName" name="partnerLastName" required>
                                    </div> 
                                    
                                    <!-- Partner CNIC -->
                                    <div class="form-group">
                                        <label for="partnerCnic">Partner CNIC:</label>
                                        <input type="text" class="form-control" id="partnerCnic" name="partnerCnic" minlength="15" maxlength="15">
                                    </div> 
                                    
                                    <!-- Partner Email -->
                                    <div class="form-group">
                                        <label for="partnerEmail">Partner Email:</label>
                                        <input type="text" class="form-control" id="partnerEmail" name="partnerEmail" required>
                                    </div> 
                                    
                                    <!-- Partner Mobile Number -->
                                    <div class="form-group" id="divPartnerMobileNumber">
                                        <label for="partnerMobileNumber">Partner Mobile Number:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+92</span>
                                            </div>
                                            <input type="tel" class="form-control" id="partnerMobileNumber" name="partnerMobileNumber" pattern="[0-9]{10}" maxlength="10" minlength="10" 
                                            value="{{old('partnerMobileNumber')}}" placeholder="Enter Your Partner Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                                        </div>
                                        <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                    </div> 
                                    
                                    <!-- Partner Password -->
                                    <div class="form-group">
                                        <label for="partnerPassword">Partner Password:</label>
                                        <input type="password" class="form-control" id="partnerPassword" name="partnerPassword" minlength="8" maxlength="8">
                                    </div> 
                                    
                                    <!-- Partner Confirm Password -->
                                    <div class="form-group mb-1">
                                        <label for="partnerConfirmPassword">Partner Confirm Password:</label>
                                        <input type="password" class="form-control" id="partnerConfirmPassword" name="partnerConfirmPassword" minlength="8" maxlength="8">
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="showPasswordPartner"> Show Password
                                    </div>

                                    <div class="form-group">
                                        <button type="reset" class="btn btn-info" >Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(4)">Previous</button>
                                        <button type="button" class="btn btn-primary" onclick="nextStep(5)">Next</button>
                                    </div>

                                </form>
                            </div>
        
                            <!-- Warden Details -->
                            <div class="form-step" id="step5" style="display: none;">
                                <h4>Warden Details</h4>
                                <form>
                                    <div class="form-group">
                                        <label for="wardenEmail">Do you have Warden:</label>
                                        <input type="radio" class="" id="wardenCnicRadioYes" name="wardenCnicRadio" value="Yes">Yes
                                        <input type="radio" class="" id="wardenCnicRadioNo" name="wardenCnicRadio" value="No">No
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="wardenCnicCheck">Warden Cnic:</label>
                                        <input type="email" class="form-control" id="wardenCnicCheck" name="wardenCnicCheck" minlength="15" maxlength="15">
                                    </div>
                                    <div class="form-group mb-2">
                                        <button type="button" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                <form>
                                    <h4>Enter Warden Details</h4>
                                    <!-- Warden First Name -->
                                    <div class="form-group">
                                        <label for="wardenFirstName">Warden First Name:</label>
                                        <input type="text" class="form-control" id="wardenFirstName" name="wardenFirstName" required>
                                    </div> 
                                    
                                    <!-- Warden Last Name -->
                                    <div class="form-group">
                                        <label for="wardenLastName">Warden Last Name:</label>
                                        <input type="text" class="form-control" id="wardenLastName" name="wardenLastName" required>
                                    </div> 
                                    
                                    <!-- Warden CNIC -->
                                    <div class="form-group">
                                        <label for="wardenCnic">Warden CNIC:</label>
                                        <input type="text" class="form-control" id="wardenCnic" name="wardenCnic" minlength="15" maxlength="15">
                                    </div> 
                                    
                                    <!-- Warden Email -->
                                    <div class="form-group">
                                        <label for="wardenEmail">Warden Email:</label>
                                        <input type="text" class="form-control" id="wardenEmail" name="wardenEmail" required>
                                    </div> 
                                    
                                    <!-- Warden Mobile Number -->
                                    <div class="form-group" id="divWardenMobileNumber">
                                        <label for="wardenMobileNumber">Warden Mobile Number:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+92</span>
                                            </div>
                                            <input type="tel" class="form-control" id="wardenMobileNumber" name="wardenMobileNumber" pattern="[0-9]{10}" maxlength="10" minlength="10" 
                                            value="{{old('wardenMobileNumber')}}" placeholder="Enter Your Warden Mobile Number Here:" onkeyup="validateMobileNumber(this)">
                                        </div>
                                        <small class="form-text text-muted">Please enter a mobile number. Don't add +92</small>
                                    </div> 
                                    
                                    <!-- Warden Password -->
                                    <div class="form-group">
                                        <label for="wardenPassword">Warden Password:</label>
                                        <input type="password" class="form-control" id="wardenPassword" name="wardenPassword" minlength="8" maxlength="8">
                                    </div> 
                                    
                                    <!-- Warden Confirm Password -->
                                    <div class="form-group mb-1">
                                        <label for="wardenConfirmPassword">Warden Confirm Password:</label>
                                        <input type="password" class="form-control" id="wardenConfirmPassword" name="wardenConfirmPassword" minlength="8" maxlength="8">
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="showPasswordWarden"> Show Password
                                    </div>

                                    <div class="form-group">
                                        <button type="reset" class="btn btn-info" >Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(5)">Previous</button>
                                        <button type="button" class="btn btn-primary" onclick="nextStep(6)">Next</button>
                                    </div>
                                </form>
                            </div>

                            <!--Hostel Features, Facilities, Amenities, Luxuries-->
                            <div class="form-step" id="step6" style="display: none;">
                                <h4>Hostel Features, Facilities, Amenities, Luxuries</h4>
                                <form>
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
                                    
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-info" >Reset</button>
                                        <button type="button" class="btn btn-success" onclick="prevStep(6)">Previous</button>
                                        <button type="button" class="btn btn-primary" onclick="nextStep(7)">Next</button>
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
    <!-- END: Content-->

@endsection
{{-- Begin: Main-Content Section  --}}

{{-- Begin: Script Section Starts Here --}}
@section('scripts')
    {{--  --}}
    <script>
        function nextStep(step) {
            document.getElementById('step' + (step - 1)).style.display = 'none';
            document.getElementById('step' + step).style.display = 'block';
        }

        function prevStep(step) {
            document.getElementById('step' + step).style.display = 'none';
            document.getElementById('step' + (step - 1)).style.display = 'block';
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

                // Format Hostel Partner CNIC on input
                $('#partnerCnic').on('input', function() {
                    formatField($(this));
                });
                
                // Format Hostel Wanrden CNIC Check on input
                $('#wardenCnicCheck').on('input', function() {
                    formatField($(this));
                });

                // Format Hostel Warden CNIC on input
                $('#wardenCnic').on('input', function() {
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
@endsection
<!-- End: Script Section Starts Here -->

