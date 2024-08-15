<div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="editMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMedicineModalLabel">Edit Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <form id="editMedicineForm">
                <div class="modal-body">
                    <input type="hidden" id="editMedicineId" name="editMedicineId">
                    <div class="mb-3">
                        <label for="editMedicineName" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="editMedicineName" name="editMedicineName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDosage" class="form-label">Dosage</label>
                        <input type="text" class="form-control" id="editDosage" name="editDosage" required>
                    </div>
                    <div class="mb-3">
                        <label for="editQuantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="editQuantity" name="editQuantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="editExpirationDate" class="form-label">Expiration Date</label>
                        <input type="text" class="form-control date-picker" id="editExpirationDate" name="editExpirationDate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitEditForm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
