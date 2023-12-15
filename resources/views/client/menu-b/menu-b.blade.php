@extends('client.layouts.master')
@section('title','Your title here')

{{-- Begin: Addiitonal CSS Section starts Here --}}
@section('css')
    {{--  --}}
@endsection
{{-- End: Addiitonal CSS Section starts Here --}}

{{-- Begin: Main-Content Section  --}}
@section('content')

    {{-- Begin: To Show sett alert with respect to message --}}
    @if (session('success'))
        <script>
            Swal.fire({ title: 'Success!',  text: "{{ session('success') }}",   icon: 'success' });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({ title: 'Error!',  text: "{{ session('error') }}",   icon: 'error' });
        </script>
    @endif
    @if (session('info'))
        <script>
            Swal.fire({ title: 'Info!',  text: "{{ session('info') }}",   icon: 'info' });
        </script>
    @endif 
    @if (session('warning'))
        <script>
            Swal.fire({ title: 'Warning!',  text: "{{ session('warning') }}",   icon: 'warning' });
        </script>
    @endif
    {{-- End: To Show sett alert with respect to message --}}

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Menu B</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('client.dashboard.index') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Menus</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Menu-B</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        View Menu-B
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
                        <h4 class="card-title">Kick start your next project 🚀</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <p class="text text-justify">
                                Getting start with your project custom requirements using a ready template which is quite difficult and time
                                taking process, Vuexy Admin provides useful features to kick start your project development with no efforts !
                                Getting start with your project custom requirements using a ready template which is quite difficult and time
                                taking process, Vuexy Admin provides useful features to kick start your project development with no efforts !
                            </p>
                            <ul>
                                <li class="text text-justify">
                                    Vuexy Admin provides you getting start pages with different layouts, use the layout as per your custom
                                    requirements and just change the branding, menu &amp; content.
                                </li>
                                <li class="text text-justify">
                                    Every components in Vuexy Admin are decoupled, it means use use only components you actually need! Remove
                                    unnecessary and extra code easily just by excluding the path to specific SCSS, JS file.
                                </li>
                            </ul>
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
{{-- Begin: Main-Content Section  --}}

{{-- Begin: Script Section Starts Here --}}
@section('scripts')
    {{--  --}}
@endsection
{{-- End: Script Section Starts Here --}}
