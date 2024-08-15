<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$EquipmentClass = new IsolationClass($conn);

    // Validate incoming data
    $equipmentId = $_GET['equipment_id'];
    
    // Example of using a function to get equipment details
    $equipmentDetails = $EquipmentClass->getEquipmentById($equipmentId);

    if ($equipmentDetails) {
        header('Content-Type: application/json');
        echo json_encode($equipmentDetails);
    } else {
        // Equipment not found
        $response = array('success' => false, 'message' => 'Equipment not found.');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>
