<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <script>
        $(document).ready(function(){
            $("#submit").click(function(){
                var user = $("#username").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var pass = $("#password").val();

                if(user == "")
                {
                    $("#show_error").html("Enter Your Name");
                    return false;
                }
                else if((user.length<=3)||(user.length>=25))
                {
                    $("#show_error").html("**The username must be at least 4 character and maximum 25 character");
                    return false;
                }
                if(email == "")
                {
                    $("#show_error").html("Enter Your Email");
                    return false;
                }
                else if((email.length<10)||(email.length>20))
                {
                    $("#show_error").html("**The email between 10 and 20 numbers");
                    return false;
                }
                if(phone == "")
                {
                    $("#show_error").html("Enter Your Phone Number");
                    return false;
                }
                else if((phone.length>10)||(phone.length<10))
                {
                    $("#show_error").html("**The numbers should be 10 digits");
                    return false;
                }
                if(pass == "")
                {
                    $("#show_error").html("Enter Your Password");
                    return false;
                }
                else if((pass.length<1)||(pass.length>5))
                {
                    $("#show_error").html("**The password between 1 and 4 numbers");
                    return false;
                }
            });
        });
    </script>
    <body>
        <form class="form" id="form" method="post" action="">
            
            <div id="show_error"></div>
            <div>
                <label>Name</label>
                <p><input type="text" name="username" id="username" value=""></p>
            </div>
            <div>
                <label>Email</label>
                <p><input type="text" name="email" id="email" value=""></p>
            </div>
            <div>
                <label>Phone</label>
                <p><input type="text" name="phone" id="phone" value=""></p>
            </div>
            <div>
                <label>Password</label>
                <p><input type="text" name="password" id="password" value=""></p>
            </div>
            <div>
                <p><input type="submit" name="submit" id="submit" value="submit"></p>
            </div>
        </form>
    </body>
</html>