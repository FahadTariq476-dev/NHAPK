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
                                    <li class="breadcrumb-item"><a href="#">Elections</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.electionCategeories.post')}}">Elections Category</a></li>
                                    <li class="breadcrumb-item active">Elections Category List</li>
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
                        <h4 class="card-title">Election Category List</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <!-- Begin: Data Table for Listing User -->
                            <table class="table mb-0 dataTable" id="nhapkElectionCategoryTable" style="background-color: #f2f2f2; color: #333;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                    <!-- Your data will be populated here dynamically -->
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- End: Data Table for Listing User -->
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
    <!-- ✅ load jQuery ✅ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Include moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- ✅ load DataTables ✅ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        var jq = jQuery.noConflict();
    
        jq(document).ready(function() {
            var dataTable = jq('#nhapkElectionCategoryTable').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'description'},
                    { 
                        data: 'status',
                        render: function(data, type, row) {
                            // Display the status in a span with Bootstrap styles
                            if(data == 0){
                                return '<span class="badge bg-danger">Block</span>';
                            }
                            else{
                                return '<span class="badge bg-success">Active</span>';
                            }
                            // var statusClass = data === '1' ? 'badge bg-danger' : 'badge bg-success';
                            // var statusText = data == '1' ? 'Block' : 'Active';
                            // return '<span class="' + statusClass + '">' + statusText + '</span>';
                        }
                    },
                    { 
                        data: 'created_at', 
                        render: function(data, type, row) {
                            // Format the date in the desired format
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD-MM-yyyy');
                            }
                            return data;
                        }
                    },
                    { 
                        data: null, // Placeholder for the action column
                        render: function(data, type, row) {
                            // Render the button for the action column
                            var statusText = '';
                            var statusClass = '';

                            if (data.status === 0) {
                                statusText = 'Active';
                                statusClass = 'btn btn-success btn-sm';
                            } else {
                                statusText = 'Block';
                                statusClass = 'btn btn-danger btn-sm';
                            }

                            return '<form id="statusForm">@csrf<div class="btn-group"><button class="'+statusClass+' btnChangeStatus" data-id="' + row.id + '">'+statusText+'</button>' +
                                '<button class="btn btn-primary btn-sm edit-btn" data-id="' + row.id + '">Edit</button>' +
                                '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '">Delete</button></div></form>';
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
                    url: "/admin/election/category/list",
                    type: "GET",
                    data: function(d) {
                        // Add any additional parameters you need
                    }
                },
                drawCallback: function(settings) {
                    var json = dataTable.ajax.json();
                    console.log(json);
                },
            });

            // Event delegation for dynamically generated elements
                jq('#nhapkElectionCategoryTable').on('click', '.btnChangeStatus', function(e) {
                    e.preventDefault();
                    //  code for handling status change
                    var dataId = jq(this).data('id');

                    // Show a confirmation SweetAlert
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Are you sure you want to change the status?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, change it!",
                    }).then((result) => {
                        // Check user's choice
                        if (result.isConfirmed) {
                            var csrfToken = $('#statusForm input[name="_token"]').val();
                            jq.ajax({
                                url: '/admin/election/category/change-status/' + dataId,
                                type: 'PUT',
                                data: {
                                    "_token": csrfToken,
                                },
                                success: function(response) {
                                    dataTable.ajax.reload();
                                    if (response.status == 'error') {
                                        Swal.fire({
                                            title: "Error",
                                            text: response.message,
                                            icon: response.status,
                                        });
                                    }
                                    if (response.status == 'success') {
                                        Swal.fire({
                                            title: "Success",
                                            text: response.message,
                                            icon: response.status,
                                        });
                                    }
                                    if (response.status == 'invalid') {
                                        Swal.fire({
                                            title: "Invalid",
                                            text: response.message,
                                            icon: 'warning',
                                        });
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
                        } else {
                            dataTable.ajax.reload();
                            // User pressed Cancel
                            Swal.fire({
                                title: "Cancelled",
                                text: "You pressed Cancel!",
                                icon: "info",
                            });
                            
                        }
                    });
                });


            jq('#nhapkElectionCategoryTable').on('click', '.edit-btn', function(e) {
                e.preventDefault();
                var dataId = jq(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You wan\'t to edit this Referal Level?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with your action here
                        window.location.href = '/admin/election/category/edit/' + dataId;
                    } else {
                        Swal.fire("Cancelled", "You pressed Cancel!", "info");
                    }
                });
            });


            jq('#nhapkElectionCategoryTable').on('click', '.delete-btn', function(e) {
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
                                url: '/admin/election/category/delete/' + dataId,
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