@extends('client.layouts.master')
@section('title','Membership - Refferal Link')

{{-- Begin: Addiitonal CSS Section starts Here --}}
@section('css')
    {{--  --}}
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
                            <h2 class="content-header-title float-start mb-0">Referal Link</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.dashboard.index') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Membership</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Referal Link for Membership
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
                        <h4 class="card-title">Referal Link for Membership is:</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                           {{-- Referal Link Here --}}
                            <p id="referralLink">{{ $referralLink }}</p>
                            <button class="btn btn-primary" onclick="copyToClipboard()">Copy Link</button>
                 
                        </div>
                    </div>
                </div>
                <!-- End: Kick start -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
{{-- Begin: Main-Content Section  --}}

{{-- Begin: Script Section Starts Here --}}
@section('scripts')
    {{--  --}}
    <script>
        function copyToClipboard() {
            // Get the referral link text
            var referralLinkText = document.getElementById('referralLink').innerText;

            // Create a temporary input element
            var tempInput = document.createElement('input');
            tempInput.value = referralLinkText;
            document.body.appendChild(tempInput);

            // Select and copy the text
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            // Optionally, provide feedback to the user (e.g., show a tooltip)
            Swal.fire('Link copied to clipboard!');
        }
    </script>
@endsection
{{-- End: Script Section Starts Here --}}

