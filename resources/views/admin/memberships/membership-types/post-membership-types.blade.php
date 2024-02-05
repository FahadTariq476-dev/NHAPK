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
                            <h2 class="content-header-title float-start mb-0">Add Membership Types</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.list-memebership')}}">Membership</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.membership.membershipTypes.list')}}">Membership Types</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add Membership Types</li>
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
                        <form class="blog-form" id="membershipTypesFrom" action="{{route('admin.membership.membershipTypes.store')}}" method="POST">
                          <h2 class="text-center mb-2">Membership Types Entry</h2>
                          @csrf
                      
                          <div class="form-group mb-1">
                            <label for="name">Membership Types Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter the name">
                          </div>
                          @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      
                          <div class="form-group mb-1">
                            <label for="description">Membership Types Description:</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}" maxlength="65535" placeholder="Enter a description here">
                          </div>
                          @error('description')
                            <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                          
                          <div class="form-group mb-1">
                            <label for="description">Select Role of Membership Types:</label>
                            <select class="form-control" id="membershipRoleId" name="membershipRoleId">
                              <option  value="" selected disabled>Select Role of a Membership</option>
                              @if (count($roles)>0)
                                @foreach ($roles as $role)
                                  <option value="{{$role->id}}" @if (old('membershipRoleId')==$role->id) selected @endif>{{$role->name}}</option>
                                @endforeach
                              @else
                                <option value="" disabled>No Role Found</option>
                              @endif
                            </select>
                          </div>
                          @error('membershipRoleId')
                            <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <button type="reset" class="btn btn-primary btn-block">Reset</button>
                          <button type="submit" class="btn btn-success btn-block">Save</button>
                        </form>
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
            $("#membershipTypesFrom").submit(function (e) {
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
              
              //  Check if the membershipRoleId is empty
              var membershipRoleId = $("#membershipRoleId").val();
              if (membershipRoleId == null || membershipRoleId.trim() === "") {
                e.preventDefault();
                $("#membershipRoleId").after('<div class="alert alert-danger">Select The Memmbership Role</div>');
              }
              
          
            });

            // check the Member ship type name is unique or not
            $("#name").focusout(function(){
              let name = $("#name").val();
              $(".alert-danger").remove();
              if(name.length==0 || name.length<3){
                return;
              }
              else if(name.length>255)
              {
                $("#name").after('<div class="alert alert-danger">Name Length Should not be greater than 255.</div>');
                $("#name").focus();
              }
              else{
                $.ajax({
                  url:'/admin/memberships/membership-types/unique-name/'+name,
                  type:'GET',
                  success:function(response){
                    if(response.status==1){
                      $("#name").after('<div class="alert alert-danger">'+response.message+'</div>');
                      $("#name").focus();
                    }
                  },
                  error:function(error){
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred: ' + error.responseJSON.message,
                    });
                  },
                });
              }
            });

        });
      </script>
  
    @endsection