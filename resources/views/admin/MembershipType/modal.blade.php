<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">{{ $text ?? 'Add Membership Type' }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="{{ route('admin.membershiptype.save') }}" id="m_form_membershiptype">
    <input type="hidden" name="id" value="{{ $membershiptype->id ?? '' }}">
    @csrf
    <div class="modal-body">
        <label>Name: </label>
        <div class="mb-1">
            <input type="text" placeholder="membershiptype name" id="name" name="name"
                value="{{ $membershiptype->name ?? '' }}" class="form-control" />
        </div>

        <label>Description: </label>
        <div class="mb-1">
            <textarea name="description" id="description" cols="10" rows="5" class="form-control">{{ $membershiptype->description ?? '' }}</textarea>
        </div>

        <label>Status: </label>
        <div class="form-check form-switch form-check-success">
            <input type="checkbox" class="form-check-input" id="customSwitch111" name="status" <?php echo isset($membershiptype) && !empty($membershiptype) && $membershiptype->status == 1 ? 'checked' : ''; ?> />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="submitForm" class="btn btn-primary">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(function() {
            var jqForm = $('#m_form_membershiptype');
            jqForm.validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 4,
                        maxlength: 200
                    },
                    description: {
                        required: true,
                        minlength: 10,
                        maxlength: 2000
                    }
                },
                messages: {
                    name: {
                        required: 'Please enter a name',
                        minlength: 'Name must be at least 4 characters long',
                        maxlength: 'Name cannot exceed 200 characters'
                    },
                    description: {
                        required: 'Please enter a description',
                        minlength: 'Description must be at least 10 characters long',
                        maxlength: 'Description cannot exceed 2000 characters'
                    }
                }
            });
        });
        $("#submitForm").click(function(event) {
            event.preventDefault();
            var form = $("#m_form_membershiptype");
            var url = form.attr("action");
            var formData = new FormData(form[0]);
            if (form.valid()) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            // Display success message on the page
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                            });
                            $('#inlineForm').modal('hide');
                            $('#_ListingTable').DataTable().ajax.reload();

                        } else {
                            // Display error message on the page
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message,
                            });
                            $('#inlineForm').modal('hide');

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
