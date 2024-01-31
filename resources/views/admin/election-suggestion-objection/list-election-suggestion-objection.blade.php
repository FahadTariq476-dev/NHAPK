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
                            <h2 class="content-header-title float-start mb-0">Election Suggestion / Objection</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.electionSuggestion.list')}}">Election Suggestion / Objection</a>
                                    </li>
                                    <li class="breadcrumb-item active">List Election Suggestion / Objection</li>
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
                    <div class="col-12">
                        <div class="table-responsive">
                            <h2>Election Suggestion / Objection Record</h2>
                            <table class="table mb-0 dataTable" id="electionSuggestionTable" style="background-color: #f2f2f2; color: #333;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Text</th>
                                        <th>Suggestion Type</th>
                                        <th>Candidate Name</th>
                                        <th>Candidate Cnic</th>
                                        <th>Candidate Phone Number</th>
                                        <th>Election Name</th>
                                        <th>Election Category</th>
                                        <th>Suggestion User Name</th>
                                        <th>Suggestion User Cnic</th>
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
                                        <th>Id</th>
                                        <th>Text</th>
                                        <th>Suggestion Type</th>
                                        <th>Candidate Name</th>
                                        <th>Candidate Cnic</th>
                                        <th>Candidate Phone Number</th>
                                        <th>Election Name</th>
                                        <th>Election Category</th>
                                        <th>Suggestion User Name</th>
                                        <th>Suggestion User Cnic</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
    <!-- ✅ load jQuery ✅ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Include moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- ✅ load DataTables ✅ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        var jq = jQuery.noConflict();
    
        jq(document).ready(function() {
            var dataTable = jq('#electionSuggestionTable').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'text' },
                    {
                            data: 'suggestionType',
                            render: function (data, type, row) {
                                if (data === 'objection') {
                                    return '<span class="badge rounded-pill bg-primary">Objection</span>';
                                } else if (data === 'suggestion') {
                                    return '<span class="badge rounded-pill bg-success">Suggestion</span>';
                                } else {
                                    return data;
                                }
                            }
                    },
                    { data: 'candidate_name' },
                    { data: 'candidate_cnic_no' },
                    { data: 'candidate_phone_number' },
                    { data: 'election_name' },
                    { data: 'election_category_name' },
                    { data: 'user_name' },
                    { data: 'user_cnic_no' },
                    {
                            data: 'status',
                            render: function (data, type, row) {
                                if (data === 'pending') {
                                    return '<span class="badge rounded-pill bg-primary">Pending</span>';
                                } else if (data === 'approved') {
                                    return '<span class="badge rounded-pill bg-success">Approved</span>';
                                } else if (data === 'cancelled'){
                                    return '<span class="badge rounded-pill bg-danger">Cancelled</span>';
                                }
                            }
                    },
                    {
                        data: 'created_at', 
                        render: function(data, type, row) {
                            // Format the date in the desired format
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD-MM-yyyy HH:mm:ss');
                            }
                            return data;
                        }
                    },
                    // Action column
                    { 
                        data: null, // Placeholder for the action column
                        render: function(data, type, row) {
                            // Render the select button for the action column
                            return '<select class="status-select form-select form-select-sm" id="changeStatus" data-id="' + row.id + '">' +
                                    '<option value="" disabled>Select</option>'+
                                    '<option value="pending" ' + (row.status === 'pending' ? 'selected' : '') + '>Pending</option>' +
                                    '<option value="approved" ' + (row.status === 'approved' ? 'selected' : '') + '>Approved</option>' +
                                    '<option value="cancelled" ' + (row.status === 'cancelled' ? 'selected' : '') + '>Cancelled</option>' +
                                '</select>';
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
                    url: "/admin/election-suggestion/list",
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
        jq('#electionSuggestionTable')
            .on('change', '#changeStatus', function() {
                var selectedValue = jq(this).val();
                var dataId = jq(this).data('id');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to change the status. ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with your action here
                        jq.ajax({
                            url: '/admin/election-suggestion/change-status/' + dataId + '/' + selectedValue,
                            type: 'get',
                            success: function (response) {
                                dataTable.ajax.reload();
                                if (response.status == 'error') {
                                    Swal.fire("Error", response.message, response.status);
                                }
                                else if (response.status == 'success') {
                                    Swal.fire("Success", response.message, response.status);
                                }
                                else if (response.status == 'invalid') {
                                    Swal.fire("Invalid", response.message, 'warning');
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
    });
    

    </script>
    
    
      
    @endsection

