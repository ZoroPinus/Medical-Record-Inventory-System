<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php'; // Assuming this file contains your TeacherClass definition
include '../../../includes/config.php'; // Assuming this file contains your database connection

// Instantiate TeacherClass with the database connection
$TeacherClass = new TeacherClass($conn);

// Fetch teachers data
$teachers = $TeacherClass->getAllTeachers();

// Create an array to hold the teacher data
$teachersData = array();

// Get the current date
$currentDate = new DateTime();

// Loop through the fetched teachers and extract relevant data
while ($teacher = $teachers->fetch_assoc()) {
    // Calculate age based on birthday
    $birthday = new DateTime($teacher['Birthday']);
    $age = $currentDate->diff($birthday)->y;

    // Create an array containing teacher data
    $teacherData = array(
        'idno' => $teacher['idno'],
        'FirstName' => $teacher['FirstName'],
        'LastName' => $teacher['LastName'],
        'MiddleInitial' => $teacher['MiddleInitial'],
        'Gender' => $teacher['Gender'],
        'Department' => $teacher['Department'],
        'Address' => ucwords(strtolower($teacher['Address_Street'])) . ', ' . ucwords(strtolower($teacher['Address_City'])) . ', ' . ucwords(strtolower($teacher['Address_State'])),
        'Birthday' => $birthday->format('F j, Y'), 
        'Age' => $age, // Add calculated age to the data
        'ContactNumber' => $teacher['ContactNumber'],
        'Department' => $teacher['Department'],
        'MedicalHistory' => $teacher['MedicalHistory'],
        'EmergencyContactName' => $teacher['EmergencyContactName'],
        'EmergencyContactNumber' => $teacher['EmergencyContactNumber']
        // Add more fields as needed
    );

    // Add the teacher data to the array
    $teachersData[] = $teacherData;
}

// Return the teacher data as JSON
echo json_encode($teachersData);
?>
