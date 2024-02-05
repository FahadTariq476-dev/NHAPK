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
                            <h2 class="content-header-title float-start mb-0">Survey's Form</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.ShowDashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.suverysForm.list')}}">Survey's Form</a></li>
                                    <li class="breadcrumb-item active">Post Survey's Form</li>
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

                <!-- Content Here -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Survey's Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <h2>Create Dynamic Form</h2>
                                
                                <!-- form -->
                                <form method="post" action="{{route('admin.suverysForm.store')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Form Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Form Description</label>
                                        <textarea name="description" class="form-control" required></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="role_id">Select Role to Show</label>
                                        <select name="role_id" id="role_id" class="form-control" required>
                                            <option value="" selected disabled>Select Role to Show</option>
                                            @if (count($roles)>0)
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                            @else
                                            <option value="" disabled>No Role Found</option>
                                            @endif
                                        </select>
                                    </div>
                            
                                    <div class="form-group mb-1">
                                        <label for="form_structure">Form Structure</label>
                                        <div id="formStructure" class="mb-1">
                                            <!-- Dynamic form rows will be added here -->
                                        </div>
                                        <button type="button" class="btn btn-primary" id="addRowBtn">Add Row</button>
                                    </div>
                            
                                    <button type="submit" class="btn btn-success">Save Form</button>
                                </form>
                                <!--/ form -->
                            </div>

                        </div>
                    </div>
                </div>
                <!--/ Content Here -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

@endsection
@section('js')
<script>
     // JavaScript for adding and removing dynamic rows
     document.addEventListener('DOMContentLoaded', function () {
            var formStructure = document.getElementById('formStructure');
            var addRowBtn = document.getElementById('addRowBtn');

            addRowBtn.addEventListener('click', function () {
                var row = document.createElement('div');
                row.classList.add('row');

                // Column 1: Label column
                var labelCol = document.createElement('div');
                labelCol.classList.add('col-md-4');
                var labelInput = document.createElement('input');
                labelInput.type = 'text';
                labelInput.name = 'labels[]';
                labelInput.classList.add('form-control');
                labelInput.placeholder = 'Label';
                labelCol.appendChild(labelInput);
                row.appendChild(labelCol);

                // Column 2: Type column
                var typeCol = document.createElement('div');
                typeCol.classList.add('col-md-4');
                var typeSelect = document.createElement('select');
                typeSelect.name = 'types[]';
                typeSelect.classList.add('form-control');
                var optionText = ['Text', 'Textarea', 'Checkbox'];

                for (var i = 0; i < optionText.length; i++) {
                    var option = document.createElement('option');
                    option.value = optionText[i].toLowerCase();
                    option.text = optionText[i];
                    typeSelect.appendChild(option);
                }

                typeCol.appendChild(typeSelect);
                row.appendChild(typeCol);

                // Column 3: Remove button
                var removeCol = document.createElement('div');
                removeCol.classList.add('col-md-1');
                var removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.classList.add('btn', 'btn-danger', 'btn-sm');
                removeBtn.innerHTML = 'Remove';
                removeBtn.addEventListener('click', function () {
                    formStructure.removeChild(row);
                });
                removeCol.appendChild(removeBtn);
                row.appendChild(removeCol);

                formStructure.appendChild(row);
            });
        });

    // Function to convert the form structure to JSON string
    function getFormStructure() {
        var rows = document.querySelectorAll('#formStructure .row');
        var formStructure = [];

        rows.forEach(function (row) {
            var label = row.querySelector('input[name="labels[]"]').value;
            var type = row.querySelector('select[name="types[]"]').value;
            formStructure.push({ label: label, type: type });
        });

        return JSON.stringify(formStructure);
    }

    // Attach an event listener to the form to set the form_structure input before submission
    document.querySelector('form').addEventListener('submit', function () {
        var formStructureInput = document.createElement('input');
        formStructureInput.type = 'hidden';
        formStructureInput.name = 'form_structure';
        formStructureInput.value = getFormStructure();

        this.appendChild(formStructureInput);
    });
</script>
@endsection