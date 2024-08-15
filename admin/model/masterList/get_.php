<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MasterListClass = new MasterListClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Validate incoming data
    $recordId = $_GET['record_id'];
    
    // Example of using a function to get masterlist details by ID
    $recordDetails = $MasterListClass->getRecordById($recordId);

    if ($recordDetails) {
        header('Content-Type: application/json');
        echo json_encode($recordDetails);
    } else {
        // Record not found
        $response = array('success' => false, 'message' => 'Record not found.');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
