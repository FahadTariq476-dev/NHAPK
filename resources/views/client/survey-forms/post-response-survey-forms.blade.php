@extends('client.layouts.master')
@section('title','Survey\'s Form Response')

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
                            <h2 class="content-header-title float-start mb-0">Survey's Form Response</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('client.dashboard.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('client.surveyForms.viewSurveyForms') }}">Survey's Form</a></li>
                                    <li class="breadcrumb-item active"><a href="#">Survey's Form Response</a></li>
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
                        <h4 class="card-title">Survey's Form Response</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form action="{{route('client.surveyForms.storeResponseSurveyForms')}}" method="POST">
                                @csrf
                                <input type="hidden" name="dynamicSurveysFormsId" id="dynamicSurveysFormsId" value="{{ $dynamicSurveysForms->id }}" required>
                                <h3>{{ $dynamicSurveysForms->title }}</h3>
                                <h3>Description: </h3>{{ $dynamicSurveysForms->description }}
                                <h3>Role: </h3>{{ $dynamicSurveysForms->roleId->name }}

                                <!-- Form Structure -->
                                <div>
                                    <h4>Form Structure</h4>

                                    @php
                                        $formStructure = json_decode(stripslashes($dynamicSurveysForms->form_structure), true);
                                    @endphp
                                    
                                    @if ($formStructure && is_array($formStructure))
                                        @foreach ($formStructure as $field)
                                            <div class="mb-2">
                                                <label>{{ $field['label'] }}</label>
                                    
                                                @if ($field['type'] === 'text')
                                                    <input type="text" name="responses[{{ $field['label'] }}]" class="form-control">
                                                @elseif ($field['type'] === 'textarea')
                                                    <textarea name="responses[{{ $field['label'] }}]" class="form-control"></textarea>
                                                @elseif ($field['type'] === 'checkbox')
                                                    <input type="checkbox" name="responses[{{ $field['label'] }}]" value="1">
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No form structure available.</p>
                                    @endif

                                <!-- Actions Button -->
                                <div class="form-group">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End: Kick start -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
<!-- Begin: Main-Content Section  -->

<!-- Begin: Script Section Starts Here -->
@section('scripts')

@endsection
<!-- End: Script Section Starts Here -->

