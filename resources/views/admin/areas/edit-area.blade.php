@extends('admin.layouts.main')
@section('title','Area - Edit Area')


@section('css')
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
@endsection

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
                                    <li class="breadcrumb-item"><a href="{{route('admin.areas.list')}}">Areas</a></li>
                                    <li class="breadcrumb-item active">Edit Area</li>
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
                        <h4 class="card-title">Edit Area</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <!-- form Add Area -->
                                <form action="{{route('admin.areas.update')}}" method="POST" id="formStoreAreas">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="areaId" id="areaId" class="form-control" value="{{$areas->id}}" placeholder="Area Id Here:" readonly>
                                    <!-- Select Country -->
                                    <div class="form-group">
                                        <label for="countryId">Country</label>
                                        <select name="countryId" id="countryId" class="form-control">
                                            <option value="" selected disabled>Select Country</option>
                                            @if (count($countries)>0)
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if ($country->id == $areas->countryId) selected @endif >
                                                        {{$country->name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No Country Found</option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('countryId')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    
                                    <!-- Select State -->
                                    <div class="form-group">
                                        <label for="stateId">State</label>
                                        <select name="stateId" id="stateId" class="form-control">
                                            <option value="" selected disabled>Select State</option>
                                            @if (count($states)>0)
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" @if ($state->id == $areas->stateId) selected @endif >
                                                        {{$state->name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No State Found</option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('stateId')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    
                                    <!-- Select City -->
                                    <div class="form-group">
                                        <label for="cityId">City</label>
                                        <select name="cityId" id="cityId" class="form-control">
                                            <option value="" selected disabled>Select City</option>
                                            @if (count($cities)>0)
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}" @if ($city->id == $areas->cityId) selected @endif >
                                                        {{$city->name}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No City Found</option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('cityId')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    
                                    <!-- Area Ttile -->
                                    <div class="form-group">
                                        <label for="areaTitle">Area Title</label>
                                        <input type="text" id="areaTitle" name="areaTitle" value="{{$areas->name}}" class="form-control" placeholder="Enter Your Area Title Here:">
                                    </div>
                                    @error('areaTitle')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    
                                    <!-- Area Description -->
                                    <div class="form-group mb-1">
                                        <label for="areaDescription">Area Description</label>
                                        <textarea name="areaDescription" id="areaDescription" rows="2" class="form-control" placeholder="Enter Your Area Description Here:">{{$areas->description}}</textarea>
                                    </div>
                                    @error('areaDescription')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror

                                    <!-- Action Button -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update</button>
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
         $(document).ready(function(){
            // Initialize Select2 on the city dropdown
            $('#cityId').select2({
                placeholder: 'Select City',
                allowClear: true,
                width: '100%' // Set the width as per your requirement
            });

            // To Get the state using country id
            $("#countryId").change(function(){
                let countryId = $("#countryId").val();
                    $('#stateId').empty();
                    $('#stateId').append('<option value="" disabled selected>Select State</option>');
                    $('#cityId').empty();
                    $('#cityId').append('<option value="" disabled selected>Select City</option>');
                if(countryId !=null){
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
                if(stateId !=null){
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

            // To Check areaTitle is unique or not
            $("#areaTitle").focusout(function (e) { 
                let areaTitle = $("#areaTitle").val();
                $(".alert-danger").remove();
                if(areaTitle.trim() === '' || areaTitle == null || areaTitle.length == 0){
                    return false;
                }
                else if(areaTitle.length > 0 && (areaTitle.length <3 || areaTitle.length>255)){
                    $("#areaTitle").after('<div class="alert alert-danger">Area Title Length Should be Between 3 to 255 characters.</div>');
                }
                else{
                    let oldeAreaname = "{{$areas->name}}";
                    if( areaTitle != oldeAreaname){
                        $.ajax({
                            type: "GET",
                            url: "/admin/area/unique/"+areaTitle,
                            success: function (response) {
                                if(response.status ==  1){
                                    $("#areaTitle").after('<div class="alert alert-danger">'+response.message+'</div>');
                                    $("#areaTitle").focus();
                                }
                            },
                            error:function(error){
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text: 'An error occured: '+error.responseJSON.message,
                                });
                            },
                        });
                    }
                }
                
            });

        });
    </script>

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection