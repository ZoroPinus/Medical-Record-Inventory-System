<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MedicineClass = new MedicineClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $medicineName = $_POST['medicineName'];
    $dosage = $_POST['dosage'];
    $quantity = $_POST['quantity'];
    $expirationDate = $_POST['expirationDate'];

    // Check if medicine name already exists
    $existingMedicine = $MedicineClass->getMedicineDetails($medicineName);
    if ($existingMedicine) {
        // Medicine name already exists, throw an error message
        $response = array('success' => false, 'message' => 'Medicine name already exists.');
    } else {
        // Add medicine
        $success = $MedicineClass->addMedicine($medicineName, $dosage, $quantity, $expirationDate);

        if ($success) {
            $response = array('success' => true, 'message' => 'Medicine added successfully.');
        } else {
            $response = array('success' => false, 'message' => 'An error occurred while adding the medicine.');
        }
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
