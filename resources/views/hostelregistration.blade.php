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
                    <h2 class="text-center">Hostel Registration From</h2>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" id="hostelRegForm">
                    <div class="row">
                        {{-- Start of First Column --}}
                        <div class="col-md-offset-2 col-md-4 col-sm-6 col-xs-6">
                            <fieldset id="step1">
                                <div class="form-group">
                                    <select name="countries" class="form-control" id="countryId">
                                        <option value="null">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="states" class="form-control" id="stateId">
                                        <option value="null">Select State</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="cities" class="form-control" id="cityId">
                                        <option value="null">Select City</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="hostelLocation" id="hostelLocation"
                                    placeholder="Select Hostel Location" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="hostelOwnerName" id="hostelOwnerName"
                                    placeholder="Name of Private Hostel Owner / Head of Govt. Hostel" required >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="hostelOwnerContact" id="hostelOwnerContact"
                                    placeholder="Hostel Owner / Head Contact No" data-inputmask="'mask': '+92-99999999' " required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="hostelOwnerId" id="hostelOwnerId"
                                    placeholder="Hostel Owner / Head CNIC No" data-inputmask="'mask': '+92-99999999' " required>
                                </div>
                                <div class="cnicverify">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="totalRooms" id="totalRooms" placeholder="Total Rooms" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="hostelGender" id="hostelGender">
                                        <option>Hostel For</option>
                                        <option value="boys">Boys</option>
                                        <option value="girls">Girls</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="hostelType" name="hostelType">
                                        <option>Select Hostel Type</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>    
                                        @endforeach
                                    </select>
                                </div>                                
                            </fieldset>
                        </div>
                        {{-- End of First Column --}}


                        <!-- Second column -->
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="samehostel" style="color:red;"></div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hostelName" id="hostelName" placeholder="Hostel Name" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="hostelAddress" id="hostelAddress" rows="1" placeholder="Hostel Address" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hostelContactNumber" id="hostelContactNumber" placeholder="Hostel Contact Number" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hostelLandLine" id="hostelLandLine" placeholder="Hostel Land Line Number [Optional]">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hostelPartner" id="hostelPartner" placeholder="Hostel Partner [Optional]">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hostelWardanName" id="hostelWardanName" placeholder="Hostel Wardan Name [Optional]">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="referalCNIC" id="referalCNIC" placeholder="Enter Your Referal CNIC [Optional]">
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="hosteltype" name="hostelType">
                                    <option>Select Building Type</option>
                                    <option value="hostel">Hostel</option>
                                    <option value="house">House</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="plaza">Plaza Type</option>
                                    <option value="rooms">Rooms For Rent</option>     
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Attach Your Reg Fee Vochure / ScreenShot of Your Transaction</label>
                                <input type="file"  name="image" class="form-control" required>
                            </div>
                            <div class="form-group">
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
                    // Your existing code for the selected country
                    // alert(countryId);
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
    </body>
</html>