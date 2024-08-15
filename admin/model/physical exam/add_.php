<?php
// Include necessary files and initialize your database connection
require_once '../../controller/functions.php'; // Using require_once for essential files
require_once '../../../includes/config.php';

// Assuming you have already established a database connection
$physicalExamHandler = new PhysicalExamHandler($conn);
$studentHandler = new StudentClass($conn);

// Collect data from the POST request
$idno = $_POST['idno'];
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$date = $_POST['date'];
$course_grade_section = $_POST['course_grade_section'];
$school_year = $_POST['school_year'];
$blood_pressure = $_POST['blood_pressure'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$remarks = $_POST['remarks'];
$physicianName = $_POST['physicianName'];


// Attempt to insert physical examination data
try {
    // Get student data
    $studentData = $studentHandler->getStudentById($idno);
    if (!$studentData) {
        throw new Exception("Student not found.");
    }
    $studentID = $studentData['StudentID'];

    // Insert general physical examination data
    $physicalExamID = $physicalExamHandler->insertPhysicalExam($studentID, $blood_pressure, $height, $weight, $remarks, $physicianName);
    $medicalHistory = $studentHandler->insertMedicalHistory($idno, 'Physical Exam', $physicianName, $remarks, $date);
    // Define body parts
    $body_parts = ['eyes', 'ears', 'nose', 'throat', 'heart', 'lungs', 'abdomen', 'kidneys', 'locomotor', 'nervous', 'skin'];

    // Insert body part examination data
    foreach ($body_parts as $body_part) {
        $normal = isset($_POST[$body_part . '_normal']) ? 1 : 0;
        $abnormal = isset($_POST[$body_part . '_abnormal']) ? 1 : 0;
        $comments = $_POST[$body_part . '_comments'] ?? ''; // Default to empty string if no comments provided

        // Insert the body part exam using the physical exam ID
        $success_body_part_exam = $physicalExamHandler->insertBodyPartExam($physicalExamID, $body_part, $normal, $abnormal, $comments);
        if (!$success_body_part_exam) {
            throw new Exception("Failed to insert body part exam data for {$body_part}.");
        }
    }
    if ($medicalHistory) {
        // Return success response if everything was inserted successfully
        echo json_encode(array("success" => true, "message" => "Physical Examination added successfully"));
    }
    exit();
} catch (Exception $e) {
    // Return error response if an exception occurs
    echo json_encode(array("success" => false, "message" => "An error occurred: " . $e->getMessage()));
    exit();
}
