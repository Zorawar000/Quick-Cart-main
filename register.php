<?php 
 
    include("include/header.php"); 
?>
<div class="container my-5">
  <div class="row shadow-lg rounded-3 overflow-hidden">
    
    <!-- Left Part -->
    <div class="col-md-6 d-none d-md-flex bg-primary text-white flex-column justify-content-center align-items-center p-5">
      <h2 class="mb-4">Welcome Back!</h2>
      <p>Already have an account?</p>
      <a href="login1.php" class="btn btn-outline-light mt-3">Login</a>
      <!-- Optional: Add an image -->
      <!-- <img src="your-image-path.jpg" class="img-fluid mt-4" alt="Welcome Image"> -->
    </div>

    <!-- Right Part - Register Form -->
    <div class="col-md-6 bg-white p-5">
      <h3 class="mb-4 text-center">Create Your Account</h3>
      <form id="register_form" method="post" enctype="multipart/form-data">
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="user_image" class="form-label">User Image</label>
          <input type="file" name="user_image" id="user_image" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password (5 characters)</label>
          <input type="password" name="password" id="password" class="form-control" minlength="5" maxlength="5" required>
        </div>

        <div class="mb-3">
          <label for="phone_number" class="form-label">Phone Number</label>
          <input type="tel" name="phone_number" id="phone_number" class="form-control" minlength="10" maxlength="10" required>
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input type="text" name="address" id="address" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="address2" class="form-label">Address 2</label>
          <input type="text" name="address2" id="address2" class="form-control" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" id="city" class="form-control" required>
          </div>

          <div class="col-md-4 mb-3">
            <label for="state" class="form-label">State</label>
            <select name="state" id="state" class="form-select" required>
              <option selected disabled>Choose...</option>
              <option value="Andhra Pradesh">Andhra Pradesh</option>
              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
              <option value="Assam">Assam</option>
              <option value="Bihar">Bihar</option>
              <option value="Chhattisgarh">Chhattisgarh</option>
              <option value="Goa">Goa</option>
              <option value="Gujarat">Gujarat</option>
              <option value="Haryana">Haryana</option>
              <option value="Himachal Pradesh">Himachal Pradesh</option>
              <option value="Jharkhand">Jharkhand</option>
              <option value="Karnataka">Karnataka</option>
              <option value="Kerala">Kerala</option>
              <option value="Madhya Pradesh">Madhya Pradesh</option>
              <option value="Maharashtra">Maharashtra</option>
              <option value="Manipur">Manipur</option>
              <option value="Meghalaya">Meghalaya</option>
              <option value="Mizoram">Mizoram</option>
              <option value="Nagaland">Nagaland</option>
              <option value="Odisha">Odisha</option>
              <option value="Punjab">Punjab</option>
              <option value="Rajasthan">Rajasthan</option>
              <option value="Sikkim">Sikkim</option>
              <option value="Tamil Nadu">Tamil Nadu</option>
              <option value="Telangana">Telangana</option>
              <option value="Tripura">Tripura</option>
              <option value="Uttar Pradesh">Uttar Pradesh</option>
              <option value="Uttarakhand">Uttarakhand</option>
              <option value="West Bengal">West Bengal</option>

              <!-- Union Territories -->
              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
              <option value="Chandigarh">Chandigarh</option>
              <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
              <option value="Delhi">Delhi</option>
              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
              <option value="Ladakh">Ladakh</option>
              <option value="Lakshadweep">Lakshadweep</option>
              <option value="Puducherry">Puducherry</option>
              <!-- Add more -->
            </select>
          </div>

          <div class="col-md-2 mb-3">
            <label for="zip" class="form-label">Zip</label>
            <input type="text" name="zip" id="zip" class="form-control" required>
          </div>
        </div>

        <div class="d-grid mt-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
        </div>

        <p class="mt-3 text-center">
          Already have an account? <a href="login1.php" class="text-decoration-none fw-bold">Login here</a>
        </p>

      </form>
    </div>
  </div>
</div>

<?php include("include/footer.php"); ?>

<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
  $("#register_form").validate({
    rules:{
      first_name:"required",
      last_name:"required",
      user_image:"required",
      email:"required",
      password:{
        required:true,
        minlength:5,
        maxlength:5
      },    
      phone_number:{
        required:true,
        minlength:10,
        maxlength:10
      },
      address:"required",
      address2:"required",
      state:"required",
      zip:"required"
    },messages:{
      first_name:"Please Enter Your First Name",
      last_name:"Please Enter Your Last Name",
      user_image:"Please Upload Your Image",
      email:"Please Enter Your Email Id",
      
      password:{
        required:"Please Enter Your Password",
        minlength:"Password must be at least 5 characters long",
        maxlength:"Password must be a maximum of 5 characters long"
      },
      phone_number:{
        required:"Please Enter Your Phone Number",
        minlength:"Phone number must be 10 char long",
        maxlength:"Phone number must be maximum 10 char long"
      },
      address:"Please Enter Your address",
      address2:"Please Enter Your address2",
      state:"Please Enter State",
      zip:"Please Enter Zip"
    },
    submitHandler: function(form) {
      var formData = new FormData($("#register_form")[0]);

        $.ajax({
                  url: "register_controller.php",
                  type: "POST",
                  data: formData,
                  contentType: false, // Important
                  processData: false, // Important
                  success: function(msg) {
                                            if (msg == 1) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success!',
                                                    text: 'Registration successful. Redirecting to login...',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                }).then(() => {
                                                    window.location.href = "register.php";
                                                });
                                            } else if (msg.includes("Details Arlready Exists")) {
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Already Exists',
                                                    text: 'Phone number or Email already registered.',
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Registration failed. Please try again!',
                                                });
                                            }
                                          }

              });

    }
  });
</script>