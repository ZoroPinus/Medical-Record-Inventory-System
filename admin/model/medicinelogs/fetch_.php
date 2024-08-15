<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

$MedicineClass = new MedicineClass($conn);

// Fetch medicine logs
$medicineLogs = $MedicineClass->getAllMedicineLogs();

// Create an array to hold the medicine log data
$medicineLogsData = array();

// Loop through the fetched medicine logs and extract relevant data
foreach ($medicineLogs as $log) {
    // Create an array containing medicine log data
    $formattedTime = date("h:i A F j, Y", strtotime($log['timeLogged']));
    $logData = array(
        'medicine_name' => $log['medicine_name'],
        'recipient_name' => $log['recipient_name'],
        'quantity' => $log['quantity'],
        'dosage' => $log['dosage'],
        'time' => $formattedTime,
        'reason' => $log['reason'],
    );

    // Add the log data to the array
    $medicineLogsData[] = $logData;
}

// Return the medicine log data as JSON
echo json_encode($medicineLogsData);
?>
