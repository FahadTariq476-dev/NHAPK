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
                            <h2 class="content-header-title float-start mb-0">Post News & Media</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li> 
                                    <li class="breadcrumb-item"><a href="{{route('admin.newsfeeds.post-newsfeeds')}}">News & Media</a>
                                    </li>
                                    <li class="breadcrumb-item active">Post News & Media</li>
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
                        <form class="newsfeed-form" id="newsfeedForm" action="{{route('admin.saveNewsfeeds')}}" method="POST" enctype="multipart/form-data">
                          <h2 class="text-center mb-4">News & Media</h2>                          
                          @if(session('success'))
                            <script>
                              swal.fire({
                                title: "Success!",
                                text: "{{ session('success') }}",
                                icon: "success",
                                button: "OK",
                              });
                            </script>
                          @endif

                          @if(session('error'))
                            <script>
                              swal.fire({
                                title: "Error!",
                                text: "{{ session('error') }}",
                                icon: "error",
                                button: "OK",
                              });
                            </script>
                          @endif
                          <!-- Your form fields here -->
                          @csrf
                      
                          <div class="form-group">
                            <label for="title">News Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter the title">
                          </div>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                      
                          <div class="form-group">
                            <label for="shortDescription">News Short Description:</label>
                            <input type="text" class="form-control" id="shortDescription" name="shortDescription" value="{{old('shortDescription')}}" maxlength="255" placeholder="Enter a short description">
                          </div>
                          @error('shortDescription')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="editor">News Editor Content:</label>
                            <textarea id="editor" name="editor" class="form-control">{{ old('editor') }}</textarea>
                          </div>
                          @error('editor')
                            <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="image">News Image:</label>
                            <input type="file" class="form-control-file" id="image" name="image" value="{{old('image')}}" accept="image/*">
                          </div>
                          @error('image')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="thumbnailImage">News Thumbnail Image:</label>
                            <input type="file" class="form-control-file" id="thumbnailImage" name="thumbnailImage" value="{{old('thumbnailImage')}}" accept="image/*">
                          </div>
                          @error('thumbnailImage')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="featuredPost" name="featuredPost" @if(old('featuredPost')) checked @endif>
                            <label class="form-check-label" for="featuredPost">Mark as Featured Post</label>
                          </div>
                          @error('featuredPost')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" disabled @if(old('status') == '') selected @endif>Select Status</option>
                              <option value="pending" @if(old('status') == 'pending') selected @endif>Pending</option>
                              <option value="published" @if(old('status') == 'published') selected @endif>Published</option>
                            </select>
                          </div>
                          @error('status')
                              <div class="alert alert-danger">{{$message}}</div>
                          @enderror
                      
                          <button type="reset" class="btn btn-info btn-block">Reset</button>
                          <button type="submit" class="btn btn-primary btn-block">Submit News</button>
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
      $("#newsfeedForm").submit(function (e) {
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
          e.preventDefault();
          $("#image").after('<div class="alert alert-danger">Image is required.</div>');
        } else {
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
            e.preventDefault();
            $('#thumbnailImage').after('<div class="alert alert-danger">Image-thumbnail is required.</div>');
        }
        else{
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