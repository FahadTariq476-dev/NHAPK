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
                            <h2 class="content-header-title float-start mb-0">List Memebership</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.list-memebership')}}">Membership</a>
                                    </li>
                                    <li class="breadcrumb-item active">List Membership</li>
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
                            <h2>Membership Record</h2>
                            <table class="table mb-0 dataTable" id="memberhsipTable" style="background-color: #f2f2f2; color: #333;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Cnic</th>
                                        <th>Membership Type</th>
                                        <th>Hostel Registration Number</th>
                                        <th>Hostel Name</th>
                                        <th>Referal CNIC</th>
                                        <th>Transaction Id</th>
                                        <th>Gender</th>
                                        <th>Living Since</th>
                                        <th>Previous Hostel</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Your data will be populated here dynamically -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Cnic</th>
                                        <th>Membership Type</th>
                                        <th>Hostel Registration Number</th>
                                        <th>Hostel Name</th>
                                        <th>Referal CNIC</th>
                                        <th>Transaction Id</th>
                                        <th>Gender</th>
                                        <th>Living Since</th>
                                        <th>Previous Hostel</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Status</th>
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
            var dataTable = jq('#memberhsipTable').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'cnic' },
                    { data: 'membership_type_name' },
                    { data: 'hostelreg_no' },
                    { data: 'hostel_name' },
                    { data: 'referal_cnic' },
                    { data: 'transaction_no' },
                    { data: 'gender' },
                    { data: 'since' },
                    { data: 'previous_hostel' },
                    { data: 'country_name' },
                    { data: 'state_name' },
                    { data: 'city_name' },
                    {
                            data: 'status',
                            render: function (data, type, row) {
                                if (data === 'pending') {
                                    return '<span class="badge rounded-pill bg-primary">Pending</span>';
                                } else if (data === 'approve') {
                                    return '<span class="badge rounded-pill bg-success">Approved</span>';
                                } else if (data === 'cancel'){
                                    return '<span class="badge rounded-pill bg-danger">Cancelled</span>';
                                }
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
                                    '<option value="approve" ' + (row.status === 'approve' ? 'selected' : '') + '>Approved</option>' +
                                    '<option value="cancel" ' + (row.status === 'cancel' ? 'selected' : '') + '>Cancelled</option>' +
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
                    url: "/admin/get-membershipList",
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
        jq('#memberhsipTable')
            .on('change', '#changeStatus', function() {
                var selectedValue = jq(this).val();
                var dataId = jq(this).data('id');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to change the membership. ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with your action here
                        jq.ajax({
                            url: '/admin/memberships/update-status/' + dataId + '/' + selectedValue,
                            type: 'get',
                            success: function (response) {
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
                            },
                        });
                    } else {
                        Swal.fire("Cancelled", "You pressed Cancel!", "info");
                    }
                    dataTable.ajax.reload();
                });
            });
    });
    

    </script>
    
    
      
    @endsection

