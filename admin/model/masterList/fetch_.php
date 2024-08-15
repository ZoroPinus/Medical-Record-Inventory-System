
<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';


$MasterListClass = new MasterListClass($conn);

// Example of using a function to fetch equipment data
$masterlist = $MasterListClass->getAllRecords();

header('Content-Type: application/json');
echo json_encode($masterlist);
?>
