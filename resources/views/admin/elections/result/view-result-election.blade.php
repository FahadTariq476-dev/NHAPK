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
                            <h2 class="content-header-title float-start mb-0">Home</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.electionsResult.index')}}">Elections Result</a></li>
                                    <li class="breadcrumb-item active">View Elections Result</li>
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

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Elections Result</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form action="{{route('admin.electionsResult.calculateResult')}}" method="POST" id="formElectionResult">
                                @csrf
                                <!-- Select elections -->
                                <div class="form-group mb-1">
                                <label for="electionId">Select Election</label>
                                    <select id="electionId" name="electionId" class="form-control select2">
                                        <option value="" selected disabled>Select Election</option>
                                        @if (count($elections)>0)
                                            @foreach ($elections as $election)
                                                <option value="{{ $election->id }}" @if (old('electionId')==$election->id) selected @endif >{{ $election->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Election Found</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" id="btnSubmit">Calculate</button>
                                    <button type="reset" class="btn btn-primary" id="btnReset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Page layout -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Elections Result</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <!-- Begin: Data Table for Listing User -->
                            <table class="table mb-0" id="electionsResult" style="background-color: #f2f2f2; color: #333;">
                                <thead>
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>Candidate Cnic</th>
                                        <th>Candidate Phone Numb</th>
                                        <th>Elecetion Category Name</th>
                                        <th>Elecetion Name</th>
                                        <th>Number of Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                    <!-- Your data will be populated here dynamically -->
                                <tfoot>
                                    <tr>
                                        <th>Candidate Name</th>
                                        <th>Candidate Cnic</th>
                                        <th>Candidate Phone Numb</th>
                                        <th>Elecetion Category Name</th>
                                        <th>Elecetion Name</th>
                                        <th>Number of Votes</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- End: Data Table for Listing User -->
                        </div>
                    </div>
                </div>
                <!--/ Page layout -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

@endsection

    @section('js')

        <script type="text/javascript">
            $(document).ready(function () {
                $("#btnSubmit").click(function (e) { 
                    e.preventDefault();
                    $('.alert-danger').remove();
                    let electionId = $("#electionId").val();
                    if( electionId == null || electionId.trim() === ''){
                        e.preventDefault();
                        $("#electionId").after('<div class="alert alert-danger">Election Should be Provided.</div>');
                    }
                    else{
                        // Assuming you have a form with the ID 'formElectionResult'
                        var formGiven = $("#formElectionResult");

                        // Get the form attributes
                        var formUrl = formGiven.attr('action');
                        var formMethod = formGiven.attr('method');
                        var formData = formGiven.serialize();
                        $.ajax({
                            type: formMethod,
                            url: formUrl,
                            data: formData,
                            dataType: "json",
                            success: function (response) {
                               if(response.status == 'invalid'){
                                    Swal.fire("Invalid", response.message, 'warning');
                                }
                               else if(response.status == 'error'){
                                    Swal.fire("Error", response.message, response.status);
                                }
                               else if(response.status == 'success'){
                                    Swal.fire("Succes", response.message, response.status);
                                    // Clear existing table data
                                    $('#electionsResult tbody').empty();

                                    // Iterate through the result array and append rows to the table
                                    $.each(response.result, function (index, result) {
                                        var newRow = '<tr>' +
                                            '<td>' + result.candidateName + '</td>' +
                                            '<td>' + result.candidateCnic + '</td>' +
                                            '<td>' + result.candidatePhoneNumb + '</td>' +
                                            '<td>' + result.electionCategoryName + '</td>' +
                                            '<td>' + result.electionName + '</td>' +
                                            '<td>' + result.numVotes + '</td>' +
                                            '</tr>';
                                        $('#electionsResult tbody').append(newRow);
                                    });
                                }
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire({
                                    icon:'error',
                                    title:'Error',
                                    text:'An Error occured:'+error.responseJSON.message,
                                });
                            }
                        });
                    }
                    
                });
            });
        </script>
    
    @endsection