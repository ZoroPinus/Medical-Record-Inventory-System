<div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTeacherModalLabel">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form for adding a student -->
        <form id="addTeacherForm">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="IDNo">ID No.</label>
                <input type="text" class="form-control" id="idno" name="idno" placeholder="Enter ID No" oninput="formatIdNumber(this)" onkeypress="return isNumberKey(event)" required>
              </div>
              <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" required>
              </div>
              <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required>
              </div>
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="middleInitial" name="middleInitial" placeholder="M.I." maxlength="3">
                </div>
                <div class="col">
                  <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix (e.g., Jr., Sr.)">
                </div>
              </div>
              <div class="form-group">
                <label for="gender">Gender</label><br>
                <label class="radio-inline">
                  <input type="radio" name="gender" id="gender_male" value="male" required> Male
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" id="gender_female" value="female" required> Female
                </label>
                <label class="radio-inline">
                  <input type="radio" name="gender" id="gender_other" value="other" required> Other
                </label>
              </div>
              <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="text" class="form-control date-picker" id="birthday" name="birthday" placeholder="Enter birthday" required>
              </div>
              <div class="form-group">
                <label for="province">Province</label>
                <select class="form-control" id="province" name="province" onchange="populateMunicipalities()">
                  <option value="">Select Province</option>
                </select>
              </div>
              <div class="form-group">
                <label for="city_municipal">City/Municipal</label>
                <select class="form-control" id="municipality" name="municipality" onchange="populateBarangays()">
                  <option value="">Select Municipality</option>
                </select>
              </div>
              <div class="form-group">
                <label for="brgy_purok">Brgy/Purok</label>
                <select class="form-control" id="barangay" name="barangay">
                  <option value="">Select Barangay</option>
                </select>
              </div>
              <div class="form-group">
                <label for="contactNumber">Contact Number</label>
                <input type="number" class="form-control" id="contactNumber" name="contactNumber" placeholder="Enter contact number" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="department">Department</label>
                <select class="form-control" id="department" name="department" required onchange="showInput()">
                  <option value="SBS">SBS</option>
                  <option value="SHES">SHES</option>
                  <option value="SEAS">SEAS</option>
                  <option value="others">Others</option>
                </select>
              </div>

              <div id="otherDepartment" style="display: none;" class="form-group">
                <label for="otherDepartmentInput">Specify Other Department</label>
                <input type="text" class="form-control" id="otherDepartmentInput" name="otherDepartmentInput">
              </div>

              <hr>
              <div class="form-group">
                <label for="medicalHistory">Medical History</label>
                <textarea class="form-control" id="medicalHistory" name="medicalHistory" placeholder="Enter medical history" required></textarea>
              </div>
              <div class="form-group">
                <label for="emergencyContactName">Emergency Contact Name</label>
                <input type="text" class="form-control" id="emergencyContactName" name="emergencyContactName" placeholder="Enter emergency contact name" required>
              </div>
              <div class="form-group">
                <label for="emergencyContactNumber">Emergency Contact Number</label>
                <input type="text" class="form-control" id="emergencyContactNumber" name="emergencyContactNumber" placeholder="Enter emergency contact number" required>
              </div>
            </div>
          </div>
          <button id="submitForm" class="btn btn-primary">Add Employee</button>
        </form>
      </div>
    </div>
  </div>
</div>