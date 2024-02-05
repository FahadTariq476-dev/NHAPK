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
                            <h2 class="content-header-title float-start mb-0">List Membership Types</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.list-memebership')}}">Membership</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.membership.membershipTypes.post')}}">Membership Types</a>
                                    </li>
                                    <li class="breadcrumb-item active">List Membership Types</li>
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
                            <h2>List Membership Types</h2>
                            <table class="table mb-0 dataTable" id="membershipTypesTable" style="background-color: #f2f2f2; color: #333;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        {{-- <th>Edit</th> --}}
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
                                        <th>Action</th>
                                        {{-- <th>Edit</th> --}}
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END: Content-->

    {{-- Begin: Modal --}}
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
   {{-- End: Modal --}}

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
            var dataTable = jq('#membershipTypesTable').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'description' },
                    // Action Button to Change the status
                    { 
                        data: null,
                        render: function (data, type, row) {
                        // Add Edit and Delete buttons here
                        return '<div class="btn-group"><button class="btn btn-primary btn-sm editMembershipTypes" data-id="'+ row.id +'">Edit</button> ' +
                            '<button class="btn btn-danger btn-sm deleteMembershipTypes" data-id="'+ row.id +'">Delete</button></div>';
                        }
                    },
                ],
                serverSide: true,
                responsive: true,
                searching: true,
                bLengthChange: false,
                bInfo: false,
                pageLength: 10,
                order: [0],
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
                    url: "/admin/memberships/membership-types/list",
                    type: "GET",
                },
                drawCallback: function(settings) {
                    var json = dataTable.ajax.json();
                    // console.log(json);
                },
            });

            // Event delegation for delete button
            jq('#membershipTypesTable').on('click', '.deleteMembershipTypes', function() {
                var membershipTypeId = jq(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete the Membership Type.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Retrieve CSRF token from the meta tag
                        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                        jq.ajax({
                            url: '/admin/memberships/membership-types/delete/' + membershipTypeId,
                            type: 'DELETE',
                            data: {
                                "_token": csrfToken,
                            },
                            success: function (response) {
                                dataTable.ajax.reload();
                                if (response.status == 'error') {
                                    Swal.fire("Error", response.message, "error");
                                }
                                if (response.status == 'success') {
                                    Swal.fire("Success", response.message, "success");
                                }
                                if (response.status == 'invalid') {
                                    Swal.fire("Invalid", response.message, "warning");
                                }
                            },
                            error: function (error) {
                                console.log(error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred: ' + error.responseJSON.message,
                                });
                            },
                        });
                    } else {
                        dataTable.ajax.reload();
                        Swal.fire("Cancelled", "You pressed Cancel!", "info");
                    }
                });
            });

            // Code to handle edit button
                jq('#membershipTypesTable').on('click', '.editMembershipTypes', function() {
                    var membershipTypeId = jq(this).data('id');
                    // Navigate to the editBlogView route
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You want to edit the Membership Type",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Change it!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Proceed with your action here
                            window.location.href = '/admin/memberships/membership-types/edit/' + membershipTypeId;
                        } else {
                            Swal.fire("Cancelled", "You pressed Cancel!", "info");
                        }
                    });
                    
                });
        });
    

    </script>

    
    
      
    @endsection
