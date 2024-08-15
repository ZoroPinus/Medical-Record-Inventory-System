<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Physical Examination Certificate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .certificate {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 20px;
            display: inline-block;
            vertical-align: middle;
        }

        .heading-info {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px; /* Adjust spacing between logo and text */
        }

        .heading-info h2,
        .heading-info p {
            margin: 0;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="certificate">
            <div class="text-center mb-4">
                <div class="row">
                    <div class="col-12">
                        <div class="logo">
                            <img src="../assets/img/avatars/school-logo.png" alt="Logo" class="img-fluid">
                        </div>
                        <div class="heading-info">
                            <h2>Union Christian College</h2>
                            <p>City of San Fernando, Province of La Union</p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // Include necessary files and initialize your database connection
            require_once '../../controller/functions.php';
            require_once '../../../includes/config.php';

            // Assuming you have already established a database connection
            $physicalExamHandler = new PhysicalExamHandler($conn);

            // Get the record ID from the AJAX request
            $recordId = $_POST['record_id'];

            // Fetch the physical examination details for the selected record
            $physicalExamDetails = $physicalExamHandler->getPhysicalExamDetails($recordId);

            // Check if the details were fetched successfully
            if ($physicalExamDetails) {
                // Display the physical examination details
                echo '<div class="row">';
                
                // Display student details
                echo '<div class="col-md-6">';
                echo '<h4>Student Details</h4>';
                echo '<table class="table table-bordered">';
                echo '<tr><th>Student Name:</th><td>' . $physicalExamDetails['student_name'] . '</td></tr>';
                echo '<tr><th>Gender:</th><td>' . $physicalExamDetails['gender'] . '</td></tr>';
                echo '<tr><th>Address:</th><td>' . ucwords(strtolower($physicalExamDetails['address_street'])) . ', ' . ucwords(strtolower($physicalExamDetails['address_city'])) . ', ' . ucwords(strtolower($physicalExamDetails['address_state'])) . '</td></tr>';
                echo '<tr><th>Contact Number:</th><td>' . $physicalExamDetails['contact_number'] . '</td></tr>';
                echo '<tr><th>Education:</th><td>' . $physicalExamDetails['education'] . '</td></tr>';

                if ($physicalExamDetails['education'] === 'elementary' || $physicalExamDetails['education'] === 'high_school' || $physicalExamDetails['education'] === 'senior_high') {
                    echo '<tr><th>Grade:</th><td>' . $physicalExamDetails['grade'] . '</td></tr>';
                } elseif ($physicalExamDetails['education'] === 'college') {
                    echo '<tr><th>Year:</th><td>' . $physicalExamDetails['year'] . '</td></tr>';
                    echo '<tr><th>Course:</th><td>' . $physicalExamDetails['course'] . '</td></tr>';
                }
                echo '<tr><th>Date:</th><td>' . $physicalExamDetails['created_at'] . '</td></tr>';
                echo '</table>';
                echo '</div>';
                
                // Display physical examination details
                echo '<div class="col-md-6">';
                echo '<h4>Physical Examination</h4>';
                echo '<table class="table table-bordered">';
                echo '<thead class="thead-light"><tr><th>Body Part</th><th>Normal</th><th>Abnormal</th><th>Comments</th></tr></thead>';
                echo '<tbody>';
                foreach ($physicalExamDetails['body_parts'] as $bodyPart) {
                    echo '<tr>';
                    echo '<td>' . $bodyPart['body_part'] . '</td>';
                    echo '<td class="text-center">' . ($bodyPart['normal'] ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>') . '</td>';
                    echo '<td class="text-center">' . ($bodyPart['abnormal'] ? '<i class="fa fa-check text-danger"></i>' : '<i class="fa fa-times text-success"></i>') . '</td>';
                    echo '<td>' . $bodyPart['comments'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';

                // Display remarks
                echo '<div class="col-md-6">';
                echo '<h4>Remarks</h4>';
                echo '<p>' . $physicalExamDetails['remarks'] . '</p>';
                echo '</div>';
                
                echo '</div>'; // .row
            } else {
                echo 'Failed to fetch physical examination details.';
            }
            ?>
        </div>
    </div>
</body>
</html>
