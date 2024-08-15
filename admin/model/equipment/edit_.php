<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

// Initialize EquipmentClass
$EquipmentClass = new EquipmentClass($conn);

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set
    if (isset($_POST['editEquipmentId'], $_POST['editEquipmentName'], $_POST['editStatus'])) {
        // Sanitize and validate incoming data
        $equipmentId = $_POST['editEquipmentId'];
        $equipmentName = trim($_POST['editEquipmentName']);
        $remark = isset($_POST['editRemark']) ? trim($_POST['editRemark']) : '';
        $status = $_POST['editStatus'];

        // Update the equipment record
        $success = $EquipmentClass->updateEquipment($equipmentId, $equipmentName, $remark, $status);

        if ($success) {
            $response = array('success' => true, 'message' => 'Equipment updated successfully.');
        } else {
            $response = array('success' => false, 'message' => 'An error occurred while updating the record.');
        }
    } else {
        // Required fields are missing
        $response = array('success' => false, 'message' => 'Required fields are missing.');
    }
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
}

// Set response header and encode response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
