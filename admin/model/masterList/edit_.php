<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MasterListClass = new MasterListClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $id = $_POST['record_id'];
    $noIdNo = $_POST['noIdNo'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $unit = $_POST['unit'];

    // Example of using a function to update a record
    $success = $MasterListClass->updateRecord($id, $noIdNo, $firstname, $lastname, $sex, $course, $year, $unit);

    if ($success) {
        $response = array('success' => true, 'message' => 'Record updated successfully.');
    } else {
        $response = array('success' => false, 'message' => 'An error occurred while updating the record.');
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
