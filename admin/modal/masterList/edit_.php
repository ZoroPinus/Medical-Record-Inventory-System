<div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRecordModalLabel">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editRecordForm">
                    <input type="text" id="editRecordId" name="record_id">
                    <div class="form-group">
                        <label for="editNoIdNo">No. ID No</label>
                        <input type="text" class="form-control" id="editNoIdNo" name="noIdNo" required>
                    </div>
                    <div class="form-group">
                        <label for="editFirstname">Firstname</label>
                        <input type="text" class="form-control" id="editFirstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="editLastname">Lastname</label>
                        <input type="text" class="form-control" id="editLastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="editSex">Sex</label>
                        <input type="text" class="form-control" id="editSex" name="sex" required>
                    </div>
                    <div class="form-group">
                        <label for="editCourse">Course</label>
                        <input type="text" class="form-control" id="editCourse" name="course" required>
                    </div>
                    <div class="form-group">
                        <label for="editYear">Year</label>
                        <input type="text" class="form-control" id="editYear" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="editUnit">Unit</label>
                        <input type="text" class="form-control" id="editUnit" name="unit" required>
                    </div>
                    <div id="editError" class="alert alert-danger" style="display: none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editRecordForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>