@extends('client.layouts.master')
@section('title','Hostelites Metas')

<!-- Begin: Addiitonal CSS Section starts Here -->
@section('css')

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@endsection
<!-- End: Addiitonal CSS Section starts Here -->

<!-- Begin: Main-Content Section  -->
@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Hostelites Metas</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.dashboard.index') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Hostelites Metas
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
                <!-- Begin: Hostelites Metas -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Hostelites Metas🚀</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                           <form id="formHostelitesMetas" action="{{ route('client.storeHosteliteMetas') }}" method="POST">
                                @csrf
                                <!-- Select Country -->
                                <div class="form-group">
                                    <label for="countryId">Select Country</label>
                                    <select id="countryId" name="countryId" class="form-control select2">
                                        <option value="" selected disabled>Select Country</option>
                                        @if (count($countries)>0)
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Country Found</option>
                                        @endif
                                    </select>
                                </div>
                                @error('countryId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Select State -->
                                <div class="form-group">
                                    <label for="stateId">Select State</label>
                                    <select id="stateId" name="stateId" class="form-control select2">
                                        <option value="" selected disabled>Select State</option>
                                    </select>
                                </div>
                                @error('stateId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!-- Select City -->
                                <div class="form-group">
                                    <label for="cityId">Select City</label>
                                    <select id="cityId" name="cityId" class="form-control select2">
                                        <option value="" selected disabled>Select City</option>
                                    </select>
                                </div>
                                @error('cityId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!-- Select Hostel -->
                                <div class="form-group">
                                    <label for="hostelId">Select Hostel</label>
                                    <select id="hostelId" name="hostelId" class="form-control select2">
                                        <option value="" selected disabled>Select Hostel</option>
                                    </select>
                                </div>
                                @error('hostelId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div id="hostelDetails" style="display: none">
                                    <!-- Hostel Contact Number-->
                                    <div class="form-group">
                                        <label for="hostelContactNumber">Hostel Contact Number</label>
                                        <input type="text" name="hostelContactNumber" id="hostelContactNumber" class="form-control" placeholder="Enter Hostel Contact Number Here" readonly>
                                    </div>
                                    <!-- Hostel Owner Name / Incharge Name -->
                                    <div class="form-group">
                                        <label for="hostelOwnerName">Hostel Owner Name / Incharge Name</label>
                                        <input type="text" name="hostelOwnerName" id="hostelOwnerName" class="form-control" placeholder="Enter Hostel Owner Name / Incharge Name Here" readonly>
                                    </div>
                                </div>
                                
                                <!-- How long you been in this Hostel -->
                                <div class="form-group">
                                    <label for="livingSince">How long you been in this Hostel</label>
                                    <input type="date" name="livingSince" id="livingSince" class="form-control">
                                </div>
                                @error('livingSince')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                <!--  Previous Hostel If any (if yes) -->
                                <div class="form-group">
                                    <label for="previousHostel">Previous Hostel If any (if yes)</label>
                                    <input type="text" name="previousHostel" id="previousHostel" class="form-control" placeholder="Previous Hostel If any (if yes)">
                                </div>

                                <!-- Referral CNIC -->
                                <div class="form-group">
                                    <label for="referralCnic">Referral CNIC:</label>
                                    <input type="text" class="form-control" id="referralCnic" name="referralCnic" value="{{old('referralCnic')}}" placeholder="Enter referral cnic here:" maxlength="15" minlength="15">
                                </div>
                                @error('referralCnic')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
            
                                <!-- Transaction Number -->
                                <div class="form-group mb-1">
                                    <label for="transactionNo">Transaction Number:</label>
                                    <input type="text" class="form-control" id="transactionNo" name="transactionNo" value="{{old('transactionNo')}}" placeholder="Enter your transaction number here:">
                                </div>
                                @error('transactionNo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <button type="reset" class="button btn-primary" id="btnReset">Reset</button>
                                    <button type="submit" class="button btn-success">Submit</button>
                                </div>
                           </form>
                        </div>
                    </div>
                </div>
                <!-- End: Hostelites Metas -->

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> Use this layout to set menu (navigation) default collapsed. Please check the&nbsp;<a class="text-primary" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-collapsed-menu.html" target="_blank">Layout collapsed menu documentation</a>&nbsp; for more details.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
<!-- End: Main-Content Section  -->

<!-- Begin: Script Section Starts Here -->
@section('scripts')
    <script type="text/javascript">
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
        function formatField(field) {
            var value = field.val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
            var formattedValue = formatCnic(value);
            field.val(formattedValue);
        }

        $(document).ready(function(){
            // Format referralCnic on input
                $('#referralCnic').on('input', function() {
                    formatField($(this));
                });

            // Set maximum and minimum values for both fields
                $('#referralCnic').attr('maxlength', '15');
                $('#referralCnic').attr('minlength', '15');
            
            // Initialize Select2 on the city dropdown
                $('#cityId').select2({
                    placeholder: 'Select City',
                    allowClear: true,
                    width: '100%' // Set the width as per your requirement
                });
                
            // Initialize Select2 on the hostel dropdown
                $('#hostelId').select2({
                    placeholder: 'Select Hostel',
                    allowClear: true,
                    width: '100%' // Set the width as per your requirement
                });

            //  To get States for the Given Country
                $("#countryId").change(function(){
                    let countryId = $("#countryId").val();
                        $('#stateId').empty();
                        $('#stateId').append('<option value="" disabled selected>Select State</option>');
                        $('#cityId').empty();
                        $('#cityId').append('<option value="" disabled selected>Select City</option>');
                        $('#hostelId').empty();
                        $('#hostelId').append('<option value="" disabled selected>Select Hostel</option>');
                        $("#hostelContactNumber").val('');
                        $("#hostelOwnerName").val('');
                        $("#hostelDetails").hide();
                    if(cityId !=null){
                        $.ajax({
                            url:'/get-states/'+countryId,
                            type:'GET',
                            success:function(response){
                                if (!response || (Array.isArray(response) && response.length === 0)) {
                                    $('#stateId').append('<option value="" disabled>No State Found</option>');
                                } else {
                                    $.each(response, function(key, value) {
                                        $('#stateId').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                }
                            },
                            error:function(error){
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text: 'An error occured: '+error.responseJSON.message,
                                });
                            }
                        });
                    }
                });
                
            //  To get Cities for the Given State
                $("#stateId").change(function(){
                    let stateId = $("#stateId").val();
                        $('#cityId').empty();
                        $('#cityId').append('<option value="" disabled selected>Select City</option>');
                        $('#hostelId').empty();
                        $('#hostelId').append('<option value="" disabled selected>Select Hostel</option>');
                        $("#hostelContactNumber").val('');
                        $("#hostelOwnerName").val('');
                        $("#hostelDetails").hide();
                    if(cityId !=null){
                        $.ajax({
                            url:'/get-cities/'+stateId,
                            type:'GET',
                            success:function(response){
                                if (!response || (Array.isArray(response) && response.length === 0)) {
                                    $('#cityId').append('<option value="" disabled>No City Found</option>');
                                } else {
                                    $.each(response, function(key, value) {
                                        $('#cityId').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                }
                            },
                            error:function(error){
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text: 'An error occured: '+error.responseJSON.message,
                                });
                            }
                        });
                    }
                });
                
            //  To get Hostel for the Given City
                $("#cityId").change(function(){
                    let cityId = $("#cityId").val();
                        $('#hostelId').empty();
                        $('#hostelId').append('<option value="" disabled selected>Select Hostel</option>');
                        $("#hostelContactNumber").val('');
                        $("#hostelOwnerName").val('');
                        $("#hostelDetails").hide();
                    if(cityId !=null){
                        $.ajax({
                            url:'/get-properties/'+cityId,
                            type:'GET',
                            success:function(response){
                                if (!response || (Array.isArray(response) && response.length === 0)) {
                                    $('#hostelId').append('<option value="" disabled>No Hostel Found</option>');
                                } else {
                                    $.each(response, function(key, value) {
                                        $('#hostelId').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                }
                            },
                            error:function(error){
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text: 'An error occured: '+error.responseJSON.message,
                                });
                            }
                        });
                    }
                });

            // To get Hostel Details Using Hostel Id
            $("#hostelId").change(function(){
                let hostelId = $("#hostelId").val();
                if(hostelId != null){
                    $.ajax({
                        url:'/hostel-contact-and-author/'+hostelId,
                        get:'GET',
                        success:function(response){
                            $("#hostelContactNumber").val('');
                            $("#hostelOwnerName").val('');
                            $("#hostelDetails").hide();
                            if(response.status == 'success'){
                                $("#hostelContactNumber").val(response.hostelContactNumber);
                                $("#hostelOwnerName").val(response.hostelOwnerName);
                                $("#hostelDetails").show();
                            }
                            else if(response.status == 'invalid'){
                                Swal.fire('Invalid',response.message, response.status);
                            }
                        },
                        error:function(error){
                            console.log(error);
                            Swal.fire({
                                icon:'error',
                                title:'Error',
                                text:'An error occured: '+error.responseJSON.message,
                            });
                        },
                    });
                }
            });
                
            
            // To Verify The transaction Number
                $("#transactionNo").focusout(function(){
                    $("#alertDangerTransactionNo").remove();
                    let transactionNo = $("#transactionNo").val();
                    if(transactionNo.length > 3){
                        verifyAjaxTransactionNumber(transactionNo);
                    }
                });
                
                function verifyAjaxTransactionNumber(transactionNo){
                    $.ajax({
                        url:'/checkTransaction_no/'+transactionNo,
                        type:'GET',
                        success:function(response){
                            if(response==1){
                                $("#transactionNo").after('<div class="alert alert-danger" id="alertDangerTransactionNo">Transaction Number Should be Unique.</div>');
                                $("#transactionNo").focus();
                            }
                        },
                        error:function(error){
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An Error Occured: '+error.responseJSON.message,
                            });
                        },
                    });
                };

            // To verify referal cnic
                $("#referralCnic").focusout(function(){
                    let referralCnic = $("#referralCnic").val();
                    $("#alertDangerReferralCnic").remove();
                    if(referralCnic.length>0 && referralCnic.length!=15){
                        $("#referralCnic").after('<div class="alert alert-danger" id="alertDangerReferralCnic">Valid Cnic shoudld be provided.'+referralCnic.length+'</div>')
                        $("#referralCnic").focus();
                    }
                    else{
                        if(referralCnic.length==15){
                            verifyAjaxReferalCnic(referralCnic);
                        }
                    }
                });

                function verifyAjaxReferalCnic(referralCnic){
                    $.ajax({
                        url:'/checkCNIC/'+referralCnic,
                        type:'GET',
                        success:function(response){
                            if(response==0){
                                $("#referralCnic").after('<div class="alert alert-danger" id="alertDangerReferralCnic">Referal CNIC does not exist in our record. Kindly use the valid cnic.</div>');
                                $("#referralCnic").focus();
                            }
                        },
                        error:function(error){
                            console.log(error);
                            Swal.fire({
                                icon:'error',
                                title:'Error',
                                text:'An Error Occured: '+error.responseJSON.message,
                            });
                        },
                    });
                }

            // To reset the alert 
                $("#btnReset").click(function(){
                    $(".alert-danger").remove();
                    $("#alertDangerReferralCnic").remove();
                    $("#alertDangerTransactionNo").remove();
                });

            
            //  To Verify the form before submit
                $("#formHostelitesMetas").submit(function(e){
                    $(".alert-danger").remove();
                    // // To Check City is selected or not
                    // let cityId = $("#cityId").val();
                    // if(cityId == null || cityId.length==0){
                    //     $("#cityId").after('<div class="alert alert-danger">City Should be Selected.</div>');
                    //     e.preventDefault();
                    // }
                    
                    // // To Check Hostel is selected or not
                    // let hostelId = $("#hostelId").val();
                    // if(hostelId == null || hostelId.length==0){
                    //     $("#hostelId").after('<div class="alert alert-danger">Hostel Should be Selected.</div>');
                    //     e.preventDefault();
                    // }
                    
                    // // To Check livingSince is empty or not
                    // let livingSince = $("#livingSince").val();
                    // if(livingSince == null || livingSince.length==0){
                    //     $("#livingSince").after('<div class="alert alert-danger">Living Since Should be Selected.</div>');
                    //     e.preventDefault();
                    // }
                    
                    // // To Check referralCnic is empty or not
                    // let referralCnic = $("#referralCnic").val();
                    // if(referralCnic.trim() === '' || referralCnic == null || referralCnic.length==0 || referralCnic.length!=15){
                    //     $("#referralCnic").after('<div class="alert alert-danger">Referral Cnic Since Should be Given & Cnic Should be valid.</div>');
                    //     e.preventDefault();
                    // }
                    
                    // // To Check transactionNo is empty or not
                    // let transactionNo = $("#transactionNo").val();
                    // if(transactionNo.trim() === '' || transactionNo == null || transactionNo.length<4 ){
                    //     $("#transactionNo").after('<div class="alert alert-danger">Transaction No Since Should be Given.</div>');
                    //     e.preventDefault();
                    // }
                });
        });
    </script>


    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

@endsection
<!-- End: Script Section Starts Here -->

