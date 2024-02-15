<!-- Bootstrap Modal -->
<div class="modal fade" id="candidateListModal" tabindex="-1" role="dialog" aria-labelledby="candidateListModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="candidateListModalLabel">Candidate List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalviewCandidateListIcon">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your candidate list content here -->
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row" class="fw-bold">Candidate Name</th>
                            <td><span id="viewCandidateName" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Candidate Picture</th>
                            <td>
                                <img class="round" id="viewCandidateImage" name="viewCandidateImage" src="" alt="avatar" height="140" width="140">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Candidate Mobile No</th>
                            <td><span id="viewCandidateMobileNo" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Candidate Address</th>
                            <td><span id="viewCandidateAddress" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Candidate Area</th>
                            <td><span id="viewCandidateArea" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Candidate Objectives</th>
                            <td><span id="viewCandidateObjectives" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Hostel Name</th>
                            <td><span id="viewCandidateHostelName" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Election Category</th>
                            <td><span id="viewElectionCategoryId" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Election Seat</th>
                            <td><span id="viewElectionSeatId" class="form-control-static"></span></td>
                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold">Candidate Status</th>
                            <td><span id="viewCandidateStatus" class="form-control-static"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalviewCandidateList">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#closeModalviewCandidateList").click(function (e) { 
            e.preventDefault();
            resetFields();
            $('#candidateListModal').modal('hide');
        });
        
        $("#closeModalviewCandidateListIcon").click(function (e) { 
            e.preventDefault();
            resetFields();
            $('#candidateListModal').modal('hide');
        });

        function resetFields(){
            $("#viewCandidateName").text('');
            $("#viewCandidateMobileNo").text('');
            $("#viewCandidateAddress").text('');
            $("#viewCandidateArea").text('');
            $("#viewCandidateObjectives").text('');
            $("#viewCandidateHostelName").text('');
            $("#viewElectionCategoryId").text('');
            $("#viewElectionSeatId").text('');
            $("#viewCandidateStatus").text('');

            // Update candidate picture
            $("#viewCandidateImage").attr("src", "");
            $("#viewCandidateImage").attr("alt", "avtar");
        }
        

    });
</script>