<div class="modal fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="addEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEquipmentModalLabel">Add Equipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
            <form id="addEquipmentForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="equipmentName" class="form-label">Equipment Name</label>
                        <input type="text" class="form-control" id="equipmentName" name="equipmentName" required>
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea type="text" class="form-control" id="remark" name="remark"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select form-control" id="status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitForm">Add Equipment</button>
                </div>
            </form>
        </div>
    </div>
</div>
