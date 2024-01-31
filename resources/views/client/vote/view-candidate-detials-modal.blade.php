<!-- Bootstrap Modal -->
<div class="modal fade" id="candidateListModal" tabindex="-1" role="dialog" aria-labelledby="candidateListModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="candidateListModalLabel">Candidate List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalIcon">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your candidate list content here -->
                <form>
                    <!-- Select Candidate -->
                    <div class="form-group">
                        <label for="viewCandidateId">Select Your Candidate</label>
                        <select id="viewCandidateId" name="viewCandidateId" class="form-control">
                            <option value="" selected disabled>Select Candidate</option>
                            @if (count($candidates)>0)
                            @foreach ($candidates as $candidate)
                                <option value="{{ $candidate->id }}">
                                    {{ $candidate->user->name }}
                                </option>
                            @endforeach
                            @else
                                <option value="" disabled>No Candidate Found</option>
                            @endif
                        </select>
                    </div>
                    <!-- Candidate Details -->
                    <div>
                        <!-- Candidate Picture-->
                        <div class="form-group">
                            <label for="viewCandidateImage">Candidate Picture</label><br>
                            {{-- {{ Storage::url() }} --}}
                            <img class="round" id="viewCandidateImage" name="viewCandidateImage" src="" alt="avatar" height="140" width="140">
                        </div>

                        <!-- Candidate Cnic -->
                        <div class="form-group">
                            <label for="viewCandidateCnic">Candidate Cnic</label>
                            <input type="text" id="viewCandidateCnic" name="viewCandidateCnic" value="" class="form-control" readonly>
                        </div>
                        
                        <!-- Candidate Mobile No -->
                        <div class="form-group">
                            <label for="viewCandidateMobileNo">Candidate Mobile No</label>
                            <input type="text" id="viewCandidateMobileNo" name="viewCandidateMobileNo" value="" class="form-control" readonly>
                        </div>
                        
                        <!-- Candidate Country-->
                        <div class="form-group">
                            <label for="viewCandidateCountryName">Candidate Country</label>
                            <input type="text" id="viewCandidateCountryName" name="viewCandidateCountryName" value="" class="form-control" readonly>
                        </div>
                        
                        <!-- Candidate State-->
                        <div class="form-group">
                            <label for="viewCandidateStateName">Candidate State</label>
                            <input type="text" id="viewCandidateStateName" name="viewCandidateStateName" value="" class="form-control" readonly>
                        </div>
                        
                        <!-- Candidate City-->
                        <div class="form-group">
                            <label for="viewCandidateCityName">Candidate City</label>
                            <input type="text" id="viewCandidateCityName" name="viewCandidateCityName" value="" class="form-control" readonly>
                        </div>
                        
                        <!-- Candidate Address-->
                        <div class="form-group">
                            <label for="viewCandidateAddress">Candidate Address</label>
                            <input type="text" id="viewCandidateAddress" name="viewCandidateAddress" value="" class="form-control" readonly>
                        </div>
                        
                        <!-- Candidate Description-->
                        <div class="form-group">
                            <label for="viewCandidateDescription">Candidate Description</label>
                            <textarea id="viewCandidateDescription" name="viewCandidateDescription" class="form-control" readonly></textarea>
                        </div>

                        <!-- Select electionCategory -->
                        <div class="form-group">
                            <label for="viewElectionCategoryId">Select Election Category</label>
                            <input type="text" id="viewElectionCategoryId" name="viewElectionCategoryId" value="" class="form-control" readonly>
                        </div>
                        
                        <!-- Select elections -->
                        <div class="form-group">
                            <label for="viewElectionId">Select Election</label>
                            <input type="text" id="viewElectionId" name="viewElectionId" value="" class="form-control" readonly>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        document.getElementById('viewCandidateListLink').addEventListener('click', function () {
            $('#candidateListModal').modal('show');
        });

        $("#closeModal").click(function (e) { 
            e.preventDefault();
            resetFields();
            $('#candidateListModal').modal('hide');
        });
        
        $("#closeModalIcon").click(function (e) { 
            e.preventDefault();
            resetFields();
            $('#candidateListModal').modal('hide');
        });

        function resetFields(){
            $("#viewCandidateCnic").val('');
            $("#viewCandidateMobileNo").val('');
            $("#viewCandidateCountryName").val('');
            $("#viewCandidateStateName").val('');
            $("#viewCandidateCityName").val('');
            $("#viewCandidateAddress").val('');
            $("#viewCandidateDescription").val('');
            $("#viewElectionCategoryId").val('');
            $("#viewElectionId").val('');

            // Update candidate picture
            $("#viewCandidateImage").attr("src", "");
            $("#viewCandidateImage").attr("alt", "avtar");
        }
        
        $("#viewCandidateId").change(function () { 
            let viewCandidateId = $("#viewCandidateId").val();
            var baseUrl = "{{ url('/') }}";
            if( viewCandidateId == null){
                return true
            }
            else{
                $.ajax({
                    type: "GET",
                    url: "/client/viewCandidateDetails/"+viewCandidateId,
                    success: function (response) {
                        resetFields();
                        if(response.status == "invalid"){
                            Swal.fire({
                                icon:'warning',
                                title:'Invalid',
                                text: response.message,
                            });
                        }
                        else{
                            $("#viewCandidateCnic").val(response.user.cnic_no);
                            $("#viewCandidateMobileNo").val(response.user.phone_number);
                            $("#viewCandidateCountryName").val(response.country.name);
                            $("#viewCandidateStateName").val(response.state.name);
                            $("#viewCandidateCityName").val(response.city.name);
                            $("#viewCandidateAddress").val(response.user.address);
                            $("#viewCandidateDescription").val(response.user.short_description);
                            $("#viewElectionCategoryId").val(response.electionCategory.name);
                            $("#viewElectionId").val(response.election.name);

                            // Update candidate picture
                            $("#viewCandidateImage").attr("src", baseUrl + "/storage/" +response.user.picture_path);
                            $("#viewCandidateImage").attr("alt", response.user.name);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                        Swal.fire({
                            icon:'error',
                            title:'Error',
                            text: 'An error occured: '+error.responseJSON.message,
                        });
                    },
                });
            }
        });

    });
</script>