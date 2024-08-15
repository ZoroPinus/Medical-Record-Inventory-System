<div class="modal fade" id="viewTeacherModal" tabindex="-1" role="dialog" aria-labelledby="viewTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTeacherModalLabel">View Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="viewTeacherForm">
                    <input type="hidden" id="viewTeacherId" name="viewTeacherId">

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
                            <!-- <div class="form-group">
                                <label for="view_Email">Email</label>
                                <input type="email" class="form-control" id="view_Email" name="view_Email" required>
                            </div>
                            <div class="form-group">
                                <label for="viewSubjectTaught">Subject Taught</label>
                                <input type="text" class="form-control" id="viewSubjectTaught" name="viewSubjectTaught">
                            </div>
                            <div class="form-group">
                                <label for="viewExperienceYears">Experience Years</label>
                                <input type="number" class="form-control" id="viewExperienceYears" name="viewExperienceYears">
                            </div> -->

                            <!-- <div class="form-group">
                                <label for="viewGradeLevelTaught">Grade Level Taught</label>
                                <input type="text" class="form-control" id="viewGradeLevelTaught" name="viewGradeLevelTaught">
                            </div> -->
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
                                <label for="viewProvince">Province</label>
                                <input type="text" class="form-control" id="viewProvince" name="viewProvince" placeholder="Enter Province">
                            </div>
                            <div class="form-group">
                                <label for="viewCityMunicipal">City/Municipal</label>
                                <input type="text" class="form-control" id="viewCityMunicipal" name="viewCityMunicipal" placeholder="Enter City/Municipal">
                            </div>
                            <div class="form-group">
                                <label for="viewBrgyPurok">Brgy/Purok</label>
                                <input type="text" class="form-control" id="viewBrgyPurok" name="viewBrgyPurok" placeholder="Enter Brgy/Purok">
                            </div>


                            <div class="form-group">
                                <label for="viewContactNumber">Contact Number</label>
                                <input type="text" class="form-control" id="viewContactNumber" name="viewContactNumber" placeholder="Enter contact number">
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="viewDepartment">Department</label>
                                <select class="form-control" id="viewDepartment" name="viewDepartment" required onchange="showViewInput()">
                                    <option value="SBS">SBS</option>
                                    <option value="SHES">SHES</option>
                                    <option value="SEAS">SEAS</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div id="viewotherDepartment" style="display: none;" class="form-group">
                                <label for="viewotherDepartmentInput">Specify Other Department</label>
                                <input type="text" class="form-control" id="viewotherDepartmentInput" name="viewotherDepartmentInput">
                            </div>


                            <div class="form-group">
                                <label for="viewMedicalHistory">Medical History</label>
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
                    <!-- Add more form fields as needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>