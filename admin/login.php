<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Quick Cart - Admin Login</title>
    <link rel="icon" href="./asset/img/Quick-Cart-logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0">
        <div class="card-body p-5">
          <h2 class="text-center mb-4 fw-bold text-primary">Admin Login</h2>

          <span id="msgform" class="text-danger mb-3 d-block text-center"></span>

          <form method="post" name="admin_login_form" id="admin_login_form">

            <div class="mb-3">
              <label for="username" class="form-label fw-semibold">Username or Email</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Enter username or email">
            </div>

            
            <input type="hidden" name="processuser" value="1">

            <div class="mb-4">
              <label for="password" class="form-label fw-semibold">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary btn-block fw-bold">Login</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
    $("#admin_login_form").validate({
      rules:{
        username: {
          required: true
        },
        password:{ 
          required:true, 
          minlength:5,
        }
      },
      messages:{
        username:{
          required:"Please enter username or email"
        },
        password:{ 
          required:"Please enter your password", 
          minlength:"Minimum 5 characters",
        }
      },
      submitHandler: function(form) {
        var str = $("#admin_login_form").serialize();
        $.ajax({
          url:"admin_login_controller.php",
          type:"POST",
          data:str,
          success:function(msg){
            //alert(msg);
            if(msg==1){
              window.location.href = "index.php";
            }else{
              $("#msgform").text("Invalid username/email or password.");
            }
          }
        });
      }
    });
</script>
</body>
</html>

