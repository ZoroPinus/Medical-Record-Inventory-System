<!-- <div class="footer-wrap pd-20 mb-20 card-box">
				© 2023 All Rights Reserved | Clinical
					<a href="#" target="_blank"
						>.com</a
					>
				</div> -->
				</div>
            </div>

		<!-- js -->

		

	
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<!-- buttons for Export datatable -->
		<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
		<!-- Datatable Setting js -->
		<script src="vendors/scripts/datatable-setting.js"></script>
		<!-- Google Tag Manager (noscript) 
		<script src="vendors/scripts/dashboard3.js"></script>-->

		<script src="src/plugins/fullcalendar/fullcalendar.min.js"></script>
		<script src="vendors/scripts/calendar-settings.js"></script>
		<script src="src/plugins/dropzone/src/dropzone.js"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
                    

     <script>
                $(document).ready(function() {
                    // Check if DataTable is already initialized
                    if (!$.fn.dataTable.isDataTable('.data-table')) {
                        // Initialize DataTable
                        $('.data-table').DataTable({
                            columnDefs: [
                                { targets: 'datatable-nosort', orderable: false } // Disable sorting for columns with class 'datatable-nosort'
                            ],
                            order: [[1, 'asc']] // Sort by the second column (Queuing Code) in ascending order by default
                        });
                    }
                });
				$(document).ready(function() {
			// Click event for the edit profile button
			$('#editProfileBtn').click(function(e) {
				e.preventDefault();
				// Ajax request to fetch user profile data
				$.ajax({
					url: 'model/profile/fetch_profile.php', // URL to your PHP script to fetch profile data
					type: 'GET',
					dataType: 'json',
					success: function(data) {
						// Populate modal fields with fetched data
						$('#editFirstName').val(data.firstName);
						$('#editLastName').val(data.lastName);
						$('#editEmail').val(data.email);
						$('#editProfilePicturePreview').val(data.profile_picture);
						// Show the modal
						$('#editProfileModal').modal('show');
					},
					error: function(xhr, status, error) {
						console.error('Error fetching profile data:', error);
					}
				});
			});
		// Submit event for the edit profile form
		$('#editProfileForm').submit(function(e) {
			e.preventDefault();

			// Create a FormData object to handle form data (including files)
			var formData = new FormData(this);

			// Log the form data (for debugging purposes)
			for (var pair of formData.entries()) {
				console.log(pair[0] + ': ' + pair[1]);
			}

			$.ajax({
				url: 'model/profile/update_profile.php', // URL to your PHP script to update profile data
				type: 'POST',
				data: formData,
				processData: false, // Tell jQuery not to process the data
				contentType: false, // Tell jQuery not to set the content type
				dataType: 'json',
				success: function(response) {
					console.log(response);
					if (response.success) {
						// Handle success using Swal (SweetAlert)
						Swal.fire({
							icon: 'success',
							title: 'Success!',
							text: response.message
						}).then((result) => {
							if (result.isConfirmed) {
								$('#editProfileModal').modal('hide');
							}
						});
					} else {
						// Handle failure using Swal (SweetAlert)
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: response.message
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('Error updating profile:', error);
					// Display an error message using Swal (SweetAlert)
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Failed to update profile. Please try again.'
					});
				}
			});
		});
			// JavaScript code for old password visibility toggle
			$('#toggleOldPassword').click(function() {
				var passwordInput = $('#editOldPassword');
				var icon = $(this).find('i');
				// Toggle password visibility
				if (passwordInput.attr('type') === 'password') {
					passwordInput.attr('type', 'text');
					icon.removeClass('icon-copy ion-eye').addClass('icon-copy ion-eye-disabled');
				} else {
					passwordInput.attr('type', 'password');
					icon.removeClass('icon-copy ion-eye-disabled').addClass('icon-copy ion-eye');
				}
			});

			// JavaScript code for new password visibility toggle
			$('#toggleNewPassword').click(function() {
				var passwordInput = $('#editNewPassword');
				var icon = $(this).find('i');
				// Toggle password visibility
				if (passwordInput.attr('type') === 'password') {
					passwordInput.attr('type', 'text');
					icon.removeClass('icon-copy ion-eye').addClass('icon-copy ion-eye-disabled');
				} else {
					passwordInput.attr('type', 'password');
					icon.removeClass('icon-copy ion-eye-disabled').addClass('icon-copy ion-eye');
				}
			});
		});

			</script>