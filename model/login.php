<?php
session_start();
date_default_timezone_set('Asia/Manila'); 
require_once '../includes/config.php';
require_once '../controller/function.php';

$loginObj = new LoginClass($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $response = array();

    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    if (empty($username) || empty($password)) {
        $response["success"] = false;
        $response["message"] = "Username and password are required.";
    } else {
        // Validate and sanitize the username
        $allowedCharactersPattern = '/^[a-zA-Z0-9@!#$%^&*()_+{}\[\]:;<>,.?~\/\\-]+$/';

        if (preg_match($allowedCharactersPattern, $username)) {
            $user = $loginObj->AuthenticateUser($username, $password);

            if ($user !== false) {
                // Update loggedinAt timestamp
                $loggedinAt = date('Y-m-d H:i:s'); // Current timestamp in MySQL datetime format
                $stmt = $conn->prepare("UPDATE user SET loggedinAt = ? WHERE user_id = ?");
                $stmt->bind_param("si", $loggedinAt, $user['user_id']);
                $stmt->execute();
                $stmt->close();

                // Set the user role and ID in the session based on the available ID fields
                if (isset($user['user_id'])) {
                    $_SESSION['first_name'] = $user['firstName'];
                    $_SESSION['last_name'] = $user['lastName'];
                    $_SESSION['user_id'] = $user['user_id'];
                } elseif (isset($user['user_id'])) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['first_name'] = $user['firstName'];
                    $_SESSION['last_name'] = $user['lastName'];
                }
                $_SESSION['role'] = $user['user_type'];
                $_SESSION['profile_picture'] = $user['profile_picture'];
                $_SESSION['username'] = $user['firstName'] . ' ' . $user['lastName'];
                $_SESSION['email'] = $user['email'];

                $response["success"] = true;
                $response["message"] = "Login successful.";
                $response["user"] = $user;
            } else {
                // Check if the email exists in the database
                $userByEmail = $loginObj->GetUserByEmail($username);

                if ($userByEmail !== false) {
                    // Check if the password is incorrect
                    $response["success"] = false;
                    $response["message"] = "Incorrect password.";
                } else {
                    // Email not found
                    $response["success"] = false;
                    $response["message"] = "Email not found.";
                }
            }
        } else {
            // Invalid characters in the username
            $response["success"] = false;
            $response["message"] = "Invalid characters in the username.";
        }
    }

    // Send JSON response back to the client
    header("Content-Type: application/json");
    echo json_encode($response);
}
?>
