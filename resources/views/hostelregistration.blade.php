<!DOCTYPE html>
<html>
    <head>
        <title>Hostel Registration</title>
        <!-- Favicon  -->
        <link rel="icon" href="/assets/img/NHAPK.JPEG">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
        <style>
            @media only screen and (max-width: 600px)
            {
            .registrationForm{
                margin-top:15% !important;
                }
            }
        </style>
    </head>
    <body>
        {{-- @dd($countries->toArray()); --}}
        <div class="container">
            <div class="row registrationForm" style="margin-top:5%;">
                <div class="col-md-12">
                    @if(session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div>
                    @endif
                    <h2 class="text-center">Hostel Registration From</h2>
                </div>
                <form action="hostelRegistration/save" method="POST" enctype="multipart/form-data" id="hostelRegForm">
                    @csrf
                    <div class="row">
                        {{-- Start of First Column --}}
                        <div class="col-md-offset-2 col-md-6 col-sm-6 col-xs-6">
                            <fieldset id="step1">
                                <div class="mb-1 mt-3">
                                    <select name="countries" class="form-control" id="countryId">
                                        <option value="null">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1 mt-3">
                                    <select name="states" class="form-control" id="stateId">
                                        <option value="null">Select State</option>
                                    </select>
                                </div>
                                <div class="mb-1 mt-3">
                                    <select name="cities" class="form-control" id="cityId">
                                        <option value="null">Select City</option>
                                    </select>
                                </div>
                                <div class="mb-1 mt-3">
                                    <input type="text" class="form-control" name="hostelLocation" id="hostelLocation" placeholder="Select Hostel Location" required>
                                    <input type="hidden" class="form-control" name="latitude" id="latitude" placeholder="Latitude Here" readonly/>
                                    <input type="hidden" class="form-control" name="longitude" id="longitude" placeholder="Latitude Here" readonly/>
                                </div>
                                <div class="mb-1 mt-3">
                                    <input type="text" class="form-control" name="hostelOwnerName" id="hostelOwnerName" placeholder="Name of Private Hostel Owner / Head of Govt. Hostel" required >
                                </div>
                                <div class="mb-1 mt-3">
                                    <input type="text" class="form-control" name="hostelOwnerContact" id="hostelOwnerContact" placeholder="Hostel Owner / Head Contact No" required />
                                    <small class="form-text text-muted" id="HostelOwnerLblMobNo">Please enter a mobile number. Don't add +923</small>
                                </div>
                                <div class="mb-1 mt-3">
                                    <input type="text" class="form-control" name="hostelOwnerCnic" id="hostelOwnerCnic" placeholder="Hostel Owner / Head CNIC No"  required>
                                </div>
                                {{-- Get the email if the user is new --}}
                                <div class="mb-1 mt-3">
                                    <input type="email" class="form-control" name="hostelOwnerEmail" id="hostelOwnerEmail" placeholder="Enter email here" style="display:none;"/>
                                </div>
                                {{-- Get the email if the user is new --}}
                                <div class="cnicverify">
                                </div>
                                <div class="mb-1 mt-3">
                                    <input type="number" class="form-control" name="totalRooms" id="totalRooms" placeholder="Total Rooms" required>
                                </div>
                                <div class="mb-1 mt-3">
                                    <select class="form-control" name="hostelGender" id="hostelGender">
                                        <option>Hostel For</option>
                                        <option value="Male">Boys</option>
                                        <option value="Female">Girls</option>
                                    </select>
                                </div>
                                <div class="mb-1 mt-3">
                                    <select class="form-control" id="hostelType" name="hostelType">
                                        <option>Select Hostel Type</option>
                                        @foreach ($property_types as $property_type)
                                        <option value="{{$property_type->id}}">{{$property_type->name}}</option>    
                                        @endforeach
                                    </select>
                                </div>                                
                            </fieldset>
                        </div>
                        {{-- End of First Column --}}


                        <!-- Second column -->
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="mb-1 mt-3">
                                <input type="text" class="form-control" name="hostelName" id="hostelName" placeholder="Hostel Name" required>
                            </div>
                            <div class="samehostel" style="color:red;"></div>
                            <div class="mb-1 mt-3">
                                <textarea class="form-control" name="hostelAddress" id="hostelAddress" rows="3" placeholder="Hostel Address" required></textarea>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="text" class="form-control" name="hostelContactNumber" id="hostelContactNumber" placeholder="Hostel Contact Number" required />
                                <small class="form-text text-muted" id="HostelContactLblMobNo">Please enter a mobile number. Don't add +923</small>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="text" class="form-control" name="hostelLandLine" id="hostelLandLine" placeholder="Hostel Land Line Number [Optional]">
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="text" class="form-control" name="hostelPartnerName" id="hostelPartnerName" placeholder="Hostel Partner Name [Optional]">
                            </div>
                            {{-- Start of Hostel Partner Details if any --}}
                            <div id="hostelPartnerDetails">
                                <div class="mb-1 mt-3">
                                    <input type="text" name="partnerContact" id="partnerContact" placeholder="Hostel Partner Contact Number:" class="form-control" />
                                    <small class="form-text text-muted" id="PartnerContactLblMobNo">Please enter a mobile number. Don't add +923</small>
                                </div>
                
                                <div class="mb-1 mt-3">
                                    <input type="text" ame="partnerCnic" id="partnerCnic" placeholder="Hostel Partner CNIC#" class="form-control" />
                                </div>
                            </div>
                            {{-- End of Hostel Partner Details if any --}}
                            <div class="mb-1 mt-3">
                                <input type="email" name="hostelPartnerEmail" id="hostelPartnerEmail" placeholder="Hostel Partner Email Here:" class="form-control" style="display: none;"/>
                            </div>
                            <div class="PartnerCnicVerify"></div>
                            <div class="mb-1 mt-3">
                                <input type="text" class="form-control" name="hostelWardenName" id="hostelWardenName" placeholder="Hostel Warden Name [Optional]">
                            </div>

                            {{-- Start of Hostel Warden Detailas if any --}}
                            <div id="hostelWardenDetails">
                                <div class="mb-1 mt-3">
                                    <input type="text" name="hostelWardenContact" id="hostelWardenContact" placeholder="Hostel Warden Contact Number:" class="form-control" />
                                    <small class="form-text text-muted" id="HostelWardenLblMobNo">Please enter a mobile number. Don't add +923</small>
                                </div>                
                                <div class="mb-1 mt-3">
                                    <input type="text" name="hostelWardenCnic" id="hostelWardenCnic" placeholder="Hostel Warden CNIC#" class="form-control" />
                                </div>
                            </div>
                            {{-- End of Hostel Warden Detailas if any --}}
                            <div class="wardenCnicVeryify"></div>
                            <div class="mb-1 mt-3">
                                <input type="email" class="form-control" name="hostelWardenEmail" id="hostelWardenEmail" placeholder="Enter Hodtel Warden Email Here:" style="display: none" />
                            </div>

                            <div class="mb-1 mt-3">
                                <input type="text" class="form-control" name="referalCNIC" id="referalCNIC" placeholder="Enter Your Referal CNIC [Optional]">
                            </div>
                            <div class="mb-1 mt-3">
                                <select class="form-control" id="hostelCategories" name="hostelCategories">
                                    <option>Select Hostel Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>    
                                        @endforeach   
                                </select>
                            </div>
                            <div class="mb-1 mt-3">
                                <label>Attach Your Reg Fee Vochure / ScreenShot of Your Transaction</label>
                                <input type="file"  name="image" class="form-control" required>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="checkbox" id="terms" name="terms" value="true" required/>
					            <a href="https://termsfeed.com/terms-conditions/f18d6159c88d21b6c392878b73562e24">Are You Agree with Terms & Conditions</a> 
                            </div>
                        </div>
                        {{-- End of Second Column --}}                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <input type="submit" value="Register" name="registerBtn" id="registerBtn" class="btn btn-success btn-block" style="color:white;width:30%;margin:auto;height:50px;font-size:1.5em;"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <!-- Include jQuery via CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <!-- Include Inputmask.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
        {{-- Start of the script to input masking the id card --}}
        <script>
            $(document).ready(function () {
                // Apply input masking to ID card input
                $('#hostelOwnerCnic').inputmask('99999-9999999-9', { placeholder: '_' });
                $('#partnerCnic').inputmask('99999-9999999-9', { placeholder: '_' });
                $('#hostelWardenCnic').inputmask('99999-9999999-9', { placeholder: '_' });
                $('#referalCNIC').inputmask('99999-9999999-9', { placeholder: '_' });
                $('#hostelOwnerContact').inputmask('999999999', { placeholder: '_' });
                $('#hostelContactNumber').inputmask('999999999', { placeholder: '_' });
                $('#partnerContact').inputmask('999999999', { placeholder: '_' });
                $('#hostelWardenContact').inputmask('999999999', { placeholder: '_' });
            });
        </script>
        {{-- End of the script to input masking the id card --}}

        {{-- <script>
            $(document).ready(function () {
                $('#hostelRegForm').submit(function (event) {
                    // Prevent the default form submission
                    event.preventDefault();
                    alert("yes");
    
                    // Validate empty fields
                    var isValid = true;
                    $(this).find('input').each(function () {
                        if ($.trim($(this).val()) === '') {
                            alert('Please fill in all fields.');
                            isValid = false;
                            return false; // Exit the loop early if an empty field is found
                        }
                    });
    
                    // If all fields are filled, you can proceed with form submission
                    if (isValid) {
                        // Perform your form submission logic here
                        alert('Form submitted successfully!');
                    }
                });
            });
        </script> --}}
    


        {{-- Start of script tag of get states from country id --}}
        <script>
            $(document).ready(function(){
                $('#countryId').change(function(){
                    $('#stateId').empty();
                    $('#stateId').append('<option value="null">Select State</option>');
                    var countryId = $(this).val();
                    if(countryId == "null"){  // Check if the selected value is "Select Country"
                    alert("No country selected!");
                    return;  // Exit the function early
                    }
                    $.ajax({
                        url: '/get-states/' + countryId,
                        type: 'GET',
                        success: function(response) {
                            // Clear existing options
                            $('#stateId').empty();
                            $('#stateId').append('<option value="null">Select State</option>');
                            // Populate the state dropdown with the fetched data
                            $.each(response, function(key, value) {
                                $('#stateId').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
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
                $('#stateId').change(function(){
                    $('#cityId').empty();
                    $('#cityId').append('<option value="null">Select City</option>');
                    var stateId = $(this).val();
                    if(stateId == "null"){  // Check if the selected value is "Select Country"
                    alert("No state selected!");
                    return;  // Exit the function early
                    }
                    // Your existing code for the selected country
                    // alert(countryId);
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        type: 'GET',
                        success: function(response) {
                            // Clear existing options
                            $('#cityId').empty();
                            $('#cityId').append('<option value="null">Select City</option>');
                            // Populate the state dropdown with the fetched data
                            $.each(response, function(key, value) {
                                $('#cityId').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
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
                    $.ajax({
                        type:'GET',
                        url:'hostelRegistration/hostelOwnerCniccheck/' + hostelOwnerCnic,
                        success:function(response){
                            if(response==0){
                                $(".cnicverify").show();
                                $(".cnicverify").html("Hostel is Registered with this CNIC.");
                                $("#hostelOwnerCnic").focus();
                                $('#hostelOwnerEmail').hide();
                                $('#hostelOwnerEmail').val('');
                                $(".cnicverify").css({"border":"2px solid red"});
                            }
                            else if(response==-1){
                                $(".cnicverify").show();
                                $(".cnicverify").html("You are a new user kindly provide the email of the owner");
                                $('#hostelOwnerEmail').show();
                                $("#hostelOwnerEmail").focus();
                                $(".cnicverify").css({"border":"2px solid green"});
                            }
                            else{
                                $(".cnicverify").html("");
                                $(".cnicverify").hide();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>
        {{-- End of script to verify the cnic of the owner --}}
        
        {{-- Start of script to verify the cnic of the Hostel Partner --}}
        <script>
            $(document).ready(function(){
                $('#partnerCnic').focusout(function(){
                    //
                    let hostelPartnerCnic = $('#partnerCnic').val();
                    $.ajax({
                        type:'GET',
                        url:'hostelRegistration/hostelPartnerCniccheck/' + hostelPartnerCnic,
                        success:function(response){
                            if(response==0){
                                $(".PartnerCnicVerify").show();
                                $(".PartnerCnicVerify").html("Hostel Partner is Registered with this CNIC.");
                                $("#partnerCnic").focus();
                                $('#hostelPartnerEmail').hide();
                                $('#hostelPartnerEmail').val('');
                                $(".PartnerCnicVerify").css({"border":"2px solid red"});
                            }
                            else if(response==-1){
                                $(".PartnerCnicVerify").show();
                                $(".PartnerCnicVerify").html("Hostel Partner is a new user kindly provide the email of the partner");
                                $('#hostelPartnerEmail').show();
                                $("#hostelPartnerEmail").focus();
                                $(".PartnerCnicVerify").css({"border":"2px solid green"});
                            }
                            else{
                                $(".PartnerCnicVerify").html("");
                                $(".PartnerCnicVerify").hide();
                                $('#hostelPartnerEmail').hide();
                                $('#hostelPartnerEmail').val('');
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });
        </script>
        {{-- End of script to verify the cnic of the Hostel Partner --}}

        {{-- Start of script to verify the cnic of the Hostel Warden --}}
        <script>
            $(document).ready(function(){
                $('#hostelWardenCnic').focusout(function(){
                    //
                    let hostelPartnerCnic = $('#hostelWardenCnic').val();
                    $.ajax({
                        type:'GET',
                        url:'hostelRegistration/hostelPartnerCniccheck/' + hostelPartnerCnic,
                        success:function(response){
                            if(response==0){
                                $(".wardenCnicVeryify").show();
                                $(".wardenCnicVeryify").html("Hostel Warden is Registered with this CNIC.");
                                $("#partnerCnic").focus();
                                $('#hostelWardenEmail').hide();
                                $('#hostelWardenEmail').val('');
                                $(".wardenCnicVeryify").css({"border":"2px solid red"});
                            }
                            else if(response==-1){
                                $(".wardenCnicVeryify").show();
                                $(".wardenCnicVeryify").html("Hostel Warden is a new user kindly provide the email of the warden");
                                $('#hostelWardenEmail').show();
                                $("#hostelWardenEmail").focus();
                                $(".wardenCnicVeryify").css({"border":"2px solid green"});
                            }
                            else{
                                $(".wardenCnicVeryify").html("");
                                $(".wardenCnicVeryify").hide();
                                $('#hostelWardenEmail').hide();
                                $('#hostelWardenEmail').val('');
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
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
                                    $(".samehostel").show();
                                    $(".samehostel").html("Hostel Name Already Exist");
                                }
                                else{
                                    $(".samehostel").hide();
                                    $(".samehostel").html();
                                }
                                // alert(response);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                    else if(hostelName.length==0){
                        $(".samehostel").hide();
                        $(".samehostel").html();
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
    </body>
</html>