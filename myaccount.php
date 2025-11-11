<?php 

        include("include/header.php");

        if(empty($_SESSION['user_id']))
        {
            echo "<script>window.location.href = 'login1.php';</script>";
            exit();
        }
        else
        {
            //$notification_insert = $new_project->notification_insert($connect);
            $myaccount = $new_project->select_user_data($connect);

?>


    <div class="row border-top px-xl-5 my-3">
        <?php include("include/myaccount_dashboard.php"); ?>
        <div class="col-lg-9">
            <div class="myaccount">
                <div class="container">
                    <div class="row gutters align-items-start">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="account-settings">
                                        <div class="user-profile">
                                            <div class="user-avatar">
                                                <img src="uploads/<?php echo htmlspecialchars($myaccount['user_image']);?>" name="user_image" id="user_image" alt="Maxwell Admin">
                                            </div>
                                            <h5 class="user-name"><?php echo htmlspecialchars($myaccount['first_name']); ?></h5>
                                            <h6 class="user-email"><?php echo htmlspecialchars($myaccount['email']); ?></h6>
                                        </div>
                                        <div class="myaccount_about">
                                            <h5>About</h5>
                                            <p>I'm <?php echo htmlspecialchars($myaccount['first_name']); ?>. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mb-2 text-primary">Personal Details</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo htmlspecialchars($myaccount['first_name']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo htmlspecialchars($myaccount['last_name']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($myaccount['email']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="phone_number">Phone</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($myaccount['phone_number']); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="mt-3 mb-2 text-primary">Address</h6>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="address">Address 1</label>
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($myaccount['address']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="address2">Address 2</label>
                                                <input type="text" class="form-control" id="address2" name="address2" value="<?php echo htmlspecialchars($myaccount['address2']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($myaccount['city']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" id="state" name="state" value="<?php echo htmlspecialchars($myaccount['state']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="zip">Zip Code</label>
                                                <input type="text" class="form-control" id="zip" name="zip" value="<?php echo htmlspecialchars($myaccount['zip']); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("include/footer.php"); }?>