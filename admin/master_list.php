<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <!-- Master List Table -->
                <div class="col-md-12">
                    <?php include 'includes/session.php'; ?>
                    <div class="card-box pb-10">
                        <div class="h5 pd-20 mb-0">Master List</div>
                        <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addRecordModal" type="button">
                            <i class="fa fa-plus"></i>
                            Add Record
                        </button>
                        <div class="table-responsive">
                            <table id="masterListTable" class="table datanew">
                                <thead>
                                    <tr>
                                        <th>No. ID No</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Sex</th>
                                        <th>Course</th>
                                        <th>Year</th>
                                        <th>Unit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'modal/masterList/add_.php'; ?>
    <?php include 'modal/masterList/edit_.php'; ?>

    <script>
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

        // Function to fetch master list
        function fetchMasterList() {
            if ($.fn.DataTable.isDataTable('#masterListTable')) {
                $('#masterListTable').DataTable().destroy();
            }
            var dataTable = $('#masterListTable').DataTable({
                columns: [
                    { data: 'NoIdNo', title: 'No. ID No', orderable: true },
                    { data: 'Firstname', title: 'Firstname', orderable: true },
                    { data: 'Lastname', title: 'Lastname', orderable: true },
                    { data: 'Sex', title: 'Sex', orderable: true },
                    { data: 'Course', title: 'Course', orderable: true },
                    { data: 'Year', title: 'Year', orderable: true },
                    { data: 'Unit', title: 'Unit', orderable: true },
                    {
                        data: null,
                        title: 'Action',
                        orderable: false,
                        render: function(data, type, row) {
                            return '<div class="table-actions"><a class="edit-record" data-toggle="modal" data-target="#editRecordModal" data-record-id="' + row.ID + '" href="#"> <i class="icon-copy dw dw-edit2"></i></a> <a class="delete-record" data-record-id="' + row.ID + '" href="#"> <i class="icon-copy dw dw-delete-3"></i></a></div>';
                        }
                    }
                ]
            });
            $.ajax({
                url: 'model/masterList/fetch_.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    dataTable.clear().rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request failed: ' + status + ', ' + error);
                    $('#errorContainer').text('Error loading data: ' + error).show();
                }
            });
        }

        // Fetch master list on page load
        fetchMasterList();

        // Add Record Form Submission
        $("#submitRecordForm").on("click", function(e) {
            e.preventDefault();
            if (validateFormInputs('#addRecordForm')) {
                $.ajax({
                    type: "POST",
                    url: "model/masterList/add_.php",
                    data: $("#addRecordForm").serialize(),
                    success: function(response) {
                        fetchMasterList();
                        var responseData;
                        try {
                            responseData = JSON.parse(response);
                        } catch (e) {
                            responseData = response;
                        }
                        if (responseData && responseData.success) {
                            $(".fade").hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: responseData.message
                            }).then((result) => {
                                document.getElementById("addRecordForm").reset();
                                $('#addRecordModal').modal('hide');
                            });
                        } else {
                            $(".fade").hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: responseData.message || 'Failed to submit the form'
                            });
                        }
                    },
                    error: function(error) {
                        $(".fade").hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to submit the form. Please try again later.'
                        });
                        console.log("Error: " + error);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Please fill in all required fields.',
                });
            }
        });

        // Function to fetch record details for editing
        $('#masterListTable').on('click', '.edit-record', function(e) {
            e.preventDefault();
            var recordId = $(this).data('record-id');
            $('#editRecordId').val(recordId);

            $.ajax({
                url: 'model/masterList/get_.php',
                type: 'GET',
                data: { record_id: recordId },
                dataType: 'json',
                success: function(response) {
                    $('#editNoIdNo').val(response.NoIdNo);
                    $('#editFirstname').val(response.Firstname);
                    $('#editLastname').val(response.Lastname);
                    $('#editSex').val(response.Sex);
                    $('#editCourse').val(response.Course);
                    $('#editYear').val(response.Year);
                    $('#editUnit').val(response.Unit);
                    // Show the edit modal
                    $('#editRecordModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching record details:', error);
                }
            });
        });

        // Edit Record Form Submission
        $('#editRecordForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: 'model/masterList/edit_.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(formData);
                    if (response.success) {
                        $('#editRecordModal').modal('hide');
                        fetchMasterList();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                    } else {
                        $('#editError').text('Error updating record: ' + response.message).show();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Failed to update record'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('#editError').text('Error updating record: ' + error).show();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update record. Please try again later.'
                    });
                }
            });
        });

        // Delete Record
        $('#masterListTable').on('click', '.delete-record', function(e) {
            e.preventDefault();
            var recordId = $(this).data('record-id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'model/masterList/del_.php',
                        data: { record_id: recordId },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your record has been deleted.',
                                    'success'
                                ).then((result) => {
                                    fetchMasterList();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete the record.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your record is safe :)',
                        'error'
                    );
                }
            });
        });

    });
    </script>
</body>