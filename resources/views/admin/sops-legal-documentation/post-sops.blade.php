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
                            <h2 class="content-header-title float-start mb-0">SOP's</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li> 
                                    <li class="breadcrumb-item"><a href="{{route('admin.sops.post-sops')}}">SOP's</a>
                                    </li>
                                    <li class="breadcrumb-item img">Post SOP's
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

            {{-- Post FAQ's Content Here --}}
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
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
                        
                        <form action="{{route('admin.sops.storeSops')}}" method="POST" id="sopsForm" enctype="multipart/form-data">
                            <h2 class="text-center mb-4">SOP's & Legal Documentation</h2>  
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">SOP's Title:</label>
                                <input type="text" name="title" id="title" class="form-control" maxlength="250" value="{{old('title')}}">
                            </div>
                            @error('title')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
    
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                            </div>
                            @error('description')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                            
                            <div class="mb-3">
                                <label for="file_path">Choose File:</label>
                                <input type="file" class="form-control-file" id="file_path" name="file_path" value="{{old('file_path')}}" accept="/*">
                              </div>
                              @error('file_path')
                                  <div class="alert alert-danger">{{$message}}</div>
                              @enderror

    
                            <div class="mb-3">
                                <label for="file_type" class="form-label">File Type:</label>
                                <select name="file_type" id="file_type" class="form-control">
                                    <option value="" @if (old('file_type')=="") selected @endif disabled>Select File Type</option>
                                    <option value="img" @if (old('file_type')=="img") selected @endif>Image</option>
                                    <option value="file" @if (old('file_type')=="file") selected @endif>File</option>
                                </select>
                            </div>
                            @error('file_type')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
    
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Post FAQ's Content Here --}}

            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> Please check the&nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-without-menu.html" target="_blank">Layout without menu documentation</a>&nbsp; for more details.
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
        $(document).ready(function(){
            // Jquery Form validation
            $("#sopsForm").submit(function (e){
                $(".alert-danger").remove();

                // To check that qusetion is given or not
                let title = $("#title").val();
                if(title.trim()===''){
                    e.preventDefault();
                    $("#title").after('<div class="alert alert-danger">Title Should be provided.</div>');
                }
                
                // To check that description is given or not
                let description = $("#description").val();
                if(description.trim()===''){
                    e.preventDefault();
                    $("#description").after('<div class="alert alert-danger">Descriptions should be provided</div>');
                }

                // Check the file type is empty or not
                let file_type = $("#file_type").val();
                // If the file type is empty then error
                if (file_type === '' || file_type === null) {
                    e.preventDefault();
                    $("#file_type").after('<div class="alert alert-danger">File Type Should be selected.</div>');
                } else {
                    // If the file type is not empty then check the file according to file type selected.
                    var file_path = $("#file_path")[0].files[0];

                    if (!file_path) {
                        e.preventDefault();
                        $("#file_path").after('<div class="alert alert-danger">File is required.</div>');
                    } else {
                        // Check file size
                        var maxSize = 2 * 1024 * 1024; // 2MB in bytes

                        if (file_type === 'img') {
                            // Check image size
                            if (file_path.size > maxSize) {
                                e.preventDefault();
                                $("#file_path").after('<div class="alert alert-danger">Image size should not be greater than 2MB.</div>');
                            }

                            // Check image extension
                            var allowedImageExtensions = /(\.jpg|\.jpeg|\.png|\.JPEG|\.JPG|\.PNG)$/i;
                            if (!allowedImageExtensions.exec(file_path.name)) {
                                e.preventDefault();
                                $("#file_path").after('<div class="alert alert-danger">Invalid image file type. Allowed types: jpg, jpeg, png, JPEG, JPG, PNG.</div>');
                            }
                        } else if (file_type === 'file') {
                            // Check file type (PDF or Word)
                            var allowedFileExtensions = /(\.pdf|\.doc|\.docx)$/i;
                            if (!allowedFileExtensions.exec(file_path.name)) {
                                e.preventDefault();
                                $("#file_path").after('<div class="alert alert-danger">Invalid file type. Allowed types: pdf, doc, docx.</div>');
                            }

                            // Check file size
                            if (file_path.size > maxSize) {
                                e.preventDefault();
                                $("#file_path").after('<div class="alert alert-danger">File size should not be greater than 2MB.</div>');
                            }
                        }
                    }
                }       
                // 
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#file_path").change(function () {
                // Check if a file is selected
                if (this.files.length > 0) {
                    // Reset the file type dropdown
                    $("#file_type").val("");
                }
            });
        });
    </script>
    @endsection