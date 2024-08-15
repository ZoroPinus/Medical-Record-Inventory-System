<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php'; // Assuming this file contains your TeacherClass definition
include '../../../includes/config.php'; // Assuming this file contains your database connection

// Instantiate TeacherClass with the database connection
$TeacherClass = new TeacherClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $idno = $_POST['editIdNo'];
    $firstName = $_POST['editFirstName'];
    $middleInitial = $_POST['editMiddleInitial'];
    $lastName = $_POST['editLastName'];
    $gender = $_POST['editedGender'];
    $suffix = $_POST['editSuffix'];
    $birthday = $_POST['editBirthday'];
    $addressStreet = $_POST['editBrgyPurok'];
    $addressCity = $_POST['editCityMunicipal'];
    $addressState = $_POST['editProvince'];
    $contactNumber = $_POST['editContactNumber'];
    $department = $_POST['edit_Department'];
    $medicalHistory = $_POST['editMedicalHistory'];
    $emergencyContactName = $_POST['editEmergencyContactName'];
    $emergencyContactNumber = $_POST['editEmergencyContactNumber'];
    $teacherId = $_POST['editTeacherId'];


    // Edit the teacher using the TeacherClass method

    if ($department === 'others') {
        // Retrieve the specific department entered by the user
        $specificDepartment = $_POST['edit_otherDepartmentInput'];

        $success = $TeacherClass->updateTeacher(
            $idno,
            $firstName,
            $middleInitial,
            $lastName,
            $suffix,
            $gender,
            $addressStreet,
            $addressCity,
            $addressState,
            $contactNumber,
            $birthday,
            $specificDepartment,
            $medicalHistory,
            $emergencyContactName,
            $emergencyContactNumber,
            $teacherId
        );
    } else {
        $success = $TeacherClass->updateTeacher(
            $idno,
            $firstName,
            $middleInitial,
            $lastName,
            $suffix,
            $gender,
            $addressStreet,
            $addressCity,
            $addressState,
            $contactNumber,
            $birthday,
            $department,
            $medicalHistory,
            $emergencyContactName,
            $emergencyContactNumber,
            $teacherId,
        );
    }

    // Check if the teacher was edited successfully
    if ($success) {
        // Teacher edited successfully
        // You can return a success message
        echo json_encode(array("success" => true, "message" => "Teacher updated successfully"));
        exit();
    } else {
        // Failed to edit teacher
        // You can return an error message
        echo json_encode(array("success" => false, "message" => "Failed to update teacher"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}
