<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MasterListClass = new MasterListClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $record_id = $_POST['record_id'];
    
    // Example of using a function to delete equipment
    $success = $MasterListClass->deleteRecord($record_id);

    if ($success) {
        $response = array('success' => true, 'message' => 'Student deleted successfully.');
    } else {
        $response = array('success' => false, 'message' => 'An error occurred while deleting the student.');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
