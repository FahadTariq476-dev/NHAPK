@extends('client.layouts.master')
@section('title','Your title here')

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
                            <h2 class="content-header-title float-start mb-0">SOP's</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.dashboard.index') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">SOP's</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        List SOP's
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
                <!-- Begin: Kick start -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List SOP's to Download 🚀</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <table class="table table-bordered data-table" id="sopsTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-transform: unset">Title</th>
                                        <th style="text-transform: unset">Description</th>
                                        <th style="text-transform: unset">Created Date</th>
                                        <th style="text-transform: unset">Show</th>
                                        <th style="text-transform: unset">Download</th>
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
                                        <th style="text-transform: unset">Title</th>
                                        <th style="text-transform: unset">Description</th>
                                        <th style="text-transform: unset">Created Date</th>
                                        <th style="text-transform: unset">Show</th>
                                        <th style="text-transform: unset">Download</th>
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

    <!-- Begin: Bootstrap Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">SOP's Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Message content will be inserted here dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End:   Bootstrap Modal -->

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
                ajax: "{{ route('client.sops.list_sops') }}", // Replace with your data source URL
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {
                        data: 'description', 
                        render: function(data, type, row) {
                            // Show only the first 100 characters with an ellipsis at the end
                            var truncatedDescription = data.length > 100 ? data.substring(0, 100) + '  __...' : data;
                            return truncatedDescription;
                        }
                    },
                    {
                        data: 'created_at',
                        render: function (data, type, row) {
                            // Assuming 'created_at' is a valid date string
                            var formattedDate = moment(data).format('DD-MMM-YYYY');
                            return formattedDate;
                        }
                    },
                    {
                        data: 'null',
                        render: function (data, type, row) {
                            return '<a href="#" data-id="' + row.id + '" class="btn btn-primary btn-sm showDesc-btn">Show</a>';
                        }
                    },
                    {
                        data: 'null',
                        render: function (data, type, row) {
                            var assetPath = '{{ asset('') }}'; // Assuming Laravel's asset function is available in your Blade template
                            var sopsFilePath = assetPath + row.file_path;
                            return '<a href="#" data-id="' + row.id + '" data-file="' + sopsFilePath + '" class="btn btn-success btn-sm downloadSop">Download</a>';
                        }
                    },
                ],
                order:[[1,'desc']]
            });

            // Event delegation for dynamically generated elements
            jq('#sopsTable')
            .on('click', '.showDesc-btn', function () {
                var dataId = jq(this).data('id');

                // Fetch the message by ID
                jq.ajax({
                    url: '/client/sops/list/get-description/' + dataId,
                    method: 'GET',
                    success: function (response) {
                        jq('#messageModal').find('.modal-body').html('<p>' + response + '</p>');
                        jq('#messageModal').modal('show');
                    },
                    error: function (error) {
                        console.error('Error fetching contact message:', error);
                    }
                });
            })

            jq('#sopsTable').on('click', '.downloadSop', function (e) {
                e.preventDefault();

                var fileUrl = $(this).data('file');
                var fileId = $(this).data('id');

                Swal.fire({
                    title: 'Download Confirmation',
                    text: 'Are you sure you want to download this file?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, download it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                    // Initiate the download here
                    initiateDownload(fileUrl, fileId);
                    }
                });
            });
        });

        // Begin: Function to download the file
        function initiateDownload(fileUrl, fileId) {
            // Create a temporary link element
            var link = document.createElement('a');

            // Set the href attribute to the file URL
            link.href = fileUrl;

            // Set the download attribute to force the download
            link.download = '';

            // Append the link to the document
            document.body.appendChild(link);

            // Trigger a click event on the link
            link.click();

            // Remove the link from the document
            document.body.removeChild(link);
        }
        // End: Function to download the file
    </script>

    <script>
        jq(document).ready(function() {
            // Close button ("x" button) click event
            jq('#messageModal .close').click(function() {
                jq('#messageModal').modal('hide');
            });

            // "Close" button click event
            jq('#messageModal .modal-footer .btn-warning').click(function() {
                jq('#messageModal').modal('hide');
            });
            
        });
    </script>
@endsection
{{-- End: Script Section Starts Here --}}

