<?php 
 
    include("include/header.php"); 
?>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0">
        <div class="card-body p-5">
          <h2 class="text-center mb-4 fw-bold text-primary">Login to Your Account</h2>

          <span id="msgform" class="text-danger mb-3 d-block text-center"></span>

          <form method="post" name="login_form" id="login_form">

            <div class="mb-3">
              <label for="email" class="form-label fw-semibold">Email address</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
            </div>

            <input type="hidden" name="processuser" value="1">

            <div class="mb-4">
              <label for="password" class="form-label fw-semibold">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary btn-block fw-bold">Login</button>
            </div>

            <p class="text-center mt-3">
              Don't have an account?
              <a href="register.php" class="text-decoration-none fw-bold text-primary">Register here</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include("include/footer.php"); ?>

<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
  $("#login_form").validate({
    rules:{
      email:{
        required:true,
        email:true
      },
      password:{
        required:true,
        minlength:5,
        maxlength:5
      }
    },
    messages:{
      email:{
        required:"Please Enter Your Email",
        email:"Please Enter a Valid Email"
      },
      password:{
        required:"Please Enter Your Password",
        minlength:"Password must be 5 char long",
        maxlength:"Password must be 5 char long"
      }
    },
    submitHandler: function(form) {
      var str = $("#login_form").serialize();
        $.ajax({
          url:"test_for_login1.php",
          type:"POST",
          data:str,
          success:function(msg)
          {
            if(msg==1) {
              window.location.href = "myaccount.php";
            } else {
              $("#msgform").text("Invalid email or password.");
            }
          }
        });
    }
  });
</script>
