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

    .input-wrap {
        display: inline-block;
        border: none;
        border-bottom: 1px solid black;
        text-align: center;
    }

    .long-input {
        width: 100%;
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
                        <div class="h5 pd-20 mb-0">Medical Certificates</div>
                        <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addMedicalCertificate" type="button">
                            <i class="fa fa-plus"></i> Add Medical Certificate
                        </button>
                        <div class="table-responsive">
                            <table id="CertificateTable" class="table  nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>School Doctor</th>
                                        <th>Date Created</th>
                                        <th>Copy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Images will be displayed here -->
                                </tbody>
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
<?php include 'modal/certificates/add_.php'; ?>

<script>
    $(document).ready(function() {
        fetchCertificateRecords(); // Call this function to fetch certificate records


        function fetchCertificateRecords() {
            if ($.fn.DataTable.isDataTable('#CertificateTable')) {
                $('#CertificateTable').DataTable().destroy();
            }

            $.ajax({
                url: 'model/certificates/certificates.json',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#CertificateTable').DataTable({
                        data: data,
                        columns: [
                            {
                                data: 'name',
                                title: 'Name'
                            },
                            {
                                data: 'physicianName',
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
                    console.error('Error fetching certificate records:', error);
                }
            });
        }
        $("#addMedicalCertificateForm").on("submit", function(event) {
            event.preventDefault(); 

            $.ajax({
                url: 'model/certificates/save_data.php', // Path to your PHP script
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
    });
</script>
