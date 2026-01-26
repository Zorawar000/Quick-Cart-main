<?php 
include("include/header.php");
?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h2 class="mb-4">Contact Us</h2>
      <form id="contact_us" method="post" class="row g-3" enctype="multipart/form-data">
        <div class="col-md-6">
          <label class="form-label">Your Name</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Your Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="col-12">
          <label class="form-label">Subject</label>
          <input type="text" name="subject" id="subject" class="form-control">
        </div>
        <div class="col-12">
          <label class="form-label">Message</label>
          <textarea name="message" id="message" rows="5" class="form-control"></textarea>
        </div>
        <div class="col-12">
          <button type="submit" name="submit" id="submit" class="btn btn-primary">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include("include/footer.php"); ?>


<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
  $("#contact_us").validate({
    rules:{
      name:"required",
      email:"required",
      subject:"required",
      message:"required"
    },messages:{
      name:"Please Enter Your Name",
      email:"Please Enter Your Email",
      subject:"Please Enter Your Subject",
      message:"Please Enter Your Message"
    },
    submitHandler: function(form) {
      var formData = new FormData($("#contact_us")[0]);

        $.ajax({
                  url: "contact_controller.php",
                  type: "POST",
                  data: formData,
                  contentType: false, // Important
                  processData: false, // Important
                  success: function(msg) {
                                            if (msg == 1) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success!',
                                                    text: 'Thank you for contacting us! Your message has been sent, and we will respond as soon as possible.',
                                                    showConfirmButton: false,
                                                    timer: 5000
                                                }).then(() => {
                                                    window.location.href = "contact.php";
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    //text: 'We’re experiencing a technical issue. Please try again later!',
                                                    text: msg

                                                });
                                            }
                                          }

              });

    }
  });
</script>