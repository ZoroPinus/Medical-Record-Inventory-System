<div class="modal fade" id="addMedicineLogModal" tabindex="-1" role="dialog" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMedicineModalLabel">Add Medicine Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form for adding a medicine log -->
        <form id="addMedicineLogForm">
          <input type="text" id="medicineId" name="medicineId" style="display: none;">
          <input type="text" id="dosage" name="dosage" style="display: none;">
          <div class="form-group">
            <label for="medicineName">Medicine Name</label>
            <input type="text" class="form-control" id="medicineName" name="medicineName" placeholder="Select Medicine" readonly onclick="openMedicineSelectionModal()">
          </div>
          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required>
          </div>
          <div class="form-group">
            <label for="time">Time</label>
            <input type="time" class="form-control" id="time" name="time" placeholder="Enter Time" required>
          </div>
          <div class="form-group">
            <label for="recipient_name">Recipient Name</label>
            <input class="form-control" id="recipient_name" name="recipient_name" placeholder="Enter Name" required></input>
          </div>
          <div class="form-group">
            <label for="reason">Reason</label>
            <textarea class="form-control" id="reason" name="reason" placeholder="Enter Reason" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Add Medicine Log</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function openMedicineSelectionModal() {
    $('#medicineSelectionModal').modal('show');
  }
</script>