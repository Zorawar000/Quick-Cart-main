<?php
include("include/header.php");

if (!isset($_GET['user_id'])) {
    echo "<div class='alert alert-danger'>Invalid Request!</div>";
    exit;
}

$id = $_GET['user_id'];
//echo($id = intval($_GET['user_id']));die;
$query = mysqli_query($connect, "SELECT * FROM `new_project_table` WHERE user_id='$id'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    echo "<div class='alert alert-warning text-center my-5'>User not found!</div>";
    include("include/footer.php");
    exit;
}
?>

<div class="main_content_iner">
   <div class="container my-4">
      <div class="card shadow-sm">
         <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User Details</h5>
            <a href="user-list.php" class="btn btn-light btn-sm">← Back</a>
         </div>
         <div class="card-body">
            <div class="row g-3">
               <div class="col-md-6">
                  <div class="border rounded p-3">
                     <h6 class="text-muted">Full Name</h6>
                     <p class="fw-bold"><?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="border rounded p-3">
                     <h6 class="text-muted">Email</h6>
                     <p class="fw-bold"><?php echo htmlspecialchars($user['email']); ?></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="border rounded p-3">
                     <h6 class="text-muted">Status</h6>
                     <?php if ($user['status']) { ?>
                        <span class="badge bg-success">Active</span>
                     <?php } else { ?>
                        <span class="badge bg-secondary">Inactive</span>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="border rounded p-3">
                     <h6 class="text-muted">Registered On</h6>
                     <p class="fw-bold"><?php echo $user['added_on'] ?? 'N/A'; ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include("include/footer.php"); ?>
