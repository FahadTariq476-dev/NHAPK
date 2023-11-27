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
                            <h2 class="content-header-title float-start mb-0">Edits Blogs</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Blogs</li>
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
                        <form class="blog-form" id="blogForm" action="{{route('admin.updateFullBlog')}}" method="POST" enctype="multipart/form-data">
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
                          <input type="text" name="id" value="{{ $blogs->id }}">
                      
                          <div class="form-group">
                            <label for="title">Blog Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $blogs->title }}" placeholder="Enter the title">
                          </div>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                      
                          <div class="form-group">
                            <label for="shortDescription">Short Description:</label>
                            <input type="text" class="form-control" id="shortDescription" name="shortDescription" value="{{ $blogs->short_description }}" maxlength="255" placeholder="Enter a short description">
                          </div>
                          @error('shortDescription')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="editor">Editor:</label>
                            <textarea id="editor" name="editor" class="form-control">{{ $blogs->editor_content }}</textarea>
                          </div>
                          @error('editor')
                            <div class="alert alert-danger">{{$message}}</div>
                          @enderror

                          <div class="form-group">
                            <label for="image">Blog Image:</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            @if ($blogs->image_path)
                            <img src="{{ asset($blogs->image_path) }}" alt="{{ asset('no-image-icon.png') }}" id="image-preview" class="img-fluid mt-2" style="max-height: 200px;">
                            <span id="image-name">{{ $blogs->image_path }}</span>
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
                            @if ($blogs->image_path)
                            <img src="{{ asset($blogs->thumbnail_image_path) }}" alt="{{ asset('no-image-icon.png') }}" id="image-preview" class="img-fluid mt-2" style="max-height: 200px;">
                            <span id="image-name">{{ $blogs->thumbnail_image_path }}</span>
                            @else
                            <img src="{{ asset('no-image-icon.png') }}" alt="{{ asset('no-image-icon.png') }}" id="image-preview" class="img-fluid mt-2" style="max-height: 200px; display: none;">
                            <span id="image-name">Image is not saved.</span>
                            @endif
                          </div>
                          @error('thumbnailImage')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="featuredPost" name="featuredPost" @if($blogs->featured_post) checked @endif>
                            <label class="form-check-label" for="featuredPost">Mark as Featured Post</label>
                          </div>
                          @error('featuredPost')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" disabled @if($blogs->status) selected @endif>Select Status</option>
                              <option value="pending" @if($blogs->status) selected @endif>Pending</option>
                              <option value="published" @if($blogs->status) selected @endif>Published</option>
                            </select>
                          </div>
                          @error('status')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          {{-- <div class="form-group">
                            <label for="postCategory">Post Category:</label>
                            <select class="form-control" id="postCategory" name="postCategory" required>
                              <option value="" disabled selected>Select a category</option>
                              <option value="travel">Travel</option>
                              <option value="food">Food</option>
                              <option value="lifestyle">Lifestyle</option>
                              <!-- Add more categories as needed -->
                            </select>
                          </div> --}}
                          <button type="submit" class="btn btn-primary btn-block">Update Blog</button>
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