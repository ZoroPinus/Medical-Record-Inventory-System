<?php
require '../includes/config.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get first name, last name, email, and password from the POST request
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email already exists in the database
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists, handle accordingly (maybe show an error message)
    echo json_encode(['status' => 'error', 'message' => 'Email already exists.']);
} else {
    // Generate OTP
    $otp = generateOTP();

    // Send verification email
    // sendVerificationEmail($email, $firstName, $otp);

    // Insert the user data
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO user (email, password, firstName, lastName, user_type, otp, profile_picture) VALUES (?, ?, ?, ?, 'admin', ?, '6618c4857b1a4_4.PNG')");
    $stmt->bind_param("ssssi", $email, $hashedPassword, $firstName, $lastName, $otp);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo json_encode(['status' => 'success', 'message' => 'Registration Successful', 'user_type' => 'admin']);
}

// Function to generate OTP
function generateOTP() {
    return rand(100000, 999999); // Generate a 6-digit OTP
}

// Function to send verification email
function sendVerificationEmail($email, $first_name, $code) {
    // Instantiate PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Set SMTP parameters
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'b2bdrivingschoolverify@gmail.com'; // Replace with your email
        $mail->Password = 'adqegamglvhwfypo'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Define email body
        $mail->setFrom('noreply@yourwebsite.com', 'Atad Patrol System'); // Replace with your email and name
        $mail->addAddress($email, $first_name);
        $mail->isHTML(true);

        $mail->Subject = 'Email Verification';
        $mail->Body    = 'Your email verification is: ' . $code;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
