@extends('client.layouts.master')
@section('title','Election Nomination - View')

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
                                    <li class="breadcrumb-item active">View Election Nomination</li>
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
                        <h4 class="card-title">View Nomination</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                           <form id="formApplyElectionNomination" action="#" method="GET">
                                @csrf
                                <!-- Select elections -->
                                <div class="form-group mb-1">
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
            $("#btnSubmit").click(function (e) { 
                e.preventDefault();
                let electionId = $("#electionId").val();
                if(electionId == null || electionId.trim() === '' || electionId.length== 0){
                    e.preventDefault();
                    $("#electionId").after('<div class="alert alert-danger">Election Should be Provided.</div>');
                    return false;
                }
                else{
                    var baseUrl = "{{ url('/') }}";
                    $.ajax({
                        type: "GET",
                        url: "/client/election/nomination/view/details/"+electionId,
                        success: function (response) {
                            // resetFields();
                            if(response.status == "invalid"){
                                Swal.fire({
                                    icon:'warning',
                                    title:'Invalid',
                                    text: response.message,
                                });
                            }
                            else if (response.status == "success"){
                                $("#candidateListModal").modal('show');
                                $("#viewCandidateName").text(response.candidate.user.name);
                                $("#viewCandidateMobileNo").text(response.candidate.user.phone_number);
                                let address = response.candidate.user.address+ ", "+response.candidate.user.city.name+ ", "+response.candidate.user.state.name+ ", "
                                $("#viewCandidateAddress").text(address);
                                $("#viewCandidateArea").text(response.candidate.user.area.name);
                                $("#viewCandidateDescription").text(response.candidate.user.short_description);
                                $("#viewCandidateHsotelName").text(response.candidate.hostel.name);
                                $("#viewCandidateObjectives").text(response.candidate.objectives);
                                $("#viewElectionCategoryId").text(response.candidate.election_category.name);
                                $("#viewElectionSeat").text(response.candidate.election_seat.title);
                                $("#viewCandidateStatus").text(response.candidate.status);
                                $("#viewCandidateReferal").text(response.candidate.referralCount);
                                $("#viewCandidateStars").text(response.candidate.stars);

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
        });
    </script>

    @include('client.election-nomination.view-nomination-modal')
@endsection
<!-- End: Script Section Starts Here -->

