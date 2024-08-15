<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the POST request
    $date = $_POST['date'];
    $id_number = $_POST['idno'];
    $name = $_POST['name'];
    $course_year_grade = $_POST['courseYearGrade'];
    $incidence = $_POST['incidence'];
    $prepared_by = $_POST['nurseName'];

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
    $sql = "INSERT INTO incidental_reports (date, id_number, name, course_year_grade, incidence, prepared_by) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param('sissss', $date, $id_number, $name, $course_year_grade, $incidence, $prepared_by);

    $stmt->execute();

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
