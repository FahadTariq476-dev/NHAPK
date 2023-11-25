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
                            <h2 class="content-header-title float-start mb-0">Post Blogs</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item active">Post Blogs</li>
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
                        <form class="blog-form" id="blogForm" action="{{route('admin.saveBlogPost')}}" method="POST" enctype="multipart/form-data">
                          <h2 class="text-center mb-4">Blog Entry</h2>
                          <!-- Your form fields here -->

                            @if($errors->any())
                            <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                            </div>
                            @endif
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
                          @csrf
                      
                          <div class="form-group">
                            <label for="title">Blog Title:</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title" required>
                          </div>
                      
                          <div class="form-group">
                            <label for="shortDescription">Short Description:</label>
                            <input type="text" class="form-control" id="shortDescription" name="shortDescription" placeholder="Enter a short description" required>
                          </div>
                      
                          <div class="form-group">
                            <label for="fullDescription">Full Description:</label>
                            <textarea class="form-control" id="fullDescription" name="fullDescription" rows="5" placeholder="Write the full blog content here" required></textarea>
                          </div>
                      
                          <div class="form-group">
                            <label for="editor">Editor:</label>
                            <textarea id="editor" name="editor"></textarea>
                          </div>
                      
                          <div class="form-group">
                            <label for="image">Blog Image:</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                          </div>
                      
                          <div class="form-group">
                            <label for="thumbnailImage">Thumbnail Image:</label>
                            <input type="file" class="form-control-file" id="thumbnailImage" name="thumbnailImage" accept="image/*" required>
                          </div>
                      
                          <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="featuredPost" name="featuredPost">
                            <label class="form-check-label" for="featuredPost">Mark as Featured Post</label>
                          </div>
                      
                          <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" disabled selected>Select Status</option>
                              <option value="draft">Draft</option>
                              <option value="published">Published</option>
                            </select>
                          </div>
                      
                          <div class="form-group">
                            <label for="postCategory">Post Category:</label>
                            <select class="form-control" id="postCategory" name="postCategory" required>
                              <option value="" disabled selected>Select a category</option>
                              <option value="travel">Travel</option>
                              <option value="food">Food</option>
                              <option value="lifestyle">Lifestyle</option>
                              <!-- Add more categories as needed -->
                            </select>
                          </div>
                          <button type="submit" class="btn btn-primary btn-block">Submit Blog</button>
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
      
    @endsection