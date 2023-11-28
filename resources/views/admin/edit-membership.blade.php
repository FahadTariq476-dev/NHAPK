@extends('admin.layouts.main')
@section('main-container')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Edits Membership</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menu</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.list-memebership')}}">Membership</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.list-memebership')}}">List Memebrship</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Membership</li>
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

                <div class="row">
                    <div class="container">
                      <!-- Membership Registration Form -->
                      <form method="POST" action="/addMembership" id="membership">
                        @csrf
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter your name here:">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- CNIC -->
                        <div class="form-group">
                            <label for="cnic">CNIC:</label>
                            <input type="text" class="form-control" id="cnic" name="cnic" value="{{old('cnic')}}" placeholder="Enter your cnic here:">
                        </div>
                        <div class="cnicverify">
                            {{-- Here we show the error if cnic exsit on focusout --}}
                        </div>
                        @error('cnic')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Membership Type -->
                        <div class="form-group">
                            <label for="membershipType">Membership Type:</label>
                            <select class="form-control" id="membershiptype_id" name="membershiptype_id">
                                <option value="" selected disabled>Select Membership</option>
                                {{-- @if (count($membershipTypes)>0)
                                    @foreach($membershipTypes as $membershipType)
                                        <option value="{{ $membershipType->id }}" @if (old('membershiptype_id')==$membershipType->id) selected @endif >
                                            {{ $membershipType->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No Membership Found</option>
                                @endif --}}
                            </select>
                        </div>
                        @error('membershiptype_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Country -->
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select class="form-control" id="country_id" name="country_id">
                                <option value="" selected disabled>Select Country</option>
                                {{-- @if (count($countries)>0)
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if (old('country_id')==$country->id) selected @endif >
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No Country Found</option>
                                @endif --}}
                            </select>
                        </div>
                        @error('country_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- State -->
                        <div class="form-group">
                            <label for="state">State:</label>
                            <select class="form-control" id="states_id" name="states_id">
                                <option value="" selected disabled>Select State</option>
                            </select>
                        </div>
                        @error('states_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <!-- City -->
                        <div class="form-group">
                            <label for="city">City:</label>
                            <select class="form-control" id="city_id" name="city_id">
                                <option value="" selected disabled>Select City</option>
                            </select>
                        </div>
                        @error('city_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Hostel Registration Number -->
                        <div class="form-group">
                            <label for="hostelRegNo">Hostel:</label>
                            <select class="form-control" id="hostelreg_no" name="hostelreg_no">
                                <option value="" selected disabled>Select Hostel</option>
                            </select>
                        </div>
                        @error('hostelreg_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Link to Add New Hostel If Hostel Not Found -->
                        <div class="form-group">
                            <div class="" >
                                <a href="{{route('saveHostelForm')}}" target="_blank">If not found Add Your Hostel</a>
                            </div>
                        </div>
    
                        <!-- Referral CNIC -->
                        <div class="form-group">
                            <label for="referralCNIC">Referral CNIC:</label>
                            <input type="text" class="form-control" id="referal_cnic" name="referal_cnic" value="{{old('referal_cnic')}}" placeholder="Enter referral cnic here:">
                        </div>
                        @error('referal_cnic')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Transaction Number -->
                        <div class="form-group">
                            <label for="transactionNo">Transaction Number:</label>
                            <input type="text" class="form-control" id="transaction_no" name="transaction_no" value="{{old('transaction_no')}}" placeholder="Enter your transaction number here:">
                        </div>
                        <div id="verify_transaction_no">
                            {{-- Here we show the error if transaction id exsit on focusout --}}
                        </div>
                        @error('transaction_no')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Gender -->
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="" disabled @if (old('gender')=="") selected @endif>Select Gender</option>
                                <option value="male" @if (old('gender')=="male") selected @endif>Male</option>
                                <option value="female" @if (old('gender')=="female") selected @endif>Female</option>
                            </select>
                        </div>
                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Since -->
                        <div class="form-group">
                            <label for="since">Since:</label>
                            <input type="date" class="form-control" id="since" value="{{old('since')}}" name="since">
                            <small class="form-text text-muted">Living Since</small>
                        </div>
    
                        <!-- Previous Hostel -->
                        <div class="form-group">
                            <label for="previousHostel">Previous Hostel:</label>
                            <input type="text" class="form-control" id="previous_hostel" name="previous_hostel" value="{{old('previous_hostel')}}" placeholder="Enter your previous hostel registration number here: [Optional]">
                        </div> 
                        
                         <!-- Agree Terms & COndition -->
                        <div class="form-group">
                            <input type="checkbox" id="terms" name="terms" @if (old('terms')) checked @endif >
                            <a href="https://www.termsfeed.com/terms-conditions/f18d6159c88d21b6c392878b73562e24" target="_blank()">
                                Are You Agree with Terms & Conditions
                            </a>
                        </div> 
                        @error('terms')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <!-- Reset Button -->
                        <button type="reset" class="btn btn-warning">Reset</button> 
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                        {{-- <form class="blog-form" id="blogForm" action="#" method="POST" enctype="multipart/form-data">
                          <h2 class="text-center mb-4">Edit Blog</h2>
                          @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                          <!-- Your form fields here -->
                          @csrf
                          <input type="text" name="id" value="{{ $memberships->id }}">
                      
                          <div class="form-group">
                            <label for="title">Blog Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $memberships->title }}" placeholder="Enter the title">
                          </div>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                      
                          <div class="form-group">
                            <label for="shortDescription">Short Description:</label>
                            <input type="text" class="form-control" id="shortDescription" name="shortDescription" value="{{ $memberships->short_description }}" maxlength="255" placeholder="Enter a short description">
                          </div>
                          @error('shortDescription')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="editor">Editor:</label>
                            <textarea id="editor" name="editor" class="form-control">{{ $memberships->editor_content }}</textarea>
                          </div>
                          @error('editor')
                            <div class="alert alert-danger">{{$message}}</div>
                          @enderror

                          <div class="form-group">
                            <label for="image">Blog Image:</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            @if ($memberships->image_path)
                            <img src="{{ asset($memberships->image_path) }}" alt="{{ asset('no-image-icon.png') }}" id="image-preview" class="img-fluid mt-2" style="max-height: 200px;">
                            <span id="image-name">{{ $memberships->image_path }}</span>
                            @else
                            <img src="{{ asset('no-image-icon.png') }}" alt="{{ asset('no-image-icon.png') }}" id="image-preview" class="img-fluid mt-2" style="max-height: 200px; display: none;">
                            <span id="image-name">Image is not saved.</span>
                            @endif
                          </div>
                          @error('image')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                          

                          <div class="form-group">
                            <label for="thumbnailImage">Thumbnail Image:</label>
                            <input type="file" class="form-control-file" id="thumbnailImage" name="thumbnailImage" accept="image/*">
                            @if ($memberships->image_path)
                            <img src="{{ asset($memberships->thumbnail_image_path) }}" alt="{{ asset('no-image-icon.png') }}" id="image-preview" class="img-fluid mt-2" style="max-height: 200px;">
                            <span id="image-name">{{ $memberships->thumbnail_image_path }}</span>
                            @else
                            <img src="{{ asset('no-image-icon.png') }}" alt="{{ asset('no-image-icon.png') }}" id="image-preview" class="img-fluid mt-2" style="max-height: 200px; display: none;">
                            <span id="image-name">Image is not saved.</span>
                            @endif
                          </div>
                          @error('thumbnailImage')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="featuredPost" name="featuredPost" @if($memberships->featured_post) checked @endif>
                            <label class="form-check-label" for="featuredPost">Mark as Featured Post</label>
                          </div>
                          @error('featuredPost')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" disabled @if($memberships->status) selected @endif>Select Status</option>
                              <option value="pending" @if($memberships->status) selected @endif>Pending</option>
                              <option value="published" @if($memberships->status) selected @endif>Published</option>
                            </select>
                          </div>
                          @error('status')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <button type="submit" class="btn btn-primary btn-block">Update Blog</button>
                        </form> --}}
                      </div>
                </div>
                <br>
                <br>

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> Please check the&nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-full.html" target="_blank">Layout full documentation</a>&nbsp; for more details.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @endsection
    @section('js')
    <!-- Include a rich text editor library, for example, TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/YOUR-TINYMCE-API-KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: '#editor'
          // Add any additional configuration for the editor if needed
        });
      </script>

    <!-- Add this at the end of your file, after including jQuery -->
<script>
    $(document).ready(function () {
      // Form validation logic
      $("#blogForm").submit(function (e) {
        // Reset previous error messages
        $(".alert-danger").remove();
  
        // Check if the title is empty
        var title = $("#title").val();
        if (title.trim() === "") {
          e.preventDefault();
          $("#title").after('<div class="alert alert-danger">Title is required.</div>');
        }
  
        // Check if the short description is empty
        var shortDescription = $("#shortDescription").val();
        if (shortDescription.trim() === "" || shortDescription.length > 255) {
          e.preventDefault();
          $("#shortDescription").after('<div class="alert alert-danger">Short Description is required and Short description Length should not be greater than 255 chraceters.</div>');
        }
  
        // Check if the editor content is empty (assuming you want it to be required)
        var editorContent = tinymce.get('editor').getContent();
        if (editorContent.trim() === "") {
          e.preventDefault();
          $("#editor").after('<div class="alert alert-danger">Editor content is required.</div>');
        }

        
        // Check if an image is selected
        var image = $("#image")[0].files[0];
        if (!image) {
          // Check image size
          if (image.size > 2 * 1024 * 1024) { // 2MB in bytes
            e.preventDefault();
            $("#image").after('<div class="alert alert-danger">Image size should not be greater than 2MB.</div>');
          }
  
          // Check image extension
          var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPEG|\.JPG|\.PNG)$/i;
          if (!allowedExtensions.exec(image.name)) {
            e.preventDefault();
            $("#image").after('<div class="alert alert-danger">Invalid image file type. Allowed types: jpg, jpeg, png, JPEG, JPG, PNG.</div>');
          }
        } 

        //  Check then thumbnail image
        var thumbnailImage = $('#thumbnailImage')[0].files[0];
        if(!thumbnailImage){
            // Check the thumbnailImage size
            if(thumbnailImage.size>2 * 1024 * 1024){    // 2MB in sise
                e.preventDefault();
                $('#thumbnailImage').after('<div class="alert alert-danger">Image-thumbnail size should not be greater than 2MB.</div>');
            }
            // Check the image extension
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPEG|\.JPG|\.PNG)$/i;
            if(!allowedExtensions.exec(thumbnailImage.name)){
                e.preventDefault();
                $('#thumbnailImage').after('<div class="alert alert-danger">Invalid image file type. Allowed types: jpg, jpeg, png, JPEG, JPG, PNG.</div>');
            }
        }
  
        // Check if the status is selected
        var status = $("#status").val();
        if (status === null || status === "") {
          e.preventDefault();
          $("#status").after('<div class="alert alert-danger">Status is required</div>');
        }
      });
    });
  </script>
  
    @endsection