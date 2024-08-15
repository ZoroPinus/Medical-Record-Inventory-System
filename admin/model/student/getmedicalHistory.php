<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

// Assuming you have a StudentClass with a method to fetch students
$StudentClass = new StudentClass($conn);

$studentId = $_GET['studentId'];
$medicalHistory = $StudentClass->fetchMedicalHistory($studentId);

// Create an array to hold the student data
$medicalHistoryData = array();

// Get the current date
$currentDate = new DateTime();

// Loop through the fetched students and extract relevant data
while ($list = $medicalHistory->fetch_assoc()) {
    // Convert the date string to a DateTime object
    $date = new DateTime($list['date']);

    // Create an array containing student data
    $listData = array(
        'studentId' => $list['studentId'],
        'type' => $list['type'],
        'doctor' => $list['doctor'],
        'remarks' => $list['remarks'],
        'date' => $date->format('F j, Y')
        // Add more fields as needed
    );

    // Add the student data to the array
    $medicalHistoryData[] = $listData;
}

// Return the student data as JSON
echo json_encode($medicalHistoryData);
?>
