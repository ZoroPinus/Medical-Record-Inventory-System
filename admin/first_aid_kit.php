<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="row pb-10">
                <!-- First Aid Kits Table -->
                <div class="col-md-12">
                    <?php include 'includes/session.php'; ?>
                    <div class="card-box pb-10">
                        <div class="h5 pd-20 mb-0">First Aid Kit List</div>
                        <button class="btn btn-success mb-2 m-3" data-toggle="modal" data-target="#addFirstAidKitModal" type="button">
                            <i class="fa fa-plus"></i>
                            Add First Aid Kit
                        </button>
                        <div class="table-responsive">
                            <table id="firstAidKitTable" class="table  datanew">
                                <thead>
                                    <tr>
                                        <th>Kit Name</th>
                                        <th>Remark</th>
                                        <th>Expiry Date</th>
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
    <?php include 'modal/first_aid_kit/add_.php'; ?>
    <?php include 'modal/first_aid_kit/edit_.php'; ?>
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

            // Function to fetch first aid kit list
            function fetchFirstAidKitList() {
                if ($.fn.DataTable.isDataTable('#firstAidKitTable')) {
                    $('#firstAidKitTable').DataTable().destroy();
                }
                var dataTable = $('#firstAidKitTable').DataTable({
                    columns: [{
                            data: 'Name',
                            title: 'First Aid Kit Name',
                            orderable: true
                        },
                        {
                            data: 'Remark',
                            title: 'Remark',
                            orderable: true
                        },
                        {
                            data: 'ExpiryDate',
                            title: 'ExpiryDate',
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
                                return '<div class="table-actions"><a class="edit-first-aid-kit" data-toggle="modal" data-target="#editFirstAidKitModal" data-first-aid-kit-id="' + row.FirstAidKitID + '" href="#"> <i class="icon-copy dw dw-edit2"></i></a> <a class="delete-first-aid-kit" data-first-aid-kit-id="' + row.FirstAidKitID + '" href="#"> <i class="icon-copy dw dw-delete-3"></i></a></div>';
                            }
                        }
                    ]


                });
                $.ajax({
                    url: 'model/first_aid_kit/fetch_.php',
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

            // Fetch first aid kit list on page load
            fetchFirstAidKitList();

            // Add First Aid Kit Form Submission
            $("#submitForm").on("click", function(e) {
                e.preventDefault();
                if (validateFormInputs('#addFirstAidKitForm')) {
                    $.ajax({
                        type: "POST",
                        url: "model/first_aid_kit/add_.php",
                        data: $("#addFirstAidKitForm").serialize(),
                        success: function(response) {
                            fetchFirstAidKitList();
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
                                    document.getElementById("addFirstAidKitForm").reset();
                                    $('#addFirstAidKitModal').modal('hide');
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
            }); // Function to fetch first aid kit details for editing
            $('#firstAidKitTable').on('click', '.edit-first-aid-kit', function(e) {
                e.preventDefault();
                var firstAidKitId = $(this).data('first-aid-kit-id');
                $('#editFirstAidKitId').val(firstAidKitId);

                $.ajax({
                    url: 'model/first_aid_kit/get_.php',
                    type: 'GET',
                    data: {
                        first_aid_kit_id: firstAidKitId
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#editName').val(response.Name);
                        $('#editRemark').val(response.Remark);
                        $('#editExpiryDate').val(response.ExpiryDate);
                        // Show the edit modal
                        $('#editFirstAidKitModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching first aid kit details:', error);
                    }
                });
            });

            // Edit First Aid Kit Form Submission
            // Edit First Aid Kit Form Submission
            $('#editFirstAidKitForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'model/first_aid_kit/edit_.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json', // Ensure that the response is parsed as JSON
                    success: function(response) {
                        if (response.success) {
                            $('#editFirstAidKitModal').modal('hide');
                            fetchFirstAidKitList();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            });
                        } else {
                            $('#editError').text('Error updating first aid kit: ' + response.message).show();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to update first aid kit'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#editError').text('Error updating first aid kit: ' + error).show();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update first aid kit. Please try again later.'
                        });
                    }
                });
            });

            // Delete First Aid Kit
            $('#firstAidKitTable').on('click', '.delete-first-aid-kit', function(e) {
                e.preventDefault();
                var firstAidKitId = $(this).data('first-aid-kit-id');
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
                            url: 'model/first_aid_kit/del_.php',
                            data: {
                                first_aid_kit_id: firstAidKitId
                            },
                            dataType: 'json', // Ensure that the response is parsed as JSON
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Success!',
                                        'Your first aid kit has been deleted.',
                                        'success'
                                    ).then((result) => {
                                        fetchFirstAidKitList();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete the first aid kit.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete the first aid kit. Please try again later.',
                                    'error'
                                );
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Cancelled',
                            'Your first aid kit is safe :)',
                            'error'
                        );
                    }
                });
            });



        });
    </script>
</body>
</html>