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
        margin-bottom: 20px;
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
                        <div class="h5 pd-20 mb-0">Dental Health Records </div>
                        <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addDentalHealthModal" type="button">
                            <i class="fa fa-plus"></i> Add Dental Health Records
                        </button>
                        <div class="table-responsive">
                            <table id="imageTable" class="table datanew">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date Created</th>
                                        <th>Copy</th>
                                    </tr>
                                </thead>
                                <!-- Physical Examination Table Body Will Be Filled Dynamically -->
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Include Dental and Certificate Modal Files Here -->

</body>

</html>

<?php include 'includes/footer.php'; ?>
<?php include 'modal/dental health/add_.php'; ?>

<script>
    $(document).ready(function() {
        fetchDentalHealthRecords();


        function fetchDentalHealthRecords() {
            if ($.fn.DataTable.isDataTable('#imageTable')) {
                $('#imageTable').DataTable().destroy();
            }

            $.ajax({
                url: 'model/dental health/uploaded_images.json',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#imageTable').DataTable({
                        data: data,
                        columns: [
                            {
                                data: 'name',
                                title: 'Name'
                            },
                            {
                                data: 'doctor',
                                title: 'Dentist Name'
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
                    console.error('Error fetching dental health records:', error);
                }
            });
        }

        $("#dentalHealthForm").on("submit", function(event) {
            event.preventDefault(); 

            $.ajax({
                url: 'model/dental health/save_data.php', // Path to your PHP script
                type: 'POST',
                data: $(this).serialize(),
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

        // Add and remove row functionality
        $('#addRowBtn').click(function() {
            var newRow = '<tr><td><input type="text" name="columns[]" /></td><td><input type="number" name="columns[]" /></td><td><input type="number" name="columns[]" /></td><td><input type="text" name="columns[]" /></td></tr>';
            $('#dynamicTable tbody').append(newRow);
        });

        $('#removeRowBtn').click(function() {
            $('#dynamicTable tbody tr:last').remove();
        });
    });
</script>