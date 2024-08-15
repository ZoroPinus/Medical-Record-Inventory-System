
<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$EquipmentClass = new EquipmentClass($conn);

if (isset($_POST['equipment_id'])) {
    $equipment_id = $_POST['equipment_id'];
    $record = $EquipmentClass->getEquipmentById($equipment_id);
    echo json_encode($record);
} else {
    $response = array('success' => false, 'message' => 'Invalid request');
    echo json_encode($response);
}
?>