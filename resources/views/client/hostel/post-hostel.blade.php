@extends('client.layouts.master')
@section('title','Add Hostel')

@section('css')
    <!-- Begin: DataTables CSS and JS -->
    @include('client.layouts.dataTables-links')
    <!-- End: DataTables CSS and JS -->

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
                        <h4 class="card-title">Add Hostel</h4>
                    </div>
                    <div class="card-body">
                        <div id="form-container">
                            <!-- Hostel Information -->
                            <div class="form-step" id="step1">
                                <h4>Hostel Information</h4>
                                <form class="row" id="formAddHostel">
                                    @csrf
                                    <!-- Left Column -->
                                    <div class="col-md-6 mb-1">
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

                                        <!-- Total Number of Rooms -->
                                        <div class="form-group">
                                            <label for="hostelTotalRooms">Total Number of Rooms:</label>
                                            <input type="number" class="form-control" value="" id="hostelTotalRooms" name="hostelTotalRooms" placeholder="Enter Total Number of Rooms Here:">
                                        </div>

                                        <!-- Hostel Room Occupancy -->
                                        <div class="form-group">
                                            <label for="hostelRoomOccupancy">Hostel Room Occupancy:</label>
                                            <input type="number" class="form-control" value="" id="hostelRoomOccupancy" name="hostelRoomOccupancy" placeholder="Enter Hostel Room Occupancy Here:">
                                        </div>
                                        
                                    </div>
                            
                                    <!-- Right Column -->
                                    <div class="col-md-6 mb-1">
                                        <!-- Hostel Name -->
                                        <div class="form-group">
                                            <label for="hostelName">Hostel Name:</label>
                                            <input type="text" class="form-control" id="hostelName" value="" name="hostelName" minlength="3" maxlength="250" placeholder="Enter Your Hostel Name Here:">
                                        </div>

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

                                        <!-- Hostel Address -->
                                        <div class="form-group">
                                            <label for="hostelAddress">Hostel Adress:</label>
                                            <textarea class="form-control" id="hostelAddress" name="hostelAddress" rows="5" minlength="5" maxlength="400" placeholder="Enter Your Hostel Address Here:"></textarea>
                                        </div>
                            
                                        <!-- Hostel Categories-->
                                        <div class="form-group">
                                            <label for="hostelCategories">Select Hostel Categories:</label>
                                            <select class="form-control" id="hostelCategoryId" name="hostelCategoryId">
                                                <option value="" selected disabled >Select Hostel Category</option>
                                                @if (count($categories)>0)
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">
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
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button type="submit" class="btn btn-primary" id="btnAddHostel">Next</button>
                                    </div>
                                    
                                </form>
                            </div>
          
                            <!-- Partner Details -->
                            <div class="form-step" id="step2" style="display: none;">
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
                                    <button type="button" class="btn btn-success" onclick="prevStep(2)">Previous</button>
                                    <button type="submit" class="btn btn-primary" id="btnNextPartner">Next</button>
                                    {{-- <button type="button" class="btn btn-primary" onclick="nextStep(5)">Next</button> --}}
                                    {{-- <a href="#" id="btnNextPartner">Next</a> --}}
                                </div>
                            </div>
        
                            <!-- Warden Details -->
                            <div class="form-step" id="step3" style="display: none;">
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
                                <button type="button" class="btn btn-success" onclick="prevStep(3)">Previous</button>
                                <button type="button" class="btn btn-primary" id="btnNextWarden">Save</button>
                                {{-- <a href="#" id="btnNextWarden">Next</a> --}}
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

        // Begin:  To Validate Mobile Number 
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
        // End:  To Validate Mobile Number 

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

        $(document).ready(function () {
            // Begin:   CNIC formatting
            // Format Hostel Partner CNIC Check on input
            $('#partnerCnicCheck').on('input', function() {
                formatField($(this));
            });
            
            // Format Hostel Wanrden CNIC Check on input
            $('#wardenCnicCheck').on('input', function() {
                formatField($(this));
            });
            
            // End:   CNIC formatting

            // Begin: Get states from country id
            $('#hostelCountryId').change(function(){
                $('#hostelStatesId').empty();
                $('#hostelStatesId').append('<option value="null" selected disabled>Select State</option>');
                $('#hostelCityId').empty();
                $('#hostelCityId').append('<option value="" disabled selected>Select City</option>');
                var hostelCountryId = $(this).val();
                if(hostelCountryId == "null"){  // Check if the selected value is "Select Country"
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
                        Swal.fire({
                            icon:'error',
                            title:'Error',
                            text:'An Error Occured: '+error.responseJSON.message,
                        });
                    }
                });
            });
            // End: Get states from country id

            // Begin: get cities from state id
            $('#hostelStatesId').change(function(){
                $('#hostelCityId').empty();
                $('#hostelCityId').append('<option value="" disabled selected>Select City</option>');
                var hostelStatesId = $(this).val();
                if(hostelStatesId == "null"){  
                    return false;  // Exit the function early
                }
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
                        Swal.fire({
                            icon:'error',
                            title:'Error',
                            text:'An Error Occured: '+error.responseJSON.message,
                        });
                    }
                });
            });
            // End: get cities from state id

            // Begin: To verify the Name of the Hostel
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
                                return true;
                            }
                        },
                        error: function(error) {
                            console.log(error);
                                Swal.fire({
                                icon:'error',
                                title:'Error',
                                text:'An Error Occured: '+error.responseJSON.message,
                            });
                        }
                    });
                }
            });
            // End: To verify the Name of the Hostel

            // Begin: To check that given email is unique or not
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
                            },
                            error: function(error) {
                            console.log(error);
                                Swal.fire({
                                icon:'error',
                                title:'Error',
                                text:'An Error Occured: '+error.responseJSON.message,
                            });
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
            $('#partnerEmail').focusout(function(){
                $(".alert-danger").remove();
                checkEmail('#partnerEmail');
            });
            $('#wardenEmail').focusout(function(){
                $(".alert-danger").remove();
                checkEmail('#wardenEmail');
            });

            // End: To check that given email is unique or not

            // Begin: To Show the Partner / Warden Cnic check button and deal with the new suer register form
            // Partner
            function  clearPartnerFields() {
                $("#divAlertPartnerCnicCheck").remove();
                $("#PartnerRegisterAlert").remove();
                $("#divEnterPartnerDetails").hide();
                $("#partnerAuthorId").val('');
                $("#partnerFirstName").val('');
                $("#partnerLastName").val('');
                $("#partnerEmail").val('');
                $("#partnerMobileNumber").val('');
                $("#partnerAuthorId").val('');
            }
            $("input[name='partnerCnicRadio']").change(function() {
                var selectedValue = $(this).val();
                $("#partnerCnicCheck").val('');
                clearPartnerFields();
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
            
            function clearWardenFields(){
                $("#divAlertWardenCnicCheck").remove();
                $("#WardenRegisterAlert").remove();
                $("#divEnterWardenDetails").hide();
                $("#wardenFirstName").val('');
                $("#wardenLastName").val('');
                $("#wardenEmail").val('');
                $("#wardenMobileNumber").val('');
                $("#wardenAuthorId").val('');
            }
            // Warden
            $("input[name='wardenCnicRadio']").change(function() {
                var selectedValue = $(this).val();
                $("#wardenCnicCheck").val('');
                clearWardenFields();
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
            // End: To Show the Partner / Warden Cnic check button and deal with the new suer register form
            

            // Begin: To verify the cnic of the partner
            $('#partnerCnicCheck').on('keyup', function(){
                let partnerCnicCheck = $('#partnerCnicCheck').val();
                clearPartnerFields();
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
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text:'An Error Occured: '+error.responseJSON.message,
                                });
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
            // End: To verify the cnic of the partner
            

            // Begin: To verify the cnic of the warden
            $('#wardenCnicCheck').on('keyup',function(){
                let wardenCnicCheck = $('#wardenCnicCheck').val();
                clearWardenFields();
                if(wardenCnicCheck.length!=0){
                    if(wardenCnicCheck.length == 15){
                        $.ajax({
                            type:'GET',
                            // url:'/checkCNIC/' + wardenCnicCheck,
                            url:'/checkCnicWithData/' + wardenCnicCheck,
                            success:function(response){
                                if(response==0){
                                    $("#divAlertWardenCnicCheck").remove();
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
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text:'An Error Occured: '+error.responseJSON.message,
                                });
                            }
                        });
                    }
                    else{
                        $("#wardenCnicCheck").after('<div class="alert alert-danger" id="divAlertWardenCnicCheck">Warden CNIC length should be provided correctly.</div>');
                        $("#wardenCnicCheck").focus();
                        return false;
                    }
                }
                else{
                    return false;
                }
            });
            // End: To verify the cnic of the warden

            // phone number validation function
            function validatePhoneNumberLengthType(phoneNumber) {
                // Check if the phone number starts with 3, consists of digits only, and has a length of 10
                return /^[3]\d{9}$/.test(phoneNumber) && phoneNumber.length == 10;
            }

            // Begin: To Verfiy the Unique Mobile Number
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
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text:'An Error Occured: '+error.responseJSON.message,
                                });
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
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text:'An Error Occured: '+error.responseJSON.message,
                                });
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
            // End: To Verfiy the Unique Mobile Number

            // Begin:   To Validate the form (formAddHostel)
            $("#btnAddHostel").click(function(e){
                e.preventDefault();
                $(".addHostelAlert").remove();

                // To check the Hostel Name is empty or not
                let hostelName = $("#hostelName").val();
                if(hostelName.trim() === '' || hostelName == null ||hostelName.length == 0 || hostelName.length < 3 || hostelName.length > 255){
                    $("#hostelName").after('<div class="alert alert-danger addHostelAlert">Hostel Name & Unique Hostel Name Should be Provided</div>');
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
                
                
                // To check the Hostel Address is empty or not
                let hostelAddress = $("#hostelAddress").val();
                if(hostelAddress.trim() === '' || hostelAddress == null ||  hostelAddress.length < 5 || hostelAddress.length > 400){
                    $("#hostelAddress").after('<div class="alert alert-danger addHostelAlert">Hostel Address Should be Provided</div>');
                    e.preventDefault();
                }
                

                // To check the Hostel Categories is empty or not
                let hostelCategoryId = $("#hostelCategoryId").val();
                if(hostelCategoryId === null || hostelCategoryId.trim() === '' ){
                    $("#hostelCategoryId").after('<div class="alert alert-danger addHostelAlert">Hostel Categories Should be Provided</div>');
                    e.preventDefault();
                }

                // To check the Hostel Type is empty or not
                let hostelTypeId = $("#hostelTypeId").val();
                if(hostelTypeId === null || hostelTypeId.trim() === ''){
                    $("#hostelTypeId").after('<div class="alert alert-danger addHostelAlert">Hostel Type Should be Provided.</div>');
                    e.preventDefault();
                }

                // To check the Hostel Room Occupancy is empty or not
                let hostelRoomOccupancy = $("#hostelRoomOccupancy").val();
                if(hostelRoomOccupancy.trim() === '' ||isNaN(hostelRoomOccupancy) || parseInt(hostelRoomOccupancy) < 0){
                    $("#hostelRoomOccupancy").after('<div class="alert alert-danger addHostelAlert">Hostel Room Occupancy Should be Provided.</div>');
                    e.preventDefault();
                }
 
                // To check the Hostel Contact Number is empty or not
                let hostelContactNumber = $("#hostelContactNumber").val();
                if(hostelContactNumber.trim() === '' || hostelContactNumber == null ||  hostelContactNumber.length != 10){
                    $("#divHostelContactNumber").after('<div class="alert alert-danger addHostelAlert">Valid Hostel Contact Number Should be Provided.</div>');
                    e.preventDefault();
                }
                
                // If there are no validation errors, proceed with next form request
                if ($(".addHostelAlert").length === 0) {
                    nextStep(2);
                }

            });
            // End: To Validate the form (formAddHostel)

            // Begin: To Validate the form of Register New Partner
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
                        nextStep(3);
                    }
                }
            });
            // End: To Validate the form of Register New Partner

            // Begin: To Validate the form of Register New Warden
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
                        //  save the form
                        e.preventDefault();

                        // Create a FormData object
                        var formData = new FormData($('#formAddHostel')[0]); // Initialize with the first form data

                        // Collect data from Form 4 (formNewPartnerDetails)
                        var formData2 = new FormData($('#formNewPartnerDetails')[0]);
                        formData2.forEach((value, key) => {
                            formData.append(key, value);
                        });

                        // Collect data from Form 5 (formNewWardenDetails)
                        var formData3 = new FormData($('#formNewWardenDetails')[0]);
                        formData3.forEach((value, key) => {
                            formData.append(key, value);
                        });

                        // Append data from other forms to FormData
                        $.each(formData2, function (index, field) {
                            formData.append(field[0], field[1]);
                        });

                        $.each(formData3, function (index, field) {
                            formData.append(field[0], field[1]);
                        });

                        // Add CSRF token to the FormData
                        formData.append('_token', $('#formAddHostel input[name="_token"]').val());

                
                
                        $.ajax({
                            type: 'POST',  // Adjust the type as needed (e.g., 'GET' or 'POST')
                            url: '/client/hostels/storeHostel',    // Adjust the action
                            data: formData,
                            contentType: false, // Ensure that FormData is processed correctly
                            processData: false, // Prevent jQuery from processing the data
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire('Success', response.message, 'success');
                                    // Reset all forms
                                    $('#formAddHostel')[0].reset();
                                    $('#formNewPartnerDetails')[0].reset();
                                    $('#formNewWardenDetails')[0].reset();
                                    $('#formNewPartnerDetails').hide();
                                    $('#formNewWardenDetails').hide();
                                    $(".addHostelAlert").remove();
                                    $(".PartnerRegisterAlert").remove();
                                    $(".WardenRegisterAlert").remove();
                                    document.getElementById('step3').style.display = 'none';
                                    document.getElementById('step1').style.display = 'block';

                                    // Redirect to the home route
                                    // window.location.href = '/client/dashboard';
                                    
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function (err) {
                                // If there is an error adding the user
                                let error = err.responseJSON;
                                $(".alert-danger").remove();
                                if (error.hasOwnProperty('errors')) {
                                    document.getElementById('step3').style.display = 'none';
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
                    }
                }
            });
            // End: To Validate the form of Register New Warden


        });

    </script>




    
    <!-- Start of the script to Save all the btnSaveHostelAllFroms -->
    <script>
        $(document).ready(function(){
            $("#btnSaveHostelAllFroms").click(function(e){
                
            });
        });
    </script>
    <!-- End of the script to Save all the btnSaveHostelAllFroms -->


@endsection

