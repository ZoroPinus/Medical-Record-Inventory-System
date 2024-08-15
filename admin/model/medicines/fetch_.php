<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$MedicineClass = new MedicineClass($conn);

// Fetch medicine data
$medicines = $MedicineClass->getAllMedicines();

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($medicines);
?>
