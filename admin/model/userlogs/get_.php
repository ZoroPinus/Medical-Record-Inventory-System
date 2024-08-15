<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

$UserClass = new UserClass($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];

    // Fetch user logs by ID
    $userLog = $UserClass->getUserLogById($userId);

    if ($userLog) {
        // User log found
        echo json_encode(array("success" => true, "data" => $userLog));
    } else {
        // User log not found
        echo json_encode(array("success" => false, "message" => "User log not found"));
    }
} else {
    // If the request is not POST, return an error
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
