<?php
class LoginClass {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticateUser($usernameOrEmail, $password) {
        $user = $this->authenticateUserInTable('user', $usernameOrEmail, $password);

        if ($user) {
            return $user;
        }

        // Add additional tables or conditions as needed for user authentication

        return false;
    }

    private function authenticateUserInTable($table, $usernameOrEmail, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE email = ? ");
        $stmt->bind_param("s", $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION["role"] = $row["user_type"];
                $_SESSION[$table . '_id'] = $row[$table . '_id'];
                return $row;
            }
        }

        return false;
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result && $result->num_rows > 0;
    }
}


class VerifyClass {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function verifyEmailStatus($email) {
        $stmt = $this->conn->prepare("UPDATE user SET otp = 'Verified' WHERE email = ?");
        $stmt->bind_param("s", $email);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
    function verifyCode($email, $verificationCode) {
            $stmt = $this->conn->prepare("SELECT otp FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $storedCode = $row['otp'];

                // Check if the provided code matches the stored code
                if ($verificationCode === $storedCode) {
                    return true;
                }
            }

            return false;
        }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result && $result->num_rows > 0;
    }
}