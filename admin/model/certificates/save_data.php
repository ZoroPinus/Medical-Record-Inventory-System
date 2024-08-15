<?php
// Check if the request method is POST
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $idno = $_POST['idno'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $date = date('Y-m-d H:i:s');
    $remarks = $_POST['remarks'];
    $physicianName = $_POST['physicianName'];
    $licNo = $_POST['licNo'];
    $type = "Medical Certificate";

    // Database connection
    $servername = ""; // Provide your server name
    $username = "root"; // Add your database username
    $password = ""; // Add your database password
    $dbname = "uccs_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
    }

    // Prepare and bind statement to insert data
    $stmt = $conn->prepare("INSERT INTO medical_certificates (idno, name, age, address, date, remarks, physician_name, licNo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $idno, $name, $age, $address, $date, $remarks, $physicianName, $licNo);

    $insert_query = $conn->prepare("INSERT INTO medicalhistory (studentId, type, doctor, remarks, date) VALUES (?, ?, ?, ?, ?)");
    $insert_query->bind_param("sssss", $idno, $type, $physicianName, $remarks, $date);

    // Execute the statements
    if ($stmt->execute() && $insert_query->execute()) {
        echo json_encode(["status" => "success", "message" => "Record saved successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }

    // Close statements and connection
    $insert_query->close();
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, send an error message
    echo json_encode(["status" => "error", "message" => "Error: Request method must be POST."]);
}
?>
