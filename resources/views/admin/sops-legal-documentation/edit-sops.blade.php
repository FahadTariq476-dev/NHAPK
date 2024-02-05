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
                            <h2 class="content-header-title float-start mb-0">Edit SOP's</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.sops.post-sops')}}">SOP's</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.sops.list-sops')}}">List SOP's</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit SOP's
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
                        <form action="{{route('admin.sops.updateSops')}}" method="POST" id="sopsForm" enctype="multipart/form-data">
                            <h2 class="text-center mb-4">SOP's & Legal Documentation</h2>  
                            @csrf
                            <input type="hidden" class="form-control" name="sopsId" id="sopsId" value="{{$sops->id}}" readonly>
                            <div class="mb-3">
                                <label for="title" class="form-label">SOP's Title:</label>
                                <input type="text" name="title" id="title" class="form-control" maxlength="250" value="{{$sops->title}}">
                            </div>
                            @error('title')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
    
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{$sops->description}}</textarea>
                            </div>
                            @error('description')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                            
                            <div class="mb-3">
                                <label for="file_path">Choose File:</label>
                                <input type="file" class="form-control-file" id="file_path" name="file_path" value="{{$sops->file_path}}" accept="/*">
                                @if ($sops->file_type == 'img')
                                @if ($sops->file_path)
                                    <img src="{{ asset($sops->file_path) }}" alt="Image" id="image-preview" class="img-fluid mt-2" style="max-height: 200px;" onerror="this.onerror=null; this.src='{{ asset('app-assets/images/no-image-icon.jpg') }}';">
                                    <span id="image-name">{{ $sops->file_path }}</span>
                                @else
                                    <img src="{{ asset('app-assets/images/no-image-icon.jpg') }}" alt="Image" id="image-preview" class="img-fluid mt-2" style="max-height: 200px;" onerror="this.onerror=null; this.src='{{ asset('app-assets/images/no-image-icon.jpg') }}';">
                                    <span id="image-name">Image is not saved.</span>
                                @endif
                                @elseif ($sops->file_type == 'file')
                                @if ($sops->file_path)
                                    <!-- Display file-related information or provide download link -->
                                    <span id="file-info">File: <a href="{{ asset($sops->file_path) }}" target="_blank">{{ $sops->file_path }}</a></span>
                                @else
                                    <span id="file-info">No file selected.</span>
                                @endif
                            @endif
                            </div>
                            @error('file_path')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

    
                            <div class="mb-3">
                                <label for="file_type" class="form-label">File Type:</label>
                                <select name="file_type" id="file_type" class="form-control">
                                    <option value="" @if (($sops->file_type)=="") selected @endif disabled>Select File Type</option>
                                    <option value="img" @if (($sops->file_type)=="img") selected @endif>Image</option>
                                    <option value="file" @if (($sops->file_type)=="file") selected @endif>File</option>
                                </select>
                            </div>
                            @error('file_type')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
    
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Post FAQ's Content Here --}}
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

                // To check that question is given or not
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

                // Check if the file has been changed
                if ($("#file_path").prop('files').length > 0) {
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
                } else {
                    // If the file has not been changed, check if the file type is selected
                    let file_type = $("#file_type").val();
                    if (file_type === '' || file_type === null) {
                        e.preventDefault();
                        $("#file_type").after('<div class="alert alert-danger">File Type Should be selected.</div>');
                    }else {
                        // Check if the selected file type matches $sops->file_type
                        if (file_type !== '{{$sops->file_type}}') {
                            e.preventDefault();
                            $("#file_type").after('<div class="alert alert-danger">File Type does not match the existing SOP\'s file type.</div>');
                        }
                    }
                }
            });

            // Reset file type dropdown if a file is selected
            $("#file_path").change(function () {
                $("#file_type").val("");
            });
        });
    </script>
@endsection
