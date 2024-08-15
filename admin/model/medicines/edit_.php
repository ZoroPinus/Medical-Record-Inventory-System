<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MedicineClass = new MedicineClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $medicineId = $_POST['editMedicineId'];
    $medicineName = $_POST['editMedicineName'];
    $dosage = $_POST['editDosage'];
    $quantity = $_POST['editQuantity'];
    $expirationDate = $_POST['editExpirationDate'];

    // Edit medicine
    $success = $MedicineClass->editMedicine($medicineId, $medicineName, $dosage, $quantity, $expirationDate);
    
    if ($success) {
        $response = array('success' => true, 'message' => 'Medicine updated successfully.');
    } else {
        $response = array('success' => false, 'message' => 'An error occurred while updating the medicine.');
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
