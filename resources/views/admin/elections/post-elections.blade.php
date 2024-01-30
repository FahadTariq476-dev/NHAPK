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
                                    <li class="breadcrumb-item"><a href="{{route('admin.elections.index')}}">Elections</a></li>
                                    <li class="breadcrumb-item active">Post Elections</li>
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
                        <h4 class="card-title">New Elections</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <!-- Form to Save Election -->
                            <form id="formElectionCategory" method="POST" action="{{route('admin.elections.store')}}">
                                @csrf
                                <!-- Election Name -->
                                <div class="form-group mb-2">
                                    <label>Election Name</label>
                                    <input type="text" class="form-control" id="name" name="name" minlength="3" value="{{old('name')}}" maxlength="255" placeholder="Election Name Here:" autofocus />
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Election Description -->
                                <div class="form-group mb-2">
                                    <label>Election Description</label>
                                    <textarea class="form-control" id="description" name="description" minlength="3" maxlength="255" placeholder="Election Description Here:" autofocus>{{old('name')}}</textarea>
                                </div>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Election Starting Date -->
                                <div class="form-group mb-2">
                                    <label>Election Starting Date</label>
                                    <input type="datetime-local" class="form-control" id="startDate" name="startDate" value="{{old('startDate')}}" autofocus />
                                </div>
                                @error('startDate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Election Ending Date -->
                                <div class="form-group mb-2">
                                    <label>Election Ending Date</label>
                                    <input type="datetime-local" class="form-control" id="endDate" name="endDate" value="{{old('endDate')}}" autofocus />
                                </div>
                                @error('endDate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Election Apply Start Date -->
                                <div class="form-group mb-2">
                                    <label>Election Apply Start Date to Apply</label>
                                    <input type="datetime-local" class="form-control" id="applyStartDate" name="applyStartDate" value="{{old('applyStartDate')}}" autofocus />
                                </div>
                                @error('applyStartDate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Election Last Date -->
                                <div class="form-group mb-2">
                                    <label>Election Last Date to Apply</label>
                                    <input type="datetime-local" class="form-control" id="lastDate" name="lastDate" value="{{old('lastDate')}}" autofocus />
                                </div>
                                @error('lastDate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                

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
                
                // Function to check that Election Name is unique or Not
                function checkUniqueName(name) {
                    $.ajax({
                        type: "GET",
                        url: "/admin/elections/unique-name/"+name,
                        success: function (response) {
                            if(response.status == 1){
                                $("#name").after('<div class="alert alert-danger" id="alertDangerName">Election Name Should be unique.</div>');
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
                    $("#alertDangerName").remove();
                    if(name.trim() === '' || name == null || name.length == 0){
                        return true;
                    }
                    else if(name.length <3 || name.length >255){
                        $("#name").after('<div class="alert alert-danger" id="alertDangerName">Election Name Should be greater than 3 characters and less than 255.</div>');
                        $("#name").focus();
                    }
                    else{
                       checkUniqueName(name);
                    }
                });


                // Validate the form
                $("#btnSubmit").click(function (e) { 
                    $("#alertDangerName").remove();
                    $(".alert-danger").remove();

                    // to check the Election Category Name is Empty or Not
                    let name = $("#name").val();
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
                    if(description.trim() === '' || description == null || description.length == 0){
                        e.preventDefault();
                        $("#description").after('<div class="alert alert-danger">Election Description Should be Provided.</div>');
                    }
                    else if(description.length <3 || description.length >255){
                        e.preventDefault();
                        $("#description").after('<div class="alert alert-danger">Election Description Should be greater than 3 characters and less than 255.</div>');
                    }

                    
                    // Get the current date and time
                    let currentDate = new Date();

                    // Extract individual components
                    let year = currentDate.getFullYear();
                    let month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
                    let day = String(currentDate.getDate()).padStart(2, '0');
                    let hours = String(currentDate.getHours()).padStart(2, '0');
                    let minutes = String(currentDate.getMinutes()).padStart(2, '0');

                    // Format the date as a string
                    let currentDateString = `${year}-${month}-${day}T${hours}:${minutes}`;

                    console.log(currentDateString);

                    // To check that the Election startDate is empty or not
                    let startDate = $("#startDate").val();
                    console.log("Start Date is:"+startDate);
                    if (startDate.trim() === '') {
                        e.preventDefault();
                        $("#startDate").after('<div class="alert alert-danger">Election Start Date Should be Provided.</div>');
                    } 
                    else{
                        let selectedStartDate = new Date(startDate);
                        console.log("Select Start Date is "+selectedStartDate);

                        // Check if the selected start date is greater than or equal to the current date
                        if (selectedStartDate <= currentDate) {
                            e.preventDefault();
                            $("#startDate").after('<div class="alert alert-danger">Election Start Date Should be Greater Than the Current Date.</div>');
                        } else {
                            // Continue with your code if the validation passes
                        }
                    }
                    
                    // To check that the Election lastDate is empty or not
                    let lastDate = $("#lastDate").val();
                    console.log("lastDate is:"+lastDate);
                    if (lastDate.trim() === '') {
                        e.preventDefault();
                        $("#lastDate").after('<div class="alert alert-danger">Election Last Date to Apply Should be Provided.</div>');
                    } 
                    else{
                        // Convert the selected last date to a JavaScript Date object
                        let selectedLastDate = new Date(lastDate);
                        console.log("Select Last Date: "+selectedLastDate);

                        let selectedStartDate = new Date(startDate);
                        // Calculate the difference in milliseconds
                        let timeDifferenceLast = selectedStartDate.getTime() - selectedLastDate.getTime();
                        console.log("timeDifferenceLast: "+timeDifferenceLast);

                        // Calculate the difference in days
                        let daysDifference = timeDifferenceLast / (1000 * 60 * 60 * 24);
                        console.log("daysDifference: "+daysDifference);

                        // Set the minimum number of days
                        let minimumDays = 5;

                        // Check if the selected last date is at least minimumDays smaller than the start date
                        if (daysDifference < minimumDays) {
                            e.preventDefault();
                            $("#lastDate").after('<div class="alert alert-danger">Election Last Date must be at least ' + minimumDays + ' days before the Election Start Date.</div>');
                        }
                    }
                    
                    
                    // To check that the Election applyStartDate is empty or not
                    let applyStartDate = $("#applyStartDate").val();
                    console.log("applyStartDate is:"+applyStartDate);
                    if (applyStartDate.trim() === '') {
                        e.preventDefault();
                        $("#applyStartDate").after('<div class="alert alert-danger">Election Apply Start Date to Apply Should be Provided.</div>');
                    } 
                    else{
                        // Convert the selected ApplyStart date to a JavaScript Date object
                        let selectedApplyStartDate = new Date(applyStartDate);
                        console.log("Select ApplyStart Date: "+selectedApplyStartDate);

                        let selectedApplyLastDate = new Date(lastDate);
                        console.log("Select selectedApplyLastDate Date: "+selectedApplyLastDate);
                        // Calculate the difference in milliseconds
                        let timeDifferenceLast = selectedApplyLastDate.getTime() - selectedApplyStartDate.getTime();
                        console.log("timeDifferenceLast: "+timeDifferenceLast);

                        // Calculate the difference in days
                        let daysDifference = timeDifferenceLast / (1000 * 60 * 60 * 24);
                        console.log("daysDifference: "+daysDifference);

                        // Set the minimum number of days
                        let minimumDays = 1;

                        // Check if the selected last date is at least minimumDays smaller than the start date
                        if (daysDifference < minimumDays) {
                            e.preventDefault();
                            $("#applyStartDate").after('<div class="alert alert-danger">Election Apply Start Date must be at least ' + minimumDays + ' days before the Election Appy Last Date.</div>');
                        }
                    }

                    // To check that the Election startDate is empty or not
                    let endDate = $("#endDate").val();
                    console.log("endDate Date is:"+endDate);
                    if (endDate.trim() === '') {
                        e.preventDefault();
                        $("#endDate").after('<div class="alert alert-danger">Election End Date Should be Provided.</div>');
                    } 
                    else{
                        let selectedStartDate = new Date(startDate);
                        let selectedEndtDate = new Date(endDate);
                        console.log(selectedEndtDate);
                        if(selectedEndtDate <= selectedStartDate){
                            e.preventDefault();
                            $("#endDate").after('<div class="alert alert-danger">Election End Date Should be greater than Start Date Provided.</div>');
                        }
                    }


                });

            });
        </script>
    @endsection