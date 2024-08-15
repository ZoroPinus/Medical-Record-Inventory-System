<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <!-- Admin Logs Table -->
                <div class="col-md-12">
                    <?php include 'includes/session.php'; ?>
                    <div class="card-box pb-10">
                        <div class="h5 pd-20 mb-0">User Logs</div>
                        <div class="input-group px-3 justify-content-between">
                            <span class="input-group-btn">
                                <button class="btn btn-primary upload-button" data-toggle="modal" data-target="#addUserLogModal" type="button">
                                    <i class="fa fa-plus"></i>
                                    Add Logs
                                </button>
                            </span>
                        </div>
                        <div class="table-responsive">
                            <table id="userLogsTable" class="table hover nowrap">
                                <thead>
                                    <tr>
                                        <th>ID No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Time</th>
                                        <th>Department/Office</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" onclick="printContent()">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'modal/userlogs/add_.php'; ?>

    <script>

    </script>
    <script>
        function printContent() {
            window.print();
        }
        $(document).ready(function() {
            // Function to validate form inputs
            function validateFormInputs(formId) {
                var isValid = true;
                $(formId + ' input[required], ' + formId + ' textarea[required], ' + formId + ' select[required]').each(function() {
                    if ($(this).is('select')) {
                        if ($(this).val() === null || $(this).val() === '') {
                            isValid = false;
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    } else {
                        if ($.trim($(this).val()) === '') {
                            isValid = false;
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    }
                });
                return isValid;
            }

            function fetchUserLogs() {
                // Check if DataTable is already initialized and destroy it if true
                if ($.fn.DataTable.isDataTable('#userLogsTable')) {
                    $('#userLogsTable').DataTable().destroy();
                }

                // Initialize DataTable
                var dataTable = $('#userLogsTable').DataTable({
                    columns: [
                        {
                            data: 'user_id',
                            title: 'ID No',
                            orderable: true
                        },
                        {
                            data: 'FirstName',
                            title: 'First Name',
                            orderable: true
                        },
                        {
                            data: 'LastName',
                            title: 'Last Name',
                            orderable: true
                        },
                        {
                            data: 'Time',
                            title: 'Time',
                            orderable: true
                        },
                        {
                            data: 'DepartmentOffice',
                            title: 'Department/Office',
                            orderable: true
                        },
                        {
                            data: 'Reason',
                            title: 'Reason',
                            orderable: true
                        }
                    ]
                });

                // AJAX request to fetch user logs
                $.ajax({
                    url: 'model/userLogs/fetch_.php', // Adjust the URL to your PHP script
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Log the fetched data
                        dataTable.clear().rows.add(data).draw(); // Populate DataTable with the fetched data
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax request failed: ' + status + ', ' + error);
                        $('#errorContainer').text('Error loading data: ' + error).show(); // Show error message
                    }
                });
            }

            // Fetch user logs on page load
            fetchUserLogs();
            $("#addUserLogForm").on("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                $.ajax({
                    type: "POST",
                    url: "model/userlogs/add_.php",
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        console.log(response); // Log server response

                        // Parse JSON response
                        var responseData;
                        try {
                            responseData = JSON.parse(response);
                        } catch (e) {
                            responseData = response;
                        }

                        // Check if the form submission was successful
                        if (responseData && responseData.success) {
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: responseData.message
                            }).then(function() {
                                // Clear the form fields
                                $('#addUserLogForm')[0].reset();
                                // Hide the modal
                                $('#addUserLogModal').modal('hide');
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: responseData.message || 'Failed to submit the form'
                            });
                        }
                    },
                    error: function(error) {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to submit the form. Please try again later.'
                        });
                        console.log("Error: " + error);
                    }
                });
            });

            

        });
    </script>