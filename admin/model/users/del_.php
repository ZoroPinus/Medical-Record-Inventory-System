<?php
session_start();
include '../../controller/functions.php';
include '../../../includes/config.php';

$UserClass = new UserClass($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get the user ID to delete
    $user_id = $_POST['user_id'];

    // Perform the deletion
    $query = $UserClass->deleteUser($user_id);

    if ($query) {
        $_SESSION['alert'] = 'success';
        $_SESSION['text'] = 'User deleted successfully.';
    } else {
        $_SESSION['alert'] = 'danger';
        $_SESSION['text'] = 'An error occurred while deleting the user.';
    }

    // Redirect back to the users.php page
    header('Location: ../../users.php');
    exit;
}
?>
