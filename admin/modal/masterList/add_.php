<div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel">Add Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addRecordForm">
                    <div class="form-group">
                        <label for="noIdNo">No. ID No</label>
                        <input type="text" class="form-control" id="noIdNo" name="noIdNo" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <input type="text" class="form-control" id="sex" name="sex" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" class="form-control" id="course" name="course" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitRecordForm">Save</button>
            </div>
        </div>
    </div>
</div>