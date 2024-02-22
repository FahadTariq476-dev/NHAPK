@extends('admin.layouts.main')
@section('title','Area - List New Area')
@section('css')
 <style>
    .common-th {
        text-transform: none !important;
        font-size: initial !important;
        letter-spacing: normal !important;
    }
 </style>
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
                                    <li class="breadcrumb-item"><a href="{{route('admin.areas.post')}}">Areas</a></li>
                                    <li class="breadcrumb-item active">List Areas</li>
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
                        <h4 class="card-title">List Areas</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <table class="table mb-0 dataTable" id="nhapkAreaTable" style="background-color: #f2f2f2; color: #333;">
                                    <thead>
                                        <tr>
                                            <th class="common-th">Id</th>
                                            <th class="common-th">Name</th>
                                            <th class="common-th">Description</th>
                                            <th class="common-th">State</th>
                                            <th class="common-th">City</th>
                                            <th class="common-th">Added By</th>
                                            <th class="common-th">Status</th>
                                            <th class="common-th">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Your data will be populated here dynamically -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="common-th">Id</th>
                                            <th class="common-th">Name</th>
                                            <th class="common-th">Description</th>
                                            <th class="common-th">State</th>
                                            <th class="common-th">City</th>
                                            <th class="common-th">Added By</th>
                                            <th class="common-th">Status</th>
                                            <th class="common-th">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
    <!-- ✅ load jQuery ✅ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Include moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- ✅ load DataTables ✅ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        var jq = jQuery.noConflict();
    
        jq(document).ready(function() {
            var dataTable = jq('#nhapkAreaTable').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'description' },
                    { data: 'stateName' },
                    { data: 'cityName' },
                    {
                        data: 'addBy',
                        render: function (data, type, row) {
                            if (data === 'admin') {
                                return '<span class="badge rounded-pill bg-success">Admin</span>';
                            } else if (data === 'user'){
                                return '<span class="badge rounded-pill bg-info">User</span>';
                            }
                        }
                    },
                    {
                        data: 'status',
                        render: function (data, type, row) {
                            if (data === 1) {
                                return '<span class="badge rounded-pill bg-success">Active</span>';
                            } else if (data === 0){
                                return '<span class="badge rounded-pill bg-danger">Block</span>';
                            }
                        }
                    },
                    // Action column
                    { 
                        data: null, // Placeholder for the action column
                        render: function(data, type, row) {
                            // Render the select button for the action column
                            var statusButton = "";
                            if(data.status == 1){
                                statusButton = '<button class="btn btn-danger btn-sm changeStatusBtn" data-id="' + row.id + '">Block</button>';
                            }
                            else if(data.status == 0){
                                statusButton = '<button class="btn btn-success btn-sm changeStatusBtn" data-id="' + row.id + '">Active</button>';
                            }
                            return '<form id="statusForm" >@csrf<div class="btn-group">' +statusButton+
                                '<button type="submit" class="btn btn-primary btn-sm edit-btn" data-id="' + row.id + '">Edit</button>'+
                                '<button type="submit" class="btn btn-warning btn-sm delete-btn" data-id="' + row.id + '">Delete</button></div></form>';
                        }
                    },
                ],
                serverSide: true,
                responsive: true,
                searching: true,
                bLengthChange: false,
                bInfo: false,
                pageLength: 10,
                order: [],
                processing: true,
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                    paginate: {
                        previous: "Prev",
                    },
                },
                aLengthMenu: [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                ajax: {
                    url: "/admin/area/list",
                    type: "GET",
                    data: function(d) {
                        // Add any additional parameters you need
                    },
                    error: function (error) {
                        console.log(error);
                        Swal.fire({
                            icon:'error',
                            title:'Error',
                            text:'An Error occured:'+error.responseJSON.message,
                        });
                    },
                },
                drawCallback: function(settings) {
                    var json = dataTable.ajax.json();
                    console.log(json);
                },
            });

            // Event delegation for dynamically generated elements
            jq('#nhapkAreaTable').on('click', '.edit-btn', function(e) {
                e.preventDefault();
                var dataId = jq(this).data('id');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to edit the Area?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with your action here
                        window.location.href = '/admin/area/edit/' + dataId;
                        
                    } else {
                        dataTable.ajax.reload();
                        Swal.fire("Cancelled", "You pressed Cancel!", "info");
                    }
                });
            });
            
            
            // Event delegation for changeStatus button
            jq('#nhapkAreaTable').on('click', '.changeStatusBtn', function(e) {
                e.preventDefault();
                var dataId = jq(this).data('id');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to change the status of the area?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        var csrfToken = $('#statusForm input[name="_token"]').val();
                        // Proceed with your action here
                        jq.ajax({
                            url: '/admin/area/status/' + dataId ,
                            type: 'PUT',
                            data: {
                                    "_token": csrfToken,
                            },
                            success: function (response) {
                                dataTable.ajax.reload();
                                if (response.status == 'error') {
                                    Swal.fire('Error', response.message, response.status);
                                }
                                else if (response.status === 'success') {
                                    Swal.fire('Success', response.message, response.status);
                                }
                                else if (response.status == 'invalid') {
                                    Swal.fire('Invalid', response.message, 'warning');
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
                    } else {
                        dataTable.ajax.reload();
                        Swal.fire("Cancelled", "You pressed Cancel!", "info");
                    }
                });
            });

            // 
            jq('#nhapkAreaTable').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var dataId = jq(this).data('id');
                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var csrfToken = $('#statusForm input[name="_token"]').val();
                            // Proceed with delete action
                            jq.ajax({
                                url: '/admin/area/delete/' + dataId,
                                type: 'delete',
                                data: {
                                    "_token": csrfToken,
                                },
                                success: function(response) {
                                    dataTable.ajax.reload();
                                    if (response.status == 'error') {
                                        Swal.fire('Error', response.message, response.status);
                                    }
                                    else if (response.status == 'success') {
                                        Swal.fire('Success', response.message, response.status);
                                    }
                                    else if (response.status == 'invalid') {
                                        Swal.fire('Invalid', response.message, 'warning');
                                    }
                                },
                                error: function(error) {
                                    console.log(error);
                                    Swal.fire({
                                        icon:'error',
                                        title:'Error',
                                        text:'An Error occured:'+error.responseJSON.message,
                                    });
                                }
                            });
                        }
                        else{
                            Swal.fire("Cancelled", "You pressed Cancel!", "info");
                        }
                    });
            });

        });
    

    </script>
    
    
      
@endsection