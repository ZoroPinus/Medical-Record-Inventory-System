<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMedicineModalLabel">Add Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <form id="addMedicineForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="medicineName" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="medicineName" name="medicineName" required>
                    </div>
                    <div class="mb-3">
                        <label for="dosage" class="form-label">Dosage</label>
                        <input type="text" class="form-control" id="dosage" name="dosage" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="expirationDate" class="form-label">Expiration Date</label>
                        <input type="text" class="form-control date-picker" id="expirationDate" name="expirationDate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitForm">Add Medicine</button>
                </div>
            </form>
        </div>
    </div>
</div>
