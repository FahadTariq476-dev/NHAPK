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
                                    <li class="breadcrumb-item active">Listing
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <table class="table mb-0 dataTable" id="nhapkBlogTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-nowrap">#</th>
                                        <th scope="col" class="text-nowrap">Name</th>
                                        <th scope="col" class="text-nowrap">Firstname</th>
                                        <th scope="col" class="text-nowrap">Lastname</th>
                                        <th scope="col" class="text-nowrap">Hostel_name</th>
                                        <th scope="col" class="text-nowrap">Email</th>
                                        {{-- <th scope="col" class="text-nowrap">Email_verified_at</th> --}}
                                        <th scope="col" class="text-nowrap">Password</th>
                                        <th scope="col" class="text-nowrap">Remember_Token</th>
                                        <th scope="col" class="text-nowrap">Date_Of_Birth</th>
                                        <th scope="col" class="text-nowrap">Phone_Number</th>
                                        <th scope="col" class="text-nowrap">Cnic_No</th>
                                        <th scope="col" class="text-nowrap">Institute</th>
                                        <th scope="col" class="text-nowrap">Address</th>
                                        <th scope="col" class="text-nowrap">Short_Description</th>
                                        <th scope="col" class="text-nowrap">Slug</th>
                                        
                                        <th scope="col" class="text-nowrap">Picture_Path</th>
                                        <th scope="col" class="text-nowrap">Youtube_Link</th>
                                        <th scope="col" class="text-nowrap">Facebook_Link</th>
                                        <th scope="col" class="text-nowrap">Instagram_Link</th>
                                        <th scope="col" class="text-nowrap">Auto_Approve_Booking	</th>
                                         <th scope="col" class="text-nowrap">Nhapk_Register</th>
                                        
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
                            </table>
                           
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-10">
                             
                            </div>
                        </div>
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Info:</strong> Please check the&nbsp;<a class="text-primary"
                                    href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layout-full.html"
                                    target="_blank">Layout full documentation</a>&nbsp; for more details.
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
    <!-- Include DataTables script -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            
        var dataTable = $('#nhapkBlogTable').DataTable({
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
                url: "{{route('admin.user')}}",
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
