@extends('admin.layouts.main')
@section('title')
	{{env('APP_NAME')}} | MembershipType
@endsection
@section('main-container')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
     <!-- Success message -->
     <div id="successMessage" class="alert alert-success" role="alert" style="display: none;"></div>

     <!-- Error message -->
     <div id="errorMessage" class="alert alert-danger" role="alert" style="display: none;"></div>
    @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Membership Type</h2>
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
            <!-- Responsive tables start -->
            <button data-id="" type="button" class="btn btn-outline-primary mb-2 addMembershipType" data-bs-toggle="modal" data-bs-target="#inlineForm">
                Add Membership Type
            </button>
            <div class="row" id="table-responsive">
                <div class="col-12">

                    <div class="card">
                        {{-- <div class="card-header">
                            <h4 class="card-title">Category List</h4>
                        </div> --}}
                        <div class="table-responsive">
                            <table class="table mb-0 dataTable " id="_ListingTable">
                                <thead >
                                    <tr>
                                        <th scope="col" class="text-nowrap">#</th>
                                        <th scope="col" class="text-nowrap">Name</th>
                                        <th scope="col" class="text-nowrap">Description</th>
                                        <th scope="col" class="text-nowrap">Status</th>
                                        <th scope="col" class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            </div>
        </div>
    </div>
</div>
@endsection
@section("js")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Include moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- ✅ load DataTables ✅ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
    $(document).ready(function() {
        var dataTable = $('#_ListingTable').DataTable({
            serverSide: true,
            responsive: true,
            searching: true,
            bLengthChange: false,
            bInfo: false,
            pageLength: 10,
            order: [],
            processing: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw " ></i><span class="sr-only ">Loading...</span> ',
                paginate: {
                previous: " Prev  ",
                },
            },
            aLengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            "ajax": {
                url: "membershiptype/list",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                type: "POST",
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
        // show modal
        $(document).on('click', '.addMembershipType', function() {
            var update_id = $(this).data("id");
            // $('#inlineForm .modal-content').html('');
            // Perform Ajax request here
            $.ajax({
                url: 'membershiptype/getrowdetail', // Replace with the actual URL for your Ajax request
                type: 'POST', // or 'POST' depending on your requirements
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: {
                    // Add any data you want to send in the request body
                    update_id: update_id
                },
                success: function(response) {
                    // Handle the response from the server
                    // Append the response HTML to the modal body
                    $('#inlineForm .modal-content').html(response);
                    // Open the modal
                    $('#inlineForm').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
        // show edit modal
        $(document).on('click', '.editItem', function() {
            var update_id = $(this).data("id");
            // $('#inlineForm .modal-content').html('');
            // Perform Ajax request here
            $.ajax({
                url: 'membershiptype/getrowdetail', // Replace with the actual URL for your Ajax request
                type: 'POST', // or 'POST' depending on your requirements
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                data: {
                    // Add any data you want to send in the request body
                    update_id: update_id
                },
                success: function(response) {
                    // Handle the response from the server
                    // Append the response HTML to the modal body
                    $('#inlineForm .modal-content').html(response);
                    // Open the modal
                    $('#inlineForm').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
        //Delete item
        $(document).off('click', '.deleteItem').on('click', '.deleteItem', function(e) {
            var id = $(this).data('id');
            e.preventDefault();
            Swal.fire({
                title: "Are you sure to delete the selected record?",
                text: "You will not be able to recover this record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0,
                preConfirm: false
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "membershiptype/delete",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    data: {
                    'id': id
                    },
                    async: false,
                    success: function(result) {
                        if(result.status == "success"){
                            toastr.success("Deleted Successfully");
                            location.reload();
                        }else{
                            toastr.error("Something went wrong");
                        }
                    }
                });
                }
            });
        });
    });
</script>
@endsection
