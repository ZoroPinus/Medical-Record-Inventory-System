<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';
$userClass = new UserClass($conn);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, return an error response
    $response = array('success' => false, 'message' => 'User not logged in');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit(); // Terminate the script
}

// Validate incoming data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the POST request
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $email = $_POST['editEmail'];
    $oldPassword = $_POST['editOldPassword'];
    $newPassword = $_POST['editNewPassword'];

    // Get the user's ID and current password from the database
    $userId = $_SESSION['user_id'];
    $currentPassword = $userClass->getUserPassword($userId);

    // Check if the old password matches the current password
    if (!password_verify($oldPassword, $currentPassword)) {
        $response = array('success' => false, 'message' => 'Invalid old password');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Terminate the script
    }

    // Check if the new password meets the required length
    if (strlen($newPassword) < 8) {
        // Password does not meet the required length, return an error response
        $response = array('success' => false, 'message' => 'New password must be at least 8 characters long');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit(); // Terminate the script
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    // Handle file upload
    $uploadedFile = $_FILES['editProfilePicture'];
    $profilePicture = null;

    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDirectory = '../uploads/'; // Specify the directory where you want to save the uploaded files
        $uploadedFileName = uniqid() . '_' . basename($uploadedFile['name']); // Generate a unique filename
        $uploadedFilePath = $uploadDirectory . $uploadedFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadedFilePath)) {
            // File uploaded successfully, store the file path
            $profilePicture = $uploadedFileName; // Store only the filename in the database
        } else {
            // Error uploading file
            $response = array('success' => false, 'message' => 'Error uploading profile picture');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } elseif ($uploadedFile['error'] !== UPLOAD_ERR_NO_FILE) {
        // Error uploading file
        $response = array('success' => false, 'message' => 'Error uploading profile picture');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Example of using a function to update the user's profile
    $success = $userClass->editUser($firstName, $lastName, $email, $hashedPassword, $userId, $profilePicture);
    if ($success) {
        $response = array('success' => true, 'message' => 'Profile updated successfully.');
    } else {
        $response = array('success' => false, 'message' => 'Failed to update profile.');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>