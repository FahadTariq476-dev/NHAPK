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
                            <h2 class="content-header-title float-start mb-0">FAQ's</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li> 
                                    <li class="breadcrumb-item"><a href="{{route('admin.faqs.post-faqs')}}">FAQ's</a>
                                    </li>
                                    <li class="breadcrumb-item active">Post FAQ's
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
                        <form action="{{route('admin.faqs.storeFaqs')}}" method="POST" id="faqsForm">
                            <h2 class="text-center mb-4">FAQ's</h2>  
                            @csrf
                            <div class="mb-3">
                                <label for="question" class="form-label">Question:</label>
                                <input type="text" name="question" id="question" class="form-control" maxlength="250" value="{{old('question')}}">
                            </div>
                            @error('question')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
    
                            <div class="mb-3">
                                <label for="answer" class="form-label">Answer:</label>
                                <textarea name="answer" id="answer" class="form-control">{{old('answer')}}</textarea>
                            </div>
                            @error('answer')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
    
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" @if (old('status')=="") selected @endif disabled>Select Status</option>
                                    <option value="active" @if (old('status')=="active") selected @endif>Active</option>
                                    <option value="inactive" @if (old('status')=="inactive") selected @endif>Inactive</option>
                                </select>
                            </div>
                            @error('status')
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
            $("#faqsForm").submit(function (e){
                $(".alert-danger").remove();

                // To check that qusetion is given or not
                let question = $("#question").val();
                if(question.trim()===''){
                    e.preventDefault();
                    $("#question").after('<div class="alert alert-danger">Question Should be provided.</div>');
                }
                
                // To check that answer is given or not
                let answer = $("#answer").val();
                if(answer.trim()===''){
                    e.preventDefault();
                    $("#answer").after('<div class="alert alert-danger">Answers should be provided</div>');
                }

                // To check that the status is given or not
                let status = $("#status").val();
                if(status==='' || status===null){
                    e.preventDefault();
                    $("#status").after('<div class="alert alert-danger">Status Should be selected.</div>');
                }
            });
        });
    </script>
    @endsection