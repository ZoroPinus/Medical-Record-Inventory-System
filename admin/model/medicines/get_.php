<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MedicineClass = new MedicineClass($conn);

    $medicineId = $_GET['medicine_id'];

    // Fetch medicine details
    $medicineDetails = $MedicineClass->getMedicineDetails($medicineId);

    if ($medicineDetails) {
        // Return medicine details as JSON response
        header('Content-Type: application/json');
        echo json_encode($medicineDetails);
    } else {
        // Medicine not found
        $response = array('success' => false, 'message' => 'Medicine not found');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

?>
