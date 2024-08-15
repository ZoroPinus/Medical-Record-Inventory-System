<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

$UserClass = new UserClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_POST['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $time = $_POST['time'];
    $departmentOffice = $_POST['departmentOffice'];
    $reason = $_POST['reason'];

    // Add the user log using the UserClass method
    $success = $UserClass->addUserLog($userId, $firstName, $lastName, $time, $departmentOffice, $reason);

    // Check if the user log was added successfully
    if ($success) {
        // User log added successfully
        echo json_encode(array("success" => true, "message" => "User log added successfully"));
        exit();
    } else {
        // Failed to add user log
        echo json_encode(array("success" => false, "message" => "Failed to add user log"));
        exit();
    }
} else {
    // If the form is not submitted via POST method, return an error
    echo json_encode(array("success" => false, "message" => "Form submission method not allowed"));
    exit();
}
?>
