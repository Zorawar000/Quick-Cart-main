<?php
    include("../db.php");
    include("./AdminFunctions.php");

    $admin = new AdminFunctions;
?>


<!DOCTYPE html>
<html lang="zxx">
   <!-- Mirrored from demo.dashboardpack.com/sales-html/index_3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Apr 2023 14:08:07 GMT -->
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <title>Quick Cart</title>
      <link rel="icon" href="./asset/img/Quick-Cart-logo.png" type="image/png">
      <link rel="stylesheet" href="./asset/css/bootstrap1.min.css" />
      <?php include("include/links.php"); ?>
   </head>
   <body class="crm_body_bg">      
      <nav class="sidebar vertical-scroll dark_sidebar  ps-container ps-theme-default ps-active-y">
         <div class="logo d-flex justify-content-between">
            <a href="index.php"><img src="./asset/img/Quick-Cart-logo.png" alt></a>
            <div class="sidebar_close_icon d-lg-none">
               <i class="ti-close"></i>
            </div>
         </div>
         <ul id="sidebar_menu">
            <li class>
               <a href="index.php" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/7.svg" alt>
                  </div>
                  <span>Dashboard</span>
               </a>
            </li>
            <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/2.svg" alt>
                  </div>
                  <span>Admin</span>
               </a>
               <ul>
                  <li><a href="change-password.php">Change Passwrod</a></li>
               </ul>
            </li>
            <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/2.svg" alt>
                  </div>
                  <span>Categories</span>
               </a>
               <ul>
                  <li><a href="add-categories.php">Add Categories</a></li>
                  <li><a href="view-categories.php">View Categories</a></li>
                  <li><a href="add-sub-categories.php">Add Sub Categories</a></li>
                  <li><a href="view-sub-categories.php">View Sub Categories</a></li>
               </ul>
            </li>
            <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/8.svg" alt>
                  </div>
                  <span>Products</span>
               </a>
               <ul>
                  <li><a href="add-products.php">Add Products</a></li>
                  <li><a href="view-products.php">View Products</a></li>
               </ul>
            </li>
            <!-- <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/2.svg" alt>
                  </div>
                  <span>Customers</span>
               </a>
               <ul>
                  <li><a href="editor.html">editor</a></li>
                  <li><a href="mail_box.html">Mail Box</a></li>
                  <li><a href="chat.html">Chat</a></li>
                  <li><a href="faq.html">FAQ</a></li>
               </ul>
            </li> -->
            <!-- <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/2.svg" alt>
                  </div>
                  <span>Invoices</span>
               </a>
               <ul>
                  <li><a href="editor.html">editor</a></li>
                  <li><a href="mail_box.html">Mail Box</a></li>
                  <li><a href="chat.html">Chat</a></li>
                  <li><a href="faq.html">FAQ</a></li>
               </ul>
            </li> -->
            <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/8.svg" alt>
                  </div>
                  <span>Order</span>
               </a>
               <ul>
                  <li><a href="orders.php">Orders List</a></li>
                  <!-- <li><a href="themefy_icon.html">themefy icon</a></li> -->
               </ul>
            </li>
            <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/9.svg" alt>
                  </div>
                  <span>Users</span>
               </a>
               <ul>
                  <li><a href="user-list.php">User List</a></li>
               </ul>
            </li>
            
            <li class>
               <a class="has-arrow" href="#" aria-expanded="false">
                  <div class="icon_menu">
                     <img src="./asset/img/menu-icon/2.svg" alt>
                  </div>
                  <span>Banner</span>
               </a>
               <ul>
                  <li><a href="add-banner.php">Add Banner</a></li>
                  <li><a href="view-banner.php">View Banner</a></li>
               </ul>
            </li>
         </ul>
      </nav>
      <section class="main_content dashboard_part large_header_bg">
         <div class="container-fluid g-0">
            <div class="row">
               <div class="col-lg-12 p-0 ">
                  <div class="header_iner d-flex justify-content-between align-items-center">
                     <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                     </div>
                     <div class="serach_field-area d-flex align-items-center">
                        <div class="search_inner">
                           <form action="#">
                              <div class="search_field">
                                 <input type="text" placeholder="Search here...">
                              </div>
                              <button type="submit"> <img src="asset/img/icon/icon_search.svg" alt> </button>
                           </form>
                        </div>
                        <span class="f_s_14 f_w_400 ml_25 white_text text_white">Apps</span>
                     </div>
                     <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                           <li>
                              <a class="bell_notification_clicker nav-link-notify" href="#"> <img src="asset/img/icon/bell.svg" alt>
                              </a>
                              <div class="Menu_NOtification_Wrap">
                                 <div class="notification_Header">
                                    <h4>Notifications</h4>
                                 </div>
                                 <div class="Notification_body">
                                    <div class="single_notify d-flex align-items-center">
                                       <div class="notify_thumb">
                                          <a href="#"><img src="asset/img/staf/2.png" alt></a>
                                       </div>
                                       <div class="notify_content">
                                          <a href="#">
                                             <h5>Cool Marketing </h5>
                                          </a>
                                          <p>Lorem ipsum dolor sit amet</p>
                                       </div>
                                    </div>
                                    <div class="single_notify d-flex align-items-center">
                                       <div class="notify_thumb">
                                          <a href="#"><img src="asset/img/staf/4.png" alt></a>
                                       </div>
                                       <div class="notify_content">
                                          <a href="#">
                                             <h5>Awesome packages</h5>
                                          </a>
                                          <p>Lorem ipsum dolor sit amet</p>
                                       </div>
                                    </div>
                                    <div class="single_notify d-flex align-items-center">
                                       <div class="notify_thumb">
                                          <a href="#"><img src="asset/img/staf/3.png" alt></a>
                                       </div>
                                       <div class="notify_content">
                                          <a href="#">
                                             <h5>what a packages</h5>
                                          </a>
                                          <p>Lorem ipsum dolor sit amet</p>
                                       </div>
                                    </div>
                                    <div class="single_notify d-flex align-items-center">
                                       <div class="notify_thumb">
                                          <a href="#"><img src="asset/img/staf/2.png" alt></a>
                                       </div>
                                       <div class="notify_content">
                                          <a href="#">
                                             <h5>Cool Marketing </h5>
                                          </a>
                                          <p>Lorem ipsum dolor sit amet</p>
                                       </div>
                                    </div>
                                    <div class="single_notify d-flex align-items-center">
                                       <div class="notify_thumb">
                                          <a href="#"><img src="asset/img/staf/4.png" alt></a>
                                       </div>
                                       <div class="notify_content">
                                          <a href="#">
                                             <h5>Awesome packages</h5>
                                          </a>
                                          <p>Lorem ipsum dolor sit amet</p>
                                       </div>
                                    </div>
                                    <div class="single_notify d-flex align-items-center">
                                       <div class="notify_thumb">
                                          <a href="#"><img src="asset/img/staf/3.png" alt></a>
                                       </div>
                                       <div class="notify_content">
                                          <a href="#">
                                             <h5>what a packages</h5>
                                          </a>
                                          <p>Lorem ipsum dolor sit amet</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="nofity_footer">
                                    <div class="submit_button text-center pt_20">
                                       <a href="#" class="btn_1">See More</a>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <a class="CHATBOX_open nav-link-notify" href="#"> <img src="asset/img/icon/msg.svg" alt> </a>
                           </li>
                        </div>
                        <div class="profile_info">
                           <img src="asset/img/client_img.png" alt="#">
                           <div class="profile_info_iner">
                              <div class="profile_author_name">
                                 <p>Administrator</p>
                                 <h5><?php echo $_SESSION['admin_full_name']; ?></h5>
                              </div>
                              <div class="profile_info_details">
                                 <a href="admin_profile.php">My Profile </a>
                                 <a href="#">Settings</a>
                                 <a href="logout.php">Log Out </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>