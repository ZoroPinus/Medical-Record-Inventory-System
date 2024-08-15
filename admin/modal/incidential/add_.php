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
<div class="modal fade" id="addCovid19Report" tabindex="-1" role="dialog" aria-labelledby="medicalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal header with close button -->
            <div class="modal-header">
                <h5 class="modal-title" id="medicalModalLabel">Incidential Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body with form for entering physical examination data -->
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <!-- Certificate container with school logo and title -->
                        <div class="certificate-container rounded shadow p-4 mb-5 " id="frame">
                            <div class="certificate-header d-flex justify-content-center align-items-center mb-4">
                                <img src="../assets/img/avatars/school-logo.png" class="img-fluid logo mr-3" alt="Logo">
                                <div class="certificate-title-container text-center">
                                    <h2 class="certificate-title d-inline-block mb-0">Union Christian College</h2>
                                    <p>Widdoes St., Brgy. II, San Fernando City La Union<br>
                                        2500 Philippines<br>
                                        URL Address: www.ucc.edu.ph</p>
                                    <h4>OFFICE OF STUDENT AFFAIRS & SERVICES</h4>
                                </div><span class="ml-3"></span>
                                <img src="../assets/img/avatars/church-logo.png" class="img-fluid logo mr-3" alt="Logo">
                            </div>
                            <div class="certificate-content text-center">
                                <h6>INCIDENTAL REPORT</h6><br>
                            </div>
                            <br>
                            <form id="addIncidentalReportForm">
                                <div class="form-group col-md-3">
                                    <label for="date">Date:</label>
                                    <input type="date" style="border: none; border-bottom: 1px solid black; " id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="idno">ID no.:</label>
                                    <input type="text" id="idno" name="idno" oninput="formatIdNumber(this)" onkeypress="return isNumberKey(event)" style="border: none; border-bottom: 1px solid gray; width: 580px; max-width: 580px; box-sizing: border-box;">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" style="border: none; border-bottom: 1px solid gray; width: 580px; max-width: 580px; box-sizing: border-box;">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="courseYearGrade">Course/Year/Grade:</label>
                                    <input type="text" id="courseYearGrade" name="courseYearGrade" style="border: none; border-bottom: 1px solid gray; width: 380px; max-width: 380px; box-sizing: border-box;">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="incidence">Incidence:</label>
                                    <input type="text" id="incidence" name="incidence" style="border: none; border-bottom: 1px solid gray; width: 580px; max-width: 580px; box-sizing: border-box;"><br><br>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <ul>
                                            <li>Prepared By:</li>
                                            <li style="text-decoration: underline;">
                                                <input type="text" class="form-control" id="nurseName" name="nurseName" placeholder="Enter Name">
                                            </li>
                                            <li class="font-italic">School Nurse</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                </div>
                                <!-- Modal footer with download button and close button -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" onclick="print()">Print</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>

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

                            $('#name').val(response.data.FirstName + ' ' + response.data.MiddleInitial + ' ' + response.data.LastName);
                            if (response.data.Education == "college") {
                                $('#courseYearGrade').val(response.data.Year + ' ' + response.data.Year);
                            } else {
                                $('#courseYearGrade').val(response.data.Grade);
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
</script>

<script>
    function print() {
        var node = document.getElementById('frame');

        // Set white background color
        node.style.backgroundColor = '#fffffff';

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
                saveDataURL(dataUrl);
            })
            .catch(function(error) {
                console.error('Oops, something went wrong', error);
            });
        // Function to save data URL to server
        function saveDataURL(dataUrl) {
            var name = document.getElementById('name').value;
            var preparedByName = document.getElementById('nurseName').value;
            var incidence = document.getElementById('incidence').value;
            var date = document.getElementById('date').value;
            $.ajax({
                url: 'model/incidential/upload.php',
                type: 'POST',
                data: {
                    name:name,
                    incidence:incidence,
                    date:date,
                    preparedByName:preparedByName,
                    imageCode: dataUrl
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