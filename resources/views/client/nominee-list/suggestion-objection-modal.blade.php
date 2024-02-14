<div class="modal" tabindex="-1" role="dialog" id="suggestionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enter Your <span class="titleToShow"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="suggestionModalCloseIcon">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="suggestionForm" action="{{route('client.electionSuggestion.post')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="suggestionCandidateId" name="suggestionCandidateId" placeholder="Candidate Id Here:" readonly/>
                    <div class="form-group">
                        <label for="suggestionType">Suggestion Type</label>
                        <select name="suggestionType" id="suggestionType" class="form-control">
                            <option value="" selected disabled>Select Suggestion Type</option>
                            <option value="suggestion">Suggestion</option>
                            <option value="objection">Objection</option>
                        </select>
                    </div>
                    <div class="form-group mb-1" >
                        <label for="suggestionText">Enter Your <span class="titleToShow"></span>:</label>
                        <textarea class="form-control" id="suggestionText" name="suggestionText" rows="3"></textarea>
                        <div id="suggestionTextError"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Handle form submission
        $('#suggestionForm').submit(function (e) {
            e.preventDefault();
            $(".alert-danger").remove();

            let suggestionType = $("#suggestionType").val();
            if (!(suggestionType== 'suggestion' || suggestionType== 'objection')) {
                e.preventDefault();
                $("#suggestionType").after('<div class="alert alert-danger">Suggestion Type should be provided.</div>');
                return false;
            }
            let suggestionText = $("#suggestionText").val();
            if (suggestionText.trim() === '' || suggestionText == null || suggestionText.length === 0) {
                e.preventDefault();
                $("#suggestionTextError").after('<div class="alert alert-danger">Text should be provided.</div>');
                return false;
            }
            else{
                $.ajax({
                    type: "POST",  // Use POST for form submissions
                    url: $(this).attr('action'),  // Get the form action dynamically
                    data: $(this).serialize(),  // Serialize the form data
                    success: function (response) {
                        if(response.status == "invalid"){
                            Swal.fire({
                                icon:'warning',
                                title:'Invalid',
                                text: response.message,
                            });
                        }
                        else if(response.status == "success"){
                            $('#suggestionModal').modal('hide');
                            Swal.fire({
                                icon:response.status,
                                title:'Success',
                                text: response.message,
                            });
                        }
                        else if(response.status == "error"){
                            Swal.fire({
                                icon:response.status,
                                title:'Error',
                                text: response.message,
                            });
                        }else if(response.status == "info"){
                            Swal.fire({
                                icon:response.status,
                                title:'Warning',
                                text: response.message,
                            });
                        }
                        else {
                            Swal.fire({
                                icon:'error',
                                title:'Error',
                                text: 'There is an',
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
                                    $("#" + field).after('<div class="alert alert-danger">' + errorMessage + '</div>');
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
            }

        });

        // Reset form and errors when modal is closed
        $('#suggestionModal').on('hidden.bs.modal', function () {
            $('#suggestionForm')[0].reset();
            $("#suggestionTextError").empty();
        });

        $("#suggestionModalCloseIcon").click(function (e) { 
            e.preventDefault();
            $('#suggestionModal').modal('hide');
        });

    });
</script>