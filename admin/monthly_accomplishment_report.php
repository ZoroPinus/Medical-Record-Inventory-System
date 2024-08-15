<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <div class="col-md-12">
                    <?php include 'includes/session.php'; ?>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="physical" role="tabpanel" aria-labelledby="physical-tab">
                            <div class="card-box pb-10">
                                <div class="h5 pd-20 mb-0">Monthly Accomplishment Report</div>
                                <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addCovid19Report" type="button">
                                    <i class="fa fa-plus"></i> Add Report
                                </button>
                                <div class="table-responsive">
                                    <table id="CovidTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>Doctors Name</th>
                                                <th>Prepared By</th>
                                                <th>Date</th>
                                                <th>Copy</th> <!-- New column for View button -->
                                            </tr>
                                        </thead>
                                        <!-- Physical Examination Table Body Will Be Filled Dynamically -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'modal/monthly accomplishment/add_.php'; ?>
    <script>
        $(document).ready(function() {
            fetchCovidReportRecords();

            function fetchCovidReportRecords() {
                if ($.fn.DataTable.isDataTable('#CovidTable')) {
                    $('#CovidTable').DataTable().destroy();
                }

                $.ajax({
                    url: 'model/monthly accomplishment/accomplishment_report_copy.json',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log("sdsd:" + data);
                        $('#CovidTable').DataTable({
                            data: data,
                            columns: [{
                                    data: 'doctorsName', // Date column from the JSON data
                                    title: 'Doctors Name' // Header for the Date column
                                },
                                {
                                    data: 'preparedByName', // Date column from the JSON data
                                    title: 'Prepared By' // Header for the Date column
                                },
                                {
                                    data: 'timestamp', // Date column from the JSON data
                                    title: 'Date' // Header for the Date column
                                },
                                {
                                    data: 'dataUrl',
                                    title: 'Copy',
                                    render: function(data, type, row) {
                                        var imageElement = $('<img>').addClass('img-fluid').attr('src', data).css('max-width', '100%');
                                        return imageElement.prop('outerHTML');
                                    }
                                }

                            ],
                            responsive: true
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching Covid report records:', error);
                    }
                });
            }

            $("#addAccomplishmentForm").on("submit", function(event) {
                event.preventDefault();

                // Extract the form data
                var formData = extractFormData();

                $.ajax({
                    url: 'model/monthly accomplishment/save_data.php', // Path to your PHP script
                    type: 'POST',
                    data: formData, // Pass the extracted form data
                    dataType: 'json', 
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            function extractFormData() {
                // Access the form element
                var form = document.getElementById('addAccomplishmentForm');

                // Access the table element
                var table = form.querySelector('.modal-table');

                // Access the input fields for nurse name and doctor name
                var nurseNameInput = form.querySelector('#nurseName');
                var doctorNameInput = form.querySelector('#doctorName');

                // Initialize an array to store the extracted data
                var data = [];

                // Check if table and input elements are found
                if (!table || !nurseNameInput || !doctorNameInput) {
                    console.error('Table or input elements not found.');
                    return null;
                }

                // Loop through each row in the table (skipping the first row which contains headers)
                for (var i = 1; i < table.rows.length; i++) {
                    var row = table.rows[i];
                    console.log('Row:', row);

                    // Check if textarea elements are found in the current row
                    var textareas = row.querySelectorAll('textarea');
                    console.log('Textareas:', textareas);
                    if (textareas.length !== 3) {
                        console.error('Textarea elements not found or incorrect number of textareas in row ' + i);
                        continue; // Skip this row if textarea elements are not found or incorrect number of textareas
                    }

                    // Create an object to store the data for each row
                    var rowData = {
                        activities: textareas[0].value,
                        timeSchedule: textareas[1].value,
                        intervention: textareas[2].value
                    };
                    console.log('Row data:', rowData);

                    // Add the row data object to the data array
                    data.push(rowData);
                }

                // Extract nurse name and doctor name
                var nurseName = nurseNameInput.value;
                var doctorName = doctorNameInput.value;

                // Return an object containing all the extracted data
                return {
                    nurseName: nurseName,
                    doctorName: doctorName,
                    reportData: data
                };
            }

        });
    </script>
</body>

</html>