@extends('client.layouts.master')
@section('title','List Hostel')

{{-- Begin: Addiitonal CSS Section starts Here --}}
@section('css')
    {{--  --}}
    <!-- Begin: DataTables CSS and JS -->
    @include('client.layouts.dataTables-links')
    <!-- End: DataTables CSS and JS -->

@endsection
{{-- End: Addiitonal CSS Section starts Here --}}

{{-- Begin: Main-Content Section  --}}
@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">List Hostel</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.dashboard.index') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.hostels.index') }}">Hostel</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        List Hostel
                                    </li>
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
                <!-- Begin: List Hostel -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Hostel's 🚀</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <table class="table table-bordered data-table" id="hostelsTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-transform: unset">Name</th>
                                        <th style="text-transform: unset">Location</th>
                                        <th style="text-transform: unset">Bedrooms</th>
                                        <th style="text-transform: unset">Floors</th>
                                        <th style="text-transform: unset">Hostel Type</th>
                                        <th style="text-transform: unset">Created</th>
                                        <th style="text-transform: unset">Status</th>
                                        <th style="text-transform: unset">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Data Here</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-transform: unset">Name</th>
                                        <th style="text-transform: unset">Location</th>
                                        <th style="text-transform: unset">Bedrooms</th>
                                        <th style="text-transform: unset">Floors</th>
                                        <th style="text-transform: unset">Hostel Type</th>
                                        <th style="text-transform: unset">Created</th>
                                        <th style="text-transform: unset">Status</th>
                                        <th style="text-transform: unset">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: List Hostel -->

                <div class="row">
                    <div class="col-12">
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

@endsection
{{-- Begin: Main-Content Section  --}}

{{-- Begin: Script Section Starts Here --}}
@section('scripts')
    {{--  --}}
    <script type="text/javascript">
        var jq = jQuery.noConflict();
           jQuery(document).ready(function () {
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('client.hostels.listHostels') }}", // Replace with your data source URL
                    columns: [
                        {data: 'id'},
                        {data: 'name'},
                        {data: 'location'},
                        {data: 'number_bedroom'},
                        {data: 'number_floor'},
                        {data: 'category_name'},
                        {
                            data: 'created_at',
                            render: function (data, type, row) {
                                // Assuming 'created_at' is a valid date string
                                var formattedDate = moment(data).format('DD-MMM-YYYY');
                                return formattedDate;
                            }
                        },
                        {
                            data: 'moderation_status',
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
                        {
                            data: 'null',
                            render: function (data, type, row) {
                                return '<a href="#" data-id="' + row.id + '" class="btn btn-primary btn-sm editHostelBtn">Edit</a>';
                            }
                        },
                    ],
                    order:[[0,'desc']]
                });
    
                // Event delegation for dynamically generated elements
                jq('#hostelsTable').on('click', '.editHostelBtn', function (e) {
                    var dataId = jq(this).data('id');
                    // Navigate to the editBlogView route
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You want to edit the hostel.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Proceed with your action here
                            window.location.href = '/client/hostels/edit/' + dataId;
                        } else {
                            Swal.fire("Cancelled", "You pressed Cancel!", "info");
                        }
                    });
                });


            });
        </script>
    

    
@endsection
{{-- End: Script Section Starts Here --}}

