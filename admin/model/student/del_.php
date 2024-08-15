<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

// Assuming you have a StudentClass with a method to delete a student
$StudentClass = new StudentClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve student ID from the request
    $studentId = $_POST['studentId'];

    // Delete the student using the StudentClass method
    $success = $StudentClass->deleteStudent($studentId);

    // Check if the student was deleted successfully
    if ($success) {
        // Student deleted successfully
        // You can return a success message
        echo json_encode(array("success" => true, "message" => "Student deleted successfully"));
        exit();
    } else {
        // Failed to delete student
        // You can return an error message
        echo json_encode(array("success" => false, "message" => "Failed to delete student"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}
?>
