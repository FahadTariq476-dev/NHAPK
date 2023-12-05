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
                            @if(session('success'))
                                <script>
                                    Swal.fire({
                                        title: 'Success!',
                                        text: "{{ session('success') }}",
                                        icon: 'success'
                                    });
                                </script>
                            @endif
                            @if(session('error'))
                                <script>
                                    Swal.fire({
                                        title: 'Error!',
                                        text: "{{ session('error') }}",
                                        icon: 'error'
                                    });
                                </script>
                            @endif
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
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                    <!-- Your data will be populated here dynamically -->
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
                                        <th>Edit</th>
                                        <th>Delete</th>
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
                    // Edit button
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-primary btn-sm edit-btn" data-id="' + row.id + '">Edit</button>';
                        }
                    },
                    // Delete button
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-warning btn-sm delete-btn" data-id="' + row.id + '">Status</button>';
                        }
                    }
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
            .on('click', '.edit-btn', function() {
                var dataId = jq(this).data('id');
                // Navigate to the editBlogView route
                // window.location.href = '/admin/editMembership/' + dataId;
            })
            .on('click', '.delete-btn', function() {
                var dataId = jq(this).data('id');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                })
            });
    });
    

    </script>
    
    
      
    @endsection

