<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

$StudentClass = new StudentClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
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
    $education = $_POST['education'];
    $grade = null;
    $year = null;
    $course = null;

    if ($education == 'Elementary' || $education == 'High School' || $education == 'Senior High') {
        $grade = $_POST['grade']; // Set value to the grade
    }
    
    if ($education == 'College') {
        $year = $_POST['year'];
        $course = $_POST['course'];
    }

    $medicalHistory = $_POST['addMedicalHistory'];
    $emergencyContactName = $_POST['addEmergencyContactName'];
    $emergencyContactNumber = $_POST['addEmergencyContactNumber'];

    // Check if the student already exists based on idno, first name, last name, and birthday
    $existingStudent = $StudentClass->getExistingStudent($firstName, $lastName, $contactNumber, $birthday, $idno);
    $existingId = $StudentClass->getExistingId($idno);

    if ($existingId) {
        // Student already exists
        echo json_encode(array("success" => false, "message" => "Student already exists"));
        exit();
    }
    if ($existingStudent) {
        // Student already exists
        echo json_encode(array("success" => false, "message" => "Student already exists"));
        exit();
    }

    // Add the student using the StudentClass method
    $success = $StudentClass->addStudent($idno, $firstName, $middleInitial, $lastName, $suffix, $gender, $brgy_purok, $city_municipal, $province, $contactNumber, $birthday, $education, $grade, $year, $course, $medicalHistory, $emergencyContactName, $emergencyContactNumber);

    // Check if the student was added successfully
    if ($success) {
        // Student added successfully
        // You can redirect or return a success message
        echo json_encode(array("success" => true, "message" => "Student added successfully", "idno"=> $idno));
        exit();
    } else {
        // Failed to add student
        // You can redirect or return an error message
        echo json_encode(array("success" => false, "message" => "Failed to add student"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}

?>
