<?php 
include("include/header.php"); 

        if(empty($_SESSION['admin_username']))
        {
            echo "<script>window.location.href = 'login.php';</script>";
            exit();
        }
        else
        {
?>

<div class="main_content_iner">
   <div class="container-fluid p-0">
      <div class="row justify-content-center">
         <div class="col-lg-8">
            <div class="white_card card_height_100 mb_30">
               <div class="white_card_header">
                  <div class="box_header m-0">
                     <div class="main-title">
                        <h3 class="m-0">Change Password</h3>
                     </div>
                  </div>
               </div>
               <div class="white_card_body">
                  <form id="change_password_form" method="POST">
                     <div class="row">
                        <div class="col-md-12 mb-3">
                           <label for="current_password" class="form-label">Current Password</label>
                           <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="col-md-12 mb-3">
                           <label for="new_password" class="form-label">New Password</label>
                           <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="col-md-12 mb-3">
                           <label for="confirm_password" class="form-label">Confirm New Password</label>
                           <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <div class="col-md-12">
                           <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#change_password_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: 'change_password_controller.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Password changed successfully!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        $('#change_password_form')[0].reset();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong!'
                });
            }
        });
    });
});
</script>

<?php include("include/footer.php"); } ?>
