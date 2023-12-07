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
                            <h2 class="content-header-title float-start mb-0">Menus</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item active">Complaint List</li>
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
                        <div class="table-responsive">
                            <h2>List Complaints Here</h2>
                            <table class="table mb-0 dataTable" id="complaintTable" style="background-color: #f2f2f2; color: #333;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mob No</th>
                                        <th>Email</th>
					                    <th>Room<br>Number</th>
                                        <th>Hostel Name</th>
                                        <th>Complaint Type</th>
                                        <th>Complaint Details</th>
                                        <th>Complaint<br>Prioirty</th>
                                        <th>Complaint Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Complaint</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mob No</th>
                                        <th>Email</th>
					                    <th>Room<br>Number</th>
                                        <th>Hostel Name</th>
                                        <th>Complaint Type</th>
                                        <th>Complaint Details</th>
                                        <th>Complaint<br>Prioirty</th>
                                        <th>Complaint Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Complaint</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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

    <!-- Begin: Bootstrap Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Contact Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Message content will be inserted here dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal" id="modal-closebutton">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Bootstrap Modal -->

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
    var dataTable = jq('#complaintTable').DataTable({
        // DataTables options...
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'mob_no' },
            { data: 'email' },
            { data: 'room_no' },
            { data: 'property_name' },
            { data: 'complaint_type_name' },
            { 
                data: 'complaint_details',
                render: function(data, type, row) {
                    // Show only the first 100 characters with an ellipsis at the end
                    var truncatedDescription = data.length > 100 ? data.substring(0, 50) + '  __...' : data;
                    return truncatedDescription;
                }
            },
            { data: 'complaint_priority' },
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
            { data: 'status' },
            { 
                data: null, // Placeholder for the action column
                render: function(data, type, row) {
                    // Render the select button for the action column
                    // form-select
                    return '<select class="status-select form-select form-control form-select-sm" data-id="' + row.id + '">' +
                                '<option value="" disabled>Select</option>'+
                               '<option value="pending" ' + (row.status === 'pending' ? 'selected' : '') + '>Pending</option>' +
                               '<option value="resolved" ' + (row.status === 'resolved' ? 'selected' : '') + '>Resolved</option>' +
                               '<option value="inprocess" ' + (row.status === 'inprocess' ? 'selected' : '') + '>In-Process</option>' +
                               '<option value="approved" ' + (row.status === 'approved' ? 'selected' : '') + '>Approved</option>' +
                           '</select>';
                }
            },
            { 
                    data: null,
                    render: function(data, type, row) {
                         return '<button class="btn btn-success btn-sm complaint-btn" data-id="' + row.id + '">Complaint</button>';
                    }
            },
        ],
        columnDefs: [
            {
                targets: 8, // Target the 'complaint_priority' column
                render: function(data, type, row) {
                    // Apply background color to the cell based on complaint priority
                    switch (data) {
                        case 'high':
                            return '<span class="alert alert-danger text-danger">High</span>';
                        case 'normal':
                            return '<span class="alert alert-warning text-warning">Normal</span>';
                        case 'low':
                            return '<span class="alert alert-success text-success">Low</span>';
                        default:
                            return data;
                    }
                }
            },
            {
                targets: 10, // Target the 'status' column
                render: function(data, type, row) {
                    // Apply background color to the cell based on status
                    switch (data) {
                        case 'pending':
                            return '<span class="badge bg-danger" id="' + row.id + '">Pending</span>'; 
                        case 'approved':
                            return '<span class="badge bg-warning" id="' + row.id + '">Approved</span>';
                        case 'inprocess':
                            return '<span class="badge bg-info" id="' + row.id + '">In-Progress</span>';
                        case 'resolved':
                            return '<span class="badge bg-success" id="' + row.id + '">Resolved</span>';
                        default:
                            return data;
                    }
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
        "ajax": {
            url: "/get-adminListingComplaint",
            type: "GET",
            data: function(d) {
                d.institute_id = '<?= $Institute_id ?? '' ?>';
            }
        },
        "drawCallback": function(settings) {
            var json = dataTable.ajax.json();
            console.log(json);
        },
        responsive: true,
    });

    // Event delegation for dynamically generated elements
    jq('#complaintTable').on('change', '.status-select', function() {
            var selectedValue = jq(this).val();
            var dataId = jq(this).data('id');
            // Use SweetAlert for confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to change the status to " + selectedValue + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with your action here
                    jq.ajax({
                        url:'/complaint/update-status/'+selectedValue+'/'+dataId,
                        type:'get',
                        success:function(response){
                            if(response=='error'){
                                Swal.fire({
                                    title: 'Error!',
                                    text: "Status didn't update.",
                                    icon: 'error'
                                });
                                dataTable.ajax.reload();
                            }
                            if(response=='success'){
                                Swal.fire({
                                    title: 'Success!',
                                    text: "Status Updated Succefully",
                                    icon: 'success'
                                });
                                dataTable.ajax.reload();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                } else {
                    dataTable.ajax.reload();
                    Swal.fire({
                        title: 'Cancelled',
                        text: "You pressed Cancel!",
                        icon: 'info'
                    });
                }
            });
        }
    )
    .on('click', '.complaint-btn', function() {
        var dataId = jq(this).data('id');

        // Fetch the complaint by ID
        jq.ajax({
            url: '/admin/complaint/list-complaint/get-details/' + dataId, 
            method: 'GET',
            success: function(response) {
                // Show modal with the complaint details
                jq('#messageModal').find('.modal-body').html('<p>' + response + '</p>');
                jq('#messageModal').modal('show');
            },
            error: function(error) {
                console.error('Error fetching contact message:', error);
            }
        });
                
    });
});

     </script>

<script>
    jq(document).ready(function() {
        // Close button ("x" button) click event
        jq('#messageModal .close').click(function() {
            jq('#messageModal').modal('hide');
        });

        // "Close" button click event
        jq('#modal-closebutton').click(function() {
            jq('#messageModal').modal('hide');
        });
        
    });
</script>
    
    @endsection