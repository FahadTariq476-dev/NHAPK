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
                            <h2 class="content-header-title float-start mb-0">Edit Complaint Types</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ListComplaintView')}}">Complaints</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.complaint-types.index')}}">Complaint Types</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.complaint-types.list')}}">List Complaint Types</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Complaint Types</li>
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
                    <div class="container" style="color: black;">
                        <form class="blog-form" id="complaint_typesForm" action="{{route('admin.complaint-types.update')}}" method="POST">
                          <h2 class="text-center mb-4">Edit Complaint Types</h2>
                          @if(session('success'))
                            <script>
                              Swal.fire({
                                title: 'Success!',
                                text: "{{ session('success') }}",
                                icon: 'success'
                              });
                            </script>
                          @endif
                          @if(session('error'))
                            <script>
                              Swal.fire({
                                title: 'Error!',
                                text: "{{ session('error') }}",
                                icon: 'error'
                              });
                            </script>
                          @endif
                          <!-- Your form fields here -->
                          @csrf
                          <input type="hidden" id="complaint_types_id" name="complaint_types_id" value="{{$complaint_types->id}}" readonly>
                      
                          <div class="form-group mb-1">
                            <label for="name">Complaint Types Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $complaint_types->name }}" placeholder="Enter the name">
                          </div>
                          @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      
                          <div class="form-group mb-1">
                            <label for="description">Complaint Types Description:</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $complaint_types->description }}" maxlength="65535" placeholder="Enter a description here">
                          </div>
                          @error('description')
                            <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <button type="submit" class="btn btn-primary btn-block">Update Complaint Types</button>
                        </form>
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
      <script>
        $(document).ready(function () {
          // Form validation logic
          $("#complaint_typesForm").submit(function (e) {
            // Reset previous error messages
            $(".alert-danger").remove();
            
            // Check if the name is empty
            var name = $("#name").val();
            if (name.trim() === "") {
              e.preventDefault();
              $("#name").after('<div class="alert alert-danger">Name is required.</div>');
            }
          
            //  Check if the description is empty
            var description = $("#description").val();
            if (description.trim() === "" || description.length > 65535) {
              e.preventDefault();
              $("#description").after('<div class="alert alert-danger">Valid Description is required.</div>');
            }
        
          });
        });
      </script>
  
    @endsection