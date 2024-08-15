<?php
session_start();

// Include database connection and user class
include '../../controller/functions.php';
include '../../../includes/config.php';

// Initialize UserClass object
$userClass = new UserClass($conn);

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch user profile by user ID
    $userData = $userClass->getUserById($userId);

    if($userData) {
        // Return user data as JSON response
        header('Content-Type: application/json');
        echo json_encode($userData);
    } else {
        // User not found
        $response = array('success' => false, 'message' => 'User not found.');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // User is not logged in
    $response = array('success' => false, 'message' => 'User not logged in.');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
