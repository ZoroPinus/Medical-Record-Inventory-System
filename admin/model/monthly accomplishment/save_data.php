<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the POST request
    $nurse_name = $_POST['nurseName'];
    $doctor_name = $_POST['doctorName'];
    $reportData = $_POST['reportData'];

    // Database connection parameters
    $servername = ""; // Add your server name
    $username = "root"; // Add your database username
    $password = ""; // Add your database password
    $dbname = "uccs_db"; // Add your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO monthly_accomplishments (activities, timeSchedule, intervention, nurse_name, doctor_name) VALUES (?, ?, ?, ?, ?)";

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);

    // Loop through each report data
    foreach ($reportData as $rowData) {
        $activities = $rowData['activities'];
        $timeSchedule = $rowData['timeSchedule'];
        $intervention = $rowData['intervention'];

        // Bind parameters and execute the statement
        $stmt->bind_param('sssss', $activities, $timeSchedule, $intervention, $nurse_name, $doctor_name);
        $stmt->execute();
    }

    // Check if any error occurred during execution
    if ($stmt->error) {
        // Return error response
        $response = array(
            'status' => 'error',
            'message' => 'Error saving data to the database.'
        );
        echo json_encode($response);
    } else {
        // Return success response
        $response = array(
            'status' => 'success',
            'message' => 'Data saved successfully.'
        );
        echo json_encode($response);
    }

    $stmt->close();
    $conn->close();
} else {
    // Return error response for invalid request method
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method.'
    );
    echo json_encode($response);
}
?>
