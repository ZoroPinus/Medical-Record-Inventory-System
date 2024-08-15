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
                <h2 class="h3 mb-0">Employees</h2>
            </div>
            <div class="card-box mb-30">
                <?php include 'includes/session.php'; ?>
                <div class="pb-20"></div>
                <!-- Add teacher button -->
                <div class="input-group px-3 justify-content-between">
                    <span class="input-group-btn">
                        <button class="btn btn-primary upload-button" data-toggle="modal" data-target="#addTeacherModal" type="button">
                            <i class="fa fa-plus"></i>
                            Add Employee
                        </button>
                    </span>
                    <button type="button" class="btn btn-primary" onclick="printContent()">Print</button>
                </div>
                <div class="table-responsive">
                    <table id="teachersTable" class="table hover nowrap">
                        <thead>
                            <tr>
                                <th>Id No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Middle Initial</th>
                                <!-- <th>Email</th> -->
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <!-- <th>Subject Taught</th> -->
                                <!-- <th>Experience Years</th> -->
                                <th>Department</th>
                                <!-- <th>Grade Level Taught</th> -->
                                <th>Phone Number</th>
                                <th>Address</th>
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
    <?php include 'modal/teacher/add_.php'; ?>
    <?php include 'modal/teacher/edit_.php'; ?>
    <?php include 'modal/teacher/view_.php'; ?>

</body>

<style>
    /* Custom Icon Class */
    .custom-icon {
        display: inline-block;
        width: 24px;
        /* Adjust width and height as needed */
        height: 24px;
        background-color: #007bff;
        /* Blue color for the icon background */
        color: #fff;
        /* White color for the icon */
        border-radius: 50%;
        /* Rounded shape for the icon */
        text-align: center;
        line-height: 24px;
        /* Center the icon vertically */
        font-size: 14px;
        /* Adjust the icon size */
        text-transform: uppercase;
        /* Convert text to uppercase */
        font-weight: bold;
        /* Bold font for the icon */
        text-decoration: none;
        /* Remove underline from text */
    }

    /* Optional Hover Effect */
    .custom-icon:hover {
        background-color: #0056b3;
        /* Darker blue color on hover */
        cursor: pointer;
    }
</style>

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

    function showInput() {
        var departmentSelect = document.getElementById('department');
        var otherDepartmentDiv = document.getElementById('otherDepartment');
        var otherDepartmentInput = document.getElementById('otherDepartmentInput');

        if (departmentSelect.value === 'others') {
            otherDepartmentDiv.style.display = 'block';
            otherDepartmentInput.setAttribute('required', 'required');
        } else {
            otherDepartmentDiv.style.display = 'none';
            otherDepartmentInput.removeAttribute('required');
        }
    }

    function showEditInput() {
        var editdepartmentSelect = document.getElementById('edit_Department');
        var editotherDepartmentDiv = document.getElementById('editotherDepartment');
        var editotherDepartmentInput = document.getElementById('edit_otherDepartmentInput');

        if (editdepartmentSelect.value === 'others') {
            editotherDepartmentDiv.style.display = 'block';
            editotherDepartmentInput.setAttribute('required', 'required');
        } else {
            editotherDepartmentDiv.style.display = 'none';
            editotherDepartmentInput.removeAttribute('required');
        }
    }

    function showViewInput() {
        var viewdepartmentSelect = document.getElementById('view_Department');
        var viewotherDepartmentDiv = document.getElementById('viewotherDepartment');
        var viewotherDepartmentInput = document.getElementById('view_otherDepartmentInput');

        if (viewdepartmentSelect.value === 'others') {
            viewotherDepartmentDiv.style.display = 'block';
            viewotherDepartmentInput.setAttribute('required', 'required');
        } else {
            viewotherDepartmentDiv.style.display = 'none';
            viewotherDepartmentInput.removeAttribute('required');
        }
    }
</script>
<script>
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
        const data = JSON.parse(localStorage.getItem('philippineData'));
        const municipalityDropdown = $('#municipality');
        municipalityDropdown.empty();
        municipalityDropdown.append('<option value="">Select Municipality</option>');

        const municipalities = [];
        for (const regionCode in data) {
            for (const provinceName in data[regionCode].province_list) {
                if (provinceName === selectedProvince) {
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
        // Function to fetch teacher list and populate the DataTable
        function fetchTeacherList() {
            if ($.fn.DataTable.isDataTable('#teachersTable')) {
                $('#teachersTable').DataTable().destroy();
            }

            // Initialize DataTable with column definitions
            var dataTable = $('#teachersTable').DataTable({
                columns: [{
                        data: 'idno',
                        title: 'ID no.',
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
                    // {
                    //     data: 'Email',
                    //     title: 'Email',
                    //     orderable: true
                    // },
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
                    // {
                    //     data: 'SubjectTaught',
                    //     title: 'Subject Taught',
                    //     orderable: true
                    // },
                    // {
                    //     data: 'ExperienceYears',
                    //     title: 'Experience Years',
                    //     orderable: true
                    // },
                    {
                        data: 'Department',
                        title: 'Department',
                        orderable: true
                    },
                    // {
                    //     data: 'GradeLevelTaught',
                    //     title: 'Grade Level Taught',
                    //     orderable: true
                    // },
                    {
                        data: 'ContactNumber',
                        title: 'Contact Number',
                        orderable: true
                    },
                    {
                        data: 'Address',
                        title: 'Address',
                        orderable: true
                    },
                    {
                        data: null,
                        title: 'Action',
                        orderable: false,
                        render: function(data, type, row) {
                            return '<div class="table-actions">' +
                                '<a class="view-teacher" data-toggle="modal" data-target="#viewTeacherModal" data-teacher-id="' + row.idno + '" href="#">' +
                                '<i class="fa fa-eye"></i>' + // Text for the view action
                                '</a>' +
                                '<a class="edit-teacher" data-toggle="modal" data-target="#editTeacherModal" data-teacher-id="' + row.idno + '" href="#">' +
                                '<i class="icon-copy dw dw-edit2"></i>' +
                                '</a>' +
                                '<a class="delete-teacher" data-teacher-id="' + row.idno + '" href="#">' +
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
                url: 'model/teacher/fetch_.php',
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

        // Call the fetchTeacherList function to load teacher data on page load
        fetchTeacherList();

        // Event handler for form submission to add a new teacher
        $("#addTeacherForm").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "model/teacher/add_.php",
                data: $(this).serialize(),
                success: function(response) {
                    console.log("Response from server:", response);
                    if (response && response.success) {
                        // Display success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(function() {
                            // Reset the form, reload teacher list, and hide the modal
                            $('#addTeacherForm')[0].reset();
                            fetchTeacherList();
                            $('#addTeacherModal').modal('hide');
                        });
                    } else {
                        // Display error message from the server
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Failed to submit the form'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Log the error and response to the console
                    console.error("Error submitting form:", error);
                    console.log("Response from server:", xhr.responseText);

                    // Display error message if there was an error with the AJAX request
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error || 'Failed to submit the form'
                    });
                }
            });
        });

        $("#editTeacherForm").on("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                type: "POST",
                url: "model/teacher/edit_.php",
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
                        $('#editTeacherModal').modal('hide');
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: responseData.message
                        }).then(function() {
                            fetchTeacherList();
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: responseData.message || 'Failed to update teacher'
                        });
                    }
                },
                error: function(error) {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update teacher. Please try again later.'
                    });
                    console.log("Error: " + error);
                }
            });
        });

        // Event handler for deleting a teacher
        $(document).on("click", ".delete-teacher", function() {
            var teacherId = $(this).data("teacher-id");
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this teacher data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "model/teacher/del_.php",
                        data: {
                            teacherId: teacherId
                        },
                        success: function(response) {
                            try {
                                response = JSON.parse(response);
                                if (response && response.success) {
                                    // Display success message
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        // Reload teacher list after deletion
                                        fetchTeacherList();
                                    });
                                } else {
                                    // Display error message from the server
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message || 'Failed to delete teacher'
                                    });
                                }
                            } catch (error) {
                                console.error("Error parsing JSON response:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Invalid response from server'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Log the error and response to the console
                            console.error("Error deleting teacher:", error);
                            console.log("Response from server:", xhr.responseText);

                            // Display error message if there was an error with the AJAX request
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error || 'Failed to delete teacher'
                            });
                        }
                    });
                }
            });
        });


        $('#teachersTable').on('click', '.edit-teacher', function() {
            var teacherId = $(this).data('teacher-id');
            console.log("Teacher Id: " + teacherId);
            $.ajax({
                url: 'model/teacher/get_.php',
                type: 'POST',
                data: {
                    teacherId: teacherId
                },
                success: function(response) {
                    var teacherData = JSON.parse(response);
                    // Populate the edit form fields with teacher data
                    $('#editIdNo').val(teacherData.idno);
                    $('#editFirstNames').val(teacherData.FirstName);
                    $('#editLastNames').val(teacherData.LastName);
                    $('#edit_email').val(teacherData.Email);
                    $('#editMiddleInitial').val(teacherData.MiddleInitial);
                    $('#editSuffix').val(teacherData.Suffix);
                    $('input[name="editedGender"][value="' + teacherData.Gender + '"]').prop('checked', true);
                    $('#editBirthday').val(teacherData.Birthday);
                    $('#editBrgyPurok').val(teacherData.Address_Street);
                    $('#editCityMunicipal').val(teacherData.Address_City);
                    $('#editProvince').val(teacherData.Address_State);
                    $('#editContactNumber').val(teacherData.ContactNumber);


                    if (
                        teacherData.Department !== 'SBS' &&
                        teacherData.Department !== 'SHES' &&
                        teacherData.Department !== 'SEAS' &&
                        teacherData.Department !== 'others'
                    ) {
                        $('#edit_Department').val('others');
                    } else {
                        $('#edit_Department').val(teacherData.Department);
                    }
                    $('#edit_otherDepartmentInput').val(teacherData.Department);

                    $('#editCourse').val(teacherData.CouFirstNamerse);
                    // Populate education, year, and course fields based on the education level
                    if (teacherData.Education === 'college') {
                        $('#editYearGroup').show();
                        $('#editYear').val(teacherData.Year);
                        $('#editCourseGroup').show();
                        $('#editCourse').val(teacherData.Course);
                    } else {
                        $('#editYearGroup').hide();
                        $('#editCourseGroup').hide();
                        $('#editGradeGroup').show(); // Show the grade group if it's not college
                        $('#editGrade').val(teacherData.Grade);
                    }

                    $('#editMedicalHistory').val(teacherData.MedicalHistory);
                    $('#editEmergencyContactName').val(teacherData.EmergencyContactName);
                    $('#editEmergencyContactNumber').val(teacherData.EmergencyContactNumber);
                    // Store the teacher ID in a hidden input field
                    $('#editTeacherId').val(teacherId);
                    // Show the edit teacher modal
                    $('#editTeacherModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching teacher data:', error);
                }
            });
        });

        $('#teachersTable').on('click', '.view-teacher', function() {
            var teacherId = $(this).data('teacher-id');
            console.log("Teacher Id: " + teacherId);
            $.ajax({
                url: 'model/teacher/get_.php',
                type: 'POST',
                data: {
                    teacherId: teacherId
                },
                success: function(response) {
                    var teacherData = JSON.parse(response);
                    // Populate the edit form fields with teacher data
                    $('#viewIdNo').val(teacherData.idno);
                    $('#viewFirstNames').val(teacherData.FirstName);
                    $('#viewLastNames').val(teacherData.LastName);
                    $('#view_email').val(teacherData.Email);
                    $('#viewMiddleInitial').val(teacherData.MiddleInitial);
                    $('#viewSuffix').val(teacherData.Suffix);
                    $('input[name="viewedGender"][value="' + teacherData.Gender + '"]').prop('checked', true);
                    $('#viewBirthday').val(teacherData.Birthday);
                    $('#viewBrgyPurok').val(teacherData.Address_Street);
                    $('#viewCityMunicipal').val(teacherData.Address_City);
                    $('#viewProvince').val(teacherData.Address_State);
                    $('#viewContactNumber').val(teacherData.ContactNumber);
                    if (
                        teacherData.Department !== 'SBS' &&
                        teacherData.Department !== 'SHES' &&
                        teacherData.Department !== 'SEAS' &&
                        teacherData.Department !== 'others'
                    ) {
                        $('#view_Department').val('others');
                    } else {
                        $('#view_Department').val(teacherData.Department);
                    }
                    $('#view_otherDepartmentInput').val(teacherData.Department);
                    $('#viewMedicalHistory').val(teacherData.MedicalHistory);
                    $('#viewEmergencyContactName').val(teacherData.EmergencyContactName);
                    $('#viewEmergencyContactNumber').val(teacherData.EmergencyContactNumber);
                    // Store the teacher ID in a hidden input field
                    $('#viewTeacherId').val(teacherId);
                    // Show the view teacher modal
                    $('#viewTeacherModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching teacher data:', error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to disable all form fields within the viewTeacherForm
        function disableFormFields() {
            $('#viewTeacherForm :input').prop('disabled', true);
        }

        // Call disableFormFields function when the modal is shown
        $('#viewTeacherModal').on('shown.bs.modal', function() {
            disableFormFields();
        });

        // Optional: Enable form fields when the modal is hidden
        $('#viewTeacherModal').on('hidden.bs.modal', function() {
            $('#viewTeacherForm :input').prop('disabled', false);
        });
    });
</script>