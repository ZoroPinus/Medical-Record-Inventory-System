<?php
// Include necessary files and initialize your database connection
require_once '../../controller/functions.php';
require_once '../../../includes/config.php';

// Assuming you have already established a database connection
$physicalExamHandler = new PhysicalExamHandler($conn);

// Fetch physical examination records
$records = $physicalExamHandler->getPhysicalExamRecords();

// Return the records as JSON
header('Content-Type: application/json');
echo json_encode($records);
exit();