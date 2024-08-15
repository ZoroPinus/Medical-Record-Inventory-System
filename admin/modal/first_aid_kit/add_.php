<!-- Add First Aid Kit Modal -->
<div class="modal fade" id="addFirstAidKitModal" tabindex="-1" role="dialog" aria-labelledby="addFirstAidKitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFirstAidKitModalLabel">Add First Aid Kit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add First Aid Kit Form -->
                <form id="addFirstAidKitForm">
                    <div class="form-group">
                        <label for="addName">First Aid Kit Name</label>
                        <input type="text" class="form-control" id="addName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="addRemark">Remark</label>
                        <textarea class="form-control" id="addRemark" name="remark"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="addExpiryDate">Expiry Date</label>
                        <input type="date" class="form-control" id="addExpiryDate" name="expiry_date" required>
                    </div>
                    <button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
