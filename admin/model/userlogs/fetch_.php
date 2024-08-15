<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

$UserClass = new UserClass($conn);
$userLogs = $UserClass->fetchUserLogs();

// Create an array to hold the user log data
$userLogsData = array();

// Loop through the fetched user logs and extract relevant data
while ($log = $userLogs->fetch_assoc()) {
    // Example: Format the time if needed
    $formattedTime = date("h:i A", strtotime($log['Time']));

    // Create an array containing user log data
    $logData = array(
        'log_id' => $log['log_id'],
        'user_id' => $log['user_id'],
        'FirstName' => $log['First_Name'],
        'LastName' => $log['Last_Name'],
        'Time' => $formattedTime,
        'DepartmentOffice' => $log['Department_Office'],
        'Reason' => $log['Reason']
    );

    // Add the log data to the array
    $userLogsData[] = $logData;
}

// Return the user log data as JSON
echo json_encode($userLogsData);
?>
