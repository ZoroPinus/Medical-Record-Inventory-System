<!-- Edit First Aid Kit Modal -->
<div class="modal fade" id="editFirstAidKitModal" tabindex="-1" role="dialog" aria-labelledby="editFirstAidKitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFirstAidKitModalLabel">Edit First Aid Kit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit First Aid Kit Form -->
                <form id="editFirstAidKitForm">
                    <input type="hidden" id="editFirstAidKitId" name="first_aid_kit_id">
                    <div class="form-group">
                        <label for="editName">First Aid Kit Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editRemark">Remark</label>
                        <textarea class="form-control" id="editRemark" name="remark"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editExpiryDate">Expiry Date</label>
                        <input type="date" class="form-control" id="editExpiryDate" name="expiry_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
