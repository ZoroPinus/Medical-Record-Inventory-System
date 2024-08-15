<style>
    /* Hide the original checkbox */


    /* Style the fake checkbox */
    .styled-checkboxgreen {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #ccc;
        border-radius: 3px;
        margin-right: 10px;
    }

    .styled-checkboxgreen {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #fff;
        border-radius: 3px;
        margin-right: 10px;
    }

    /* Style the checkmark */
    .styled-checkboxgreen::after {
        content: "";
        position: absolute;
        display: none;
        left: 6px;
        top: 2px;
        width: 8px;
        height: 13px;
        border: solid green;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    /* Show the checkmark when the checkbox is checked */
    input[type="checkbox"]:checked+.styled-checkboxgreen::after {
        display: block;
    }


    /* Style the fake checkbox */
    .styled-checkboxred {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #ccc;
        border-radius: 3px;
        margin-right: 10px;
    }

    .styled-checkboxred {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #fff;
        border-radius: 3px;
        margin-right: 10px;
    }

    /* Style the checkmark */
    .styled-checkboxred::after {
        content: "";
        position: absolute;
        display: none;
        left: 6px;
        top: 2px;
        width: 8px;
        height: 13px;
        border: solid red;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    /* Show the checkmark when the checkbox is checked */
    input[type="checkbox"]:checked+.styled-checkboxred::after {
        display: block;
    }
</style>
<!-- Modal for adding a new physical examination record -->
<form id="addPhysicalExamForm">
    <div class="modal fade" id="addPhysicalExamModal" tabindex="-1" role="dialog" aria-labelledby="medicalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <!-- Modal header with close button -->
                <div class="modal-header">
                    <h5 class="modal-title" id="medicalModalLabel">Physical Examination</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal body with form for entering physical examination data -->
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <!-- Certificate container with school logo and title -->
                            <div class="certificate-container rounded shadow p-4 mb-5 " id="frame1">
                                <div class="certificate-header d-flex justify-content-center align-items-center mb-4">
                                    <img src="../assets/img/avatars/school-logo.png" class="img-fluid logo mr-3" alt="Logo">
                                    <div class="certificate-title-container text-center">
                                        <h2 class="certificate-title d-inline-block mb-0">Union Christian College</h2>
                                    </div><span class="ml-3"></span>
                                    <img src="../assets/img/avatars/church-logo.png" class="img-fluid logo mr-3" alt="Logo">
                                </div>
                                <div class="certificate-content text-center">
                                    <h4>City of San Fernando, La Union</h4>
                                    <h5>Province of La Union</h5>
                                </div>
                                <br>
                                <!-- Form fields for entering patient data -->
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="idno">ID no.:</label>
                                        <input type="text" style="border: none; border-bottom: 1px solid black;" id="idno" name="idno" oninput="formatIdNumber(this)" onkeypress="return isNumberKey(event)">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="name">Name:</label>
                                        <input type="text" style="border: none; border-bottom: 1px solid black;" id="physicalExamName" name="name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="age">Age:</label>
                                        <input type="number" style="border: none; border-bottom: 1px solid black;" id="dentalhealthRecordAge" name="age">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="sex">Sex:</label>
                                        <input type="text" style="border: none; border-bottom: 1px solid black;" id="sex" name="sex">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="date">Date:</label>
                                        <input type="date" style="border: none; border-bottom: 1px solid black;" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="course_grade_section">Course Grade Year & Section:</label>
                                        <input type="text" style="border: none; border-bottom: 1px solid black;" id="course_grade_section" name="course_grade_section">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="school_year">School Year:</label>
                                        <input type="text" style="border: none; border-bottom: 1px solid black;" id="school_year" name="school_year">
                                    </div>
                                </div>
                                <!-- Form fields for entering medical data -->
                                <div class="form-row mb-3">
                                    <div class="form-group col">
                                        <label for="blood_pressure">Blood Pressure:</label>
                                        <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Enter Blood Pressure">
                                    </div>
                                    <div class="form-group col">
                                        <label for="height">Height:</label>
                                        <input type="text" class="form-control" id="height" name="height" placeholder="Enter Height">
                                    </div>
                                    <div class="form-group col">
                                        <label for="weight">Weight:</label>
                                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Weight">
                                    </div>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Body Part</th>
                                            <th>Normal</th>
                                            <th>Abnormal</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Eyes</td>
                                            <td><input type="checkbox" name="eyes_normal" id="checkboxId" onclick="toggleCheckboxes(event, 'eyes')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="eyes_abnormal" onclick="toggleCheckboxes(event, 'eyes')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="eyes_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Ears</td>
                                            <td><input type="checkbox" name="ears_normal" onclick="toggleCheckboxes(event, 'ears')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="ears_abnormal" onclick="toggleCheckboxes(event, 'ears')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="ears_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Nose</td>
                                            <td><input type="checkbox" name="nose_normal" onclick="toggleCheckboxes(event, 'nose')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="nose_abnormal" onclick="toggleCheckboxes(event, 'nose')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="nose_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Throat</td>
                                            <td><input type="checkbox" name="throat_normal" onclick="toggleCheckboxes(event, 'throat')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="throat_abnormal" onclick="toggleCheckboxes(event, 'throat')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="throat_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Heart</td>
                                            <td><input type="checkbox" name="heart_normal" onclick="toggleCheckboxes(event, 'heart')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="heart_abnormal" onclick="toggleCheckboxes(event, 'heart')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="heart_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Lungs</td>
                                            <td><input type="checkbox" name="lungs_normal" onclick="toggleCheckboxes(event, 'lungs')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="lungs_abnormal" onclick="toggleCheckboxes(event, 'lungs')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="lungs_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Abdomen</td>
                                            <td><input type="checkbox" name="abdomen_normal" onclick="toggleCheckboxes(event, 'abdomen')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="abdomen_abnormal" onclick="toggleCheckboxes(event, 'abdomen')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="abdomen_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Kidneys</td>
                                            <td><input type="checkbox" name="kidneys_normal" onclick="toggleCheckboxes(event, 'kidneys')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="kidneys_abnormal" onclick="toggleCheckboxes(event, 'kidneys')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="kidneys_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Locomotor</td>
                                            <td><input type="checkbox" name="locomotor_normal" onclick="toggleCheckboxes(event, 'locomotor')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="locomotor_abnormal" onclick="toggleCheckboxes(event, 'locomotor')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="locomotor_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Nervous System</td>
                                            <td><input type="checkbox" name="nervous_normal" onclick="toggleCheckboxes(event, 'nervous')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="nervous_abnormal" onclick="toggleCheckboxes(event, 'nervous')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="nervous_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Skin</td>
                                            <td><input type="checkbox" name="skin_normal" onclick="toggleCheckboxes(event, 'skin')"><span class="styled-checkboxgreen"></span></td>
                                            <td><input type="checkbox" name="skin_abnormal" onclick="toggleCheckboxes(event, 'skin')"><span class="styled-checkboxred"></span></td>
                                            <td><textarea name="skin_comments" class="form-control" style="height:40px"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label for="remarks">Remarks:</label>
                                    <textarea name="remarks" id="remarks" class="form-control" style="border: none; border-radius: 0; border-bottom: 1px solid black; height: 50px;"></textarea>
                                </div>
                                <div class="text-left">
                                    <p>Sincerely,</p>
                                    <input type="text" class="form-control" id="physicianName" style="width:300px" name="physicianName" placeholder="Enter Name">
                                    <p class="py-2">School Physician</p>
                                    <p>Lic. No. <input type="text" class="form-control" id="licNo" style="width:300px" name="licNo" placeholder="Enter License Number"></p>
                                    <p>This certification is issued upon his/her request for any legal intent and purpose it may serve.</p>
                                </div>
                            </div>
                            <!-- Modal footer with download button and close button -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" onclick="downloadPhysicalExam()">Print</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function toggleCheckboxes(event, group) {
        var checkboxes = document.querySelectorAll(`input[type="checkbox"][name^="${group}"]`);
        checkboxes.forEach(function(checkbox) {
            if (checkbox !== event.target) {
                checkbox.checked = false;
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#idno').on('change', function() {
            var idno = $(this).val();
            if (idno) {
                $.ajax({
                    url: 'model/certificates/get_.php',
                    type: 'POST',
                    data: {
                        userId: idno
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {

                            $('#physicalExamName').val(response.data.FirstName + ' ' + response.data.MiddleInitial + ' ' + response.data.LastName);
                            var birthDate = new Date(response.data.Birthday);
                            var age = calculateAge(birthDate);
                            $('#dentalhealthRecordAge').val(age);
                            $('#sex').val(response.data.Gender);
                            if (response.data.Education == "College") {
                                $('#course_grade_section').val(response.data.Course + ' ' + response.data.Year);
                            } else {
                                $('#course_grade_section').val(response.data.Grade);
                            }
                            var schoolYear = calculateSchoolYear();
                            $('#school_year').val(schoolYear);
                        } else {
                            alert('User not found');
                        }
                    },
                    error: function() {
                        alert('An error occurred');
                    }
                });
            }
        });
    });

    function calculateAge(birthday) {
        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();
        var m = today.getMonth() - birthday.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthday.getDate())) {
            age--;
        }
        return age;
    }

    function calculateSchoolYear() {
        var today = new Date();
        var currentYear = today.getFullYear();
        var currentMonth = today.getMonth(); // January is 0, December is 11

        // School year starts in August (month 7) and ends in June (month 5)
        if (currentMonth >= 7) { // August (7) to December (11)
            return 'SY ' + currentYear + '-' + (currentYear + 1);
        } else { // January (0) to June (5)
            return 'SY ' + (currentYear - 1) + '-' + currentYear;
        }
    }

    function downloadPhysicalExam() {
        var node = document.getElementById('frame1');
        var nameValue = document.getElementById('physicalExamName').value;
        var physicianName = document.getElementById('physicianName').value;

        // Set white background color
        node.style.backgroundColor = '#ffffff';

        // Convert the DOM node to PNG image with white background color
        domtoimage.toPng(node)
            .then(function(dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                // Download the image
                // downloadURI(dataUrl, "Physical_Exam_Record.png");

                // Log the base64 data
                console.log("Base64 Data:", dataUrl);
                printImage(img);
                // Save the image and checkbox state
                saveDataURL(dataUrl, nameValue, physicianName);
                // savePhysicalExam();
            })
            .catch(function(error) {
                console.error('Oops, something went wrong', error);
            });
        // Function to save data URL to server
        function saveDataURL(dataUrl, nameValue, physicianName) {
            $.ajax({
                url: 'model/physical exam/upload.php',
                type: 'POST',
                data: {
                    imageCode: dataUrl,
                    nameValue: nameValue,
                    doctor: physicianName,
                },
                success: function(response) {
                    console.log("Image and name saved successfully:", response);
                    // Swal.fire(
                    //     'Saved!',
                    //     'Your student\'s document has been saved.',
                    //     'success'
                    // )
                },
                error: function(xhr, status, error) {
                    console.error('Error saving image and name:', error);
                }
            });
        }
    }



    // Function to download URI
    // function downloadURI(uri, name) {
    //     var link = document.createElement('a');
    //     link.download = name;
    //     link.href = uri;
    //     document.body.appendChild(link);
    //     link.click();
    //     document.body.removeChild(link);
    // }


    // Function to print image

    function printImage(img) {
        img.onload = function() {
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print Image</title></head><body style="margin: 0; text-align: center;">');
            printWindow.document.write('<img src="' + img.src + '" style="max-width: 100%; max-height: 100%;">');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        };
    }
</script>