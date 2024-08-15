<?php
// Include necessary files and initialize your database connection
include '../../controller/functions.php';
include '../../../includes/config.php';

// Assuming you have a StudentClass with a method to fetch students
$StudentClass = new StudentClass($conn);
$students = $StudentClass->fetchStudents();

// Create an array to hold the student data
$studentsData = array();

// Get the current date
$currentDate = new DateTime();

// Loop through the fetched students and extract relevant data
while ($student = $students->fetch_assoc()) {
    // Calculate age based on birthday
    $birthday = new DateTime($student['Birthday']);
    $age = $currentDate->diff($birthday)->y;

    // Adjust age if birthday hasn't occurred yet this year
    // if ($currentDate->format('md') < $birthday->format('md')) {
    //     $age--;
    // }

    // Format the address
    $address = ucwords(strtolower($student['Address_Street'])) . ', ' . ucwords(strtolower($student['Address_City'])) . ', ' . ucwords(strtolower($student['Address_State']));

    // Create an array containing student data
    $studentData = array(
        'idno' => $student['idno'],
        'StudentID' => $student['StudentID'],
        'FirstName' => $student['FirstName'],
        'LastName' => $student['LastName'],
        'MiddleInitial' => $student['MiddleInitial'],
        'Gender' => $student['Gender'],
        'Address' => $address,
        'Birthday' => $birthday->format('F j, Y'),
        'Age' => $age, // Add calculated age to the data
        'ContactNumber' => $student['ContactNumber'],
        'Education' => $student['Education'],
        'MedicalHistory' => $student['MedicalHistory'],
        'EmergencyContactName' => $student['EmergencyContactName'],
        'EmergencyContactNumber' => $student['EmergencyContactNumber']
        // Add more fields as needed
    );

    // Add the student data to the array
    $studentsData[] = $studentData;
}

// Return the student data as JSON
echo json_encode($studentsData);
?>
