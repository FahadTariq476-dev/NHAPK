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
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.referralLevels.listReferralLevel')}}">Referral Level</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Referral Level
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
            <div class="content-body">

                <!-- Post Referral Level -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Referral Level</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <!-- formReferralLevel -->
                                <form action="{{ route('admin.referralLevels.updateReferralLevel') }}" method="POST" id="formReferralLevel">
                                    @csrf
                                    <input type="hidden" id="referralLevelId" name="referralLevelId" class="form-control" value="{{$referralLevel->id}}" placeholder="Enter Id of Referral Level Here:" readonly/>
                                    <!-- Title -->
                                    <div class="form-group">
                                        <label>Title:</label>
                                        <input type="text" id="title" name="title" class="form-control" value="{{$referralLevel->title}}" placeholder="Enter Title of Referral Level Here:" minlength="3" maxlength="255" autofocus />
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Description -->
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <textarea id="description" name="description" class="form-control" placeholder="Enter Description of Referral Level Here:" minlength="3" maxlength="255" autofocus>{{$referralLevel->description}}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Number -->
                                    <div class="form-group mb-1">
                                        <label>Number:</label>
                                        <input type="number" id="number" name="number" value="{{$referralLevel->number}}" class="form-control" placeholder="Enter Number of Referral Level Here:" autofocus />
                                    </div>
                                    @error('number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                     <!-- Percentage -->
                                     <div class="form-group mb-1">
                                        <label>Percentage:</label>
                                        <input type="number" id="percentage" name="percentage" value="{{$referralLevel->percentage}}" class="form-control" placeholder="Enter Percentage of Referral Level Here:" autofocus />
                                    </div>
                                    @error('percentage')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Buttons -->
                                    <div class="form-group">
                                        <button type="submit" id="btnSave" name="btnSave" class="button btn-success">Update</button>
                                    </div>
                                </form>
                                <!-- formReferralLevel -->
                            </div>

                            <div class="alert alert-primary" role="alert">
                                <div class="alert-body">
                                    <strong>Info:</strong> Please check the &nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layouts.html#layout-collapsed-menu" target="_blank">Layout documentation</a>&nbsp; for more layout options i.e collapsed menu, without menu, empty & blank.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Post Referral Level -->

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
            $("#title").focus();
            // To check the given title is unique or not
                $("#title").focusout(function () { 
                    let oldTitle = '{{ $referralLevel->title}}'
                    let title = $("#title").val();
                    $("#alertDangerTitle").remove();
                    if(title.trim() === '' || title == null || title.length == 0){
                        return false;
                    }
                    else if(title.length<3 || title.length>255){
                        $("#title").after('<div class="alert alert-danger" id="alertDangerTitle">Title Length Should be Greater than 3 & Less Than 255. </div>');
                        return false;
                    }
                    else{
                        if(oldTitle !=title){
                            $.ajax({
                                type: "GET",
                                url: "/admin/referral-levels/unique-title/"+title,
                                success: function (response) {
                                    if(response.status === 'error'){
                                        $("#title").after('<div class="alert alert-danger" id="alertDangerTitle">'+response.message+'</div>');
                                        $("#title").focus();
                                        return true;
                                    }
                                },
                                error: function (error) {
                                    console.log(error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text:'An Error Occured: '+error.responseJSON.message,
                                    });
                                },
                            });
                        }
                    }
                });

            // To validate the form
            $("#formReferralLevel").submit(function (e) { 
                $(".alert-danger").remove();
                //   To check the given title is empty or not
                let title = $("#title").val();
                if(title.trim() === '' || title == null || title.length == 0){
                    $("#title").after('<div class="alert alert-danger" >Title Should be Provided </div>');
                    e.preventDefault();
                }
                else{
                    if(title.length<3 || title.length>255){
                        $("#title").after('<div class="alert alert-danger">Title Length Should be Greater than 3 & Less Than 255. </div>');
                        e.preventDefault();
                    }
                }
                
                //   To check the given description is empty or not
                let description = $("#description").val();
                if(description.trim() === '' || description == null || description.length == 0){
                    $("#description").after('<div class="alert alert-danger" >Description Should be Provided </div>');
                    e.preventDefault();
                }
                else{
                    if(description.length<3 || description.length>255){
                        $("#description").after('<div class="alert alert-danger">Description Length Should be Greater than 3 & Less Than 255. </div>');
                        e.preventDefault();
                    }
                }

                //   To check the given number is empty or not
                let number = $("#number").val();
                if(number.trim() === '' || number == null || number.length == 0 || isNaN(number) || parseInt(number) <= 0 || !Number.isInteger(Number(number))){
                    $("#number").after('<div class="alert alert-danger" >Number Should be Provided. Number will be Postive Integer.</div>');
                    e.preventDefault();
                }

                //   To check the given percentage is empty or not
                let percentage = $("#percentage").val();
                if(percentage.trim() === '' || percentage == null || percentage.length == 0 || isNaN(percentage) || parseInt(percentage) <= 0 || !Number.isInteger(Number(percentage))){
                    $("#percentage").after('<div class="alert alert-danger" >Percentage Should be Provided. Percentage will be Postive Integer.</div>');
                    e.preventDefault();
                }

            });
            

        });
    </script>
@endsection