<?php
header('Content-Type: application/json'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idno = $_POST['idno'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $date = $_POST['date'];
    $course_grade_section = $_POST['course_grade_section'];
    $school_year = $_POST['school_year'];
    $columns = $_POST['columns']; // This is an array
    $doctor = $_POST['physicianName']; // This is an array
    $type = "Dental Health"; // This is an array
    $remarks = "Visit dental health records for more info"; // This is an array

    // Database connection
    $servername = "";
    $username = "root"; // Add your database username
    $password = ""; // Add your database password
    $dbname = "uccs_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO dental_health_records (idno, name, age, sex, date, course_grade_section, school_year, doctor) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("ssisssss", $idno, $name, $age, $sex, $date, $course_grade_section, $school_year, $doctor);

    $insert_query = $conn->prepare("INSERT INTO medicalhistory (studentId, type, doctor, remarks, date) VALUES (?, ?, ?, ?, ?)");
    $insert_query->bind_param("sssss", $idno, $type, $doctor, $remarks, $date);
    if ($stmt->execute()) {
        $record_id = $stmt->insert_id;

        // Insert columns data
        $stmt_columns = $conn->prepare("INSERT INTO dental_health_columns (record_id, column1, column2, column3, column4) VALUES (?, ?, ?, ?, ?)");
        $stmt_columns->bind_param("iiiss", $record_id, $column1, $column2, $column3, $column4);

        for ($i = 0; $i < count($columns); $i += 4) {
            $column1 = $columns[$i];
            $column2 = $columns[$i + 1];
            $column3 = $columns[$i + 2];
            $column4 = $columns[$i + 3];
            $stmt_columns->execute();
        }

        $stmt_columns->close();
        if ($insert_query->execute()) {
            echo json_encode(["status" => "success", "message" => "Record saved successfully."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    $insert_query->close();
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
