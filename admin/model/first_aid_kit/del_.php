<?php

session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new instance of the FirstAidKitClass
    $firstAidKitClass = new FirstAidKitClass($conn);

    // Validate and sanitize input data
    $firstAidKitId = $_POST["first_aid_kit_id"];

    // Delete the first aid kit using the class method
    $result = $firstAidKitClass->deleteFirstAidKit($firstAidKitId);

    // Check if the operation was successful
    if ($result) {
        // Return success message
        $response = array("success" => true, "message" => "First aid kit deleted successfully");
        echo json_encode($response);
    } else {
        // Return error message
        $response = array("success" => false, "message" => "Failed to delete first aid kit");
        echo json_encode($response);
    }
}
?>
