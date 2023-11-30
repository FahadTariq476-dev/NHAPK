@extends('admin.layouts.main')
@section('main-container')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Edits Membership</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menu</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.list-memebership')}}">Membership</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.list-memebership')}}">List Memebrship</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Membership</li>
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

                <div class="row">
                    <div class="container">
                      <!-- Membership Registration Form -->
                      <form method="POST" action="/admin/updateMembership" id="membership">
                        @csrf
                        <input type="text" class="form-control" id="membership-id" name="membership" value="{{$memberships->id}}" placeholder="Enter your name here:" readonly>
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$memberships->name}}" placeholder="Enter your name here:">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- CNIC -->
                        <div class="form-group">
                            <label for="cnic">CNIC:</label>
                            <input type="text" class="form-control" id="cnic" name="cnic" value="{{$memberships->cnic}}" placeholder="Enter your cnic here:">
                        </div>
                        <div class="cnicverify">
                            {{-- Here we show the error if cnic exsit on focusout --}}
                        </div>
                        @error('cnic')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Membership Type -->
                        <div class="form-group">
                            <label for="membershipType">Membership Type:</label>
                            <select class="form-control" id="membershiptype_id" name="membershiptype_id">
                                <option value="" selected disabled>Select Membership</option>
                                @if (count($membershipTypes)>0)
                                    @foreach($membershipTypes as $membershipType)
                                        <option value="{{ $membershipType->id }}" @if ($memberships->membershiptype_id==$membershipType->id) selected @endif >
                                            {{ $membershipType->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No Membership Found</option>
                                @endif
                            </select>
                        </div>
                        @error('membershiptype_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Country -->
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select class="form-control" id="country_id" name="country_id">
                                <option value="" selected disabled>Select Country</option>
                                @if (count($countries)>0)
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if ($memberships->country_id==$country->id) selected @endif >
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
                                @if (count($states)>0)
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" @if ($memberships->states_id==$state->id) selected @endif >
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>No State Found</option>
                            @endif
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
                                @if (count($cities)>0)
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" @if ($memberships->city_id==$city->id) selected @endif >
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>No City Found</option>
                            @endif
                            </select>
                        </div>
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Hostel Registration Number -->
                        <div class="form-group">
                            <label for="hostelRegNo">Hostel:</label>
                            <select class="form-control" id="hostelreg_no" name="hostelreg_no">
                                <option value="" selected disabled>Select Hostel</option>
                                @if (count($properties)>0)
                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}" @if ($memberships->hostelreg_no==$property->id) selected @endif >
                                        {{ $property->name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>No Hostel Found</option>
                            @endif
                            </select>
                        </div>
                        @error('hostelreg_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Link to Add New Hostel If Hostel Not Found -->
                        <div class="form-group">
                            <div class="" >
                                <a href="{{route('saveHostelForm')}}" target="_blank">If not found Add Your Hostel</a>
                            </div>
                        </div>
    
                        <!-- Referral CNIC -->
                        <div class="form-group">
                            <label for="referralCNIC">Referral CNIC:</label>
                            <input type="text" class="form-control" id="referal_cnic" name="referal_cnic" value="{{$memberships->referal_cnic}}" placeholder="Enter referral cnic here:">
                        </div>
                        @error('referal_cnic')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Transaction Number -->
                        <div class="form-group">
                            <label for="transactionNo">Transaction Number:</label>
                            <input type="text" class="form-control" id="transaction_no" name="transaction_no" value="{{$memberships->transaction_no}}" placeholder="Enter your transaction number here:">
                        </div>
                        <div id="verify_transaction_no">
                            {{-- Here we show the error if transaction id exsit on focusout --}}
                        </div>
                        @error('transaction_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Gender -->
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="" disabled @if (($memberships->gender)=="") selected @endif>Select Gender</option>
                                <option value="male" @if (($memberships->gender)=="male") selected @endif>Male</option>
                                <option value="female" @if (($memberships->gender)=="female") selected @endif>Female</option>
                            </select>
                        </div>
                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Since -->
                        <div class="form-group">
                            <label for="since">Since:</label>
                            <input type="date" class="form-control" id="since" value="{{ \Carbon\Carbon::parse($memberships->since)->format('Y-m-d') }}" name="since">
                            <small class="form-text text-muted">Living Since</small>
                        </div>
    
                        <!-- Previous Hostel -->
                        <div class="form-group">
                            <label for="previousHostel">Previous Hostel:</label>
                            <input type="text" class="form-control" id="previous_hostel" name="previous_hostel" value="{{$memberships->previous_hostel}}" placeholder="Enter your previous hostel registration number here: [Optional]">
                        </div> 
                        
    
                        <!-- Reset Button -->
                        <button type="reset" class="btn btn-warning">Reset</button> 
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                      </div>
                </div>
                <br>
                <br>

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> Please check the&nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-full.html" target="_blank">Layout full documentation</a>&nbsp; for more details.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @endsection
    @section('js')

    {{-- Start of Script to Get States Using Country Id --}}
<script>
    $(document).ready(function() {
        $('#country_id').change(function() {
            if($('#country_id').val() != null){
                var country_id = $(this).val();
            // Make an Ajax request to get the states for the selected country
            $.ajax({
                url: '/get-states/' + country_id,
                type: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#states_id').empty();
                    $('#states_id').append('<option value="" disabled selected>Select State</option>');
                    // Populate the state dropdown with the fetched data
                    if(response.length === 0 || response === null){
                        $('#states_id').append('<option value="" disabled>No State Found</option>');
                    }
                    else{
                        $.each(response, function(key, value) {
                            $('#states_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                    $('#city_id').empty();
                    $('#city_id').append('<option value="" disabled selected>Select City</option>');
                    $('#hostelreg_no').empty();
                    $('#hostelreg_no').append('<option value="" disabled selected>Select Hostel</option>');
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
                var states_id = $(this).val();
            // Make an Ajax request to get the states for the selected country
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
                    $('#hostelreg_no').empty();
                    $('#hostelreg_no').append('<option value="" disabled selected>Select Hostel</option>');
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
                var city_id = $(this).val();
            // Make an Ajax request to get the states for the selected country
            $.ajax({
                url: '/get-properties/' + city_id,
                type: 'GET',
                success: function(response) {
                    // Clear existing options
                    $('#hostelreg_no').empty();
                    $('#hostelreg_no').append('<option value="" disabled selected>Select Hostel</option>');
                    // Populate the state dropdown with the fetched data
                    if(response === 0 || response === null){
                        $('#hostelreg_no').append('<option value="" disabled>No Hostel Found</option>');
                    }
                    else{
                        $.each(response, function(key, value) {
                            $('#hostelreg_no').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
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
{{-- Close of Script to Get Hostels Using City Id --}}


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
                    $(".cnicverify").css({"border":"2px solid red"});
                    $(".cnicverify").show();
                    $(".cnicverify").html("Kindly Provide the cnic correctly");
                    $('#cnic').focus();
                    // $('#cnic').val("");
                    return;
                }
                else{
                    var memberships_cnic = {!! json_encode($memberships->cnic) !!};
                    if(cnic== memberships_cnic){
                        return;
                    }
                    $.ajax({
                        url:'/checkCNIC_Membership/'+cnic,
                        type:"GET",
                        success:function(response){
                            if(response==1){
                                // it means cnic exist.
                                $(".cnicverify").css({"border":"2px solid red"});
                                $(".cnicverify").show();
                                $(".cnicverify").html("Membership is already registered with this CNIC. Kindly Register the Memebership with new CNIC.");
                                $('#gender').val('');
                                $('#cnic').focus();
                                return;
                            }
                            else{
                                $('#gender').val('');
                                $(".cnicverify").hide();
                                $(".cnicverify").html("");
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
                    var memberships_transaction_no = {!! json_encode($memberships->transaction_no) !!};
                    if(transaction_no== memberships_transaction_no){
                        return;
                    }
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

    {{-- Start of the script to check that id card on selecting the gender --}}
    <script>
        $(document).ready(function(){
            // Function to check gender on CNIC change
            function checkGender() {
                let cnic = $('#cnic').val(), gender = $('#gender').val();
                if (gender && cnic.length === 15) {
                    var lastDigit = parseInt(cnic.slice(-1));
                    if (!(lastDigit % 2 === 0 && gender === 'female') && !(lastDigit % 2 !== 0 && gender === 'male')) {
                        alert("Kindly Select Your Gender According to your CNIC. Gender does not match with your CNIC.");
                        $('#gender').val('').focus();
                        $('#cnic').focus();
                    }
                } else {
                    alert("Kindly Provide the CNIC First");
                    $('#cnic').focus();
                    $('#gender').val('');
                }
            }

            // Check gender on gender change
            $('#gender').change(function(){
                checkGender();
            });

            // Clear gender on cnic focusout if length is 0
            $('#cnic').focusout(function(){
                if ($(this).val().length === 0) {
                    $('#gender').val('');
                }
            });
        });
    </script>
    {{-- End of the script to check that id card on selecting the gender --}}

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

        // Format CNIC on input
        $('#cnic').on('input', function() {
            formatField($(this));
        });

        // Format referal_cnic on input
        $('#referal_cnic').on('input', function() {
            formatField($(this));
        });

        // Set maximum and minimum values for both fields
        $('#cnic, #referal_cnic').attr('maxlength', '15');
        $('#cnic, #referal_cnic').attr('minlength', '15');
    });
</script>

     {{-- Begin: Jquery Form Validation --}}
     <script>
        $(document).ready(function(){
            // 
            $("#membership").submit(function(e){
                $(".alert-danger").remove();
                // Check the Full Name is empty or not
                let name = $("#name").val();
                if(name.trim() === ""){
                    e.preventDefault();
                    $("#name").after('<div class="alert alert-danger">Full name should be provided.</div>');
                    $("#name").focus();
                }

                // Check the cnic is empty or not and also check the length
                let cnic = $("#cnic").val();
                if(cnic.length != 15){
                    e.preventDefault();
                    $("#cnic").after('<div class="alert alert-danger">Cnic should provided properly.</div>');
                    $("#cnic").focus();
                }

                // Check the memebership type is selected or not
                let membershiptype_id = $('#membershiptype_id').val();
                if(membershiptype_id === "" || membershiptype_id === null){
                    e.preventDefault();
                    $("#membershiptype_id").after('<div class="alert alert-danger">Membership should be selected.</div>');
                    $("#membershiptype_id").focus();
                }

                // Check the country is selected or not
                let country_id = $('#country_id').val();
                if(country_id === "" || country_id === null){
                    e.preventDefault();
                    $("#country_id").after('<div class="alert alert-danger">Country should be selected.</div>');
                    $("#country_id").focus();
                }

                // Check the state is selected or not
                let states_id = $('#states_id').val();
                if(states_id === "" || states_id === null){
                    e.preventDefault();
                    $("#states_id").after('<div class="alert alert-danger">State should be selected.</div>');
                    $("#states_id").focus();
                }

                // Check the city is selected or not
                let city_id = $('#city_id').val();
                if(city_id === "" || city_id === null){
                    e.preventDefault();
                    $("#city_id").after('<div class="alert alert-danger">City should be selected.</div>');
                    $("#city_id").focus();
                }

                // Check the Hostel is selected or not
                let hostelreg_no = $('#hostelreg_no').val();
                if(hostelreg_no === "" || hostelreg_no === null){
                    e.preventDefault();
                    $("#hostelreg_no").after('<div class="alert alert-danger">Hostel should be selected.</div>');
                    $("#hostelreg_no").focus();
                }

                // Check the transaction is empty or not
                let transaction_no = $("#transaction_no").val();
                if(transaction_no.trim() === ""){
                    e.preventDefault();
                    $("#transaction_no").after('<div class="alert alert-danger">Transaction id should be provided.</div>');
                    $("#transaction_no").focus();
                }

                // Check the gender is selected or not
                let gender = $('#gender').val();
                if(gender === "" || gender === null){
                    e.preventDefault();
                    $("#gender").after('<div class="alert alert-danger">Gender should be selected.</div>');
                    $("#gender").focus();
                }
            });
        });
    </script>
    {{-- End: Jquery Form Validation --}}

    
  
    @endsection