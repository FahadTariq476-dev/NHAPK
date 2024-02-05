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
                        <a href="#" id="viewCandidateListLink">View Candidate List Here:</a>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form id="formVoteNow" action="#" method="POST">
                                @csrf
                                <!-- Your Name -->
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input type="text" id="yourName" name="yourName" value="{{Auth::user()->name}}" class="form-control" readonly>
                                </div>
                                <!-- Your Cnic -->
                                <div class="form-group">
                                    <label>Your Cnic</label>
                                    <input type="text" id="yourCnic" name="yourCnic" value="{{Auth::user()->cnic_no}}" class="form-control" readonly>
                                </div>
                                
                                <!-- Your Mobile No -->
                                <div class="form-group">
                                    <label>Your Mobile No</label>
                                    <input type="text" id="yourMobileNo" name="yourMobileNo" value="{{Auth::user()->phone_number}}" class="form-control" readonly>
                                </div>

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
                              
                                <!-- Select electionCategories -->
                                <div class="form-group mb-1">
                                    <label for="electionCategoryId">Select Your Election Categories</label>
                                    <select id="electionCategoryId" name="electionCategoryId" class="form-control">
                                        <option value="" selected disabled>Select Election Categories</option>
                                        @if (count($electionCategories)>0)
                                            @foreach ($electionCategories as $electionCategory)
                                                <option value="{{ $electionCategory->id }}" @if (old('electionCategoryId')==$electionCategory->id) selected @endif >{{ $electionCategory->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Election Categories Found</option>
                                        @endif
                                    </select>
                                </div>
                                @error('electionCategoryId')
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
                
                
                // To Check electionCategoryId is empty or Now
                let electionCategoryId = $("#electionCategoryId").val();
                // To Check electionId is empty or Now
                let electionId = $("#electionId").val();
                if (electionCategoryId == null || electionCategoryId.trim() === '') {
                    $("#electionCategoryId").after('<div class="alert alert-danger">Election Category Should be Provided</div>');
                    return true;
                }
                else if (electionId == null || electionId.trim() === '') {
                    $("#electionId").after('<div class="alert alert-danger">Election Should be Provided</div>');
                    return true;
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: "/client/vote/get-candidates/"+electionId+"/"+electionCategoryId,
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
                }

               
            });

            var baseUrl = "{{ url('/') }}";

            // Function to update modal content with candidate details
            function updateModalContent(candidates) {
                var modalBodyContent = $("#modalBodyContent");

                // Clear existing content
                modalBodyContent.empty();

                // Loop through candidates and append card for each candidate
                candidates.forEach(function (candidate) {
                    var cardHtml = `
                        <div class="card" style="width: 18rem;">
                            <form action="/client/vote/save" method="POST">
                                @csrf
                                <input type="hidden" name="candidateId" id="candidateId" value="${candidate.id}" readonly/>
                                <input type="hidden" name="candidateElectionId" id="candidateElectionId" value="${candidate.electionId}" readonly/>
                                <input type="hidden" name="candidateElectionCategoryId" id="candidateElectionCategoryId" value="${candidate.electionCategoryId}" readonly/>
                                <img src="${baseUrl}/storage/${candidate.user.picture_path}" class="card-img-top" alt="${candidate.user.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${candidate.user.name}</h5>
                                    <button type="submit" class="btn btn-success">Vote Now</button>
                                </div>
                            </form>
                        </div>
                    `;

                    modalBodyContent.append(cardHtml);
                });
            }

        });

        
    </script>
    
    @include('client.vote.view-candidate-detials-modal')
    @include('client.vote.show-candidate-image-for-vote')
@endsection
<!-- End: Script Section Starts Here -->

