<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$EquipmentClass = new IsolationClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $equipmentId = $_POST['editEquipmentId'];
    $equipmentName = $_POST['editEquipmentName'];
    $remark = $_POST['editRemark'];
    $status = $_POST['editStatus'];
    
    // Example of using a function to edit equipment
    $success = $EquipmentClass->updateEquipment($equipmentId, $equipmentName, $remark, $status);

    if ($success) {
        $response = array('success' => true, 'message' => 'Equipment updated successfully.');
    } else {
        $response = array('success' => false, 'message' => 'An error occurred while updating the equipment.');
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
