<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php'; // Assuming this file contains your TeacherClass definition
include '../../../includes/config.php'; // Assuming this file contains your database connection

// Instantiate TeacherClass with the database connection
$TeacherClass = new TeacherClass($conn);

// Check if the teacher ID is provided via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['teacherId'])) {
    // Retrieve the teacher ID
    $teacherId = $_POST['teacherId'];

    // Fetch teacher details by ID
    $teacher = $TeacherClass->getTeacherById($teacherId);

    // Check if the teacher exists
    if ($teacher) {
        // Return teacher details as JSON response
        echo json_encode($teacher);
        exit();
    } else {
        // Teacher not found, return error message
        echo json_encode(array("error" => "Teacher not found"));
        exit();
    }
} else {
    // If the teacher ID is not provided via POST method, return an error
    echo json_encode(array("error" => "Invalid request"));
    exit();
}
?>
