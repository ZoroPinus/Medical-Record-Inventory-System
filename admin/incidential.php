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
                                <div class="h5 pd-20 mb-0">Incidential Report</div>
                                <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addCovid19Report" type="button">
                                    <i class="fa fa-plus"></i> Add Report
                                </button>
                                <div class="table-responsive">
                                    <table id="CovidTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Incidence</th>
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
    <?php include 'modal/incidential/add_.php'; ?>


    <script>
        $(document).ready(function() {
            fetchCovidReportRecords();

            function fetchCovidReportRecords() {
                if ($.fn.DataTable.isDataTable('#CovidTable')) {
                    $('#CovidTable').DataTable().destroy();
                }

                $.ajax({
                    url: 'model/incidential/incidential_report_copy.json',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log("sdsd:" + data);
                        $('#CovidTable').DataTable({
                            data: data,
                            columns: [
                                {
                                    data: 'name', // Date column from the JSON data
                                    title: 'Name' // Header for the Date column
                                },
                                {
                                    data: 'incidence', // Date column from the JSON data
                                    title: 'Incidence' // Header for the Date column
                                },
                                {
                                    data: 'preparedByName', // Date column from the JSON data
                                    title: 'Prepared by' // Header for the Date column
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

            $("#addIncidentalReportForm").on("submit", function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                console.log(formData)
                // Make AJAX request
                $.ajax({
                    type: "POST",
                    url: "model/incidential/save_data.php",
                    data: formData,
                    success: function(response) {
                        // Parse response
                        var responseData;
                        try {
                            responseData = JSON.parse(response);
                        } catch (e) {
                            responseData = response;
                        }
                        if (responseData.status === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: responseData.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                // Reset form and hide modal
                                document.getElementById("addIncidentalReportForm").reset();
                                $('#addIncidentalReportModal').modal('hide');
                            });
                        } else {
                            console.log(response)
                            Swal.fire({
                                title: 'Error',
                                text: responseData.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                // Reset form and hide modal
                                document.getElementById("addIncidentalReportForm").reset();
                                $('#addIncidentalReportModal').modal('hide');
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


        });
    </script>
</body>

</html>