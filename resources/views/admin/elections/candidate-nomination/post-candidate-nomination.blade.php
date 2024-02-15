@extends('admin.layouts.main')
@section('title','Candidate Nomination - Apply')

<!-- Begin: Addiitonal CSS Section starts Here -->
@section('css')

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@endsection
<!-- End: Addiitonal CSS Section starts Here -->
@section('main-container')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Home</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.CandidateNomination.index')}}">Candidate Nomination</a></li>
                                    <li class="breadcrumb-item active">Post Candidate Nomination</li>
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

                <!-- Content Here -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Save Candidate Nomination</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <!-- form -->
                                <form id="formApplyElectionNomination" action="{{route('admin.CandidateNomination.storeNomination')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Select elections -->
                                    <div class="form-group">
                                        <label for="electionId">Select Election</label>
                                        <select id="electionId" name="electionId" class="form-control select2">
                                            <option value="" selected disabled>Select Election</option>
                                            @if (count($elections)>0)
                                                @foreach ($elections as $elections)
                                                    <option value="{{ $elections->id }}" @if (old('electionId')==$elections->id) selected @endif >{{ $elections->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No Election Found</option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('electionId')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
    
                                    <!-- Select electionCategory -->
                                    <div class="form-group">
                                        <label for="electionCategoryId">Select Election Category</label>
                                        {{-- <input type="text" name="electionCategoryIdText" id="electionCategoryIdText" class="form-control" readonly> --}}
                                        <select id="electionCategoryId" name="electionCategoryId" class="form-control">
                                            <option value="" selected disabled>Select Election Category</option>
                                        </select>
                                    </div>
                                    @error('electionCategoryId')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Select Election Seat -->
                                    <div class="form-group">
                                        <label for="electionSeatId">Select Election Seat</label>
                                        <select id="electionSeatId" name="electionSeatId" class="form-control">
                                            <option value="" selected disabled>Select Election Seat</option>
                                        </select>
                                    </div>
                                    @error('electionSeatId')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Select Candidate for Nimnation  -->
                                    <div class="form-group">
                                        <label for="electionNomineeId">Select Candidate for Nomination</label>
                                        <select id="electionNomineeId" name="electionNomineeId" class="form-control select2">
                                            <option value="" selected disabled>Select Nominee </option>
                                        </select>
                                    </div>
                                    @error('electionNomineeId')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
    
                                    <!-- Candidate Objectives-->
                                    <div class="form-group">
                                        <label>Candidate Objectives</label>
                                        <textarea id="candidateObjectives" name="candidateObjectives" class="form-control"></textarea>
                                    </div>
    
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
                                <!-- form -->
                            </div>

                        </div>
                    </div>
                </div>
                <!--/ Content Here -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2 on the city dropdown
            $('#electionNomineeId').select2({
                placeholder: 'Select Nominee',
                allowClear: true,
                width: '100%' // Set the width as per your requirement
            });

            // electionId
            $("#electionId").change(function () { 
                let electionId = $("#electionId").val();
                $("#electionCategroyId").empty();
                $('#electionCategroyId').append('<option value="" selected disabled>Select Election Category</option>');
                $("#electionSeatId").empty();
                $("#electionNomineeId").empty();
                $('#electionSeatId').append('<option value="" selected disabled>Select Election Seat</option>');
                if( electionId == null || electionId.length == 0){
                    $("#electionId").after('<div class="alert alert-danger">Election Should be Provided.</div>');
                    $("#electionId").focus();
                    return true
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: "/admin/candidate/nomination/get-details/"+electionId,
                        success: function (response) {
                            if(response.status == "invalid"){
                                Swal.fire({
                                    icon:'warning',
                                    title:'Invalid',
                                    text: response.message,
                                });
                            }
                            else if(response.status == "success"){
                                if (!response.elections.election_category || response.elections.election_category.length === 0) {
                                    $('#electionCategoryId').append('<option value="" disabled>No Election Category Found</option>');
                                } else {
                                    $('#electionCategoryId').append('<option value="' + response.elections.election_category.id + '">' + response.elections.election_category.name + '</option>');
                                }
                                if(response.electionSeats === 0 || response.electionSeats === null){
                                    $('#electionSeatId').append('<option value="" disabled>No Seat Found</option>');
                                }
                                else{
                                    $.each(response.electionSeats, function(key, value) {
                                        $('#electionSeatId').append('<option value="' + value.id + '">' + value.title + '</option>');
                                    });
                                }
                                if(response.users === 0 || response.users === null){
                                    $('#electionNomineeId').append('<option value="" disabled>No Nominee Found</option>');
                                }
                                else{
                                    $.each(response.users, function(key, value) {
                                        $('#electionNomineeId').append('<option value="' + value.id + '">' + value.name + ', ' + value.phone_number + '</option>');
                                    });
                                    $('#electionNomineeId').val(null).trigger('change');
                                }

                            }
                            else{
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text: response.message,
                                });
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon:'error',
                                title:'Error',
                                text: 'An error occured: '+error.responseJSON.message,
                            });
                        },
                    });
                }
            });

            // Form validation
            $("#btnSubmit").click(function (e) { 
                // Remove any existing error messages
                $(".alert").remove();
                
                
                // To Check electionId is empty or Not
                let electionId = $("#electionId").val();
                if (electionId == null || electionId.trim() === '') {
                    e.preventDefault();
                    $("#electionId").after('<div class="alert alert-danger">Election Should be Provided</div>');
                }

                // To Check electionCategoryId is empty or Not
                let electionCategoryId = $("#electionCategoryId").val();
                if (electionCategoryId == null || electionCategoryId.trim() === '') {
                    e.preventDefault();
                    $("#electionCategoryId").after('<div class="alert alert-danger">Election Category Should be Provided</div>');
                }
                
                // To Check electionSeatId is empty or Not
                let electionSeatId = $("#electionSeatId").val();
                if (electionSeatId == null || electionSeatId.trim() === '') {
                    e.preventDefault();
                    $("#electionSeatId").after('<div class="alert alert-danger">Election Seat Should be Provided</div>');
                }
                
                // To Check electionNomineeId is empty or Not
                let electionNomineeId = $("#electionNomineeId").val();
                if (electionNomineeId == null || electionNomineeId.trim() === '') {
                    e.preventDefault();
                    $("#electionNomineeId").after('<div class="alert alert-danger">Election Nominee Should be Provided</div>');
                }
                
                // To Check candidateObjectives is empty or Not
                let candidateObjectives = $("#candidateObjectives").val();
                if (candidateObjectives == null || candidateObjectives.trim() === '' || candidateObjectives.length() == 0) {
                    e.preventDefault();
                    $("#candidateObjectives").after('<div class="alert alert-danger">Candidate Objectives Should be Provided</div>');
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