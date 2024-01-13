@extends('client.layouts.master')
@section('title','Your title here')

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
                            <h2 class="content-header-title float-start mb-0">View Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.dashboard.index') }}">Profile</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        View Profile
                                    </li>
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
                        <h4 class="card-title">Account Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form action="{{ route('client.updateProfile') }}" method="POST" enctype="multipart/form-data" id="formUpdateProfile">
                                @csrf
                                <!-- First Name -->
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="{{$users->firstname}}" placeholder="Enter Your First Name Here:" minlength="3" maxlength="255" autofocus/>
                                </div>
                                @error('firstName')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                
                                <!-- Last Name -->
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $users->lastname}}" placeholder="Enter Your Last Name Here:" minlength="3" maxlength="255" autofocus/>
                                </div>
                                @error('lastName')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                
                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $users->phone_number}}" placeholder="Enter Your Phone Number Here:" readonly/>
                                </div>
                                @error('phoneNumber')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror

                                <!-- Short Description -->
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea rows="3" class="form-control" id="shortDescription" name="shortDescription" autofocus>{{$users->short_description }}</textarea>
                                </div>
                                @error('shortDescription')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror

                                <!-- Email -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="userEmail" name="userEmail" value="{{ $users->email}}" placeholder="Enter Your Email Here:" readonly/>
                                </div>
                                @error('userEmail')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                
                                <!-- User CNIC No -->
                                <div class="form-group">
                                    <label>Cnic No</label>
                                    <input type="text" class="form-control" id="userCnicNo" name="userCnicNo" value="{{ $users->cnic_no}}" placeholder="Enter Your Cnic No Here:" readonly/>
                                </div>
                                @error('userCnicNo')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                
                                <!-- User Addres -->
                                <div class="form-group">
                                    <label>Addres</label>
                                    <input type="text" class="form-control" id="userAddress" name="userAddress" value="{{ $users->address}}" placeholder="Enter Your Address Here:" autofocus/>
                                </div>
                                @error('userAddress')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                
                                <!-- User Date of Birth -->
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" id="userDob" name="userDob" value="{{ \Carbon\Carbon::parse($users->date_of_birth)->format('Y-m-d') }}" autofocus />
                                </div>
                                @error('userDob')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                
                                <!-- User Profile Image -->
                                <div class="form-group">
                                    <label>Profile Image</label>
                                    <input type="file" class="form-control" id="userProfileImage" name="userProfileImage" accept="image/*" />
                                </div>
                                @error('userProfileImage')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror

                                <!-- Display existing profile image if available -->
                                @if ($users->picture_path)
                                <div class="form-group">
                                    <label>Current Profile Image</label>
                                    <img src="{{ Storage::url($users->picture_path) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 100%; height: 200px;"/>
                                </div>
                                @endif

                                <div class="form-group">
                                    <button type="submit" class="button btn-primary" id="btnSubmit">Submit</button>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnSubmit").click(function (e) { 
                $(".alert-danger").remove();
                 
                //  To Check first name is empty or not
                let firstName = $("#firstName").val();
                if(firstName.trim()=== '' || firstName == null || firstName.length <3 || firstName.length>3255){
                    e.preventDefault();
                    $("#firstName").after('<div class="alert alert-danger">First Name Should be Provided.</div>');
                }
                
                //  To Check last name is empty or not
                let lastName = $("#lastName").val();
                if(lastName.trim()=== '' || lastName == null || lastName.length <3 || lastName.length>3255){
                    e.preventDefault();
                    $("#lastName").after('<div class="alert alert-danger">Last Name Should be Provided.</div>');
                }
                
                //  To Check shortDescription  is empty or not
                let shortDescription = $("#shortDescription").val();
                if(shortDescription.trim()=== '' || shortDescription == null || shortDescription.length <3 || shortDescription.length>3255){
                    e.preventDefault();
                    $("#shortDescription").after('<div class="alert alert-danger">Short Description Should be Provided.</div>');
                }
                
                //  To Check userAddress  is empty or not
                let userAddress = $("#userAddress").val();
                if(userAddress.trim()=== '' || userAddress == null || userAddress.length <3 || userAddress.length>3255){
                    e.preventDefault();
                    $("#userAddress").after('<div class="alert alert-danger">Address Should be Provided.</div>');
                }
                
                //  To Check userDob  is empty or not
                let userDob = $("#userDob").val();
                if(userDob.trim()=== '' || userDob == null ){
                    e.preventDefault();
                    $("#userDob").after('<div class="alert alert-danger">Date of Birth Should be Provided.</div>');
                }

                 // Check the file userProfileImage
                 let imageInput = $('#userProfileImage')[0];

                if (imageInput.files.length === 1) {
                    // Check file extension
                    let allowedExtensions = ['png', 'jpg', 'jpeg'];
                    let fileName = imageInput.files[0].name;
                    let fileExtension = fileName.split('.').pop().toLowerCase();

                    if (!allowedExtensions.includes(fileExtension)) {
                        e.preventDefault();
                        $("#userProfileImage").after('<div class="alert alert-danger">Please select a file with a valid extension (PNG, JPG, JPEG).</div>');
                    }

                    // Check file size
                    let maxSize = 2 * 1024 * 1024; // 2 MB in bytes
                    if (imageInput.files[0].size > maxSize) {
                        e.preventDefault();
                        $("#userProfileImage").after('<div class="alert alert-danger">File size should not exceed 2 MB.</div>');
                    }
                }
            });
        });
    </script>
@endsection
<!-- End: Script Section Starts Here -->

