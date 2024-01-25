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
                           <form id="formApplyElectionNomination" action="#" method="POST" enctype="multipart/form-data">
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
                                
                                <!-- Select State -->
                                <div class="form-group">
                                    <label for="stateId">State</label>
                                    <input type="text" id="stateId" name="stateId" value="{{$stateName}}" class="form-control" readonly>
                                </div>
                                
                                <!-- Select City -->
                                <div class="form-group">
                                    <label for="cityId">City</label>
                                    <input type="text" id="cityId" name="cityId" value="{{$cityName}}" class="form-control" readonly>
                                </div>

                                <!-- Select electionCategory -->
                                <div class="form-group">
                                    <label for="electionCategoryId">Election Category</label>
                                    <input type="text" id="electionCategoryId" name="electionCategoryId" value="{{$electionCategoryName}}" class="form-control" readonly>
                                </div>
                                
                                <!-- Select elections -->
                                <div class="form-group">
                                    <label for="electionId">Election</label>
                                    <input type="text" id="electionId" name="electionId" value="{{$electionName}}" class="form-control" readonly>
                                </div>
                                
                                <!-- Nomination File Status -->
                                <div class="form-group">
                                    <label for="electionId">Status</label>
                                    <input type="text" id="status" name="status" value="{{$candidate->status}}" class="form-control" readonly>
                                </div>
                                
                                
                                <!-- Number of Refferals -->
                                <div class="form-group">
                                    <label for="electionId">Number of Refferals</label>
                                    <input type="text" id="status" name="status" value="{{$candidate->referralCount}}" class="form-control" readonly>
                                </div>
                                
                                <!-- Starts -->
                                <div class="form-group">
                                    <label for="electionId">Stars</label>
                                    <input type="text" id="status" name="status" value="{{$candidate->stars}}" class="form-control" readonly>
                                </div>


                                {{-- <!--Select File -->
                                <div class="form-group">
                                    <label for="candidateFile">File</label>
                                    <img src="{{Storage::url($candidate->file)}}">
                                    <a href="{{Storage::url($candidate->file)}}">Click Here to View The File</a>
                                    <input type="text" id="countryId" name="countryId" value="{{Storage::url($candidate->file)}}" class="form-control" readonly>
                                </div> --}}

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


@endsection
<!-- End: Script Section Starts Here -->

