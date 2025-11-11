<?php
  include("include/header.php");

  $admin_profile = $admin->getAdminProfile($connect);
?>

<div class="bg-light py-4 min-vh-100">

  <!-- 🔹 Page Title Section -->
  <div class="container mb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
      <h3 class="fw-bold text-dark mb-2 mb-md-0">
        <i class="bi bi-person-circle me-2 text-primary"></i>My Profile
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-primary">Dashboard</a></li>
          <li class="breadcrumb-item active text-dark" aria-current="page">My Profile</li>
        </ol>
      </nav>
    </div>
    <hr class="mt-3">
  </div>

  <!-- 🔹 Profile Card -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">

        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
          
          <!-- Profile Header Section -->
          <div class="bg-primary text-white text-center p-4">
            <div class="mb-3">
              <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
            </div>
            <h4 class="fw-bold mb-0"><?php echo htmlspecialchars($admin_profile['full_name']); ?></h4>
            <small class="text-white-50"><?php echo htmlspecialchars($admin_profile['email']); ?></small>
          </div>

          <!-- Profile Info -->
          <div class="card-body p-4">

            <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">
              <i class="bi bi-info-circle me-2 text-primary"></i>Account Details
            </h5>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Admin ID</label>
              <p class="form-control bg-white border border-secondary-subtle text-dark">
                <?php echo htmlspecialchars($admin_profile['admin_id']); ?>
              </p>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Full Name</label>
              <p class="form-control bg-white border border-secondary-subtle text-dark">
                <?php echo htmlspecialchars($admin_profile['full_name']); ?>
              </p>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold text-dark">Email Address</label>
              <p class="form-control bg-white border border-secondary-subtle text-dark">
                <?php echo htmlspecialchars($admin_profile['email']); ?>
              </p>
            </div>

            <div class="text-center mt-4">
              <a href="change-password.php" class="btn btn-primary px-4 rounded-pill">
                <i class="bi bi-lock me-2"></i>Change Password
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include("include/footer.php"); ?>
