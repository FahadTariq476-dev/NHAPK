@extends('admin.layouts.main')
@section('main-container')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Home</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Elections</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.electionCategeories.index')}}">Elections Category</a></li>
                                    <li class="breadcrumb-item active">Elections Category Post</li>
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


                <!-- Page layout -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">New Election Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <!-- Form to Save Election Category -->
                            <form id="formElectionCategory" method="POST" action="{{route('admin.electionCategeories.store')}}">
                                @csrf
                                <!-- Election Category Name -->
                                <div class="form-group mb-2">
                                    <label>Election Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" minlength="3" value="{{old('name')}}" maxlength="255" placeholder="Election Category Name Here:" autofocus />
                                </div>
                                
                                <!-- Election Category Description -->
                                <div class="form-group mb-2">
                                    <label>Election Category Description</label>
                                    <textarea class="form-control" id="description" name="description" minlength="3" maxlength="255" placeholder="Election Category Description Here:" autofocus>{{old('name')}}</textarea>
                                </div>

                                <!-- Action Button -->
                                <div class="form-group">
                                    <button type="reset" class="btn btn-primary" id="btnReset">Reset</button>
                                    <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/ Page layout -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @endsection

    @section('js')
        <script type="text/javascript">
            $(document).ready(function () {
                
                // Function to check that Category Name is unique or Not
                function checkUniqueName(name) {
                    $.ajax({
                        type: "GET",
                        url: "/admin/election/category/unique-name/"+name,
                        success: function (response) {
                            if(response.status == 1){
                                $("#name").after('<div class="alert alert-danger" id="alertDanegerName">Election Category Name Should be unique.</div>');
                                $("#name").focus();
                                $("#name").val();
                                return true;
                            }
                            else{
                                return false;
                            }
                        },
                        error:function (error){
                            console.error();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text:'An Error Occured: '+error.responseJSON.message,
                            });
                        }
                    });
                }

                // On Focus out to check that Category Name is unique or Not
                $("#name").focusout(function(){
                    let name = $("#name").val();
                    $("#alertDanegerName").remove();
                    if(name.trim() === '' || name == null || name.length == 0){
                        return true;
                    }
                    else if(name.length <3 || name.length >255){
                        $("#name").after('<div class="alert alert-danger" id="alertDanegerName">Election Category Name Should be greater than 3 characters and less than 255.</div>');
                        $("#name").focus();
                    }
                    else{
                       checkUniqueName(name);
                    }
                });


                // Validate the form
                $("#btnSubmit").click(function (e) { 
                    // e.preventDefault();
                    $(".alert-danger").remove();

                    // to check the Election Category Name is Empty or Not
                    let name = $("#name").val();
                    $("#alertDanegerName").remove();
                    if(name.trim() === '' || name == null || name.length == 0){
                        e.preventDefault();
                        $("#name").after('<div class="alert alert-danger">Election Category Name Should be Provided.</div>');
                    }
                    else if(name.length <3 || name.length >255){
                        e.preventDefault();
                        $("#name").after('<div class="alert alert-danger">Election Category Name Should be greater than 3 characters and less than 255.</div>');
                    }
                    
                    // to check the Election Category description is Empty or Not
                    let description = $("#description").val();
                    $("#alertDanegerName").remove();
                    if(description.trim() === '' || description == null || description.length == 0){
                        e.preventDefault();
                        $("#description").after('<div class="alert alert-danger">Election Category Description Should be Provided.</div>');
                    }
                    else if(description.length <3 || description.length >255){
                        e.preventDefault();
                        $("#description").after('<div class="alert alert-danger">Election Category Description Should be greater than 3 characters and less than 255.</div>');
                    }
                });

            });
        </script>
    @endsection