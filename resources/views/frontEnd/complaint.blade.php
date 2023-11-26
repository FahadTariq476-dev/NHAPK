@extends('frontEnd.forntEnd_layout.main')
@section('main-container')
<!-- ***** Welcome Area Start ***** -->
        <section id="home" class="section welcome-area overflow-hidden d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Welcome Intro Start -->
                    <div class="col-12 col-md-7">
                        <div class="welcome-intro">
                            <h1>We make the path to your digital presence</h1>
                            <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit nihil tenetur minus quidem est deserunt molestias accusamus harum ullam tempore debitis et, expedita, repellat delectus aspernatur neque itaque qui quod.</p>
                            <!-- Buttons -->
                            <div class="button-group">
                                <a href="#" class="btn btn-bordered">Work with Us</a>
                                <a href="#" class="btn btn-bordered d-none d-sm-inline-block">View Process</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Welcome Area End ***** -->

        
<div class="container mt-5">
    <h2 class="text-center mb-4">Hostel Complaint Registration</h2>
    <div>
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

    <form action="{{route('frontEnd.saveComplaint')}}" method="POST" id="complaintForm">
        @csrf
        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" class="form-control" id="fullName" name="fullName" value="{{old('fullName')}}" placeholder="Enter your full name here:" >
        </div>
        @error('fullName')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="fullName">Mobile Number:</label>
            <input type="tel" class="form-control" id="MobNo" name="MobNo" pattern="[0-9]{9}" maxlength="9" minlength="9" value="{{old('MobNo')}}" placeholder="Enter your mobile number here:" >
            <small class="form-text text-muted">Please enter a mobile number. Don't add +923</small>
        </div>
        @error('MobNo')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="fullName">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter your email here:" >
        </div>
        @error('email')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="roomNumber">Room Number:</label>
            <input type="text" class="form-control" id="roomNumber" name="roomNumber" value="{{old('roomNumber')}}" placeholder="Enter your room number" >
        </div>
        @error('roomNumber')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="countryId">Select Country</label>
            <select class="form-control" id="countryId" name="countryId" >
                <option value="" selected disabled>Select Country</option>
                @if(count($countries)>0)
                @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name}}</option>
                @endforeach
                @else
                <option value=""  disabled>No Country found</option>
                @endif
            </select>
        </div>
        @error('countryId')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="stateId">Select State</label>
            <select class="form-control" id="stateId" name="stateId">
                <option value="" selected disabled>Select State</option>
            </select>
        </div>
        @error('stateId')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="cityId">Select City</label>
            <select class="form-control" id="cityId" name="cityId" >
                <option value="" selected disabled>Select City</option>
            </select>
        </div>
        @error('cityId')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="hostelId">Select Hostel</label>
            <select class="form-control" id="hostelId" name="hostelId" >
                <option value="" selected disabled>Select Hostel</option>
            </select>
        </div>
        @error('hostelId')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="complaintType">Complaint Type:</label>
            <select class="form-control" id="complaintType" name="complaintType" >
                <option value="" disabled @if(old('complaintType')=='') selected @endif>
                    Select complaint type
                </option>
                <option value="cleanliness" @if(old('complaintType')=='cleanliness') selected @endif>
                    Cleanliness</option>
                <option value="maintenance" @if(old('complaintType')=='maintenance') selected @endif>
                    Maintenance
                </option>
                <option value="security" @if(old('complaintType')=='security') selected @endif>
                    Security
                </option>
                <!-- Add more complaint types as needed -->
            </select>
        </div>
        @error('complaintType')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="priority">Select Complaint Priority</label>
            <select class="form-control" id="priority" name="priority" >
                <option value="" disabled @if (old('priority')=='') selected @endif>
                    Select Priority
                </option>
                <option value="high" @if (old('priority')=='high') selected @endif>
                    High
                </option>
                <option value="normal" @if (old('priority')=='normal') selected @endif>
                    Normal
                </option>
                <option value="low" @if(old('priority')=='low') selected @endif>
                    Low
                </option>
            </select>
        </div>
        @error('priority')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-group">
            <label for="complaintDetails">Complaint Details:</label>
            <textarea class="form-control" id="complaintDetails" name="complaintDetails" rows="4" placeholder="Provide details about your complaint" >{{old('complaintDetails')}}</textarea>
        </div>
        @error('complaintDetails')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit Complaint</button>
    </form>
</div>



{{-- Begin: To Get States Name and Id Using Country Id --}}
<script>
    $(document).ready(function() {
        $('#countryId').change(function() {
            if($('#countryId').val() != null){
                var countryId = $(this).val();
                // Make an Ajax request to get the states for the selected country
                $.ajax({
                    url: '/get-states/' + countryId,
                    type: 'GET',
                    success: function(response) {
                        // Clear existing options
                        $('#stateId').empty();
                        $('#stateId').append('<option value="" selected disabled>Select State</option>');
                        // Check if response has states or if states are null
                        if (response.length === 0 || response === null) {
                            $('#stateId').append('<option value="" disabled>No states found</option>');
                        } else {
                            // Populate the state dropdown with the fetched data
                            $.each(response, function(key, value) {
                                $('#stateId').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                        $('#cityId').empty();
                        $('#cityId').append('<option value="" selected disabled>Select City</option>');
                        $('#hostelId').empty();
                        $('#hostelId').append('<option value="" selected disabled>Select Hostel</option>')
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>
{{-- End: To Get States Name and Id Using Country Id --}}


{{-- Begin: To Get Cities Name and Id Using States Id --}}
<script>
    $(document).ready(function() {
        $('#stateId').change(function() {
            if($('#stateId').val() != null){
                var stateId = $(this).val();
                // Make an Ajax request to get the states for the selected country
                $.ajax({
                    url: '/get-cities/' + stateId,
                    type: 'GET',
                    success: function(response) {
                        // Clear existing options
                        $('#cityId').empty();
                        $('#cityId').append('<option value="" disabled selected>Select City</option>');
                        // Check if response has cities or if cities are null
                        if(response.length === 0 || response === null){
                            $('#cityId').append('<option value="" disabled>No city found</option>');
                        }
                        else{
                            // Populate the state dropdown with the fetched data
                            $.each(response, function(key, value) {
                                $('#cityId').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                        $('#hostelId').empty();
                        $('#hostelId').append('<option value="" selected disabled>Select Hostel</option>')
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>
{{-- End: To Get Cities Name and Id Using States Id --}}

{{-- Begin: To Get The All Hostel Name and Id Using the City ID --}}
<script>
    $(document).ready(function(){
        $('#cityId').change(function(){
            if($('#cityId').val() != null){
                let cityId = $(this).val();
                $.ajax({
                    url:'/get-properties/'+cityId,
                    type:"GET",
                    success:function(response){
                        $('#hostelId').empty();
                        $('#hostelId').append('<option value="" selected disabled>Select Hostel</option>')
                        if(response.length === 0 || response === null){
                            $('#hostelId').append('<option value=""  disabled>No Hostel Found</option>')
                        }
                        else{
                            $.each(response, function(key, value){
                                $('#hostelId').append('<option value="'+value.id+'">'+value.name+'</option>')
                            });
                        }
                    },
                    error:function(error){
                        console.log(error);
                    },
                });
            }
        });
    });
</script>
{{-- End: To Get The All Hostel Name and Id Using the City ID --}}

{{-- Begin: Form validation --}}
<script>
    $(document).ready(function(){
        // complaintForm validation logic here
        $("#complaintForm").submit(function(e){
            // Reset the previous error message
            $(".alert-danger").remove();

            // Check if the Full name is empty
            let fullName = $('#fullName').val();
            if(fullName.trim() === ''){
                e.preventDefault();
                $("#fullName").after('<div class="alert alert-danger">Full Name should be provided.</div>');
            }

            // Check if the Mobile Number is empty or it's length is not equal to 9
            let MobNo = $("#MobNo").val();
            if(MobNo.trim() ==='' || MobNo.length !=9){
                e.preventDefault();
                $("#MobNo").after('<div class="alert alert-danger">Mobile Number Should be provided properly. Plzz Dont add +923 in the mobile no.</div>')
            }

            // Check if the email is empty
            let email = $("#email").val();
            if(email.trim() === ''){
                e.preventDefault();
                $("#email").ajax('<div class="alert alert-danger">Email should be provided properly.</div>')
            }

            // 

        });
    });
</script>
{{-- End: Form validation --}}



@endsection()