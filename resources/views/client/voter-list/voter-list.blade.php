@extends('client.layouts.master')
@section('title','Voter List')

<!-- Begin: Addiitonal CSS Section starts Here -->
@section('css')
    <!-- Begin: DataTables CSS and JS -->
    @include('client.layouts.dataTables-links')
    <!-- End: DataTables CSS and JS -->

@endsection
<!-- End: Addiitonal CSS Section starts Here -->

<!-- Begin: Main-Content Section  -->
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
                            <h2 class="content-header-title float-start mb-0">Voter List</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('client.dashboard.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Voter List</li>
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
                <!-- Begin: Kick start -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Voter List</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <table class="table table-bordered data-table" id="votersListTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-transform: unset">Name</th>
                                        <th style="text-transform: unset">Mob No</th>
                                        <th style="text-transform: unset">Area</th>
                                        <th style="text-transform: unset">Hostel Name</th>
                                        <th style="text-transform: unset">Status</th>
                                        <th style="text-transform: unset">Created Date</th>
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
                                        <th style="text-transform: unset">Mob No</th>
                                        <th style="text-transform: unset">Area</th>
                                        <th style="text-transform: unset">Hostel Name</th>
                                        <th style="text-transform: unset">Status</th>
                                        <th style="text-transform: unset">Created Date</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: Kick start -->

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
<!-- Begin: Main-Content Section  -->

<!-- Begin: Script Section Starts Here -->
@section('scripts')
<script type="text/javascript">
    var jq = jQuery.noConflict();
       jQuery(document).ready(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('client.vote.showVotersList') }}", // Replace with your data source URL
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'phone_number'},
                    {data: 'area_name'},
                    {data: 'hostel_name'},
                    {
                        data: 'verified_account',
                        render: function (data, type, row) {
                            if (data == 0) {
                                return '<div class="alert alert-warning">Unverified</div>';
                            } else {
                                return '<div class="alert alert-success">Verified</div>';
                            }
                        }
                    },
                    {
                        data: 'created_at',
                        render: function (data, type, row) {
                            // Assuming 'created_at' is a valid date string
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD-MMM-yyyy [at] h:mm A');
                            }
                            return data;
                            // var formattedDate = moment(data).format('DD-MMM-YYYY');
                            // return formattedDate;
                        }
                    },
                ],
                order:[[0,'desc']]
            });
        });
       
    </script>


@endsection
<!-- End: Script Section Starts Here -->

