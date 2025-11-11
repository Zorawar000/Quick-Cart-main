<?php 
include("include/header.php");

if(empty($_SESSION['user_id'])) {
    echo "<script>window.location.href = 'login1.php';</script>";
    exit();
}
?>

<form method="post" name="change_password_form" id="change_password_form">
    <div class="row border-top px-xl-5 my-3">
        <?php include("include/myaccount_dashboard.php"); ?>
        <div class="col-lg-9">
            <div class="myaccount">
                <div class="container">
                    <div class="row gutters">
                        <div class="col-xl-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="mb-3 text-primary">Change Password</h6>

                                    <div class="form-group">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password">
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include("include/footer.php"); ?>

<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#change_password_form').validate({
        errorClass: "text-danger",
        rules:{
            old_password:"required",
            new_password:"required",
            confirm_password:{
                required:true,
                equalTo:"#new_password"
            }
        },
        messages:{
            old_password:"Please enter old password",
            new_password:"Please enter new password",
            confirm_password:{
                required:"Please confirm your new password",
                equalTo:"New and confirm password must match"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: "change_password_controller.php",
                type: "POST",
                data: $('#change_password_form').serialize(),
                success: function(response) {
                    if(response === 'Password updated successfully') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Password changed successfully.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "myaccount.php";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response
                        });
                    }
                }
            });
        }
    });
</script>
