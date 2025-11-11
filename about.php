<?php 
include("include/header.php");
?>

<div class="container py-5">
  <div class="row align-items-center justify-content-center">
    <!-- Left: Image / illustration -->
    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0 text-center">
      <img src="assets/img/Quick-Cart-1.png" 
           alt="Quick Cart" 
           class="img-fluid rounded-3 shadow-sm" 
           style="max-width: 280px;">
    </div>

    <!-- Right: About content -->
    <div class="col-lg-7 col-md-10">
      <div class="card border-0 shadow-sm p-4">
        <h2 class="text-primary fw-bold mb-3">
          <i class="bi bi-cart-check"></i> About <span class="text-dark">Quick-Cart</span>
        </h2>
        <p class="text-muted lead">
          Quick-Cart is a lightweight and modern e-commerce platform built using 
          <strong>PHP</strong> and <strong>MySQL</strong>. It allows customers to browse 
          products, add them to the cart, and securely place orders — all with an elegant and 
          responsive interface powered by <strong>Bootstrap 5</strong>.
        </p>
        <p class="text-secondary mb-4">
          This page is a placeholder. You can easily customize it with your own business 
          details, mission statement, or contact information to give your customers a better 
          understanding of what your brand stands for.
        </p>
        <a href="products.php" class="btn btn-primary btn-lg px-4">
          <i class="bi bi-shop"></i> Browse Products
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Optional testimonial or callout section -->
<div class="bg-light py-5 mt-5">
  <div class="container text-center">
    <h4 class="fw-bold text-primary mb-3">Why Choose Quick-Cart?</h4>
    <p class="text-muted mb-4">
      Fast, user-friendly, and built with modern web technologies — perfect for showcasing your products online.
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <div class="card border-0 shadow-sm p-3" style="width: 15rem;">
        <i class="bi bi-speedometer2 text-primary fs-1 mb-2"></i>
        <h6 class="fw-bold">Fast Performance</h6>
        <p class="small text-muted mb-0">Optimized code for quick loading and seamless browsing.</p>
      </div>
      <div class="card border-0 shadow-sm p-3" style="width: 15rem;">
        <i class="bi bi-phone text-primary fs-1 mb-2"></i>
        <h6 class="fw-bold">Fully Responsive</h6>
        <p class="small text-muted mb-0">Looks great on desktops, tablets, and mobile devices.</p>
      </div>
      <div class="card border-0 shadow-sm p-3" style="width: 15rem;">
        <i class="bi bi-lock text-primary fs-1 mb-2"></i>
        <h6 class="fw-bold">Secure Checkout</h6>
        <p class="small text-muted mb-0">Reliable system to ensure safe order processing.</p>
      </div>
    </div>
  </div>
</div>

<?php include("include/footer.php"); ?>
