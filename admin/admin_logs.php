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
                        <div class="h5 pd-20 mb-0">Admin Logs</div>
                        
                        <div class="table-responsive">
                            <table id="adminTable" class="table hover nowrap">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Created At</th>
                                        <th>Last Logged In</th>
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

            // Function to fetch admin list
            function fetchAdminList() {
                if ($.fn.DataTable.isDataTable('#adminTable')) {
                    $('#adminTable').DataTable().destroy();
                }
                var dataTable = $('#adminTable').DataTable({
                    columns: [
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
                            data: 'createdAt',
                            title: 'Created At',
                            orderable: true
                        },
                        {
                            data: 'loggedinAt',
                            title: 'Last Log in',
                            orderable: true
                        }
                    ]
                });
                $.ajax({
                    url: 'model/users/fetch_.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        dataTable.clear().rows.add(data).draw();
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax request failed: ' + status + ', ' + error);
                        $('#errorContainer').text('Error loading data: ' + error).show();
                    }
                });
            }

            // Fetch equipment list on page load
            fetchAdminList();


        });
    </script>