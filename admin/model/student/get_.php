<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

$StudentClass = new StudentClass($conn);

// Check if the student ID is provided via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['studentId'])) {
    // Retrieve the student ID
    $studentId = $_POST['studentId'];

    // Fetch student details by ID
    $student = $StudentClass->getStudentById($studentId);

    
    // Check if the student exists
    if ($student) {
        // Return student details as JSON response
        echo json_encode(array("success" => true, "data" => $student));
        exit();
    } else {
        // Student not found, return error message
        echo json_encode(array("error" => "Student not found"));
        exit();
    }
} else {
    // If the student ID is not provided via POST method, return an error
    echo json_encode(array("error" => "Invalid request"));
    exit();
}
?>
