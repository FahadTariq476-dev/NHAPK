<!-- Add Area Modal -->
<div class="modal fade" id="addAreaModal" tabindex="-1" role="dialog" aria-labelledby="addAreaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAreaModalLabel">Add New Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="addAreaModalCloseIcon">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addAreaForm" action="{{route('client.areas.store')}}" method="POST">
                    @csrf
                    <!-- Country -->
                    <div class="form-group">
                        <input type="hidden" id="addAreaCountryId" name="addAreaCountryId" value="" class="form-control" placeholder="Enter Your Area Title Here:" readonly>
                    </div>

                    <!-- State -->
                    <div class="form-group">
                        <input type="hidden" id="addAreaStateId" name="addAreaStateId" value="" class="form-control" placeholder="Enter Your Area Title Here:" readonly>
                    </div>

                    <!-- City -->
                    <div class="form-group">
                        <input type="hidden" id="addAreaCityId" name="addAreaCityId" value="" class="form-control" placeholder="Enter Your Area Title Here:" readonly>
                    </div>

                    <!-- Area Ttile -->
                    <div class="form-group">
                        <label for="areaTitle">Area Title</label>
                        <input type="text" id="areaTitle" name="areaTitle" class="form-control" placeholder="Enter Your Area Title Here:">
                    </div>
                    
                    <!-- Area Description -->
                    <div class="form-group mb-1">
                        <label for="areaDescription">Area Description</label>
                        <textarea name="areaDescription" id="areaDescription" rows="2" class="form-control" placeholder="Enter Your Area Description Here:">{{old('areaDescription')}}</textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="addAreaModalCloseBtn">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveArea">Save</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $("#addAreaModalBtn").click(function (e) { 
            e.preventDefault();
            //  To Check countryId  is empty or not
            let countryId = $("#countryId").val();
            if(countryId == null || countryId.trim()=== ''){
                $("#countryId").after('<div class="alert alert-danger">Country Should be Provided.</div>');
                return false;
            }
            
            //  To Check stateId  is empty or not
            let stateId = $("#stateId").val();
            if(stateId == null || stateId.trim()=== ''){
                $("#stateId").after('<div class="alert alert-danger">State Should be Provided.</div>');
                return false;
            }
            
            //  To Check cityId  is empty or not
            let cityId = $("#cityId").val();
            if(cityId == null || cityId.trim()=== ''){
                $("#cityId").after('<div class="alert alert-danger">City Should be Provided.</div>');
                return false;
            }
            resetFieldsAddAreaModal();
            $("#addAreaCountryId").val(countryId);
            $("#addAreaStateId").val(stateId);
            $("#addAreaCityId").val(cityId);
            $("#addAreaModal").modal('show');
        });
        
        $("#addAreaModalCloseBtn").click(function (e) { 
            e.preventDefault();
            resetFieldsAddAreaModal();
            $("#addAreaModal").modal('hide');
        });
        
        $("#addAreaModalCloseIcon").click(function (e) { 
            e.preventDefault();
            resetFieldsAddAreaModal();
            $("#addAreaModal").modal('hide');
        });
        function resetFieldsAddAreaModal(){
            $(".alertDangerAddArea").remove();
            $("#addAreaCountryId").val('');
            $("#addAreaStateId").val('');
            $("#addAreaCityId").val('');
            $("#addAreaCityId").val('');
            $("#areaTitle").val('');
            $("#areaDescription").val('');
        }

        $("#btnSaveArea").click(function (e) { 
            e.preventDefault();
            $(".alertDangerAddArea").remove();
            let areaTitle = $("#areaTitle").val();
            if( areaTitle.trim === '' || areaTitle == null || areaTitle.length == 0){
                $("#areaTitle").after('<div class="alert alert-danger alertDangerAddArea">Area Title Should be Provided.</div>');
                return false;
            }
            $.ajax({
                type: "POST",  // Use POST for form submissions
                url: $("#addAreaForm").attr('action'),  // Get the form action dynamically
                data: $("#addAreaForm").serialize(),  // Serialize the form data
                success: function (response) {
                    if(response.status == "invalid"){
                        Swal.fire({
                            icon:'warning',
                            title:'Invalid',
                            text: response.message,
                        });
                    }
                    else if(response.status == "success"){
                        resetFieldsAddAreaModal();
                        $('#addAreaModal').modal('hide');
                        Swal.fire({
                            icon:response.status,
                            title:'Success',
                            text: response.message,
                        });
                        $('#areaId').append('<option value="'+response.areas.id+'">'+response.areas.name+'</option>'); 
                    }
                    else if(response.status == "error"){
                        Swal.fire({
                            icon:response.status,
                            title:'Error',
                            text: response.message,
                        });
                    }
                    else {
                        Swal.fire({
                            icon:'error',
                            title:'Error',
                            text: 'There is an error.',
                        });
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // Display validation errors
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (field, messages) {
                                let errorMessage = messages.join('<br>');
                                // Check if the current error is for addAreaCountryId
                                if (field === 'addAreaCountryId'|| field === 'addAreaStateId'|| field === 'addAreaCityId') {
                                    // Display SweetAlert
                                    Swal.fire({
                                        title: 'Error',
                                        text: errorMessage, // You can customize the message here
                                        icon: 'error',
                                    }).then(function () {
                                        // Hide the modal
                                        $('#addAreaModal').modal('hide');
                                    });

                                    // Exit the loop
                                    return false;
                                }
                                $("#" + field).after('<div class="alert alert-danger alertDangerAddArea">' + errorMessage + '</div>');
                            });
                        } else {
                        // Handle other errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred: ' + xhr.responseJSON.message,
                        });
                    }
                },
            });
        });

    });
</script>