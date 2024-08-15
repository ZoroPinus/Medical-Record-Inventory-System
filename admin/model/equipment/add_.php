<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$EquipmentClass = new EquipmentClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $equipmentName = $_POST['equipmentName'];
    $remark = $_POST['remark'];
    $status = $_POST['status'];
    
    // Example of using a function to add equipment
    $success = $EquipmentClass->createEquipment($equipmentName, $remark, $status);

    if ($success) {
        $response = array('success' => true, 'message' => 'Equipment added successfully.');
    } else {
        $response = array('success' => false, 'message' => 'An error occurred while adding the equipment.');
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
