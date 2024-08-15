<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewStudentModalLabel">View Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form for viewing a student -->
        <form id="viewStudentForm">
          <input type="hidden" id="viewStudentId" name="viewStudentId">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="viewIdNo">ID No</label>
                <input type="text" class="form-control" id="viewIdNo" name="viewIdNo" placeholder="Enter ID No" required>
              </div>
              <div class="form-group">
                <label for="viewLastName">Last Name</label>
                <input type="text" class="form-control" id="viewLastNames" name="viewLastName" placeholder="Enter last name" required>
              </div>
              <div class="form-group">
                <label for="viewFirstName">First Name</label>
                <input type="text" class="form-control" id="viewFirstNames" name="viewFirstName" placeholder="Enter first name" required>
              </div>
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" id="viewMiddleInitial" name="viewMiddleInitial" placeholder="M.I." maxlength="3">
                </div>
                <div class="col">
                  <input type="text" class="form-control" id="viewSuffix" name="viewSuffix" placeholder="Suffix (e.g., Jr., Sr.)">
                </div>
              </div>
              <div class="viewed-form-group">
                <label for="viewedGender">Gender</label><br>
                <label class="viewed-radio-inline">
                  <input type="radio" name="viewedGender" id="viewed_gender_male" value="male" required> Male
                </label>
                <label class="viewed-radio-inline">
                  <input type="radio" name="viewedGender" id="viewed_gender_female" value="female" required> Female
                </label>
                <label class="viewed-radio-inline">
                  <input type="radio" name="viewedGender" id="viewed_gender_other" value="other" required> Other
                </label>
              </div>

              <div class="form-group">
                <label for="viewBirthday">Birthday</label>
                <input type="text" class="form-control date-picker" id="viewBirthday" name="viewBirthday" placeholder="Enter birthday">
              </div>
              <div class="form-group">
                <label for="viewBrgyPurok">Brgy/Purok</label>
                <input type="text" class="form-control" id="viewBrgyPurok" name="viewBrgyPurok" placeholder="Enter Brgy/Purok">
              </div>
              <div class="form-group">
                <label for="viewCityMunicipal">City/Municipal</label>
                <input type="text" class="form-control" id="viewCityMunicipal" name="viewCityMunicipal" placeholder="Enter City/Municipal">
              </div>
              <div class="form-group">
                <label for="viewProvince">Province</label>
                <input type="text" class="form-control" id="viewProvince" name="viewProvince" placeholder="Enter Province">
              </div>
              <div class="form-group">
                <label for="viewContactNumber">Contact Number</label>
                <input type="text" class="form-control" id="viewContactNumber" name="viewContactNumber" placeholder="Enter contact number">
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="education">Education</label>
                <select class="form-control" id="viewEducation" name="viewEducation" required>
                  <option value="Elementary">Elementary</option>
                  <option value="High School">High School</option>
                  <option value="Senior High">Senior High</option>
                  <option value="College">College</option>
                </select>
              </div>
              <div class="form-group" id="viewGradeGroup" style="display:none;">
                <label for="viewGrade">Grade</label>
                <select class="form-control" id="viewGrade" name="viewGrade">
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

              <div class="form-group" id="viewYearGroup" style="display:none;">
                <label for="viewYear">Year</label>
                <select class="form-control" id="viewYear" name="viewYear">
                  <!-- Options will be dynamically populated based on education level -->
                  <option value="">Select year</option>
                  <option value="First Year">First Year</option>
                  <option value="Second Year">Second Year</option>
                  <option value="Third Year">Third Year</option>
                  <option value="Fourth Year">Fourth Year</option>
                </select>
              </div>

              <div class="form-group" id="viewCourseGroup" style="display:none;">
                <label for="viewCourse">Course</label>
                <select class="form-control" id="viewCourse" name="viewCourse">
                  <!-- Options will be dynamically populated based on education level -->
                  <option value="">Select course</option>
                  <option value="BSN">BSN</option>
                  <option value="BSCS">BSCS</option>
                  <option value="BSIS">BSIS</option>
                  <option value="BSA">BSA</option>
                  <option value="BSBA">BSBA</option>
                  <option value="BSOA">BSOA</option>
                  <option value="BSED">BSED</option>
                  <option value="BSEED-GENERAL">BSEED-GENERAL</option>
                  <!-- Add more options as needed -->
                </select>
              </div>

              <hr>
              <div class="form-group">
                <label for="viewMedicalHistory">Medical History <button type="button" id="openMedicalHistoryBtn" class="btn btn-sm btn-primary ml-2" >
                    <i class="bi bi-file-person"></i> <!-- Font Awesome icon example -->
                    <!-- Use any icon of your choice -->
                  </button></label>
                <textarea class="form-control" id="viewMedicalHistory" name="viewMedicalHistory" placeholder="Enter medical history"></textarea>
              </div>
              <div class="form-group">
                <label for="viewEmergencyContactName">Emergency Contact Name</label>
                <input type="text" class="form-control" id="viewEmergencyContactName" name="viewEmergencyContactName" placeholder="Enter emergency contact name">
              </div>
              <div class="form-group">
                <label for="viewEmergencyContactNumber">Emergency Contact Number</label>
                <input type="text" class="form-control" id="viewEmergencyContactNumber" name="viewEmergencyContactNumber" placeholder="Enter emergency contact number">
              </div>
            </div>
          </div>
          <input type="hidden" id="viewStudentID" name="viewStudentID">
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    // Function to open the medical history modal and set the student ID
    function openMedicalHistoryModal() {
      var idNumber = $('#viewIdNo').val();
      $('#studentIdno').val(idNumber); // Set the student ID in the hidden input field
      $('#medicalHistoryModal').modal('show'); // Open the medical history modal
      fetchMedicalHistory(); // Fetch medical history data
    }

    // Event listener for opening the medical history modal
    $('#openMedicalHistoryBtn').click(openMedicalHistoryModal);
  });
</script>