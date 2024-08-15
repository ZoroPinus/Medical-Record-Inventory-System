<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form for adding a student -->
        <form id="addStudentForm">
          <input type="hidden" id="StudentId" name="StudentId">
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
                <label for="education">Education</label>
                <select class="form-control" id="education" name="education" required>
                  <option value="Elementary">Elementary</option>
                  <option value="High School">High School</option>
                  <option value="Senior High">Senior High</option>
                  <option value="College">College</option>
                </select>
              </div>
              <div class="form-group" id="gradeGroup" >
                <label for="grade">Grade</label>
                <select class="form-control" id="grade" name="grade">
                  <!-- Options will be dynamically populated based on education level -->
                  <option value="">Select grade</option>
                  <option value="Grade 1">Grade 1</option>
                  <option value="Grade 2">Grade 2</option>
                  <option value="Grade 3">Grade 3</option>
                  <option value="Grade 4">Grade 4</option>
                  <option value="Grade 5">Grade 5</option>
                  <option value="Grade 6">Grade 6</option>
                </select>
              </div>

              <div class="form-group" id="yearGroup" style="display:none;">
                <label for="year">Year</label>
                <select class="form-control" id="year" name="year">
                  <!-- Options will be dynamically populated based on education level -->
                  <option value="">Select year</option>
                  <option value="First Year">First Year</option>
                  <option value="Second Year">Second Year</option>
                  <option value="Third Year">Third Year</option>
                  <option value="Fourth Year">Fourth Year</option>
                </select>
              </div>

              <div class="form-group" id="courseGroup" style="display:none;">
                <label for="course">Course</label>
                <select class="form-control" id="course" name="course">
                  <!-- Options will be dynamically populated based on education level -->
                  <option value="">Select course</option>
                  <option value="BSN">BSN</option>
                  <option value="BSCS">BSCS</option>
                  <option value="BSIS">BSIS</option>
                  <option value="BSA">BSA</option>
                  <option value="BSBA">BSBA</option>
                  <option value="BSOA">BSOA</option>
                  <option value="BSED">BSED</option>
                  <option value="BSREM">BSREM</option>
                  <option value="BSEED-GENERAL">BSEED-GENERAL</option>
                  <!-- Add more options as needed -->
                </select>
              </div>

              <hr>
              <div class="form-group">
                <label for="addMedicalHistory">Medical History</label>
                <textarea class="form-control" id="addMedicalHistory" name="addMedicalHistory" placeholder="Enter medical history"></textarea>
              </div>
              <div class="form-group">
                <label for="addEmergencyContactName">Emergency Contact Name</label>
                <input type="text" class="form-control" id="addEmergencyContactName" name="addEmergencyContactName" placeholder="Enter emergency contact name">
              </div>
              <div class="form-group">
                <label for="addEmergencyContactNumber">Emergency Contact Number</label>
                <input type="text" class="form-control" id="addEmergencyContactNumber" name="addEmergencyContactNumber" placeholder="Enter emergency contact number">
              </div>
            </div>
          </div>
          <button id="submitForm" class="btn btn-primary">Add Student</button>
        </form>
      </div>
    </div>
  </div>
</div>






