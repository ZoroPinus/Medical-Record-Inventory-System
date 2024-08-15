<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

// Assuming you have a StudentClass with a method to edit a student
$StudentClass = new StudentClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $idno = $_POST['editIdNo'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $gender = $_POST['editedGender'];
    $middleInitial = $_POST['editMiddleInitial'];
    $suffix = $_POST['editSuffix'];
    $birthday = $_POST['editBirthday'];
    $addressStreet = $_POST['editBrgyPurok'];
    $addressCity = $_POST['editCityMunicipal'];
    $addressState = $_POST['editProvince'];
    $contactNumber = $_POST['editContactNumber'];
    $education = $_POST['editEducation'];
    $grade = isset($_POST['editGrade']) ? $_POST['editGrade'] : null; // Assuming grade is included for education level other than college
    $year = isset($_POST['editYear']) ? $_POST['editYear'] : null;
    $course = isset($_POST['editCourse']) ? $_POST['editCourse'] : null;
    $medicalHistory = $_POST['editMedicalHistory'];
    $emergencyContactName = $_POST['editEmergencyContactName'];
    $emergencyContactNumber = $_POST['editEmergencyContactNumber'];
    $studentId = $_POST['editStudentId'];

    // Edit the student using the StudentClass method
    $success = $StudentClass->editStudent(
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
        $education,
        $grade,
        $year,
        $course,
        $medicalHistory,
        $emergencyContactName,
        $emergencyContactNumber,
        $studentId
    );

    // Check if the student was edited successfully
    if ($success) {
        // Student edited successfully
        // You can return a success message
        echo json_encode(array("success" => true, "message" => "Student updated successfully", "result" => $success));
        exit();
    } else {
        // Failed to edit student
        // You can return an error message
        echo json_encode(array("success" => false, "message" => "Failed to update student"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}
