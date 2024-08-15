
<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$EquipmentClass = new EquipmentClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate incoming data
    $equipment_id = $_POST['equipment_id'];

    // Example of using a function to delete a record
    $success = $EquipmentClass->deleteEquipment($equipment_id);

    if ($success) {
        $response = array('success' => true, 'message' => 'Equipment deleted successfully.');
    } else {
        $response = array('success' => false, 'message' => 'An error occurred while deleting the record.');
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