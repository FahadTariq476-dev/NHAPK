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
                            <h2 class="content-header-title float-start mb-0">Post News & Media</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li> 
                                    <li class="breadcrumb-item"><a href="{{route('admin.newsfeeds.post-newsfeeds')}}">News & Media</a>
                                    </li>
                                    <li class="breadcrumb-item active">List News & Media</li>
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
                            <h2>Posted Blogs</h2>
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
                            <table class="table mb-0 dataTable" id="nhapkBlogTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Short Description</th>
                                        <th>Image Path</th>
                                        <th>Thumbnail Image Path</th>
                                        <th>Featured Post</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                    <!-- Your data will be populated here dynamically -->
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Short Description</th>
                                        <th>Image Path</th>
                                        <th>Thumbnail Image Path</th>
                                        <th>Featured Post</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
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
            var dataTable = jq('#nhapkBlogTable').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    {
                        data: 'short_description',
                        render: function(data, type, row) {
                            // Show only the first 100 characters with an ellipsis at the end
                            var truncatedDescription = data.length > 100 ? data.substring(0, 100) + '  __...' : data;
                            return truncatedDescription;
                        }
                    },
                    { data: 'image_path' },
                    { data: 'thumbnail_image_path' },
                    { 
                        data: 'featured_post', 
                        render: function(data, type, row) {
                            // Render a checkbox based on the "featured_post" value
                            return '<input type="checkbox" ' + (data ? 'checked' : '') + ' disabled>';
                        }
                    },
                    { 
                        data: 'status',
                        render: function(data, type, row) {
                            // Display the status in a span with Bootstrap styles
                            var statusClass = data === 'pending' ? 'badge bg-warning' : 'badge bg-success';
                            return '<span class="' + statusClass + '">' + data + '</span>';
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
                            // Render the select button for the action column
                            // form-select
                            return '<select class="status-select form-select form-control" data-id="' + row.id + '">' +
                                    '<option value="" disabled>Select</option>'+
                                    '<option value="pending" ' + (row.status === 'pending' ? 'selected' : '') + '>Pending</option>' +
                                    '<option value="published" ' + (row.status === 'published' ? 'selected' : '') + '>Published</option>' +
                                '</select>';
                        }
                    },
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
                            return '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '">Delete</button>';
                        }
                    }
                ],
                serverSide: true,
                responsive: true,
                searching: true,
                bLengthChange: false,
                bInfo: false,
                pageLength: 3,
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
                    url: "/admin/get-newfeedList",
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
        jq('#nhapkBlogTable')
        .on('change', '.status-select', function() {
            //  code for handling status change
            var selectedValue = jq(this).val();
            var dataId = jq(this).data('id');

            // Show a confirmation SweetAlert
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to change the status to " + selectedValue + "?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, change it!",
            }).then((result) => {
                // Check user's choice
                if (result.isConfirmed) {
                    // Proceed with your action here
                    jq.ajax({
                        url: '/admin/newsfeeds/update-status/' + selectedValue + '/' + dataId,
                        type: 'get',
                        success: function(response) {
                            if (response == 'error') {
                                Swal.fire({
                                    title: "Error",
                                    text: "Status didn't update.",
                                    icon: "error",
                                });
                                dataTable.ajax.reload();
                            }
                            if (response == 'success') {
                                Swal.fire({
                                    title: "Success",
                                    text: "Status updated successfully",
                                    icon: "success",
                                });
                                dataTable.ajax.reload();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                } else {
                    // User pressed Cancel
                    Swal.fire({
                        title: "Cancelled",
                        text: "You pressed Cancel!",
                        icon: "info",
                    });
                    dataTable.ajax.reload();
                }
            });
        })
            .on('click', '.edit-btn', function() {
                var dataId = jq(this).data('id');
                // Navigate to the editBlogView route
                window.location.href = '/admin/editNewsfeeds/' + dataId;
            })
            .on('click', '.delete-btn', function() {
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
                        // Proceed with delete action
                            jq.ajax({
                                url: '/admin/delete-newsfeeds/' + dataId,
                                type: 'get',
                                success: function(response) {
                                    if (response == 'success') {
                                        Swal.fire('Deleted!', 'Item deleted successfully', 'success');
                                        dataTable.ajax.reload();
                                    } else {
                                        Swal.fire('Error!', 'Error deleting item', 'error');
                                    }
                                },
                                error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });
    });
    

    </script>
    
    
      
    @endsection
