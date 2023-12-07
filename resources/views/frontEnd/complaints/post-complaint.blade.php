@extends('frontEnd.forntEnd_layout.main')
@section('main-container')

<!-- ***** Breadcrumb Area Start ***** -->
<section class="section breadcrumb-area overlay-dark d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Breamcrumb Content -->
                <div class="breadcrumb- text-center">
                    <h2 class="text-white mb-3">Complaints</h2>
                    <ol class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text text-white" href="/">Home</a></li>
                        <li class="breadcrumb-item text-white active">Register Complaint</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

        
<div class="container mt-5">
    <h2 class="text-center mb-4">Hostel Complaint Registration</h2>
    <div>
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success'
                });
            </script>
        @endif
        @if(session('error'))
            <script>
                    Swal.fire({
                        title: 'Error!',
                        text: "{{ session('error') }}",
                        icon: 'error'
                    });
            </script>
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
            <label for="MobNo">Mobile Number:</label>
            <div class="input-group" id="div-MobNo">
                <div class="input-group-prepend">
                    <span class="input-group-text">+923</span>
                </div>
                <input type="text" class="form-control" name="MobNo" id="MobNo" value="{{old('MobNo')}}" pattern="[0-9]{9}" maxlength="9" minlength="9"  placeholder="Enter your mobile number here:">
            </div>
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
                    Select Complaint Type
                </option>
                @if (count($complaint_types)>0)
                    @foreach ($complaint_types as $complaint_type)
                        <option value="{{ $complaint_type->id}}" @if(old('complaintType')== $complaint_type->id) selected @endif>
                            {{ $complaint_type->name }}
                        </option>
                    @endforeach
                @else
                    <option value="" disabled>No Complaint Type Found</option>
                @endif
                
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
                $("#div-MobNo").after('<div class="alert alert-danger">Mobile Number Should be provided properly. Plzz Dont add +923 in the mobile no.</div>')
            }

            // Check if the email is empty
            let email = $("#email").val();
            if(email.trim() === ''){
                e.preventDefault();
                $("#email").after('<div class="alert alert-danger">Email should be provided properly.</div>')
            }

            // Check if the room number is empty
            let roomNumber = $("#roomNumber").val();
            if(roomNumber.trim() === ""){
                e.preventDefault();
                $("#roomNumber").after('<div class="alert alert-danger">Room Number should be provided.</div>');
            }

            // Check if the contry is empty
            let countryId = $("#countryId").val();
            if(countryId === "" || countryId === null){
                e.preventDefault();
                $("#countryId").after('<div class="alert alert-danger">Country Should be selected.</div>')
            }

            // Check if the state is empty
            let stateId = $("#stateId").val();
            if(stateId === "" || stateId === null){
                e.preventDefault();
                $("#stateId").after('<div class="alert alert-danger">State should be selected</div>')
            }

            //  Check if the city is empty
            let cityId = $("#cityId").val();
            if(cityId === "" || cityId === null){
                e.preventDefault();
                $("#cityId").after('<div class="alert alert-danger">City should be provided</div>');
            }

            // Check if the hostel is empty
            let hostelId = $("#hostelId").val();
            if(hostelId === "" || hostelId === null){
                e.preventDefault();
                $("#hostelId").after('<div class="alert alert-danger">Hostel should be selected</div>')
            }

            // Chect if the Complaint Type is empty
            let complaintType = $("#complaintType").val();
            if(complaintType === "" || complaintType === null){
                e.preventDefault();
                $("#complaintType").after('<div class="alert alert-danger">Complaint Type should be selected</div>');
            }

            // Check if the priority is empty
            let priority = $("#priority").val();
            if(priority === "" || priority === null){
                e.preventDefault();
                $("#priority").after('<div class="alert alert-danger">Complaint Priority should be selected</div>');
            }

            // Check if the complaintDetails are empty
            let complaintDetails = $("#complaintDetails").val();
            if(complaintDetails.trim() ===""){
                e.preventDefault();
                $("#complaintDetails").after('<div class="alert alert-danger">Complaint details should be provided.</div>')
            }

        });
    });
</script>
{{-- End: Form validation --}}



@endsection()