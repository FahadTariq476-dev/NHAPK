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
                            <h2 class="content-header-title float-start mb-0">List Contact Us</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.contactUs.list-contactus')}}">Contact Us</a>
                                    </li>
                                    <li class="breadcrumb-item active">List Contact Us</li>
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
                            <h2>Contact Us Record</h2>
                            <table class="table mb-0 dataTable" id="contactUsTable" style="background-color: #f2f2f2; color: #333;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date & Time</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                    <!-- Your data will be populated here dynamically -->
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date & Time</th>
                                        <th>Contact</th>
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
    <!-- Bootstrap Modal -->
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

 

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @endsection
    @section('js')

    <!-- Include moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- ✅ load DataTables ✅ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        var jq = jQuery.noConflict();
    
        jq(document).ready(function() {
            var dataTable = jq('#contactUsTable').DataTable({
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'mob_no' },
                    { data: 'email' },
                    { 
                        data: 'message', 
                        render: function(data, type, row) {
                            // Show only the first 100 characters with an ellipsis at the end
                            var truncatedDescription = data.length > 100 ? data.substring(0, 100) + '  __...' : data;
                            return truncatedDescription;
                        }
                    },
                    { 
                        data: 'created_at', 
                        render: function(data, type, row) {
                            // Format the date in the desired format
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD-MMM-yyyy [at] h:mm A');
                            }
                            return data;
                        }
                    },
                    { 
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-success btn-sm contact-btn" data-id="' + row.id + '">Show Message</button>';
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
                    url: "/admin/get-contactus",
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
        jq('#contactUsTable')
            .on('click', '.contact-btn', function() {
                var dataId = jq(this).data('id');

                // Fetch the message by ID
                jq.ajax({
                    url: '/admin/contactus/get-message/' + dataId, // Replace with your actual route
                    method: 'GET',
                    success: function(response) {
                        // Show modal with the message
                        jq('#messageModal').find('.modal-body').html('<p>' + response + '</p>');
                        jq('#messageModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Error fetching contact message:', error);
                    }
                });
                
            })
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

