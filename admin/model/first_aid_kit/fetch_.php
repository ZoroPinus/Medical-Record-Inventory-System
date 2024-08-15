<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';
// Create a new instance of the FirstAidKitClass
$firstAidKitClass = new FirstAidKitClass($conn);

// Fetch all first aid kits using the class method
$firstAidKits = $firstAidKitClass->getAllFirstAidKits();

// Check if there are any first aid kits retrieved
if (!empty($firstAidKits)) {
    // Return the first aid kits data as JSON response
    echo json_encode($firstAidKits);
} else {
    // Return an empty array if no first aid kits found
    echo json_encode([]);
}
?>
