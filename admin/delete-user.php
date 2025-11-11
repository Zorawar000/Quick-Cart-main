<?php
include("include/header.php");

if (!isset($_GET['user_id'])) {
    echo "<div class='alert alert-danger text-center my-5'>Invalid request!</div>";
    include("include/footer.php");
    exit;
}

$id = $_GET['user_id'];
//$id = intval($_GET['user_id']);
$query = mysqli_query($connect, "SELECT * FROM `new_project_table` WHERE user_id='$id'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo "<div class='alert alert-warning text-center my-5'>User not found!</div>";
    include("include/footer.php");
    exit;
}

// Delete Logic
if (isset($_POST['confirm_delete'])) {
    $delete = mysqli_query($connect, "DELETE FROM `new_project_table` WHERE user_id='$id'");
    if ($delete) {
        echo "<script>alert('User deleted successfully!'); window.location='user-list.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Error deleting user!</div>";
    }
}
?>

<div class="main_content_iner">
   <div class="container my-5">
      <div class="card shadow-sm border-danger">
         <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Delete User</h5>
         </div>
         <div class="card-body text-center">
            <p class="fs-5">Are you sure you want to delete <strong><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></strong>?</p>
            <form method="POST">
               <button type="submit" name="confirm_delete" class="btn btn-danger me-2">Yes, Delete</button>
               <a href="user-list.php" class="btn btn-secondary">Cancel</a>
            </form>
         </div>
      </div>
   </div>
</div>

<?php include("include/footer.php"); ?>
