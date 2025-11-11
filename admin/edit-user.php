<?php
include("include/header.php");

if (!isset($_GET['user_id'])) {
    echo "<div class='alert alert-danger'>Invalid Request!</div>";
    exit;
}

$id = $_GET['user_id'];
$query = mysqli_query($connect, "SELECT * FROM `new_project_table` WHERE user_id='$id'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo "<div class='alert alert-warning text-center my-5'>User not found!</div>";
    include("include/footer.php");
    exit;
}

// ✅ Update Logic
if (isset($_POST['update_user'])) {
    $fname  = mysqli_real_escape_string($connect, $_POST['first_name']);
    $lname  = mysqli_real_escape_string($connect, $_POST['last_name']);
    $email  = mysqli_real_escape_string($connect, $_POST['email']);
    $status = ($_POST['status'] === 't') ? 't' : 'f'; // ensure only t or f

    $update = "UPDATE `new_project_table` SET 
                first_name='$fname',
                last_name='$lname',
                email='$email',
                status='$status'
               WHERE user_id='$id'";

    if (mysqli_query($connect, $update)) {
        echo "<script>alert('User updated successfully!'); window.location='user-list.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error updating user!</div>";
    }
}
?>

<div class="main_content_iner">
   <div class="container my-4">
      <div class="card shadow-sm">
         <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Edit User</h5>
            <a href="user_list.php" class="btn btn-light btn-sm">← Back</a>
         </div>
         <div class="card-body">
            <form method="POST">
               <div class="row g-3">
                  <div class="col-md-6">
                     <label class="form-label">First Name</label>
                     <input type="text" name="first_name" class="form-control" required 
                            value="<?php echo htmlspecialchars($user['first_name']); ?>">
                  </div>
                  <div class="col-md-6">
                     <label class="form-label">Last Name</label>
                     <input type="text" name="last_name" class="form-control" required 
                            value="<?php echo htmlspecialchars($user['last_name']); ?>">
                  </div>
                  <div class="col-md-12">
                     <label class="form-label">Email</label>
                     <input type="email" name="email" class="form-control" required 
                            value="<?php echo htmlspecialchars($user['email']); ?>">
                  </div>

                  <!-- ✅ Status Dropdown -->
                  <div class="col-md-12">
                     <label class="form-label">Status</label>
                     <select name="status" class="form-select">
                        <option value="t" <?php echo ($user['status'] == 't') ? 'selected' : ''; ?>>Active</option>
                        <option value="f" <?php echo ($user['status'] == 'f') ? 'selected' : ''; ?>>Deactive</option>
                     </select>
                  </div>

                  <div class="col-12 text-center mt-3">
                     <button type="submit" name="update_user" class="btn btn-success px-4">Update</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<?php include("include/footer.php"); ?>
