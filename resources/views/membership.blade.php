<!DOCTYPE html>
<html>
    <head>
        <title>Membership Registration</title>
        <!-- Favicon  -->
        <link rel="icon" href="/assets/img/NHAPK.JPEG">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    </head>
    <style>
        .modal-body input {}

        .text {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 500;
            text-align: center
        }

        #label #label2 {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
        }
    </style>
    <body>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-6">
                    <center>
                    <h3>
                        Registration form for Membership<br>
                        Personal Detail
                    </h3>
                    </center>
                    <div class="col-12">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                    <form method="POST" action="/addMembership" id="#membership" onsubmit="return confirmSubmit()">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-1 mt-3">
                                <input type="text" placeholder="Enter Your Full Name:" id="name" name="name" class="form-control" required/>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="text" name="cnic"  id="cnic" placeholder="Enter Your CNIC #" class="form-control" required/>
                            </div>
                            <div class="cnicverify"></div>
                            <div class="mb-1 mt-3">                                
                                <select class="form-control input-sm" name="membershiptype_id" id="membershiptype">
                                    <option value="">Select Membership Type</option>
                                    @foreach ($membershipTypes as $membershipType)
                                    <option value="{{ $membershipType->id }}">{{ $membershipType->name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                            <div class="mb-1 mt-3">
                                <input id="hostelreg_no" type="text" placeholder="Enter Your Hostel Registration No." name="hostelreg_no"  class="form-control mb-2" value="" required/>
                            </div>
                            <div class="mb-1 mt-3" id="verify_hostelreg_no"></div>
                            <div class="mb-1 mt-3">
                                <button class="btn btn-link" id="btn_search_hostel" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                    If don't know Search your hostel Registration Number by clickinghere
                                </button>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="cnic" name="referal_cnic" id="referal_cnic" placeholder="Enter Referal  CNIC #" value="" class="form-control"  required/>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="text" name="transaction_no" id="transaction_no" class="form-control" placeholder="Enter You Transaction Number..." value="" required/>
                            </div>
                            <div class="mb-1 mt-3" id="verify_transaction_no"></div>
                            <div class="mb-1 mt-3">
                                <select class="form-control" name="gender" id="selectgender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="date" id="livingSince" placeholder="Living Since" class="form-control" name="livingSince" value="" required/>
                                <small class="form-text text-muted">Livin Since</small>
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="text" name="previous_hostel" placeholder="Previous Hostel [Optional]" class="form-control" value="">
                            </div>
                            <div class="mb-1 mt-3">
                                <input type="checkbox" id="terms" name="terms" value="true" />
                                <a href="https://www.termsfeed.com/terms-conditions/f18d6159c88d21b6c392878b73562e24" target="_blank()">
                                    Are You Agree with Terms & Conditions
                                </a>
                            </div>
                            <div class="mb-1 mt-3">
                                <a href="/" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function confirmSubmit() {
                function validateAndFocus(element, errorMessage) {
                    var value = element.value.trim();
                    if (value === "") {
                        alert(errorMessage);
                        element.focus();
                        return false;
                    }
                    return true;
                }
                if (!validateAndFocus(document.getElementById("name"), "Name should be provided") ||
                    !validateAndFocus(document.getElementById("cnic"), "CNIC should be provided") ||
                    !validateAndFocus(document.getElementById("membershiptype"), "Membership should be selected") ||
                    !validateAndFocus(document.getElementById("hostelreg_no"), "Hostel Registration Number should be provided") ||
                    !validateAndFocus(document.getElementById("referal_cnic"), "Referral CNIC should be provided") ||
                    !validateAndFocus(document.getElementById("transaction_no"), "Transaction Number should be provided") ||
                    !validateAndFocus(document.getElementById("selectgender"), "Gender should be provided") ||
                    !validateAndFocus(document.getElementById("livingSince"), "Date Living Since should be provided")) {
                        return false;
                }
                if(!document.getElementById("terms").checked){
                    alert("You should agree the terms and conditions");
                    document.getElementById("terms").focus;
                    return false;
                }
                // Show a confirmation alert
                return confirm("Are you sure you want to submit the form?");
            }
        </script>

        <!-- Modal to Search Hostel Registration Number -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align:center;" class="modal-title center" id="Label">Search
                            Hostel</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form method="POST" action="https://itispakistan.com/membership/save" id="m_form_modal">
                                        <input type="hidden" name="_token" value="vYILArErMJ5TzfnudsOtSggPqeroJcp8bMjJrBK2">
                                        <div class="form-group">
                                            <select name="country_id" class="countries form-control" id="country_id"
                                                required>
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                <option value="{{$country->id}}">{{ $country->name }}</option>
                                                <!-- Display other country data as needed -->
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <select name="states_id" class="states form-control" id="states_id"
                                                required>
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <select name="city_id" class="cities form-control" id="city_id"
                                                required>
                                                <option value=""> Select City </option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <select name="property_id" class=" form-control" id="property_id" >
                                                <option value=""> Select hostel </option>
                                        
                                            </select>
                                        </div>
                                        <center>
                                            <div class=" p-3 mt-3 bg-white rounded">
                                                <span>Your Registered Hostel Number is: </span><br>
                                                <span class="text-danger" id="result"></span>
                                            </div>
                                        </center>
                                        <div class="modal-footer">
                                            <div class="btn btn-link ml-3" >
                                                <a href="{{route('saveHostelForm')}}" target="_blank">If not found Add Your Hostel</a></div>
                                            <button class="btn btn-primary" data-bs-toggle="modal">close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- Close of Modal for search hostel registraion number --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <!-- Include Inputmask.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    {{-- Start of the script to input masking the id card --}}
    <script>
        $(document).ready(function () {
            // Apply input masking to ID card input
            $('#cnic').inputmask('99999-9999999-9', { placeholder: '_' });
            $('#referal_cnic').inputmask('99999-9999999-9', { placeholder: '_' });
        });
    </script>
    {{-- End of the script to input masking the id card --}}

    {{-- Start of the script to check that id card on selecting the gender --}}
    <script>
       $(document).ready(function(){
    $('#selectgender').change(function(){
        let cnic = $('#cnic').val(), gender = $('#selectgender').val();
        if(gender && cnic.length === 15){
            var lastDigit = parseInt(cnic.slice(-1));
            if(!(lastDigit % 2 === 0 && gender === 'female') && !(lastDigit % 2 !== 0 && gender === 'male')){
                alert("Kindly Select Your Gender According to your CNIC. Gender does not match with your CNIC.");
                $('#selectgender').val('').focus();
                $('#cnic').focus();
            }
        } else {
            alert("Kindly Provide the CNIC First");
            $('#cnic').focus();
            $('#selectgender').val('');
        }
    });
});

    </script>
    {{-- End of the script to check that id card on selecting the gender --}}
    

        <script>
            $(document).ready(function(){
                $('#hostelreg_no').hide();
                $('#btn_search_hostel').hide();
                $('#membershiptype').change(function() {
                if ($('#membershiptype').val() != null) {
                    $('#hostelreg_no').show();
                    // $('#btn_search_hostel').show();
                }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#btn_search_hostel").hide();
                $("#hostelreg_no").click(function() {
                    $("#btn_search_hostel").show();
                });
            });
        </script>

        {{-- Start of the Script to Verufy CNIC Which is going to be registered for Membership --}}
        <script>
            $(document).ready(function(){
                $('#cnic').focusout(function(){
                    let cnic = $('#cnic').val();
                    if(cnic.length==0){
                        $(".cnicverify").hide();
                        $(".cnicverify").html("");
                        return;
                    }
                    if(cnic.length!==15){
                        // alert("Kindly Provide the cnic correctly");
                        $(".cnicverify").css({"border":"2px solid red"});
                        $(".cnicverify").show();
                        $(".cnicverify").html("Kindly Provide the cnic correctly");
                        $('#cnic').focus();
                        $('#cnic').val("");
                        return;
                    }
                    else{
                        $('#selectgender').val('');
                        $(".cnicverify").hide();
                        $(".cnicverify").html("");
                        $.ajax({
                            url:'/checkCNIC_Membership/'+cnic,
                            type:"GET",
                            success:function(response){
                                if(response==1){
                                    // it means cnic exist.
                                    $(".cnicverify").css({"border":"2px solid red"});
                                    $(".cnicverify").show();
                                    $(".cnicverify").html("Membership is already registered with this CNIC. Kindly Register the Memebership with new CNIC.");
                                    $('#cnic').focus();
                                    return;
                                }
                                else{
                                    // cnic did not exist
                                }
                            },
                        });
                    }
                });
            });
        </script>
        {{-- End of the Script to Verufy CNIC Which is going to be registered for Membership --}}

        {{-- Start of the Script to Verify that Transaction id is uniqe or not --}}
        <script>
            $(document).ready(function(){
                $('#transaction_no').focusout(function(){
                    let transaction_no = $('#transaction_no').val();
                    if(transaction_no.length>0){
                        $.ajax({
                            url:'/checkTransaction_no/'+transaction_no,
                            type:"GET",
                            success:function(response){
                                if(response==1){    // 1 means true transsction id exist
                                    $("#verify_transaction_no").css({"border":"2px solid red"});
                                    $("#verify_transaction_no").show();
                                    $("#verify_transaction_no").html("Transaction Id is already used. Kindly use the new and unique transaction id");
                                    $('#transaction_no').focus();
                                    return;
                                }
                                else{
                                    $("#verify_transaction_no").hide();
                                    $("#verify_transaction_no").html("");
                                }
                            },
                        });
                    }else{
                        $("#verify_transaction_no").hide();
                        $("#verify_transaction_no").html("");
                    }
                });
            });
        </script>
        {{-- End of the Script to Verify that Transaction id is uniqe or not --}}

        {{-- Start of the script to Verify the hostel id from Properties Table --}}
        <script>
            $(document).ready(function(){
                $('#hostelreg_no').focusout(function(){
                    let hostelreg_no = $('#hostelreg_no').val();
                    if(hostelreg_no.length>0){
                        //
                        $.ajax({
                            url:'/checkHostelId/'+hostelreg_no,
                            type:"GET",
                            success:function(response){
                                if(response==0){
                                    $("#verify_hostelreg_no").css({"border":"2px solid red"});
                                    $("#verify_hostelreg_no").show();
                                    $("#verify_hostelreg_no").html("Hostel does not exist. Kindly Used the Registered Hostel Number");
                                    $('#hostelreg_no').focus();
                                    return;
                                    // alert("Hostel does not exist. Kindly Used the Registered Hostel Number");
                                }
                                else{
                                    $("#verify_hostelreg_no").hide();
                                    $("#verify_hostelreg_no").html("");
                                }
                                // alert(response);
                            },
                        });
                    }
                });
            });
        </script>
        {{-- End of the script to Verify the hostel id from Properties Table --}}

{{-- Start of Script to Get States Using Country Id --}}
<script>
    $(document).ready(function() {
        $('#country_id').change(function() {
            if($('#country_id').val() != null){
                var countryId = $(this).val();
            // Make an Ajax request to get the states for the selected country
            $.ajax({
                url: '/get-states/' + countryId,
                type: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#states_id').empty();
                    $('#states_id').append('<option value="">Select State</option>');
                    // Populate the state dropdown with the fetched data
                    $.each(response, function(key, value) {
                        $('#states_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
            }

            
        });
    });
</script>
{{-- Close of Script to Get States Using Country Id --}}


{{-- Start of Script to Get Cities Using State Id --}}
<script>
    $(document).ready(function() {
        $('#states_id').change(function() {
            if($('#states_id').val() != null){
                var stateId = $(this).val();
            // Make an Ajax request to get the states for the selected country
            $.ajax({
                url: '/get-cities/' + stateId,
                type: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#city_id').empty();
                    $('#city_id').append('<option value="">Select City</option>');
                    // Populate the state dropdown with the fetched data
                    $.each(response, function(key, value) {
                        $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
            }

            
        });
    });
</script>
{{-- Close of Script to Get Cities Using State Id --}}


{{-- Start of Script to Get Hostels Using Cities Id --}}
<script>
    $(document).ready(function() {
        $('#city_id').change(function() {
            if($('#city_id').val() != null){
                var cityId = $(this).val();
            // Make an Ajax request to get the states for the selected country
            $.ajax({
                url: '/get-properties/' + cityId,
                type: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#property_id').empty();
                    $('#property_id').append('<option value="">Select Hostel</option>');
                    // Populate the state dropdown with the fetched data
                    $.each(response, function(key, value) {
                        $('#property_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
            }            
        });
    });
</script>
{{-- Close of Script to Get Hostels Using City Id --}}

{{-- Start of Script to Show the Hostel Registerd Number --}}
<script>
    // jQuery code
    $(document).ready(function(){
        // Attach change event to the select box
        $('#property_id').on('change', function(){
            // Get the selected value
            var selectedValue = $(this).val();
            // alert(selectedValue);
            // Update the content of the span
            $('#result').text(selectedValue);
        });
    });
</script>
{{-- End of Script to Show the Hostel Registerd Number --}}


    </body>
</html>