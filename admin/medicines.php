<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <!-- User Table -->
                <div class="col-md-12">
                    <?php include 'includes/session.php'; ?>
                    <div class="card-box pb-10">
                        <div class="h5 pd-20 mb-0">Medicine List</div>
                        <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addMedicineModal" type="button">
                            <i class="fa fa-plus"></i>
                            Add Medicine
                        </button>
                        <div class="table-responsive">
                            <table id="medicinesTable" class="table  datanew">
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Dosage</th>
                                        <th>Quantity</th>
                                        <th>Expiration Date</th>
                                        <th>Action</th>
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
    <?php include 'modal/medicines/add_.php'; ?>
    <?php include 'modal/medicines/edit_.php'; ?>
    <script>
        function printContent() {
            window.print();
        }


        $(document).ready(function() {

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

            function fetchMedicineList() {
                if ($.fn.DataTable.isDataTable('#medicinesTable')) {
                    $('#medicinesTable').DataTable().destroy();
                }
                var dataTable = $('#medicinesTable').DataTable({
                    columns: [{
                            data: 'Medicine',
                            title: 'Medicine',
                            orderable: true
                        },
                        {
                            data: 'Dosage',
                            title: 'Dosage',
                            orderable: true
                        },
                        {
                            data: 'Quantity',
                            title: 'Quantity',
                            orderable: true
                        },
                        {
                            data: 'ExpirationDate',
                            title: 'Expiration Date',
                            orderable: true,
                            render: function(data, type, row) {
                                var expirationDate = new Date(data);
                                var currentDate = new Date();
                                var badgeClass = expirationDate < currentDate ? 'badge badge-danger' : 'badge badge-success';
                                var text = expirationDate < currentDate ? 'Expired' : 'Valid';

                                // Format the date as "Month day, year"
                                var options = {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                };
                                var formattedDate = expirationDate.toLocaleDateString(undefined, options);

                                return '<span class="' + badgeClass + '">' + formattedDate + ' (' + text + ')</span>';
                            }
                        },
                        {
                            data: null,
                            title: 'Action',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div class="table-actions"><a class="edit-medicine" data-toggle="modal" data-target="#editMedicineModal" data-medicine-id="' + row.MedicineID + '" href="#"> <i class="icon-copy dw dw-edit2"></i></a> <a class="delete-medicine" data-medicine-id="' + row.MedicineID + '" href="#"> <i class="icon-copy dw dw-delete-3"></i></a></div>';
                            }
                        }
                    ]
                });
                $.ajax({
                    url: 'model/medicines/fetch_.php',
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

            fetchMedicineList();

            // Add Medicine Form Submission
            $("#submitForm").on("click", function(e) {
                e.preventDefault();
                if (validateFormInputs('#addMedicineForm')) {
                    $.ajax({
                        type: "POST",
                        url: "model/medicines/add_.php",
                        data: $("#addMedicineForm").serialize(),
                        success: function(response) {
                            fetchMedicineList();
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
                                    document.getElementById("addMedicineForm").reset();
                                    $('#addMedicineModal').modal('hide');
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
            // Function to fetch medicine details for editing
            $('#medicinesTable').on('click', '.edit-medicine', function(e) {
                e.preventDefault();
                var medicineId = $(this).data('medicine-id');
                $('#editMedicineId').val(medicineId); // Assuming you have an input field with id editMedicineId to store the medicine ID

                $.ajax({
                    url: 'model/medicines/get_.php',
                    type: 'GET',
                    data: {
                        medicine_id: medicineId
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#editMedicineName').val(response.Medicine);
                        $('#editDosage').val(response.Dosage);
                        $('#editQuantity').val(response.Quantity);
                        $('#editExpirationDate').val(response.ExpirationDate);
                        // Show the edit modal
                        $('#editMedicineModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching medicine details:', error);
                    }
                });
            });


            // Edit Medicine Form Submission
            $('#editMedicineForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'model/medicines/edit_.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#editMedicineModal').modal('hide');
                            fetchMedicineList();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            });
                        } else {
                            $('#editError').text('Error updating medicine: ' + response.message).show();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to update medicine'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#editError').text('Error updating medicine: ' + error).show();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update medicine. Please try again later.'
                        });
                    }
                });
            });


            // Delete Medicine
            $('#medicinesTable').on('click', '.delete-medicine', function(e) {
                e.preventDefault();
                var medicine_id = $(this).data('medicine-id');
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
                            url: 'model/medicines/del_.php',
                            data: {
                                medicine_id: medicine_id
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your medicine has been deleted.',
                                        'success'
                                    ).then((result) => {
                                        fetchMedicineList();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete the medicine.',
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
                            'Your medicine is safe :)',
                            'error'
                        );
                    }
                });
            });

        });
    </script>

</body>