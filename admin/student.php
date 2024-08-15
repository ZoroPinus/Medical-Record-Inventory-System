<?php
include 'includes/header.php';
?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="mobile-menu-overlay"></div>
    <div class="main-container">
        <div class="container-fluid pd-20-10 pd-ltr-20">
            <div class="title pd-20 mb-20 card-box">
                <h2 class="h3 mb-0">Students</h2>
            </div>
            <div class="card-box mb-30">
                <?php include 'includes/session.php'; ?>
                <div class="pb-20"></div>
                <!-- Add student button -->
                <div class="input-group px-3 justify-content-between">
                    <span class="input-group-btn">
                        <button class="btn btn-primary upload-button" data-toggle="modal" data-target="#addStudentModal" type="button">
                            <i class="fa fa-plus"></i>
                            Add Student
                        </button>
                    </span>
                    <button type="button" class="btn btn-primary" onclick="printContent()">Print</button>
                </div>
                <div class="table-responsive">
                    <table id="studentsTable" class="table hover nowrap">
                        <thead>
                            <tr>
                                <th>ID No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Middle Initial</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Education</th>
                                <!--  <th>Medical History</th>
                        <th>Emergency Contact Name</th>
                        <th>Emergency Contact Number</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'modal/student/add_.php'; ?>
    <?php include 'modal/student/edit_.php'; ?>
    <?php include 'modal/student/view_.php'; ?>
    <?php include 'modal/student/medicalHistory.php'; ?>
    <script>
        $(document).ready(function() {
            $('#education').change(function() {
                var education = $(this).val();
                if (education === 'Elementary') {
                    displayGrades(['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6']);
                    hideCourse();
                    hideYear();
                } else if (education === 'High School') {
                    displayGrades(['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10']);
                    hideCourse();
                    hideYear();
                } else if (education === 'Senior High') {
                    displayGrades(['Grade 11', 'Grade 12']);
                    hideCourse();
                    hideYear();
                } else if (education === 'College') {
                    hideGrade();
                    displayYears(['First Year', 'Second Year', 'Third Year', 'Fourth Year']);
                    displayCourses(['BSN', 'BSCS', 'BSIS', 'BSA', 'BSBA', 'BSOA', 'BSED', 'BSREM', 'BSEED-GENERAL']);
                } else {
                    hideCourse();
                    hideYear();
                }
            });
            $('#editEducation').change(function() {
                var education = $(this).val();
                if (education === 'Elementary') {
                    displayGrades(['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6']);
                    hideCourse();
                    hideYear();
                } else if (education === 'High School') {
                    displayGrades(['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10']);
                    hideCourse();
                    hideYear();
                } else if (education === 'Senior High') {
                    displayGrades(['Grade 11', 'Grade 12']);
                    hideCourse();
                    hideYear();
                } else if (education === 'College') {
                    hideGrade();
                    displayYears(['First Year', 'Second Year', 'Third Year', 'Fourth Year']);
                    displayCourses(['BSN', 'BSCS', 'BSIS', 'BSA', 'BSBA', 'BSOA', 'BSED', 'BSREM', 'BSEED-GENERAL']);
                } else {
                    hideGrade();
                    hideCourse();
                    hideYear();
                }
            });
        });

        function displayGrades(grades) {
            var options = '<option value="">Select grade</option>';
            for (var i = 0; i < grades.length; i++) {
                options += '<option value="' + grades[i] + '">' + grades[i] + '</option>';
            }
            $('#grade').html(options);
            $('#editGrade').html(options);
            $('#gradeGroup').show();
            $('#editGradeGroup').show();
        }

        function hideGrade() {
            $('#gradeGroup').hide();
            $('#editGradeGroup').hide();
        }

        function displayYears(years) {
            var options = '<option value="">Select year</option>';
            for (var i = 0; i < years.length; i++) {
                options += '<option value="' + years[i] + '">' + years[i] + '</option>';
            }
            $('#year').html(options);
            $('#editYear').html(options);
            $('#yearGroup').show();
            $('#editYearGroup').show();
        }

        function hideYear() {
            $('#yearGroup').hide();
            $('#editYearGroup').hide();
        }

        function displayCourses(courses) {
            var options = '<option value="">Select course</option>';
            for (var i = 0; i < courses.length; i++) {
                options += '<option value="' + courses[i] + '">' + courses[i] + '</option>';
            }
            $('#course').html(options);
            $('#editCourse').html(options);
            $('#courseGroup').show();
            $('#editCourseGroup').show();
        }

        function hideCourse() {
            $('#courseGroup').hide();
            $('#editCourseGroup').hide();
        }
    </script>
    <script>
        function printContent() {
            window.print();
        }
        $(document).ready(function() {
            // Fetch JSON data using AJAX
            $.ajax({
                url: 'https://raw.githubusercontent.com/flores-jacob/philippine-regions-provinces-cities-municipalities-barangays/master/philippine_provinces_cities_municipalities_and_barangays_2019v2.json',
                dataType: 'json',
                success: function(data) {
                    // Store data in localStorage for later use
                    localStorage.setItem('philippineData', JSON.stringify(data));
                    // Populate provinces dropdown
                    populateProvinces(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        function populateProvinces(data) {
            const provinceDropdown = $('#province');
            provinceDropdown.empty();
            provinceDropdown.append('<option value="">Select Province</option>');

            const provinces = [];
            for (const regionCode in data) {
                for (const provinceName in data[regionCode].province_list) {
                    provinces.push(provinceName);
                }
            }

            // Sort provinces alphabetically
            provinces.sort();

            for (const provinceName of provinces) {
                provinceDropdown.append('<option value="' + provinceName + '">' + provinceName + '</option>');
            }
        }

        function populateMunicipalities() {
            const selectedProvince = $('#province').val();
            const editselectedProvince = $('#editProvince').val();
            const data = JSON.parse(localStorage.getItem('philippineData'));
            const municipalityDropdown = $('#municipality');
            const editmunicipalityDropdown = $('#editCityMunicipal');
            municipalityDropdown.empty();
            municipalityDropdown.append('<option value="">Select Municipality</option>');
            editmunicipalityDropdown.empty();
            editmunicipalityDropdown.append('<option value="">Select Municipality</option>');

            const municipalities = [];
            for (const regionCode in data) {
                for (const provinceName in data[regionCode].province_list) {
                    if (provinceName === selectedProvince) {
                        const municipalityList = data[regionCode].province_list[provinceName].municipality_list;
                        for (const municipalityName in municipalityList) {
                            municipalities.push(municipalityName);
                        }
                    }
                    if (provinceName === editselectedProvince) {
                        const municipalityList = data[regionCode].province_list[provinceName].municipality_list;
                        for (const municipalityName in municipalityList) {
                            municipalities.push(municipalityName);
                        }
                    }
                }
            }

            // Sort municipalities alphabetically
            municipalities.sort();

            for (const municipalityName of municipalities) {
                municipalityDropdown.append('<option value="' + municipalityName + '">' + municipalityName + '</option>');
            }
            for (const municipalityName of municipalities) {
                editmunicipalityDropdown.append('<option value="' + municipalityName + '">' + municipalityName + '</option>');
            }
        }

        function populateBarangays() {
            const selectedProvince = $('#province').val();
            const selectedMunicipality = $('#municipality').val();
            const data = JSON.parse(localStorage.getItem('philippineData'));
            const barangayDropdown = $('#barangay');
            barangayDropdown.empty();
            barangayDropdown.append('<option value="">Select Barangay</option>');

            const barangays = [];
            for (const regionCode in data) {
                for (const provinceName in data[regionCode].province_list) {
                    if (provinceName === selectedProvince) {
                        const municipalities = data[regionCode].province_list[provinceName].municipality_list;
                        for (const municipalityName in municipalities) {
                            if (municipalityName === selectedMunicipality) {
                                const barangayList = municipalities[municipalityName].barangay_list;
                                for (const barangayName of barangayList) {
                                    barangays.push(barangayName);
                                }
                            }
                        }
                    }
                }
            }

            // Sort barangays alphabetically
            barangays.sort();

            for (const barangayName of barangays) {
                barangayDropdown.append('<option value="' + barangayName + '">' + barangayName + '</option>');
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            // Function to fetch student list and populate the DataTable
            function fetchStudentList() {
                if ($.fn.DataTable.isDataTable('#studentsTable')) {
                    $('#studentsTable').DataTable().destroy();
                }

                // Initialize DataTable with column definitions
                var dataTable = $('#studentsTable').DataTable({
                    columns: [{
                            data: 'idno',
                            title: 'Id No',
                            orderable: true
                        },
                        {
                            data: 'FirstName',
                            title: 'First Name',
                            orderable: true
                        },
                        {
                            data: 'LastName',
                            title: 'Last Name',
                            orderable: true
                        },
                        {
                            data: 'MiddleInitial',
                            title: 'Middle Initial',
                            orderable: true
                        },
                        {
                            data: 'Gender',
                            title: 'Gender',
                            orderable: true
                        },
                        {
                            data: 'Birthday',
                            title: 'Birthday',
                            orderable: true
                        },
                        {
                            data: 'Age',
                            title: 'Age',
                            orderable: true
                        },
                        {
                            data: 'Address',
                            title: 'Address',
                            orderable: true
                        },
                        {
                            data: 'ContactNumber',
                            title: 'Contact Number',
                            orderable: true
                        },
                        {
                            data: 'Education',
                            title: 'Education',
                            orderable: false
                        },
                        {
                            data: null,
                            title: 'Action',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div class="table-actions">' +
                                    '<a class="view-student" data-toggle="modal" data-target="#viewStudentModal" data-student-id="' + row.idno + '" href="#">' +
                                    '<i class="fa fa-eye"></i>' + // Text for the view action
                                    '</a>' +
                                    '<a class="edit-student" data-toggle="modal" data-target="#editStudentModal" data-student-id="' + row.idno + '" href="#">' +
                                    '<i class="icon-copy dw dw-edit2"></i>' +
                                    '</a>' +
                                    '<a class="delete-student" data-student-id="' + row.idno + '" href="#">' +
                                    '<i class="icon-copy dw dw-delete-3"></i>' +
                                    '</a>' +
                                    '</div>';
                            }
                        }
                        // Add more columns as needed
                    ],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    }
                });
                // Fetch data using Ajax and populate the table
                $.ajax({
                    url: 'model/student/fetch_.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Clear existing rows and add new rows
                        dataTable.clear().rows.add(data).draw();
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax request failed: ' + status + ', ' + error);
                        console.log(xhr.responseText);
                        $('#errorContainer').text('Error loading data: ' + error).show();
                    }
                });
            }

            // Initialize DataTable when the document is ready
            fetchStudentList();
            // Function to handle form submission for adding a student
            $("#addStudentForm").on("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    type: "POST",
                    url: "model/student/add_.php",
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response); // Log server response

                        // Parse JSON response
                        var responseData;
                        try {
                            responseData = JSON.parse(response);
                        } catch (e) {
                            responseData = response;
                        }

                        // Check if the form submission was successful
                        if (responseData && responseData.success) {
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: responseData.message
                            }).then(function() {
                                // Clear the form fields
                                $('#addStudentForm')[0].reset();
                                // Refresh student list
                                fetchStudentList();
                                $('#addStudentModal').modal('hide');
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: responseData.message || 'Failed to submit the form'
                            });
                        }
                    },
                    error: function(error) {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to submit the form. Please try again later.'
                        });
                        console.log("Error: " + error);
                    }
                });
            });

            $('#studentsTable').on('click', '.edit-student', function() {
                var studentId = $(this).data('student-id');
                console.log("Student Id: " + studentId);
                $.ajax({
                    url: 'model/student/get_.php',
                    type: 'POST',
                    data: {
                        studentId: studentId
                    },
                    success: function(response) {
                        var studentData = JSON.parse(response);
                        console.log(studentData)
                        // Populate the edit form fields with student data
                        $('#editIdNo').val(studentData.data.idno);
                        $('#editFirstNames').val(studentData.data.FirstName);
                        $('#editLastNames').val(studentData.data.LastName);
                        $('#editMiddleInitial').val(studentData.data.MiddleInitial);
                        $('#editSuffix').val(studentData.data.Suffix);
                        $('input[name="editedGender"][value="' + studentData.data.Gender + '"]').prop('checked', true);
                        $('#editBirthday').val(studentData.data.Birthday);
                        $('#editBrgyPurok').val(studentData.data.Address_Street);
                        $('#editCityMunicipal').val(studentData.data.Address_City);
                        $('#editProvince').val(studentData.data.Address_State);
                        $('#editContactNumber').val(studentData.data.ContactNumber);
                        $('#editEducation').val(studentData.data.Education);

                        $('#editCourse').val(studentData.data.CouFirstNamerse);
                        // Populate education, year, and course fields based on the education level
                        if (studentData.data.Education === 'College') {
                            $('#editYearGroup').show();
                            $('#editYear').val(studentData.data.Year);
                            $('#editCourseGroup').show();
                            $('#editCourse').val(studentData.data.Course);
                        } else {
                            $('#editYearGroup').hide();
                            $('#editCourseGroup').hide();
                            $('#editGradeGroup').show(); // Show the grade group if it's not college
                            $('#editGrade').val(studentData.data.Grade);
                        }

                        $('#editMedicalHistory').val(studentData.data.MedicalHistory);
                        $('#editEmergencyContactName').val(studentData.data.EmergencyContactName);
                        $('#editEmergencyContactNumber').val(studentData.data.EmergencyContactNumber);
                        // Store the student ID in a hidden input field
                        $('#editStudentId').val(studentId);
                        // Show the edit student modal
                        $('#editStudentModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching student data:', error);
                    }
                });
            });

            $('#studentsTable').on('click', '.view-student', function() {
                var studentId = $(this).data('student-id');
                $.ajax({
                    url: 'model/student/get_.php',
                    type: 'POST',
                    data: {
                        studentId: studentId
                    },
                    success: function(response) {
                        var studentData = JSON.parse(response);
                        // Populate the edit form fields with student data
                        $('#viewIdNo').val(studentData.data.idno);
                        $('#viewFirstNames').val(studentData.data.FirstName);
                        $('#viewLastNames').val(studentData.data.LastName);
                        $('#viewMiddleInitial').val(studentData.data.MiddleInitial);
                        $('#viewSuffix').val(studentData.data.Suffix);
                        $('input[name="viewedGender"][value="' + studentData.data.Gender + '"]').prop('checked', true);
                        $('#viewBirthday').val(studentData.data.Birthday);
                        $('#viewBrgyPurok').val(studentData.data.Address_Street);
                        $('#viewCityMunicipal').val(studentData.data.Address_City);
                        $('#viewProvince').val(studentData.data.Address_State);
                        $('#viewContactNumber').val(studentData.data.ContactNumber);
                        $('#viewEducation').val(studentData.data.Education);

                        $('#viewCourse').val(studentData.data.CouFirstNamerse);
                        // Populate education, year, and course fields based on the education level
                        if (studentData.data.Education === 'College') {
                            $('#viewYearGroup').show();
                            $('#viewYear').val(studentData.data.Year);
                            $('#viewCourseGroup').show();
                            $('#viewCourse').val(studentData.data.Course);
                        } else {
                            $('#viewYearGroup').hide();
                            $('#viewCourseGroup').hide();
                            $('#viewGradeGroup').show(); // Show the grade group if it's not college
                            $('#viewGrade').val(studentData.data.Grade);
                        }

                        $('#viewMedicalHistory').val(studentData.data.MedicalHistory);
                        $('#viewEmergencyContactName').val(studentData.data.EmergencyContactName);
                        $('#viewEmergencyContactNumber').val(studentData.data.EmergencyContactNumber);
                        // Store the student ID in a hidden input field
                        $('#viewStudentId').val(studentId);
                        // Show the view student modal
                        $('#viewStudentModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching student data:', error);
                    }
                });
            });

            $("#editStudentForm").on("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    type: "POST",
                    url: "model/student/edit_.php",
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response); // Log server response

                        // Parse JSON response
                        var responseData;
                        try {
                            responseData = JSON.parse(response);
                        } catch (e) {
                            responseData = response;
                        }

                        // Check if the edit operation was successful
                        if (responseData && responseData.success) {
                            // Hide the edit student modal
                            $('#editStudentModal').modal('hide');
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: responseData.message
                            }).then(function() {
                                // Refresh student list
                                fetchStudentList();
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: responseData.message || 'Failed to update student'
                            });
                        }
                    },
                    error: function(error) {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update student. Please try again later.'
                        });
                        console.log("Error: " + error);
                    }
                });
            });


            // Event handler for delete student button click
            $('#studentsTable').on('click', '.delete-student', function(e) {
                e.preventDefault(); // Prevent default anchor click behavior
                var studentId = $(this).data('student-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel',
                    reverseButtons: true,
                    preConfirm: () => {
                        return $.ajax({
                            type: 'POST',
                            url: 'model/student/del_.php',
                            data: {
                                studentId: studentId
                            },
                            dataType: 'json'
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value && result.value.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your student has been deleted.',
                                'success'
                            ).then((result) => {
                                fetchStudentList();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                result.value.message || 'Failed to delete the student.',
                                'error'
                            );
                        }
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Cancelled',
                            'Your student is safe :)',
                            'info'
                        );
                    }
                });
            });


            // Other event handlers for editing and deleting students can be added here
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to disable all form fields within the viewStudentForm except the button
            function disableFormFields() {
                $('#viewStudentForm :input:not(button)').prop('disabled', true);
            }

            // Call disableFormFields function when the modal is shown
            $('#viewStudentModal').on('shown.bs.modal', function() {
                disableFormFields();
            });

            // Optional: Enable form fields when the modal is hidden
            $('#viewStudentModal').on('hidden.bs.modal', function() {
                $('#viewStudentForm :input').prop('disabled', false);
            });
        });
    </script>