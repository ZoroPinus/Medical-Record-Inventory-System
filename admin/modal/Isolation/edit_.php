<div class="modal fade" id="editEquipmentModal" tabindex="-1" aria-labelledby="editEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEquipmentModalLabel">Edit Equipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <form id="editEquipmentForm">
                <div class="modal-body">
                    <input type="hidden" id="editEquipmentId" name="editEquipmentId">
                    <div class="mb-3">
                        <label for="editEquipmentName" class="form-label">Equipment Name</label>
                        <input type="text" class="form-control" id="editEquipmentName" name="editEquipmentName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRemark" class="form-label">Remark</label>
                        <textarea type="text" class="form-control" id="editRemark" name="editRemark"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" id="editStatus" name="editStatus" required>
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
