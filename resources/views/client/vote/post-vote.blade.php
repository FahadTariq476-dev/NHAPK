@extends('client.layouts.master')
@section('title','Votes - Vote Now')

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
                            <h2 class="content-header-title float-start mb-0">Vote</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('client.dashboard.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Menus</a></li>
                                    <li class="breadcrumb-item"><a href="#">Vote</a></li>
                                    <li class="breadcrumb-item active">Vote Now</li>
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
                        <h4 class="card-title">Vote Now</h4>
                        <a href="{{route('client.NominationList.list')}}" id="viewCandidateList">View Candidate List Here:</a>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form id="formVoteNow" action="#" method="POST">
                                @csrf
                                <!-- Select elections -->
                                <div class="form-group">
                                    <label for="electionId">Select Your Election</label>
                                    <select id="electionId" name="electionId" class="form-control">
                                        <option value="" selected disabled>Select Election</option>
                                        @if (count($elections)>0)
                                            @foreach ($elections as $election)
                                                <option value="{{ $election->id }}" @if (old('electionId')==$election->id) selected @endif >{{ $election->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Election Found</option>
                                        @endif
                                    </select>
                                </div>
                                @error('electionId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                              
                                <!-- Actions Button -->
                                <div class="form-group">
                                    <button type="reset" class="btn btn-primary" id="btnReset">Reset</button>
                                    <button type="submit" class="btn btn-success" id="btnSubmit">Select Candidate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End: Kick start -->

                <!-- Candidate Details Card (Initially Hidden) -->
                <div class="card" id="candidateDetailsCard" style="display: none;">
                    <div class="card-container d-flex flex-row">
                        <!-- Candidate details will be appended here -->
                    </div>
                </div>


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
             // Form validation
             $("#btnSubmit").click(function (e) { 
                // Remove any existing error messages
                e.preventDefault();
                $(".alert").remove();
                
                // To Check electionId is empty or Now
                let electionId = $("#electionId").val();
                if (electionId == null || electionId.trim() === '') {
                    $("#electionId").after('<div class="alert alert-danger">Election Should be Provided</div>');
                    return true;
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: "/client/vote/get-candidates/"+electionId,
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
                                // Clear previous candidate details
                                resetCandidateDetails();
                                

                                // Iterate through each candidate and update details
                                $.each(response.candidatesForVote, function(index, candidate) {
                                    updateCandidateDetails(candidate);
                                });// Show the candidate details card
                                 $('#candidateDetailsCard').show();
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
                }

               
            });

            function resetCandidateDetails() {
                // Clear previous candidate details
                $('#candidateDetailsCard').hide();
                $('#candidateName').empty();
                $('#candidateArea').empty();
                $('#candidatePicture').attr('src', '');
            }

            var baseUrl = "{{ url('/') }}";
            function updateCandidateDetails(candidate) {
                // Create a new candidate card
                var candidateCard = $('<div class="card mr-2 col-md-3" style="border: solid;">'); // Adding mr-2 for some margin between cards
                candidateCard.append(
                    '<div class="card-header"><h4 class="card-title">' + candidate.user.name + '</h4></div>'
                );
                candidateCard.append(
                    '<form action="/client/vote/save" method="POST">@csrf'+
                        '<input type="hidden" name="candidateId" id="candidateId" value="'+candidate.id+'" readonly/>'+
                        '<input type="hidden" name="candidateElectionId" id="candidateElectionId" value="'+candidate.electionId+'" readonly/>'+
                        '<input type="hidden" name="candidateElectionCategoryId" id="candidateElectionCategoryId" value="'+candidate.electionCategoryId+'" readonly/>'+
                        '<div class="card-body">' +
                            '<div class="row">' +
                                '<div class="col-md-12"><img src="' +
                                    baseUrl + "/storage/" + candidate.user.picture_path +
                                    '" alt="' + candidate.user.name + '" class="img-fluid">' +
                                '</div>' +
                                '<div class="col-md-12"><strong>Area:</strong> ' +
                                    candidate.user.area.name +
                                '</br><strong>Election Seat:</strong> ' +
                                    candidate.election_seat.title +
                                '<button type="submit" class="btn btn-success">Vote Now</button>' +
                                '</div>' +
                            '</div>' +
                        '</div>'+
                    '</form>'
                );

                // Append the new candidate card to the card-container
                $('#candidateDetailsCard .card-container').append(candidateCard);
                // Show the candidate details card
                $('#candidateDetailsCard').show();
            }


            // // Function to update modal content with candidate details
            // function updateModalContent(candidates) {
            //     var modalBodyContent = $("#modalBodyContent");

            //     // Clear existing content
            //     modalBodyContent.empty();

            //     // Loop through candidates and append card for each candidate
            //     candidates.forEach(function (candidate) {
            //         var cardHtml = `
            //             <div class="card" style="width: 18rem;">
            //                 <form action="/client/vote/save" method="POST">
            //                     @csrf
            //                     <input type="hidden" name="candidateId" id="candidateId" value="${candidate.id}" readonly/>
            //                     <input type="hidden" name="candidateElectionId" id="candidateElectionId" value="${candidate.electionId}" readonly/>
            //                     <input type="hidden" name="candidateElectionCategoryId" id="candidateElectionCategoryId" value="${candidate.electionCategoryId}" readonly/>
            //                     <img src="${baseUrl}/storage/${candidate.user.picture_path}" class="card-img-top" alt="${candidate.user.name}">
            //                     <div class="card-body">
            //                         <h5 class="card-title">${candidate.user.name}</h5>
            //                         <button type="submit" class="btn btn-success">Vote Now</button>
            //                     </div>
            //                 </form>
            //             </div>
            //         `;

            //         modalBodyContent.append(cardHtml);
            //     });
            // }

        });

        
    </script>
    
    {{-- @include('client.vote.view-candidate-detials-modal') --}}
    @include('client.vote.show-candidate-image-for-vote')
@endsection
<!-- End: Script Section Starts Here -->

