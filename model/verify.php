<?php
session_start();
require_once '../includes/config.php';
require_once '../controller/function.php';

$verifyObj = new VerifyClass($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $response = array();

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $verificationCode = isset($_POST["verification_code"]) ? $_POST["verification_code"] : "";
    $user_type = isset($_POST["user_type"]) ? $_POST["user_type"] : "";

    if (empty($email) || empty($verificationCode)) {
        $response["success"] = false;
        $response["message"] = "Email and verification code are required.";
    } else {
        // Check if the email exists before attempting verification
        if ($verifyObj->getUserByEmail($email)) {
            // Verify the provided code for the given email
            if ($verifyObj->verifyCode($email, $verificationCode)) {
                $verifyObj->verifyEmailStatus($email);

                $_SESSION['role'] = $user_type; // Store user_type in session

                $response["success"] = true;
                $response["message"] = "Account verification successful.";
                $response["user_type"] = $user_type;
            } else {
                $response["success"] = false;
                $response["message"] = "Invalid verification code.";
            }
        } else {
            // Email not found
            $response["success"] = false;
            $response["message"] = "Invalid email. Please register again.";
        }
    }

    // Send JSON response back to the client
    header("Content-Type: application/json");
    echo json_encode($response);
}
?>
