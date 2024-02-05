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
                            <h2 class="content-header-title float-start mb-0">User List</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.users.list-users')}}">User</a>
                                    </li>
                                    <li class="breadcrumb-item active">User's Listing
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
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0 dataTable" id="usersTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-nowrap">#</th>
                                        <th scope="col" class="text-nowrap">Name</th>
                                        <th scope="col" class="text-nowrap">Firstname</th>
                                        <th scope="col" class="text-nowrap">Lastname</th>
                                        <th scope="col" class="text-nowrap">Hostel_name</th>
                                        <th scope="col" class="text-nowrap">Email</th>
                                        <th scope="col" class="text-nowrap">Date_Of_Birth</th>
                                        <th scope="col" class="text-nowrap">Phone_Number</th>
                                        <th scope="col" class="text-nowrap">Cnic_No</th>
                                        <th scope="col" class="text-nowrap">Address</th>
                                        <th scope="col" class="text-nowrap">Short_Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formattedData as $row)
                                        <tr>
                                            @foreach ($row as $column)
                                                <td>{{ $column }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col" class="text-nowrap">#</th>
                                        <th scope="col" class="text-nowrap">Name</th>
                                        <th scope="col" class="text-nowrap">Firstname</th>
                                        <th scope="col" class="text-nowrap">Lastname</th>
                                        <th scope="col" class="text-nowrap">Hostel_name</th>
                                        <th scope="col" class="text-nowrap">Email</th>
                                        <th scope="col" class="text-nowrap">Date_Of_Birth</th>
                                        <th scope="col" class="text-nowrap">Phone_Number</th>
                                        <th scope="col" class="text-nowrap">Cnic_No</th>
                                        <th scope="col" class="text-nowrap">Address</th>
                                        <th scope="col" class="text-nowrap">Short_Description</th>
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

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endsection

@section('js')
    <!-- Include DataTables script -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            
        var dataTable = $('#usersTable').DataTable({
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
                url: "{{route('admin.users.list-users')}}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                type: "GET",
                data: function(d) {
                    // d.institute_id = '<?= $Institute_id ?? '' ?>';
                }
            },
            "drawCallback": function(settings) {
                var json = dataTable.ajax.json();
                console.log(json)
                // csrfHash = json.token
            },
            responsive: true,
        });
        });
    </script>
    
@endsection
