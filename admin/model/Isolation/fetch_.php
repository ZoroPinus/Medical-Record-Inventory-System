
<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$EquipmentClass = new IsolationClass($conn);

// Example of using a function to fetch equipment data
$equipmentList = $EquipmentClass->getAllEquipment();

header('Content-Type: application/json');
echo json_encode($equipmentList);
?>
