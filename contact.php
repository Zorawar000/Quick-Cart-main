<?php 
include("include/header.php");
?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h2 class="mb-4">Contact Us</h2>
      <form action="forms/contact.php" method="post" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Your Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Your Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Subject</label>
          <input type="text" name="subject" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Message</label>
          <textarea name="message" rows="5" class="form-control" required></textarea>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>
