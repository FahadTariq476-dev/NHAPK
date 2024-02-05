<script>
    $(document).ready(function () {
        // Function to handle keyup event on the name input
        $('#search_data').on('keyup', function () {
            var inputVal = $(this).val();
            if(inputVal.trim()==='' || inputVal ===null || inputVal.length==0){
                $('#nameSuggestions').hide();
                $('#nameSuggestions').html("");
                $('#selectedHostelId').val("");
            }
            if ($('#rd_by_name').prop('checked')) {
                if(!(inputVal.trim()==='' || inputVal ===null )){
                    // 
                    // Perform an AJAX request to get suggestions
                    $.ajax({
                        url: '/get-hostel-suggestions', // Change this to your actual route
                        method: 'GET',
                        data: { inputVal: inputVal },
                        success: function (data) {
                            // Display the suggestions in the suggestions div
                            $('#nameSuggestions').html(data);
                            $('#nameSuggestions').show(); // Show the suggestions
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }else {
                    // Hide the suggestions if the input is empty
                    $('#nameSuggestions').hide();
                    $('#nameSuggestions').html("");
                    $('#selectedHostelId').val("");
                }
            }
        });


        // Handle click on a suggestion
        $(document).on('click', '.suggestion-item', function () {
            var hostelName = $(this).text();
            var hostelId = $(this).data('hostel-id');
    
            // Set the selected value in the input field
            $('#search_data').val(hostelName);

            // Do something with the selected hostel ID (e.g., save it in a hidden input)
            $('#selectedHostelId').val(hostelId);

            // Hide the suggestions
            $('#nameSuggestions').hide();
        });

    });
</script>

<script>
    $(document).ready(function(){
        $('input[name="search_type"]').on('change', function (){
            var currentSelectedRadio = $(this).attr('id');
            if (currentSelectedRadio === 'rd_by_name') {
                $('#selectedHostelId').val("");
            } else if (currentSelectedRadio === 'rd_reg_no') {
                $('#selectedHostelId').val("");
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        // Handle form submission
$('#searchForm').submit(function (e) {
    // Check if Reg. Number radio button is checked
    var isRegNoChecked = $('#rd_reg_no').prop('checked');

    // If Reg. Number is checked, submit the form as is
    if (isRegNoChecked) {
        let search_data = $("#search_data").val();
        if(search_data.trim() ==='' || search_data ===null || search_data.length==0){
            e.preventDefault();
            alert("Registration Number Should be provided");
            return false;
        }
        return true;
    }

    // Extract the selected hostel ID
    var selectedHostelId = $('#selectedHostelId').val();

    // Perform any additional checks if needed
    if (selectedHostelId) {
        // Set the selected hostel ID in a hidden input and submit the form
        $('<input>').attr({
            type: 'hidden',
            name: 'selectedHostelId',
            value: selectedHostelId
        }).appendTo('#searchForm');

        // Submit the form
        $('#searchForm').submit();
    } else {
        // Handle the case when no hostel is selected
        e.preventDefault();
        alert('Please select a hostel from the suggestions.');
    }
});
    });
</script>