<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php'; // Assuming this file contains your TeacherClass definition
include '../../../includes/config.php'; // Assuming this file contains your database connection

// Set the response header to JSON
header('Content-Type: application/json');

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data// Retrieve form data
    $idno = $_POST['idno'];
    $firstName = $_POST['firstName'];
    $middleInitial = $_POST['middleInitial'];
    $lastName = $_POST['lastName'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $province = $_POST['province'];
    $city_municipal = $_POST['municipality'];
    $brgy_purok = $_POST['barangay'];
    $contactNumber = $_POST['contactNumber'];
    $department = $_POST['department'];

    $medicalHistory = $_POST['medicalHistory'];
    $emergencyContactName = $_POST['emergencyContactName'];
    $emergencyContactNumber = $_POST['emergencyContactNumber'];


    // Instantiate TeacherClass with the database connection
    $TeacherClass = new TeacherClass($conn);

    $existingTeacher = $TeacherClass -> getTeacherById($idno);

    if ($existingTeacher) {
        // Student already exists
        echo json_encode(array("success" => false, "message" => "Employee already exists"));
        exit();
    }

    // Add the teacher using the TeacherClass method
    // Check if department is "others" and handle it
    if ($department === 'others') {
        // Retrieve the specific department entered by the user
        $specificDepartment = $_POST['otherDepartmentInput'];

        // Add the teacher using the TeacherClass method with the specific department
        $success = $TeacherClass->createTeacher($idno, $firstName, $middleInitial, $lastName, $suffix, $gender, $brgy_purok, $city_municipal, $province, $contactNumber, $birthday, $specificDepartment, $medicalHistory, $emergencyContactName, $emergencyContactNumber);
    } else {
        // Add the teacher using the TeacherClass method with the selected department
        $success = $TeacherClass->createTeacher($idno, $firstName, $middleInitial, $lastName, $suffix, $gender, $brgy_purok, $city_municipal, $province, $contactNumber, $birthday, $department, $medicalHistory, $emergencyContactName, $emergencyContactNumber);
    }


    // Check if the teacher was added successfully
    if ($success) {
        // Teacher added successfully
        // Return a success message
        echo json_encode(array("success" => true, "message" => "Employee added successfully"));
        exit();
    } else {
        // Failed to add teacher
        // Return an error message
        echo json_encode(array("success" => false, "message" => "Failed to add teacher"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}
