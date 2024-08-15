<!-- Modal -->
<div class="modal fade " id="addDentalHealthModal" tabindex="-1" role="dialog" aria-labelledby="medicalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="medicalModalLabel">Dental Health Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="certificate-container rounded shadow p-4 mb-5 " id="frame2">
                            <div class="certificate-header d-flex justify-content-center align-items-center mb-4 ">
                                <img src="../assets/img/avatars/school-logo.png" class="img-fluid logo mr-3" alt="Logo">
                                <div class="certificate-title-container text-center">
                                    <h2 class="certificate-title d-inline-block mb-0">Union Christian College</h2>
                                </div>
                                <img src="../assets/img/avatars/church-logo.png" class="img-fluid logo ml-3" alt="Logo">
                            </div>
                            <div class="text-center mb-4">
                                <h4>Office of Student Affairs and Services</h4>
                                <h6>School Clinic</h6>
                                <h5>Dental Clinic Record</h5>
                            </div>
                            <form id="dentalHealthForm"> <!-- Add form element here -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="idno">ID no.:</label>
                                            <input type="text" style="border: none; border-bottom: 1px solid black;" id="idno" name="idno" oninput="formatIdNumber(this)" onkeypress="return isNumberKey(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" style="border: none; border-bottom: 1px solid black;" id="dentalhealthRecordName" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="age">Age:</label>
                                            <input type="number" style="border: none; border-bottom: 1px solid black;" id="dentalhealthRecordAge" name="age">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sex">Sex:</label>
                                            <input type="text" style="border: none; border-bottom: 1px solid black;" id="sex" name="sex">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date">Date:</label>
                                            <input type="date" style="border: none; border-bottom: 1px solid black;" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="course_grade_section">Course Grade Year & Section:</label>
                                            <input type="text" style="border: none; border-bottom: 1px solid black;" id="course_grade_section" name="course_grade_section">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="school_year">School Year:</label>
                                            <input type="text" style="border: none; border-bottom: 1px solid black;" id="school_year" name="school_year">
                                        </div>
                                    </div>
                                </div>

                                <div class="container-fluid">
                                    <table class="table table-responsive" id="dynamicTable">
                                        <thead>
                                            <!-- You can add any table headers here -->
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <table class="table table-responsive">
                                        <thead>
                                            <!-- You can add any table headers here -->
                                        </thead>
                                        <tbody>
                                            <td style="padding: 0; margin: 0; ">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="18" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="48" readonly />
                                                <input type="text" class="form-control form-control-sm" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="17" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="47" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="16" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="46" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="15" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="45" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="14" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="44" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="13" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="43" readonly />
                                                <input type="text" class="form-control form-control-sm  text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="12" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="42" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="11" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="41" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="21" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="31" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="22" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="32" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="23" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="33" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="24" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="34" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="25" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="35" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="26" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="36" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="27" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="37" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>
                                            <td style="padding: 0; margin: 0;">
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="28" readonly />
                                                <input type="number" class="form-control form-control-sm text-center" name="columns[]" value="38" readonly />
                                                <input type="text" class="form-control form-control-sm text-center" name="columns[]" />
                                            </td>

                                        </tbody>
                                    </table>
                                    <div class=" border border-dark m-5 p-5">
                                        <h6>LEGEND:</h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul>
                                                    <li>l - Caries Free</li>
                                                    <li>C - Carious Tooth</li>
                                                    <li>X - Indicated for Extraction</li>
                                                    <li>Rf - Roof Fragment</li>
                                                    <li>M - Missing/Extracted</li>
                                                    <li>Un - Unerupted</li>
                                                    <!-- Add more list items as needed -->
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul>
                                                    <li>Tf - Temporary Filing</li>
                                                    <li>Am - Amalgam Filing</li>
                                                    <li>Co - Composite Filing </li>
                                                    <li>Gf - Gold Filing</li>
                                                    <li>Js - Jacket Crown</li>
                                                    <li>S - Sealant </li>
                                                    <!-- Add more list items as needed -->
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul>
                                                    <li>Fb - Fixed Bridge</li>
                                                    <li>Ab - Abutment</li>
                                                    <li>Sc - Special Crown</li>
                                                    <li>P - Pontic</li>
                                                    <li>CD - Complete Denture</li>
                                                    <!-- Add more list items as needed -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center ">
                                        <div class="col-md-6 text-center ">
                                            <p class="mb-0">By:</p>
                                            <input type="text" class="form-control text-center" id="physicianName" style="width:150px align-self-center" name="physicianName" placeholder="Enter Name">
                                            <p class="mb-0">License No:</p>
                                            <input type="text" class="form-control text-center" id="licNo" style="width:150px align-self-center" name="licNo" placeholder="Enter License Number">
                                            <p class="mb-0">School Dentist</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="removeRowBtn">Remove Row</button>
                                    <button type="button" class="btn btn-primary" id="addRowBtn">Add Row</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="downloadButton" class="download btn btn-success" onclick="download()" >Print</button>
                                </div>
                            </form> <!-- Close the form element -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

                                $('#dentalhealthRecordName').val(response.data.FirstName + ' ' + response.data.MiddleInitial + ' ' + response.data.LastName);
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
                                // Populate other fields as necessary
                                console.log(response)
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
    </script>
    <script>
        function download() {
            var node = document.getElementById('frame2');
            var nameValue = document.getElementById('dentalhealthRecordName').value;
            var doctor = document.getElementById('physicianName').value;
            // Set white background color
            node.style.backgroundColor = 'white';

            domtoimage.toPng(node)
                .then(function(dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;

                    // Download the image
                    // downloadURI(dataUrl, "Dental Health Record.png");

                    // Print the image in a new window
                    printImage(img);

                    // Log the base64 data
                    console.log("Base64 Data:", dataUrl);
                    //save the image
                    saveDataURL(dataUrl, nameValue,doctor);

                })
            domtoimage.toPng(node)
                .then(function(dataUrl) {
                    // Send the data URL to the PHP script for saving
                    saveDataURL(dataUrl);
                })

                .catch(function(error) {
                    console.error('Oops, something went wrong', error);
                });

            function saveDataURL(dataUrl, nameValue,doctor) {
                $.ajax({
                    url: 'model/dental health/upload.php',
                    type: 'POST',
                    data: {
                        doctor:doctor,
                        dataUrl: dataUrl,
                        name: nameValue,
                    },
                    success: function(response) {
                        console.log("Image and name saved successfully:", response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving image and name:', error);
                    }
                });
            }
        }

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

    <script>
        $(document).ready(function() {
            // Initialize select2 for the .dentalhealth class
            $(".dentalhealth").select2({
                dropdownParent: $("#addDentalHealthModal")
            });

            // Event listener for student selection
            $('#studentSelect').change(function() {
                $('#selectedStudent').val($(this).val());
            });

            // Add row button click event
            $('#addRowBtn').click(function() {
                var newRow =
                    '<td style="padding: 0; margin: 0;">' +
                    '<input type="text" class="form-control form-control-sm text-center" name="columns[]" style="margin: 0;" />' +
                    '<input type="number" class="form-control form-control-sm text-center" name="columns[]" style="margin: 0;" />' +
                    '<input type="number" class="form-control form-control-sm text-center" name="columns[]" style="margin: 0;" />' +
                    '<input type="text" class="form-control form-control-sm text-center" name="columns[]" style="margin: 0;" />' +
                    '</td>';

                $('#dynamicTable tbody').append(newRow);

                // Log input values
                $('#dynamicTable tbody td:last-child input').each(function() {});
            });

            // Remove row button click event
            $('#removeRowBtn').click(function() {
                console.log("Remove Row button clicked"); // Debug statement to check if the button click event is triggered
                // Remove the last row from the table
                $('#dynamicTable tbody td:last').remove();
            });

            $('#addDentalHealth').click(function() {
            var formData = $('#dentalHealthForm').serialize();

        });
        });
    </script>