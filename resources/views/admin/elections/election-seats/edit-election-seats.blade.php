@extends('admin.layouts.main')
@section('title','Election Seats - Edit')
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
                                    <li class="breadcrumb-item"><a href="{{route('admin.electionSeats.list')}}">Elections Seat</a></li>
                                    <li class="breadcrumb-item active">Edit Elections Seat</li>
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
                        <h4 class="card-title">Edit Election Seat</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <!-- form -->
                                <form action="{{route('admin.electionSeats.update')}}" method="POST" id="formAddElectionSeat">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="electionSeatId" id="electionSeatId" value="{{$electionSeats->id}}" class="form-control" placeholder="Election Seat Id Here:" readonly>
                                    <!-- Election Seat Title -->
                                    <div class="form-group">
                                        <label for="title">Seat Title:</label>
                                        <input type="text" name="title" id="title" value="{{$electionSeats->title}}" class="form-control" placeholder="Enter Election Seat Title Here:" >
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    
                                    <!-- Election Seat Description -->
                                    <div class="form-group mb-1">
                                        <label for="title">Seat Description:</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Your Seat Description Here: ">{{$electionSeats->description}}</textarea>
                                    </div>

                                    <!-- Actions Button Here -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Change</button>
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

    </script>
@endsection