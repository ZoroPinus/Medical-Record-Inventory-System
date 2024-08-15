<div class="modal fade" id="editUserModal-<?php echo $userId ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <!-- Add your form fields for editing user information -->
            <form action="model/users/edit_.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $userId ?>">
                <div class="form-group">
                    <label for="editFirstName">First Name</label>
                    <input type="text" class="form-control" id="editFirstName" name="editFirstName" value="<?php echo $firstName ?>">
                </div>
                <div class="form-group">
                    <label for="editLastName">Last Name</label>
                    <input type="text" class="form-control" id="editLastName" name="editLastName" value="<?php echo $lastName ?>">
                </div>
                <div class="form-group">
                    <label for="editEmail">Email</label>
                    <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?php echo $email ?>">
                </div>
                <!-- Add more fields as needed -->

                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
