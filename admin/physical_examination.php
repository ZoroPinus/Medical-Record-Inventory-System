<?php include 'includes/header.php'; ?>
<style>
    @font-face {
        font-family: 'AlgerianRegular';
        src: url('../assets/algerian/Algerian-Regular.ttf') format('truetype');
        /* Replace 'path/to/Algerian-Regular.ttf' with the actual path to your font file */
        font-weight: normal;
        font-style: normal;
    }

    .certificate-container {
        background-color: white !important;
        border: 5px double #333;
    }

    .certificate-header {
        border-bottom: 2px solid #333;
        padding-bottom: 1rem;
    }

    .logo {
        max-height: 80px;
    }

    .certificate-title {
        font-family: 'AlgerianRegular', sans-serif;
        font-size: 2.5rem;
        color: #333;
    }

    h4 {
        font-family: 'AlgerianRegular', sans-serif;
        font-size: 1.5rem;
        color: #333;
    }

    .form-group label {
        display: block;
    }

    .form-control {
        border: none;
        border-bottom: 1px solid black;
    }
</style>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <div class="col-md-12">
                    <?php include 'includes/session.php'; ?>
                    <div class="card-box pb-10">
                        <div class="h5 pd-20 mb-0">Physical Examination</div>
                        <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addPhysicalExamModal" type="button">
                            <i class="fa fa-plus"></i> Add Physical Examination
                        </button>
                        <div class="table-responsive">
                            <table id="physicalExamTable" class="table datanew">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>School Physician</th>
                                        <th>Date Created</th>
                                        <th>copy</th>
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

    <!-- Include Dental and Certificate Modal Files Here -->

</body>

</html>

<?php include 'includes/footer.php'; ?>
<?php include 'modal/physical exam/add_.php'; ?>

<script>
    $(document).ready(function() {
        fetchPhysicalExamRecords();

        function fetchPhysicalExamRecords() {
            if ($.fn.DataTable.isDataTable('#physicalExamTable')) {
                $('#physicalExamTable').DataTable().destroy();
            }

            $.ajax({
                url: 'model/physical exam/physical_exam.json',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#physicalExamTable').DataTable({
                        data: data,
                        columns: [
                            {
                                data: 'name',
                                title: 'Name'
                            },
                            {
                                data: 'doctor',
                                title: 'School Physician'
                            },
                            {
                                data: 'timestamp',
                                title: 'Date Created'
                            },
                            {
                                data: 'dataUrl',
                                title: 'Physical Exam Records',
                                render: function(data, type, row) {
                                    var imageAnchor = $('<a>').attr('href', row.targetUrl).attr('target', '_blank');
                                    var imageElement = $('<img>').addClass('img-fluid').attr('src', data).css('max-width', '1000px');
                                    imageAnchor.append(imageElement);
                                    return imageAnchor.prop('outerHTML');
                                }
                            }
                        ],
                        responsive: true
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching physical exam records:', error);
                }
            });
        }

        $("#addPhysicalExamForm").on("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                type: "POST",
                url: "model/physical exam/add_.php",
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Parse JSON response
                    var responseData;
                    try {
                        responseData = JSON.parse(response);
                        console.log(responseData)
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
                            $('#addPhysicalExamForm')[0].reset();
                            // Refresh student list
                            fetchStudentList();
                            $('#addPhysicalExamForm').modal('hide');
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: responseData.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Show error message with detailed error info
                    var errorMessage = xhr.responseText ? JSON.stringify(xhr.responseText) : 'Failed to submit the form. Please try again later.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                    console.log("Error: ", errorMessage);
                }
            });
        });
    });
</script>