@extends('client.layouts.master')
@section('title','Election Nomination - Apply')

<!-- Begin: Addiitonal CSS Section starts Here -->
@section('css')

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@endsection
<!-- End: Addiitonal CSS Section starts Here -->

<!-- Begin: Main-Content Section  -->
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
                            <h2 class="content-header-title float-start mb-0">Election Nomination</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('client.dashboard.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Election Nomination</a></li>
                                    <li class="breadcrumb-item active">Apply Election Nomination</li>
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
                <!-- Begin: Kick start -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Apply Election Nomination</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                           <form id="formApplyElectionNomination" action="{{route('client.electionNomination.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Candidate Name -->
                                <div class="form-group">
                                    <label>Candidate Name</label>
                                    <input type="text" id="candidateName" name="candidateName" value="{{Auth::user()->name}}" class="form-control" readonly>
                                </div>
                                <!-- Candidate Cnic -->
                                <div class="form-group">
                                    <label>Candidate Cnic</label>
                                    <input type="text" id="candidateCnic" name="candidateCnic" value="{{Auth::user()->cnic_no}}" class="form-control" readonly>
                                </div>
                                
                                <!-- Candidate Mobile No -->
                                <div class="form-group">
                                    <label>Candidate Mobile No</label>
                                    <input type="text" id="candidateMobileNo" name="candidateMobileNo" value="{{Auth::user()->phone_number}}" class="form-control" readonly>
                                </div>

                                <!-- Select Country -->
                                <div class="form-group">
                                    <label for="countryId">Select Country</label>
                                    <select id="countryId" name="countryId" class="form-control select2">
                                        <option value="" selected disabled>Select Country</option>
                                        @if (count($countries)>0)
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @if (old('countryId')==$country->id) selected @endif >{{ $country->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Country Found</option>
                                        @endif
                                    </select>
                                </div>
                                @error('countryId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Select State -->
                                <div class="form-group">
                                    <label for="stateId">Select State</label>
                                    <select id="stateId" name="stateId" class="form-control select2">
                                        <option value="" selected disabled>Select State</option>
                                    </select>
                                </div>
                                @error('stateId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Select City -->
                                <div class="form-group">
                                    <label for="cityId">Select City</label>
                                    <select id="cityId" name="cityId" class="form-control select2">
                                        <option value="" selected disabled>Select City</option>
                                    </select>
                                </div>
                                @error('cityId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Select electionCategory -->
                                <div class="form-group">
                                    <label for="electionCategoryId">Select Election Category</label>
                                    <select id="electionCategoryId" name="electionCategoryId" class="form-control select2">
                                        <option value="" selected disabled>Select Election Category</option>
                                        @if (count($electionCategories)>0)
                                            @foreach ($electionCategories as $electionCategory)
                                                <option value="{{ $electionCategory->id }}" @if (old('countryId')==$electionCategory->id) selected @endif >{{ $electionCategory->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Country Found</option>
                                        @endif
                                    </select>
                                </div>
                                @error('electionCategoryId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Select elections -->
                                <div class="form-group">
                                    <label for="electionId">Select Election</label>
                                    <select id="electionId" name="electionId" class="form-control select2">
                                        <option value="" selected disabled>Select Election</option>
                                        @if (count($elections)>0)
                                            @foreach ($elections as $elections)
                                                <option value="{{ $elections->id }}" @if (old('countryId')==$elections->id) selected @endif >{{ $elections->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Election Found</option>
                                        @endif
                                    </select>
                                </div>
                                @error('electionId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!--Select File -->
                                <div class="form-group">
                                    <label for="candidateFile">Select File</label>
                                    <input type="file" class="form-control" id="candidateFile" name="candidateFile" />
                                    <small class="form-text text-muted">Please Upload any pdf or Image</small>
                                </div>
                                @error('candidateFile')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Actions Button -->
                                <div class="form-group">
                                    <button type="reset" class="btn btn-primary" id="btnReset">Reset</button>
                                    <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
                                </div>
                           </form>
                        </div>
                    </div>
                </div>
                <!-- End: Kick start -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
<!-- Begin: Main-Content Section  -->

<!-- Begin: Script Section Starts Here -->
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2 on the city dropdown
            $('#cityId').select2({
                placeholder: 'Select City',
                allowClear: true,
                width: '100%' // Set the width as per your requirement
            });


            //  To get States for the Given Country
            $("#countryId").change(function(){
                    let countryId = $("#countryId").val();
                        $('#stateId').empty();
                        $('#stateId').append('<option value="" disabled selected>Select State</option>');
                        $('#cityId').empty();
                        $('#cityId').append('<option value="" disabled selected>Select City</option>');
                    if(cityId !=null){
                        $.ajax({
                            url:'/get-states/'+countryId,
                            type:'GET',
                            success:function(response){
                                if (!response || (Array.isArray(response) && response.length === 0)) {
                                    $('#stateId').append('<option value="" disabled>No State Found</option>');
                                } else {
                                    $.each(response, function(key, value) {
                                        $('#stateId').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                }
                            },
                            error:function(error){
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text: 'An error occured: '+error.responseJSON.message,
                                });
                            }
                        });
                    }
                });
                
            //  To get Cities for the Given State
                $("#stateId").change(function(){
                    let stateId = $("#stateId").val();
                        $('#cityId').empty();
                        $('#cityId').append('<option value="" disabled selected>Select City</option>');
                    if(cityId !=null){
                        $.ajax({
                            url:'/get-cities/'+stateId,
                            type:'GET',
                            success:function(response){
                                if (!response || (Array.isArray(response) && response.length === 0)) {
                                    $('#cityId').append('<option value="" disabled>No City Found</option>');
                                } else {
                                    $.each(response, function(key, value) {
                                        $('#cityId').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                }
                            },
                            error:function(error){
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text: 'An error occured: '+error.responseJSON.message,
                                });
                            }
                        });
                    }
                });

            // Form validation
            $("#btnSubmit").click(function (e) { 
                // Remove any existing error messages
                $(".alert").remove();
                
                // To Check countryId is empty or Now
                let countryId = $("#countryId").val();
                if (countryId == null || countryId.trim() === '') {
                    e.preventDefault();
                    $("#countryId").after('<div class="alert alert-danger">Country Should be Provided</div>');
                }
                
                // To Check stateId is empty or Now
                let stateId = $("#stateId").val();
                if (stateId == null || stateId.trim() === '') {
                    e.preventDefault();
                    $("#stateId").after('<div class="alert alert-danger">State Should be Provided</div>');
                }
                
                // To Check cityId is empty or Now
                let cityId = $("#cityId").val();
                if (cityId == null || cityId.trim() === '') {
                    e.preventDefault();
                    $("#cityId").after('<div class="alert alert-danger">City Should be Provided</div>');
                }
                
                // To Check electionCategoryId is empty or Now
                let electionCategoryId = $("#electionCategoryId").val();
                if (electionCategoryId == null || electionCategoryId.trim() === '') {
                    e.preventDefault();
                    $("#electionCategoryId").after('<div class="alert alert-danger">Election Category Should be Provided</div>');
                }
                
                // To Check electionId is empty or Now
                let electionId = $("#electionId").val();
                if (electionId == null || electionId.trim() === '') {
                    e.preventDefault();
                    $("#electionId").after('<div class="alert alert-danger">Election Should be Provided</div>');
                }

                // File validation
                let fileInput = $("#candidateFile");
                let fileName = fileInput.val();
                if (!fileName) {
                    e.preventDefault();
                    fileInput.after('<div class="alert alert-danger">File should be selected</div>');
                } else {
                    // Check file extension
                    let fileExtension = fileName.split('.').pop().toLowerCase();
                    if (fileExtension !== 'pdf' && fileExtension !== 'jpg' && fileExtension !== 'jpeg' && fileExtension !== 'png') {
                        e.preventDefault();
                        fileInput.after('<div class="alert alert-danger">Invalid file format. Please select a PDF or image file</div>');
                    }

                    // Check file size (assuming the maximum size is 2MB)
                    let fileSize = fileInput[0].files[0].size; // in bytes
                    let maxSize = 2 * 1024 * 1024; // 2MB
                    if (fileSize > maxSize) {
                        e.preventDefault();
                        fileInput.after('<div class="alert alert-danger">File size should be less than 2 MB</div>');
                    }
                }
            });
        });
    </script>


    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection
<!-- End: Script Section Starts Here -->

