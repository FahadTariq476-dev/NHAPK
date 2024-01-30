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
                        <h4 class="card-title">Kick start your next project 🚀</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form action="#" method="POST">
                                <!-- Select Candidate -->
                                <div class="form-group mb-1">
                                    <label for="viewCandidateId">Select Your Candidate</label>
                                    <select id="viewCandidateId" name="viewCandidateId" class="form-control">
                                        <option value="" selected disabled>Select Candidate</option>
                                        @if (count($candidates)>0)
                                        @foreach ($candidates as $candidate)
                                            <option value="{{ $candidate->id }}">
                                                {{ $candidate->user->name }}
                                            </option>
                                        @endforeach
                                        @else
                                            <option value="" disabled>No Candidate Found</option>
                                        @endif
                                    </select>
                                </div>
                                <!-- Candidate Details -->
                                <div style="display: none" id="candidateDetailsDiv">
                                    <!-- Candidate Picture-->
                                    <div class="form-group">
                                        <label for="viewCandidateImage">Candidate Picture</label><br>
                                        <img class="round" id="viewCandidateImage" name="viewCandidateImage" src="" alt="avatar" height="140" width="140">
                                    </div>
            
                                    <!-- Candidate Cnic -->
                                    <div class="form-group">
                                        <label for="viewCandidateCnic">Candidate Cnic</label>
                                        <input type="text" id="viewCandidateCnic" name="viewCandidateCnic" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Candidate Mobile No -->
                                    <div class="form-group">
                                        <label for="viewCandidateMobileNo">Candidate Mobile No</label>
                                        <input type="text" id="viewCandidateMobileNo" name="viewCandidateMobileNo" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Candidate Country-->
                                    <div class="form-group">
                                        <label for="viewCandidateCountryName">Candidate Country</label>
                                        <input type="text" id="viewCandidateCountryName" name="viewCandidateCountryName" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Candidate State-->
                                    <div class="form-group">
                                        <label for="viewCandidateStateName">Candidate State</label>
                                        <input type="text" id="viewCandidateStateName" name="viewCandidateStateName" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Candidate City-->
                                    <div class="form-group">
                                        <label for="viewCandidateCityName">Candidate City</label>
                                        <input type="text" id="viewCandidateCityName" name="viewCandidateCityName" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Candidate Address-->
                                    <div class="form-group">
                                        <label for="viewCandidateAddress">Candidate Address</label>
                                        <input type="text" id="viewCandidateAddress" name="viewCandidateAddress" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Candidate Description-->
                                    <div class="form-group">
                                        <label for="viewCandidateDescription">Candidate Description</label>
                                        <textarea id="viewCandidateDescription" name="viewCandidateDescription" class="form-control" readonly></textarea>
                                    </div>
            
                                    <!-- Select electionCategory -->
                                    <div class="form-group">
                                        <label for="viewElectionCategoryId">Election Category</label>
                                        <input type="text" id="viewElectionCategoryId" name="viewElectionCategoryId" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Select elections -->
                                    <div class="form-group mb-1">
                                        <label for="viewElectionId">Election</label>
                                        <input type="text" id="viewElectionId" name="viewElectionId" value="" class="form-control" readonly>
                                    </div>
                                    
                                    <!-- Actions Button -->
                                    <div class="form-group mb-1">
                                        <button type="button" class="btn btn-warning" id="objectionBtn">Objection</button>
                                        <button type="button" class="btn btn-success" id="suggestionBtn">Suggest</button>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="reset" class="btn btn-info" id="resetBtn">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End: Kick start -->

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> Use this layout to set menu (navigation) default collapsed. Please check the&nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-collapsed-menu.html" target="_blank">Layout collapsed menu documentation</a>&nbsp; for more details.
                            </div>
                        </div>
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
<script>
    $(document).ready(function () {

        function resetFields(){
            $("#candidateDetailsDiv").hide();
            $("#viewCandidateCnic").val('');
            $("#viewCandidateMobileNo").val('');
            $("#viewCandidateCountryName").val('');
            $("#viewCandidateStateName").val('');
            $("#viewCandidateCityName").val('');
            $("#viewCandidateAddress").val('');
            $("#viewCandidateDescription").val('');
            $("#viewElectionCategoryId").val('');
            $("#viewElectionId").val('');

            // Update candidate picture
            $("#viewCandidateImage").attr("src", "");
            $("#viewCandidateImage").attr("alt", "avtar");
        }
        $("#resetBtn").click(function () { 
            resetFields();
        });
        
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
                            $("#candidateDetailsDiv").show();
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

    });
</script>
@endsection
<!-- End: Script Section Starts Here -->

