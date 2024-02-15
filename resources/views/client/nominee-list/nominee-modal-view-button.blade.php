<!-- Bootstrap Modal -->
<div class="modal fade" id="ShowVoteCandidateModal" tabindex="-1" role="dialog" aria-labelledby="ShowVoteCandidateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Candidate List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeIconModalShowVoteCandidate">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBodyContent">
                <!-- Dynamic content will be displayed here -->
                <!-- Example Card for Candidate -->
                {{-- <div class="card" style="width: 18rem;">
                    <img src="candidate_image.jpg" class="card-img-top" alt="Candidate Image">
                    <div class="card-body">
                        <h5 class="card-title">Candidate Name</h5>
                        <p class="card-text">City: Candidate City</p>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalShowVoteCandidate">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#closeIconModalShowVoteCandidate").click(function (e) { 
            e.preventDefault();
            $("#modalBodyContent").empty();
            $('#ShowVoteCandidateModal').modal('hide');
        });
        
        $("#closeModalShowVoteCandidate").click(function (e) { 
            e.preventDefault();
            $("#modalBodyContent").empty();
            $('#ShowVoteCandidateModal').modal('hide');
        });
    });
</script>