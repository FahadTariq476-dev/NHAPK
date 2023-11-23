
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <!-- ✅ Load CSS file for DataTables  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
      integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- ✅ load jQuery ✅ -->
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>

    <!-- ✅ load DataTables ✅ -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
      integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"></script>
  </head>

  <body>
    <!-- 👇️ HTML for Table  -->
    <table id="example" class="display" >
      <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Mob No</th>
            <th>Email</th>
            <th>Room<br>Number</th>
            <th>Hostel Name</th>
            <th>Complaint Type</th>
            <th>Complaint Details</th>
            <th>Complaint Prioirty</th>
            <th>Complaint Date</th>
            <th>Status</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        {{-- <tr>
            <th>#</th>
            <th>Name</th>
            <th>Mob No</th>
            <th>Email</th>
            <th>Hostel Name</th>
            <th>Room<br>Number</th>
            <th>Complaint Type</th>
            <th>Complaint Details</th>
            <th>Complaint Prioirty</th>
            <th>Complaint Date</th>
            <th>Status</th>
        </tr> --}}
      </tfoot>
    </table>

    <!-- Your JS code here  -->

    <script>
        $(document).ready(function() {
            var dataTable = $('#example').DataTable({
                columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'mob_no' },
                { data: 'email' },
                { data: 'room_no' },
                {data: 'property.name', render: $.fn.dataTable.render.text() },
                { data: 'complaint_type' },
                { data: 'complaint_details' },
                { data: 'complaint_priority' },
                { data: 'created_at' },
                { data: 'status' }
                ],
                serverSide: true,
                responsive: true,
                searching: true,
                bLengthChange: false,
                bInfo: false,
                pageLength: 10,
                order: [],
                processing: true,
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                    paginate: {
                    previous: "Prev",
                    },
                },
                aLengthMenu: [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                "ajax": {
                    url: "/get-adminListingComplaint",
                    type: "GET",
                    data: function(d) {
                        // d.institute_id = '<?= $Institute_id ?? '' ?>';
                    }
                },
                "drawCallback": function(settings) {
                    var json = dataTable.ajax.json();
                    console.log(json)
                },
                responsive: true,
            });
        });
    </script>
  </body>
</html>
