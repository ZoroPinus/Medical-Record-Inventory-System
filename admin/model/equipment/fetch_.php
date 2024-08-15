
<?php
include '../../controller/functions.php';
include '../../../includes/config.php';

$EquipmentClass = new EquipmentClass($conn);
$records = $EquipmentClass->getAllEquipment();

echo json_encode($records);
?>