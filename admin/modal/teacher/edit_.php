<div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeacherModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTeacherForm">
                    <input type="hidden" id="editTeacherId" name="editTeacherId">

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
                            <!-- <div class="form-group">
                                <label for="edit_Email">Email</label>
                                <input type="email" class="form-control" id="edit_Email" name="edit_Email" required>
                            </div>
                            <div class="form-group">
                                <label for="editSubjectTaught">Subject Taught</label>
                                <input type="text" class="form-control" id="editSubjectTaught" name="editSubjectTaught">
                            </div>
                            <div class="form-group">
                                <label for="editExperienceYears">Experience Years</label>
                                <input type="number" class="form-control" id="editExperienceYears" name="editExperienceYears">
                            </div> -->

                            <!-- <div class="form-group">
                                <label for="editGradeLevelTaught">Grade Level Taught</label>
                                <input type="text" class="form-control" id="editGradeLevelTaught" name="editGradeLevelTaught">
                            </div> -->
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
                                <label for="editDepartment">Department</label>
                                <select class="form-control" id="edit_Department" name="edit_Department" required onchange="showEditInput()">
                                    <option value="SBS">SBS</option>
                                    <option value="SHES">SHES</option>
                                    <option value="SEAS">SEAS</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div id="editotherDepartment" style="display: none;" class="form-group">
                                <label for="edit_otherDepartmentInput">Specify Other Department</label>
                                <input type="text" class="form-control" id="edit_otherDepartmentInput" name="edit_otherDepartmentInput">
                            </div>



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
                    <!-- Add more form fields as needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editTeacherForm">Save changes</button>
            </div>
        </div>
    </div>
</div>