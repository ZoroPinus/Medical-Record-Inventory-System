<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <!-- Equipment Table -->
                <div class="col-md-12">
                    <?php include 'includes/session.php'; ?>
                    <div class="card-box pb-10">
                        <div class="h5 pd-20 mb-0">Equipment List</div>
                        <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addEquipmentModal" type="button">
                            <i class="fa fa-plus"></i>
                            Add Equipment
                        </button>
                        <div class="table-responsive">
                            <table id="equipmentTable" class="table  datanew">
                                <thead>
                                    <tr>
                                        <th>Equipment Name</th>
                                        <th>Remark</th>
                                        <th>Status</th>
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
    <?php include 'modal/equipment/add_.php'; ?>
    <?php include 'modal/equipment/edit_.php'; ?>

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

            // Function to fetch equipment list
            function fetchEquipmentList() {
                if ($.fn.DataTable.isDataTable('#equipmentTable')) {
                    $('#equipmentTable').DataTable().destroy();
                }
                var dataTable = $('#equipmentTable').DataTable({
                    columns: [{
                            data: 'EquipmentName',
                            title: 'Equipment Name',
                            orderable: true
                        },
                        {
                            data: 'Remark',
                            title: 'Remark',
                            orderable: true
                        },
                        {
                            data: 'Status',
                            title: 'Status',
                            orderable: true
                        },
                        {
                            data: null,
                            title: 'Action',
                            orderable: false,
                            render: function(data, type, row) {
                                return '<div class="table-actions"><a class="edit-equipment" data-toggle="modal" data-target="#editEquipmentModal" data-equipment-id="' + row.EquipmentID + '" href="#"> <i class="icon-copy dw dw-edit2"></i></a> <a class="delete-equipment" data-equipment-id="' + row.EquipmentID + '" href="#"> <i class="icon-copy dw dw-delete-3"></i></a></div>';
                            }
                        }
                    ]
                });
                $.ajax({
                    url: 'model/equipment/fetch_.php',
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

            // Fetch equipment list on page load
            fetchEquipmentList();

            // Add Equipment Form Submission
            $("#submitForm").on("click", function(e) {
                e.preventDefault();
                if (validateFormInputs('#addEquipmentForm')) {
                    $.ajax({
                        type: "POST",
                        url: "model/equipment/add_.php",
                        data: $("#addEquipmentForm").serialize(),
                        success: function(response) {
                            fetchEquipmentList();
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
                                    document.getElementById("addEquipmentForm").reset();
                                    $('#addEquipmentModal').modal('hide');
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

            // Function to fetch equipment details for editing
            $('#equipmentTable').on('click', '.edit-equipment', function(e) {
                e.preventDefault();
                var equipmentId = $(this).data('equipment-id');
                $('#editEquipmentId').val(equipmentId);
                console.log(equipmentId);
                $.ajax({
                    url: 'model/equipment/get_.php',
                    type: 'POST',
                    data: {
                        equipment_id: equipmentId
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#editEquipmentName').val(response.EquipmentName);
                        $('#editRemark').val(response.Remark);
                        $('#editStatus').val(response.Status);
                        // Show the edit modal
                        $('#editEquipmentModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching equipment details:', error);
                    }
                });
            });

            // Edit Equipment Form Submission
            $('#editEquipmentForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'model/equipment/edit_.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#editEquipmentModal').modal('hide');
                            fetchEquipmentList();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            });
                        } else {
                            $('#editError').text('Error updating equipment: ' + response.message).show();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to update equipment'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#editError').text('Error updating equipment: ' + error).show();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update equipment. Please try again later.'
                        });
                    }
                });
            });
            // Delete Equipment
            $('#equipmentTable').on('click', '.delete-equipment', function(e) {
                e.preventDefault();
                var equipmentId = $(this).data('equipment-id');
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
                            url: 'model/equipment/del_.php',
                            data: {
                                equipment_id: equipmentId
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your equipment has been deleted.',
                                        'success'
                                    ).then((result) => {
                                        fetchEquipmentList();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete the equipment.',
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
                            'Your equipment is safe :)',
                            'error'
                        );
                    }
                });
            });

        });
    </script>

</body>
