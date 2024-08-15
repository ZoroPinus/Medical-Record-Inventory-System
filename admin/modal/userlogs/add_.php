<div class="modal fade" id="addUserLogModal" tabindex="-1" role="dialog" aria-labelledby="addUserLogModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserLogModalLabel">Add User Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form for adding a user log -->
        <form id="addUserLogForm">
          <div class="form-group">
            <label for="userId">User ID</label>
            <input type="text" class="form-control" id="userId" name="userId" placeholder="Enter User ID" oninput="formatIdNumber(this)" onkeypress="return isNumberKey(event)" required>
          </div>
          <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
          </div>
          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
          </div>
          <div class="form-group">
            <label for="time">Time</label>
            <input type="time" class="form-control" id="time" name="time" placeholder="Enter Time" required>
          </div>
          <div class="form-group">
            <label for="departmentOffice">Department/Office</label>
            <input type="text" class="form-control" id="departmentOffice" name="departmentOffice" placeholder="Enter Department/Office" required>
          </div>
          <div class="form-group">
            <label for="reason">Reason</label>
            <textarea class="form-control" id="reason" name="reason" placeholder="Enter Reason" required></textarea>
          </div>
          <button type="submit" id="submitForm" class="btn btn-primary">Add User Log</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#userId').on('change', function() {
      var userId = $(this).val();
      if (userId) {
        // AJAX request to check if the user exists in the teacher table
        $.ajax({
          url: 'model/users/get_.php', // Adjust the URL to the teacher check script
          type: 'POST',
          data: {
            userId: userId
          },
          dataType: 'json',
          success: function(response) {
            console.log(response)
            $('#firstName').val(response.FirstName);
            $('#lastName').val(response.LastName);
          },
          error: function() {
            alert('An error occurred');
          }
        });
      }
    });
  });
</script>

<!-- <script>
  $(document).ready(function() {
    $('#userId').on('change', function() {
      var userId = $(this).val();
      if (userId) {
        // AJAX request to check if the user exists in the teacher table
        $.ajax({
          url: 'model/teacher/check_.php', // Adjust the URL to the teacher check script
          type: 'POST',
          data: {
            userId: userId
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              // Teacher found, populate form fields with teacher data
              $('#firstName').val(response.data.firstName);
              $('#lastName').val(response.data.lastName);
              // Other fields can be populated similarly
            } else {
              // If not found in teacher table, check the student table
              $.ajax({
                url: 'model/student/check_.php', // Adjust the URL to the student check script
                type: 'POST',
                data: {
                  userId: userId
                },
                dataType: 'json',
                success: function(response) {
                  if (response.success) {
                    // Student found, populate form fields with student data
                    $('#firstName').val(response.data.firstName);
                    $('#lastName').val(response.data.lastName);
                    // Other fields can be populated similarly
                  } else {
                    // If not found in either table, display an alert
                    alert('User not found');
                  }
                },
                error: function() {
                  alert('An error occurred');
                }
              });
            }
          },
          error: function() {
            alert('An error occurred');
          }
        });
      }
    });
  });
</script> -->