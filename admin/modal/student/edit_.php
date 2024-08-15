<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form for editing a student -->
        <form id="editStudentForm">
          <input type="hidden" id="editStudentId" name="editStudentId">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editIdNo">ID No</label>
                <input type="text" class="form-control" id="editIdNo" name="editIdNo" oninput="formatIdNumber(this)" onkeypress="return isNumberKey(event)" placeholder="Enter ID No" required>
              </div>
              <div class="form-group">
                <label for="editLastName">Last Name</label>
                <input type="text" class="form-control" id="editLastNames" name="editLastName" placeholder="Enter last name" required>
              </div>
              <div class="form-group">
                <label for="editFirstName">First Name</label>
                <input type="text" class="form-control" id="editFirstNames" name="editFirstName" placeholder="Enter first name" required>
              </div>
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="editMiddleInitial" name="editMiddleInitial" placeholder="M.I." maxlength="3">
                </div>
                <div class="col">
                  <input type="text" class="form-control" id="editSuffix" name="editSuffix" placeholder="Suffix (e.g., Jr., Sr.)">
                </div>
              </div>
              <div class="edited-form-group">
                <label for="editedGender">Gender</label><br>
                <label class="edited-radio-inline">
                  <input type="radio" name="editedGender" id="edited_gender_male" value="male" required> Male
                </label>
                <label class="edited-radio-inline">
                  <input type="radio" name="editedGender" id="edited_gender_female" value="female" required> Female
                </label>
                <label class="edited-radio-inline">
                  <input type="radio" name="editedGender" id="edited_gender_other" value="other" required> Other
                </label>
              </div>

              <div class="form-group">
                <label for="editBirthday">Birthday</label>
                <input type="text" class="form-control date-picker" id="editBirthday" name="editBirthday" placeholder="Enter birthday">
              </div>
              <div class="form-group">
                <label for="editProvince">Province</label>
                <input type="text" class="form-control" id="editProvince" name="editProvince" placeholder="Enter Province">
              </div>
              <div class="form-group">
                <label for="editCityMunicipal">City/Municipal</label>
                <input type="text" class="form-control" id="editCityMunicipal" name="editCityMunicipal" placeholder="Enter City/Municipal">
              </div>
              <div class="form-group">
                <label for="editBrgyPurok">Brgy/Purok</label>
                <input type="text" class="form-control" id="editBrgyPurok" name="editBrgyPurok" placeholder="Enter Brgy/Purok">
              </div>
              <div class="form-group">
                <label for="editContactNumber">Contact Number</label>
                <input type="text" class="form-control" id="editContactNumber" name="editContactNumber" placeholder="Enter contact number">
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editEducation">Education</label>
                <select class="form-control" id="editEducation" name="editEducation" required>
                  <option value="Elementary">Elementary</option>
                  <option value="High School">High School</option>
                  <option value="Senior High">Senior High</option>
                  <option value="College">College</option>
                </select>
              </div>
              <div class="form-group" id="editGradeGroup" style="display:none;">
                <label for="editGrade">Grade</label>
                <select class="form-control" id="editGrade" name="editGrade">
                  <!-- Options will be dynamically populated based on education level -->
                  <option value="">Select grade</option>
                  <option value="Grade 1">Grade 1</option>
                  <option value="Grade 2">Grade 2</option>
                  <option value="Grade 3">Grade 3</option>
                  <option value="Grade 4">Grade 4</option>
                  <option value="Grade 5">Grade 5</option>
                  <option value="Grade 6">Grade 6</option>
                  <option value="Grade 7">Grade 7</option>
                  <option value="Grade 8">Grade 8</option>
                  <option value="Grade 9">Grade 9</option>
                  <option value="Grade 10">Grade 10</option>
                  <option value="Grade 11">Grade 11</option>
                  <option value="Grade 12">Grade 12</option>
                </select>
              </div>

              <div class="form-group" id="editYearGroup" style="display:none;">
                <label for="editYear">Year</label>
                <select class="form-control" id="editYear" name="editYear">
                  <!-- Options will be dynamically populated based on education level -->
                  <option value="">Select year</option>
                  <option value="First Year">First Year</option>
                  <option value="Second Year">Second Year</option>
                  <option value="Third Year">Third Year</option>
                  <option value="Fourth Year">Fourth Year</option>
                </select>
              </div>

              <div class="form-group" id="editCourseGroup" style="display:none;">
                <label for="editCourse">Course</label>
                <select class="form-control" id="editCourse" name="editCourse">
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
                <label for="editMedicalHistory">Medical History</label>
                <textarea class="form-control" id="editMedicalHistory" name="editMedicalHistory" placeholder="Enter medical history"></textarea>
              </div>
              <div class="form-group">
                <label for="editEmergencyContactName">Emergency Contact Name</label>
                <input type="text" class="form-control" id="editEmergencyContactName" name="editEmergencyContactName" placeholder="Enter emergency contact name">
              </div>
              <div class="form-group">
                <label for="editEmergencyContactNumber">Emergency Contact Number</label>
                <input type="text" class="form-control" id="editEmergencyContactNumber" name="editEmergencyContactNumber" placeholder="Enter emergency contact number">
              </div>
            </div>
          </div>
          <input type="hidden" id="editStudentID" name="editStudentID">
          <button type="submit" id="submitEditForm" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
