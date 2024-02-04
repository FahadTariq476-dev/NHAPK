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
                            <h2 class="content-header-title float-start mb-0">Save Organogram Designation</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a></li>
                                    <li class="breadcrumb-item"><a href="#">Organogram</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.organogramDesignation.list')}}">Organogram Designation</a></li>
                                    <li class="breadcrumb-item active">Post Organogram Designation</li>
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

            <!-- Post Organogram Designation Content Here -->
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Save New Organogram Designation</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <form action="{{route('admin.organogramDesignation.store')}}" method="POST" id="organogramDesignationFrom">
                                    @csrf
                                    <div class="form-group mb-1">
                                        <label for="title" class="form-label">Title:</label>
                                        <input type="text" name="title" id="title" class="form-control" minlength="3" maxlength="250" value="{{old('title')}}" placeholder="Enter title here:">
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
            
                                    <div class="form-group mb-1">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea name="description" id="description" class="form-control" minlength="3" placeholder="Enter Description Here:">{{old('description')}}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
            
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-info">Reset</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                              
                       
                            </div>

                            <div class="alert alert-primary" role="alert">
                                <div class="alert-body">
                                    <strong>Info:</strong> Please check the &nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layouts.html#layout-collapsed-menu" target="_blank">Layout documentation</a>&nbsp; for more layout options i.e collapsed menu, without menu, empty & blank.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Post Organogram Designation Content Here -->

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @endsection
    @section('js')
        <script>
            $(document).ready(function(){
                // Jquery Form validation
                $("#organogramDesignationFrom").submit(function (e){
                    $(".alert-danger").remove();

                    // To check that title is given or not
                    let title = $("#title").val();
                    if(title.trim()==='' || title == null || title.length== 0){
                        e.preventDefault();
                        $("#title").after('<div class="alert alert-danger">Title Should be provided.</div>');
                    }
                    
                    // To check that description is given or not
                    let description = $("#description").val();
                    if(description.trim()===''){
                        e.preventDefault();
                        $("#description").after('<div class="alert alert-danger">Descriptions should be provided</div>');
                    }
                });

                $("#title").focusout(function () { 
                    $("#titleAlertDanger").remove();
                    // To check that title is given or not
                    let title = $("#title").val();
                    if((title.length>0 && title.length <4) || (title.length>255)){
                        $("#title").after('<div class="alert alert-danger" id="titleAlertDanger">Title Should be of minimum  length 3 and less than 255.</div>');
                        $("#title").focus();
                    }
                    else{
                        $.ajax({
                            type: "GET",
                            url: "/admin/organogram-designation/unique-title/"+title,
                            success: function (response) {
                                if(response.status == 1){
                                    $("#title").after('<div class="alert alert-danger" id="titleAlertDanger">'+response.message+'</div>');
                                    $("#title").focus();
                                }
                            },
                            error: function (error) {
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text:'An Error occured:'+error.responseJSON.message,
                                });
                            }
                        });
                    }
                });
            });
        </script>

    @endsection