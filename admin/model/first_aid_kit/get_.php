<?php

session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';
// Check if the first aid kit ID is set in the request
if (isset($_GET['first_aid_kit_id'])) {
    // Sanitize the input to prevent SQL injection
    $firstAidKitId = $_GET['first_aid_kit_id'];

    // Create a new instance of the FirstAidKitClass
    $firstAidKitClass = new FirstAidKitClass($conn);

    // Fetch the first aid kit by its ID using the class method
    $firstAidKit = $firstAidKitClass->getFirstAidKitById($firstAidKitId);

    // Check if the first aid kit was found
    if ($firstAidKit) {
        // Return the first aid kit data as JSON response
        echo json_encode($firstAidKit);
    } else {
        // Return a message if the first aid kit was not found
        echo json_encode(['error' => 'First aid kit not found']);
    }
} else {
    // Return a message if the first aid kit ID is not provided in the request
    echo json_encode(['error' => 'First aid kit ID is required']);
}
?>
