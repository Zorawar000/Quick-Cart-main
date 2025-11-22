<?php


    include("db.php");
    include("new_project_class.php");

    $new_project = new new_project_work;
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Quick Cart</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="./admin/asset/img/Quick-Cart-logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


  
  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Flattern
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- for sweet alert of cart page payment method -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        
</head>

<body class="index-page">

  <!-- <header id="header" class="header sticky-top"> -->
    
  <header id="header" class="header">

    <div class="topbar d-flex align-items-center light-background">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <!-- <h1 class="sitename">Quick-Cart</h1> -->
           <img src="assets/img/Quick-Cart-logo.png" alt="" class="img-fluid" style="max-height: 150px;">
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <?php 
            // Function to check if page is active
            function isActive($page_name, $current) {
                return ($current == $page_name) ? 'active' : '';
            }
            
            // Get current page name
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>
            <li><a href="index.php" class="<?php echo isActive('index.php', $current_page); ?>">Home<br></a></li>
            <li><a href="about.php" class="<?php echo isActive('about.php', $current_page); ?>">About</a></li>
            <li><a href="contact.php" class="<?php echo isActive('contact.php', $current_page); ?>">Contact</a></li>
            <li><a href="products.php" class="<?php echo isActive('products.php', $current_page); ?>">Products</a></li>
            <?php if(!empty($_SESSION['user_id'])) { ?>
            <!-- <li><a href="mycart.php">My Cart</a></li> -->
            <li><a href="checkout.php" class="<?php echo isActive('checkout.php', $current_page); ?>">Checkout</a></li>
            <li><a href="orders.php" class="<?php echo isActive('orders.php', $current_page); ?>">My Orders</a></li>
            <!-- <li><a href="myaccount.php">My Account</a></li> -->
            <?php } ?>
            <li>
                <?php 
                
                    if(!empty($_SESSION['user_id']))
                    {
                      $cart_count_select = "SELECT * FROM `my_cart` WHERE user_id = '".$_SESSION['user_id']."'";
                      $cart_count_query = mysqli_query($connect,$cart_count_select);
                      $cart_count_num_row = mysqli_num_rows($cart_count_query);
                        /* echo '<a href="logout.php" class="nav-link">Logout</a>'; */
                        echo '<li class="dropdown"><a href="#"><span> Account </span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                  <li class="dropdown"><a href="#"><span> My Account </span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                    <ul>
                                      <li><a href="#">My Profile</a></li>
                                      <li><a href="#">Edit Profile</a></li>
                                      <li><a href="#">Change Password</a></li>
                                      <li><a href="logout.php">Log out</a></li>
                                    </ul>
                                  </li>
                                </ul>
                              </li>';
                              
                              $cart_active = isActive('mycart.php', $current_page);
                              if($cart_count_num_row) {echo '<li><a href="mycart.php" class="'.$cart_active.'">Cart (<span id="cart_count">'.$cart_count_num_row.'</span>)</a></li>' ;}
                              else {echo '<li><a href="mycart.php" class="'.$cart_active.'">Cart (<span id="cart_count">0</span>)</a></li>' ;}
                              $notif_active = isActive('notification.php', $current_page);
                              echo '<li class="dropdown notification-icon"><a href="notification.php" class="'.$notif_active.'"><i class="bi bi-bell"></i></a></li>';
                    }
                    else
                    { 
                        $login_active = isActive('login1.php', $current_page);
                        $register_active = isActive('register.php', $current_page);
                        echo'<li><a href="login1.php" class="'.$login_active.'">Login</a></li>
                            <li><a href="register.php" class="'.$register_active.'">Register</a></li>';
                    }
                ?>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- Notification Icon -->
        <!-- <div class="notification-icon">
          <a href="notifications.php"><i class="bi bi-bell"></i></a>
        </div> -->
        <!-- End Notification Icon -->

      </div>

    </div>

  </header>
