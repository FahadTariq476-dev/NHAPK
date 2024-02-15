@extends('client.layouts.master')
@section('title','Nominee List')

<!-- Begin: Addiitonal CSS Section starts Here -->
@section('css')
    <!-- Begin: DataTables CSS and JS -->
    @include('client.layouts.dataTables-links')
    <!-- End: DataTables CSS and JS -->

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
                            <h2 class="content-header-title float-start mb-0">Nominee List</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('client.dashboard.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Nominee</a></li>
                                    <li class="breadcrumb-item active">View Nominee List</li>
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
                        <h4 class="card-title">Nominee List</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form action="{{route('client.electionSuggestion.post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Select Candidate -->
                                <div class="form-group mb-1">
                                    <label for="electionId">Select Election</label>
                                    <select id="electionId" name="electionId" class="form-control">
                                        <option value="" selected>Select Election</option>
                                        @if (count($electionsLists)>0)
                                        @foreach ($electionsLists as $electionsList)
                                            <option value="{{ $electionsList->id }}" @if (old('electionId') == $electionsList->id) selected @endif>
                                                {{ $electionsList->name }}
                                            </option>
                                        @endforeach
                                        @else
                                            <option value="" disabled>No Election Found</option>
                                        @endif
                                    </select>
                                </div>
                                @error('electionId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                
                                <div class="form-group">
                                    <button type="reset" class="btn btn-info" id="resetBtn">Reset</button>
                                    <button type="submit" class="btn btn-success" id="goBtn">Go</button>
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
<script>
    $(document).ready(function () {
        
        $("#viewCandidateId").change(function () { 
            let viewCandidateId = $("#viewCandidateId").val();
            var baseUrl = "{{ url('/') }}";
            if( viewCandidateId == null){
                return true
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/client/viewCandidateDetails/"+viewCandidateId,
                    success: function (response) {
                        resetFields();
                        if(response.status == "invalid"){
                            Swal.fire({
                                icon:'warning',
                                title:'Invalid',
                                text: response.message,
                            });
                        }
                        else{
                            $("#viewCandidateCnic").val(response.user.cnic_no);
                            $("#viewCandidateMobileNo").val(response.user.phone_number);
                            $("#viewCandidateCountryName").val(response.country.name);
                            $("#viewCandidateStateName").val(response.state.name);
                            $("#viewCandidateCityName").val(response.city.name);
                            $("#viewCandidateAddress").val(response.user.address);
                            $("#viewCandidateDescription").val(response.user.short_description);
                            $("#viewElectionCategoryId").val(response.electionCategory.name);
                            $("#viewElectionId").val(response.election.name);

                            // Update candidate picture
                            $("#viewCandidateImage").attr("src", baseUrl + "/storage/" +response.user.picture_path);
                            $("#viewCandidateImage").attr("alt", response.user.name);
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
        
        // electionId
        $("#electionId").change(function () { 
            let electionId = $("#electionId").val();
            $("#electionCategroyId").empty();
            $('#electionCategroyId').append('<option value="" selected disabled>Select Election Category</option>');
            if( electionId == null || electionId.length == 0){
                $("#electionId").after('<div class="alert alert-danger">Election Should be Provided.</div>');
                $("#electionId").focus();
                return true
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/client/election-catogries/"+electionId,
                    success: function (response) {
                        if(response.status == "invalid"){
                            Swal.fire({
                                icon:'warning',
                                title:'Invalid',
                                text: response.message,
                            });
                        }
                        else if(response.status == "success"){
                            if(response === 0 || response === null){
                                $('#electionCategroyId').append('<option value="" disabled>No Category Found</option>');
                            }
                            else{
                                $.each(response.electionCategories, function(key, value) {
                                    $('#electionCategroyId').append('<option value="' + value.election_category.id + '">' + value.election_category.name + '</option>');
                                });
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


        $("#goBtn").click(function (e) { 
            e.preventDefault();
            $(".alert-danger").remove();

            //  To check electionId is empty or not
            let electionId = $("#electionId").val();
            if( electionId == null || electionId.length == 0 || electionId.trim()===''){
                e.preventDefault();
                $("#electionId").after('<div class="alert alert-danger">Election Should be Provided.</div>');
                return true;
            }
            
            $.ajax({
                type: "GET",
                url: "/client/nomination/list/candidate-list/"+electionId,
                success: function (response) {
                    if(response.status == "invalid"){
                        Swal.fire({
                            icon:'warning',
                            title:'Invalid',
                            text: response.message,
                        });
                    }
                    else  if(response.status == "error"){
                        Swal.fire({
                            icon:response.status,
                            title:'Error',
                            text: response.message,
                        });
                    }
                    else if(response.status == "success"){
                        // Update modal content with received candidates
                        updateModalContent(response.candidatesForVote);

                        // Show the modal
                        $("#ShowVoteCandidateModal").modal('show');
                        Swal.fire({
                            icon:response.status,
                            title:'Success',
                            text: response.message,
                        });
                    }
                    else if(response.status == "info"){
                        Swal.fire({
                            icon:response.status,
                            title:'Info',
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
                }
            });
            
        });

        var baseUrl = "{{ url('/') }}";

        // Function to update modal content with candidate details
        function updateModalContent(candidates) {
            var modalBodyContent = $("#modalBodyContent");

            // Clear existing content
            modalBodyContent.empty();

            // Loop through candidates and append card for each candidate
            
                        // <form action="/client/vote/save" method="POST">
            candidates.forEach(function (candidate) {
                var cardHtml = `
                    <div class="card" style="width: 24rem;">
                        <form action="#" >
                            @csrf
                            <input type="hidden" name="candidateId" id="candidateId" value="${candidate.id}" readonly/>
                            <input type="hidden" name="candidateElectionId" id="candidateElectionId" value="${candidate.electionId}" readonly/>
                            <input type="hidden" name="candidateElectionCategoryId" id="candidateElectionCategoryId" value="${candidate.electionCategoryId}" readonly/>
                            <img src="${baseUrl}/storage/${candidate.user.picture_path}" class="card-img-top" alt="${candidate.user.name}">
                            <div class="card-body">
                                <label for="candidateName" class="fw-bold">Name:</label>${candidate.user.name}</br>
                                <label for="candidateName" class="fw-bold">Election Category:</label>${candidate.election_category.name}</br>
                                <label for="candidateName" class="fw-bold">Election Seat:</label>${candidate.election_seat.title}</br>
                                <label for="candidateName" class="fw-bold">Area:</label>${candidate.user.area.name}</br>
                                <label for="candidateName" class="fw-bold">Hostel Name:</label>${candidate.hostel.name}</br>
                                <label for="candidateCity" class="fw-bold">City:</label>${candidate.user.city.name}
        
                                <div class="btn-group mt-2" role="group">
                                    <button type="submit" class="btn btn-info btn-sm suggestionObjectionBtn" data-id=${candidate.id}>Object / Suggest Now</button>
                                    <button type="submit" class="btn btn-success btn-sm viewDetailsBtn" data-id=${candidate.id}>View Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                `;

                modalBodyContent.append(cardHtml);
            });
        }

        // Delegated click event for dynamically created elements
        $("#modalBodyContent").on("click", ".viewDetailsBtn", function (e) {
            e.preventDefault();

            // Get the candidate id from the data attribute
            let viewCandidateId = $(this).data("id");
            var baseUrl = "{{ url('/') }}";
            if( viewCandidateId == null){
                return true
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/client/viewCandidateDetails/"+viewCandidateId,
                    success: function (response) {
                        // resetFields();
                        if(response.status == "invalid"){
                            Swal.fire({
                                icon:'warning',
                                title:'Invalid',
                                text: response.message,
                            });
                        }
                        else{
                            $("#candidateListModal").modal('show');
                            $("#viewCandidateName").text(response.candidate.user.name);
                            $("#viewCandidateMobileNo").text(response.candidate.user.phone_number);
                            let address = response.candidate.user.address+ ", "+response.candidate.user.city.name+ ", "+response.candidate.user.state.name+ ", "
                            $("#viewCandidateAddress").text(address);
                            $("#viewCandidateArea").text(response.candidate.user.area.name);
                            $("#viewCandidateHostelName").text(response.candidate.hostel.name);
                            $("#viewCandidateObjectives").text(response.candidate.objectives);
                            $("#viewElectionCategoryId").text(response.candidate.election_category.name);
                            $("#viewElectionSeatId").text(response.candidate.election_seat.title);
                            $("#viewCandidateStatus").text(response.candidate.status);

                            // Update candidate picture
                            $("#viewCandidateImage").attr("src", baseUrl + "/storage/" +response.candidate.user.picture_path);
                            $("#viewCandidateImage").attr("alt", response.candidate.user.name);
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

        // Add an event listener to the "Object Now" button
        $("#modalBodyContent").on("click", ".suggestionObjectionBtn", function (e) {
            e.preventDefault();
            // Open the Bootstrap modal
            $('#suggestionModal').modal('show');

            // Get the candidate id from the data attribute
            let suggestionCandidateId = $(this).data("id");

            // Set the suggestionCandidateId in the modal input
            $('#suggestionCandidateId').val(suggestionCandidateId);

        });


        
       

    });
</script>
@include('client.nominee-list.nominee-modal-view-button')
@include('client.nominee-list.view-candidate-detials-modal')
@include('client.nominee-list.suggestion-objection-modal')
@endsection
<!-- End: Script Section Starts Here -->

