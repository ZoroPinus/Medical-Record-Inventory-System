<!-- Modal Dialog for Medicine Selection -->
<div class="modal fade" id="medicineSelectionModal" tabindex="-1" role="dialog" aria-labelledby="medicineSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicineSelectionModalLabel">Select Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Medicine list -->
                <ul id="medicineList" class="list-group">
                    <!-- Medicine items will be populated dynamically here -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to populate medicine list
    $(document).ready(function() {
        // Perform an AJAX request to fetch medicine details
        $.ajax({
            url: 'model/medicines/fetch_.php', // Adjust the URL to your PHP script that fetches medicine details
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Iterate through the fetched medicine details and populate the list
                var medicineList = $('#medicineList');
                $.each(data, function(index, medicine) {
                    // Create list item
                    var listItem = $('<li class="list-group-item"></li>');
                    // Display medicine name
                    listItem.append($('<h5 class="mb-1">' + medicine.Medicine + '</h5>'));
                    // Display dosage
                    listItem.append($('<p class="mb-1">Dosage: ' + medicine.Dosage + '</p>'));
                    // Display quantity
                    listItem.append($('<p class="mb-1">Quantity: ' + medicine.Quantity + '</p>'));

                    // Parse the expiration date
                    var expirationDate = new Date(medicine.ExpirationDate);
                    var currentDate = new Date();
                    var expirationText = 'Expiration Date: ' + medicine.ExpirationDate;
                    var quantity =medicine.Dosage;

                    // Check if the medicine is expired
                    if (expirationDate < currentDate) {
                        expirationText += ' (Expired)';
                    }

                    // Display expiration date
                    listItem.append($('<p class="mb-1">' + expirationText + '</p>'));

                    // Create select button
                    var selectButton = $('<button type="button" class="btn btn-primary btn-sm float-right">Select</button>');

                    // Disable the button and change its color if the medicine is expired
                    if (quantity < 1) {
                        selectButton.attr('disabled', 'disabled').removeClass('btn-primary').addClass('btn-secondary');
                    }
                    if (expirationDate < currentDate) {
                        selectButton.attr('disabled', 'disabled').removeClass('btn-primary').addClass('btn-secondary');
                    } else {
                        // Handle click event to populate selected medicine if not expired
                        selectButton.click(function() {
                            // When the select button is clicked, call selectMedicine function with medicineId and medicineName
                            selectMedicine(medicine.MedicineID, medicine.Medicine, medicine.Dosage);
                        });
                    }

                    // Append select button to list item
                    listItem.append(selectButton);
                    // Append list item to medicine list
                    medicineList.append(listItem);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch medicine details:', error);
            }
        });
    });



    function selectMedicine(medicineId, medicineName, dosage) {
        // Populate the selected medicine name and id in the input fields
        $('#medicineName').val(medicineName);
        $('#medicineId').val(medicineId);
        $('#dosage').val(dosage);
        // Close the medicine selection modal
        $('#medicineSelectionModal').modal('hide');
    }
</script>