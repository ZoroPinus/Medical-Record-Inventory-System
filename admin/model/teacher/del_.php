<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php'; // Assuming this file contains your TeacherClass definition
include '../../../includes/config.php'; // Assuming this file contains your database connection

// Instantiate TeacherClass with the database connection
$TeacherClass = new TeacherClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve teacher ID from the request
    $teacherId = $_POST['teacherId'];

    // Delete the teacher using the TeacherClass method
    $success = $TeacherClass->deleteTeacher($teacherId);

    // Check if the teacher was deleted successfully
    if ($success) {
        // Teacher deleted successfully
        // You can return a success message
        echo json_encode(array("success" => true, "message" => "Teacher deleted successfully"));
        exit();
    } else {
        // Failed to delete teacher
        // You can return an error message
        echo json_encode(array("success" => false, "message" => "Failed to delete teacher"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}
?>
