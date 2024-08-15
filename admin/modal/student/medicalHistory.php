<div class="modal fade" id="medicalHistoryModal" tabindex="-1" role="dialog" aria-labelledby="medicalHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicalHistoryModalLabel">Medical History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="studentIdno">
                <div class="table-responsive">
                    <table id="medicalHistoryTable" class="table hover nowrap">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>School Phycisian/Dentist</th>
                                <th>Remarks</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    var dataTable;

    // Function to fetch medical history based on the selected student ID
    function fetchMedicalHistory() {
        // Destroy the DataTable instance if it exists
        if (dataTable && $.fn.DataTable.isDataTable('#medicalHistoryTable')) {
            dataTable.destroy();
        }

        // Get student ID
        var studentId = $('#studentIdno').val();
        
        // Initialize DataTable with column definitions
        dataTable = $('#medicalHistoryTable').DataTable({
            columns: [
                { data: 'type', title: 'Type', orderable: true },
                { data: 'doctor', title: 'School Physician/Dentist', orderable: true },
                { data: 'remarks', title: 'Remarks', orderable: true },
                { data: 'date', title: 'Date', orderable: true }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            }
        });

        // Fetch data using Ajax and populate the table
        $.ajax({
            url: 'model/student/getmedicalHistory.php',
            type: 'GET',
            dataType: 'json',
            data: {
                studentId: studentId // Pass the student ID as a parameter
            },
            success: function(data) {
                // Clear existing rows and add new rows
                dataTable.clear().rows.add(data).draw();
            },
            error: function(xhr, status, error) {
                console.error('Ajax request failed: ' + status + ', ' + error);
                console.log(xhr.responseText);
                $('#errorContainer').text('Error loading data: ' + error).show();
            }
        });
    }

    // Event listener for when the medical history modal is shown
    $('#medicalHistoryModal').on('shown.bs.modal', function() {
        // Fetch medical history data when the modal is shown
        fetchMedicalHistory();
    });
});

</script>