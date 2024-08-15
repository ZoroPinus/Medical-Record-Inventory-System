<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$UserClass = new UserClass($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get the submitted data
    $user_id = $_POST['user_id'];
    $editFirstName = $_POST['editFirstName'];
    $editLastName = $_POST['editLastName'];
    $editEmail = $_POST['editEmail'];

    // Validate and sanitize the data if needed

    // Update the user information in the database
    $query = $UserClass->editUser($editFirstName, $editLastName, $editEmail, $user_id);

    if ($query) {
        $_SESSION['alert'] = 'success';
        $_SESSION['text'] = 'User updated successfully.';
    } else {
        $_SESSION['alert'] = 'danger';
        $_SESSION['text'] = 'An error occurred while updating the user.';
    }

    // Redirect back to the users.php page
    header('Location: ../../users.php');
    exit;
}
?>
