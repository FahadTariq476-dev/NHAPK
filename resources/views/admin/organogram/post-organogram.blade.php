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
                                    <li class="breadcrumb-item"><a href="{{route('admin.organogram.list')}}">Organogram</a></li>
                                    <li class="breadcrumb-item active">Post Organogram Member</li>
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

                <!-- Content Here -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Organogram Member</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <!-- form -->
                                <form action="{{route('admin.organogram.store')}}" method="POST" id="formAddOrganogramMember">
                                    @csrf
                                    <div>
                                        <!-- Member CNIC -->
                                        <div class="form-group mb-1">
                                            <label for="memberCnic">Enter Cnic of the Member:</label>
                                            <input type="text" class="form-control" id="memberCnic" name="memberCnic" minlength="15" maxlength="15" placeholder="Enter Your Member CNIC Here:" autofocus />
                                        </div>
                                        
                                        <!-- Submi Member CNIC -->
                                        <div class="form-group mb-1">
                                            <button type="button" class="btn btn-primary" id="btnSubmitMemberCnic">Submit</button>
                                        </div>
                                    </div>
                                    <div id="divSaveOrganongramMember" style="display: @error('any') block @else none @enderror">
                                        <h4>Save Organongram Member</h4>
                                        <!-- Member CNIC to Save-->
                                        <div class="form-group mb-1">
                                            <label for="memberCnicSave">Cnic of the Member:</label>
                                            <input type="text" class="form-control" id="memberCnicSave" name="memberCnicSave" minlength="15" maxlength="15" value="{{old('memberCnicSave')}}" placeholder=" Your Member CNIC Here:" readonly />
                                        </div>
                                        @error('memberCnicSave')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror


                                        <!-- Member UserId -->
                                        <div class="form-group mb-1">
                                            <input type="hidden" class="form-control" id="memberUserId" name="memberUserId" placeholder="Your Member UserId Here:" value="{{old('memberUserId')}}" readonly />
                                        </div>
                                        @error('memberUserId')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror

                                        <!-- Member Name -->
                                        <div class="form-group mb-1">
                                            <label for="memberName">Name of the Member:</label>
                                            <input type="text" class="form-control" id="memberName" name="memberName" value="{{old('memberName')}}" placeholder="Your Member Name Here:" readonly />
                                        </div>
                                        
                                        <!-- Member Mobile Number -->
                                        <div class="form-group mb-1">
                                            <label for="memberMobileNumber">Mobile Number of the Member:</label>
                                            <input type="text" class="form-control" id="memberMobileNumber" name="memberMobileNumber" value="{{old('memberMobileNumber')}}" placeholder="Your Member Mobile Number Here:" readonly />
                                        </div>
                                        
                                        <!-- Member State -->
                                        <div class="form-group mb-1">
                                            <label for="memberState">State of the Member:</label>
                                            <input type="text" class="form-control" id="memberState" name="memberState" value="{{old('memberState')}}" placeholder="Your Member State Here:" readonly />
                                        </div>
                                        
                                        <!-- Member City -->
                                        <div class="form-group mb-1">
                                            <label for="memberCity">City of the Member:</label>
                                            <input type="text" class="form-control" id="memberCity" name="memberCity" value="{{old('memberCity')}}" placeholder="Your Member City Here:" readonly />
                                        </div>
                                        
                                        <!-- Member Address -->
                                        <div class="form-group mb-1">
                                            <label for="memberAddress">Address of the Member:</label>
                                            <input type="text" class="form-control" id="memberAddress" name="memmemberAddressberCity" value="{{old('memberAddress')}}" placeholder="Your Member Address Here:" readonly />
                                        </div>
                                        
                                        <!-- Member Description -->
                                        <div class="form-group mb-1">
                                            <label for="memberDescription">Description of the Member:</label>
                                            <textarea class="form-control" id="memberDescription" name="memberDescription" placeholder="Your Member Description Here:" readonly>{{old('memberDescription')}}</textarea>
                                        </div>
                                        
                                        <!-- Member Picture -->
                                        <div class="form-group mb-1">
                                            <label for="memberPicture">Picture of the Member:</label>
                                            <input type="text" class="form-control" id="memberPicture" name="memberPicture" value="{{old('memberPicture')}}" placeholder="Your Member City Here:" readonly />
                                        </div>
                                        
                                        <!-- Member Designation -->
                                        <div class="form-group mb-1">
                                            <label for="memberDesignationId">Select Designation of the Member:</label>
                                            <select id="memberDesignationId" name="memberDesignationId" class="form-control">
                                                <option value="" selected disabled>Select Member Designation</option>
                                                @if (count($organogramDesignations)>0)
                                                    @foreach ($organogramDesignations as $organogramDesignation)
                                                        <option value="{{$organogramDesignation->id}}" @if ($organogramDesignation->id == old('memberDesignationId')) selected @endif>
                                                            {{$organogramDesignation->title}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>Member Designation Not Found.</option>
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Action Button Here -->
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-primary" id="btnResetSaveMember">Reset</button>
                                            <button type="submit" class="btn btn-success" id="btnSaveMember">Save</button>
                                        </div>

                                    </div>
                                </form>
                                <!-- form -->
                            </div>

                        </div>
                    </div>
                </div>
                <!--/ Content Here -->

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
            // Function to format CNIC and referal_cnic dynamically
            function formatField(field) {
                var value = field.val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
                var formattedValue = formatCnic(value);
                field.val(formattedValue);
            }

            // Function to format CNIC dynamically (323226161887 => 32322-616188-7)
            function formatCnic(value) {
                if (value.length >= 5 && value.length < 12) {
                    return value.slice(0, 5) + '-' + value.slice(5);
                } else if (value.length >= 12) {
                    return value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12, 15);
                } else {
                    return value;
                }
            }

            // Format CNIC on input
            $('#memberCnic').on('input', function() {
                formatField($(this));
            });


            // Set maximum and minimum values for both fields
            $('#memberCnic').attr('maxlength', '15');
            $('#memberCnic').attr('minlength', '15');

            function resetOrganogramMemberFields() {
                $("#memberCnicSave").val('');
                $("#memberUserId").val('');
                $("#memberName").val('');
                $("#memberMobileNumber").val('');
                $("#memberState").val('');
                $("#memberCity").val('');
                $("#memberAddress").val('');
                $("#memberDescription").val('');
                $("#memberPicture").val('');
                $("#memberDesignationId").val('');
            }

            // btnSubmitMemberCnic action goes here
            $("#btnSubmitMemberCnic").click(function (e) { 
                e.preventDefault();
                $(".alert-danger").remove();
                resetOrganogramMemberFields();
                $("#divSaveOrganongramMember").hide();
                let memberCnic = $("#memberCnic").val();
                if(memberCnic.trim() === '' || memberCnic == null || memberCnic.length==0){
                    $("#memberCnic").after('<div class="alert alert-danger">Member Cnic Should be Provided.</div>');
                    $("#memberCnic").focus();
                }
                else if(memberCnic.length != 15){
                    $("#memberCnic").after('<div class="alert alert-danger">Member Cnic Length Should be Provided Properly.</div>');
                    $("#memberCnic").focus();
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: "/checkCnicWithData/"+memberCnic,
                        success: function (response) {
                            if(response == 0){
                                $("#memberCnic").after('<div class="alert alert-danger">Member Cnic Doesn\'t Exist in Our Record.</div>');
                                $("#memberCnic").focus();
                                $("#divSaveOrganongramMember").hide();
                            }
                            else{
                                $("#divSaveOrganongramMember").show();
                                $("#memberCnicSave").val(response.cnic_no || 'NULL');
                                $("#memberUserId").val(response.id || 'NULL');
                                $("#memberName").val(response.name || 'NULL');
                                $("#memberMobileNumber").val(response.phone_number || 'NULL');
                                $("#memberState").val(response.state ? response.state.name : 'NULL');
                                $("#memberCity").val(response.city ? response.city.name : 'NULL');
                                $("#memberAddress").val(response.address || 'NULL');
                                $("#memberDescription").val(response.short_description || 'NULL');
                                $("#memberPicture").val(response.picture_path || 'NULL');
                            }
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire({
                                icon:'error',
                                title:'Error',
                                text:'An Error occured:'+error.responseJSON.message,
                            });
                        },
                    });
                }
            });

            // validate form
            $("#btnSaveMember").click(function (e) { 
                let memberDesignationId = $("#memberDesignationId").val();
                if(memberDesignationId == null || memberDesignationId.length == 0){
                    e.preventDefault();
                    $("#memberDesignationId").after('<div class="alert alert-danger">Memeber Designation Should be Selected</div>');
                }
            });

        });
    </script>
@endsection