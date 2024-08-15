<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MedicineClass = new MedicineClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $medicineId = $_POST['medicine_id'];

    // Delete medicine
    $success = $MedicineClass->deleteMedicine($medicineId);

    if ($success) {
        $response = array('success' => true, 'message' => 'Medicine deleted successfully.');
    } else {
        $response = array('success' => false, 'message' => 'An error occurred while deleting the medicine.');
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
