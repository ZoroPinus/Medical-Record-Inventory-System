<!-- View Physical Examination Modal -->
<div class="modal fade" id="viewPhysicalExamModal" tabindex="-1" role="dialog" aria-labelledby="viewPhysicalExamModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewPhysicalExamModalLabel">View Physical Examination</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Physical Examination Details -->
        <div id="physicalExamDetails"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  $('#viewPhysicalExamModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recordId = button.data('record-id'); // Get the record ID from the data attribute
     console.log(recordId);
    // Fetch physical examination details from the server
    $.ajax({
      url: 'model/physical exam/get_.php',
      method: 'POST',
      data: { record_id: recordId },
      success: function(response) {
        $('#physicalExamDetails').html(response);
      },
      error: function(xhr, status, error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred while fetching the physical examination details.'
        });
      }
    });
  });
});
</script>