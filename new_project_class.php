<?php



        class new_project_work
        {
            public function new_project_register($connect)
            {
                $first_name = mysqli_real_escape_string($connect,$_POST['first_name']);
                $last_name = mysqli_real_escape_string($connect,$_POST['last_name']);
                $email = mysqli_real_escape_string($connect,$_POST['email']);
                $password_raw  = $_POST['password'];
                $password = password_hash($password_raw, PASSWORD_DEFAULT);
                $phone_number = mysqli_real_escape_string($connect,$_POST['phone_number']);
                $address = mysqli_real_escape_string($connect,$_POST['address']);
                $address2 = mysqli_real_escape_string($connect,$_POST['address2']);
                $city = mysqli_real_escape_string($connect,$_POST['city']);
                $state = mysqli_real_escape_string($connect,$_POST['state']);
                $zip = mysqli_real_escape_string($connect,$_POST['zip']);
                $added_on = date('M d, Y');
                $status = 1;


                $user_image = $_FILES['user_image']['name'];
                $target_file = "./uploads/$user_image";

                move_uploaded_file($_FILES['user_image']['tmp_name'], $target_file);




                $register_select = "SELECT *FROM new_project_table WHERE phone_number = '".$phone_number."' or email = '".$email."'";


                $register_query = mysqli_query($connect,$register_select);
                $register_num = mysqli_num_rows($register_query);

                if($register_num>0)
                {
                    echo 'Details Arlready Exists';
                }
                else
                {
                    $register_select1 = "SELECT *FROM new_project_table ORDER BY id DESC LIMIT 1";
                    $register_query1 = mysqli_query($connect,$register_select1);
                    $register_fetch = mysqli_fetch_array($register_query1);

                    if($register_fetch['user_id']!="")
                    {
                        $last_user_id = $register_fetch['user_id'];
                        $new_user_id = str_replace("User","",$last_user_id);
                        $new_user_id++;
                        $new_user_id = "User".$new_user_id;


                        $register_insert = "INSERT INTO `new_project_table`(`user_id`,`first_name`,`last_name`,`user_image`,`email`,`password`,`phone_number`,`address`,`address2`,`city`,`state`,`zip`,`added_on`,`status`) VALUES('".$new_user_id."','".$first_name."','".$last_name."','".$user_image."','".$email."','".$password."','".$phone_number."','".$address."','".$address2."','".$city."','".$state."','".$zip."','".$added_on."','".$status."')";

                        $register_sql = mysqli_query($connect,$register_insert);
                        
                        if($register_sql)
                        {
                            echo 1;
                        }
                        else
                        {
                            echo 0;
                        }
                    }
                    else
                    {
                        $new_user_id = "User1000";
                        $register_insert = "INSERT INTO `new_project_table`(`user_id`,`first_name`,`last_name`,`user_image`,`email`,`password`,`phone_number`,`address`,`address2`,`city`,`state`,`zip`,`status`) VALUES('".$new_user_id."','".$first_name."','".$last_name."','".$user_image."','".$email."','".$password."','".$phone_number."','".$address."','".$address2."','".$city."','".$state."','".$zip."','".$status."')";

                        $register_sql = mysqli_query($connect,$register_insert);
                        
                        if($register_sql)
                        {
                            echo 1;
                        }
                        else
                        {
                            echo 0;
                        }
                    }
                }
            }
            public function new_project_login($connect)
            {
                $email = mysqli_real_escape_string($connect,$_POST['email']);
                $password = $_POST['password'];
                $select = "select * from `new_project_table` where email = '".$email."'";
                $resselect = mysqli_query($connect,$select);
                $numrow = mysqli_num_rows($resselect);
                if($numrow>0)
                {
                    $row = mysqli_fetch_array($resselect);

                    if (password_verify($password, $row['password'])) 
                    {

                        $full_name = $row['first_name']." ".$row['last_name'];
                        $user_id = $row['user_id'];
                        $password = $row['password'];
                        $last_login = date("Y-m-d H:i:s");

                        $login_insert = "INSERT INTO `last_login_logout_table`(`user_id`,`full_name`,`password`,`last_login`) VALUES('".$user_id."','".$full_name."','".$password."','".$last_login."')";

                        $login_query = mysqli_query($connect,$login_insert);
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['user_id'] = $row['user_id'];
                        echo 1;
                    } 
                    else 
                    {
                        echo 0; // Incorrect password
                    }

                    
                    $notification_insert = "INSERT INTO `notification_table`(`user_id`) VALUES('".$_SESSION['user_id']."')";
                    mysqli_query($connect,$notification_insert);
                }
                else
                {
                    echo 0;
                }
            }
            public function select_user_data($connect)
            {
                $select ="select *from `new_project_table` where user_id = '".$_SESSION['user_id']."'";
                $reselect = mysqli_query($connect,$select);
                $numrow = mysqli_num_rows($reselect);
                if($numrow)
                {
                    
                    $row = mysqli_fetch_array($reselect);
                    return $row;
                }
                else
                {
                    return 0;
                }
            }
            public function select_data_user_login($connect)
            {
                $select_last_login="SELECT  * FROM `new_project_table` LEFT JOIN `last_login_logout_table` on new_project_table.user_id=last_login_logout_table.user_id WHERE new_project_table.user_id = '".$_SESSION['user_id']."'";
                
                $last_login_query = mysqli_query($connect,$select_last_login);
                $numrow = mysqli_num_rows($last_login_query);
                if($numrow)
                {
                    
                    $row = mysqli_fetch_assoc($last_login_query);
                    return $row;
                }
                else
                {
                    return 0;
                }
            }
            public function last_logout_update($connect)
            {
                $last_login = date("Y-m-d H:i:s");
                $last_logout = date("Y-m-d H:i:s");

                $last_logout_update = "UPDATE last_login_logout_table SET 
                last_login = '$last_login', 
                last_logout = '$last_logout' 
                WHERE user_id = '".$_SESSION['user_id']."'";

                $last_login_query = mysqli_query($connect,$last_logout_update);
            }

            public function new_project_update($connect)
            {
                $first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
                $last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
                $email = mysqli_real_escape_string($connect, $_POST['email']);
                $phone_number = mysqli_real_escape_string($connect, $_POST['phone_number']);
                $address = mysqli_real_escape_string($connect, $_POST['address']);
                $address2 = mysqli_real_escape_string($connect, $_POST['address2']);
                $city = mysqli_real_escape_string($connect, $_POST['city']);
                $state = mysqli_real_escape_string($connect, $_POST['state']);
                $zip = mysqli_real_escape_string($connect, $_POST['zip']);

                // Pehle existing user ka image fetch karte hain
                $select = "SELECT * FROM new_project_table WHERE user_id = '" . $_SESSION['user_id'] . "'";
                $select_query = mysqli_query($connect, $select);
                $select_fetch = mysqli_fetch_array($select_query);

                // File upload simple waise hi jaise register mein
                $user_image = isset($_FILES['user_image']['name']) ? $_FILES['user_image']['name'] : '';

                if ($user_image != "") {
                    $target_file = "./uploads/$user_image";
                    move_uploaded_file($_FILES['user_image']['tmp_name'], $target_file);
                } else {
                    $user_image = $select_fetch['user_image'];
                }

                // Escape kar rahe hain user_image bhi (thoda extra safe rehne ke liye)
                $user_image = mysqli_real_escape_string($connect, $user_image);

                $update = "UPDATE `new_project_table` SET 
                            `first_name`='$first_name', 
                            `last_name`='$last_name', 
                            `user_image`='$user_image', 
                            `email`='$email', 
                            `phone_number`='$phone_number', 
                            `address`='$address', 
                            `address2`='$address2', 
                            `city`='$city', 
                            `state`='$state', 
                            `zip`='$zip' 
                        WHERE user_id = '" . $_SESSION['user_id'] . "'";

                $update_query = mysqli_query($connect, $update);

                $display = 1;
                $title = "Profile Update Notification";
                $description = "Your Profile is Update";

                $notification_update = "UPDATE `notification_table` SET `display` = '$display', `title` = '$title', `description` = '$description' WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
                $notification_update_query = mysqli_query($connect, $notification_update);

                if ($update_query) {

                    echo "success";
                } else {
                    echo "failed";
                }
            }

            
            public function change_password($connect)
            {
                //$id = $_POST['processuser'];
                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                
                $select = "SELECT * FROM `new_project_table` WHERE user_id = '".$_SESSION['user_id']."'";
                $select_query = mysqli_query($connect, $select);
                $select_fetch = mysqli_fetch_array($select_query);
                
                if (!password_verify($old_password, $select_fetch['password'])) {
                    echo "old password not match";
                } 
                elseif ($new_password != $confirm_password) {
                    echo "new password and confirm password does not match";
                }
                else
                {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update = "UPDATE `new_project_table` SET password = '$hashed_password' WHERE user_id = '".$_SESSION['user_id']."'";
                    $update_query = mysqli_query($connect, $update);
                    if ($update_query) {
                        echo "Password updated successfully";
                    } else {
                        echo "Password update failed";
                    }
                }
            }

            public function process_bussiness_form($connect) {
                $banner_photo = $_FILES['banner_photo']['name'];
                $target_file = "uploads/$banner_photo";
                move_uploaded_file($_FILES['banner_photo']['tmp_name'], $target_file);
        
                $business_name = $_POST['business_name'];
                $service_name = $_POST['service_name'];
                $service_location = $_POST['service_location'];
                $business_owner_name = $_POST['business_owner_name'];
                $business_owner_number = $_POST['business_owner_number'];
                $business_email = $_POST['business_email'];
                $business_contact_number = $_POST['business_contact_number'];
                $business_whatsapp_number = $_POST['business_whatsapp_number'];
                $business_pan_number = $_POST['business_pan_number'];
                $business_gst_number = $_POST['business_gst_number'];
                $business_aadhar_number = $_POST['business_aadhar_number'];
                $business_cat_id = $_POST['business_cat_id'];
                $business_description = $_POST['business_description'];
                $describe_goal = json_encode($_POST['describe_goal']);
                $describe_service_type = json_encode($_POST['describe_service_type']);
                $tick_business_goal = json_encode($_POST['tick_business_goal']);
        
                $insert_query = "INSERT INTO business_profiles (
                    banner_photo, business_name, service_name, service_location, business_owner_name, 
                    business_owner_number, business_email, business_contact_number, business_whatsapp_number, 
                    business_pan_number, business_gst_number, business_aadhar_number, business_cat_id, 
                    business_description, describe_goal, describe_service_type, tick_business_goal
                ) VALUES (
                    '$banner_photo', '$business_name', '$service_name', '$service_location', '$business_owner_name', 
                    '$business_owner_number', '$business_email', '$business_contact_number', '$business_whatsapp_number', 
                    '$business_pan_number', '$business_gst_number', '$business_aadhar_number', '$business_cat_id', 
                    '$business_description', '$describe_goal', '$describe_service_type', '$tick_business_goal'
                )";
        
                $result = mysqli_query($connect, $insert_query);
        
                if ($result) {
                    echo 'Business profile added successfully';
                } else {
                    echo 'Failed to add business profile';
                }
            }


            // Notification ko read/unread mark karne ka function
            public function markNotificationReadUnread($connect, $notification_id, $read_status)
            {
                $user_id = $_SESSION['user_id'];
                $notification_id = intval($notification_id);
                $read_status = intval($read_status);

                $update_query = "UPDATE notification_table SET is_read = $read_status WHERE id = $notification_id AND user_id = '$user_id'";
                $result = mysqli_query($connect, $update_query);

                if ($result) {
                    return "success";
                } else {
                    return "error";
                }
            }

            // Pagination ke saath notifications fetch karne ka function
            public function fetchNotificationsWithPagination($connect, $page = 1, $limit = 5)
            {
                $user_id = $_SESSION['user_id'];
                $offset = ($page - 1) * $limit;

                $count_query = "SELECT COUNT(*) as total FROM notification_table WHERE user_id = '$user_id'";
                $count_res = mysqli_query($connect, $count_query);
                $total_notifications = mysqli_fetch_assoc($count_res)['total'];
                $total_pages = ceil($total_notifications / $limit);

                $query = "SELECT * FROM notification_table WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
                $result = mysqli_query($connect, $query);

                if (mysqli_num_rows($result) > 0) {
                    $html = '<ul class="list-group list-group-flush">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $read_class = $row['is_read'] == 1 ? 'text-muted' : 'fw-bold';
                        $mark_text = $row['is_read'] == 1 ? 'Mark as Unread' : 'Mark as Read';

                        $html .= '<li class="list-group-item">';
                        $html .= '<strong class="'.$read_class.'">'.htmlspecialchars($row['title'] ?? 'Notification').'</strong><br>';
                        $html .= '<span class="'.$read_class.'">'.htmlspecialchars($row['description'] ?? '').'</span><br>';
                        $html .= '<small class="text-muted">'.date('d M Y, h:i A', strtotime($row['created_at'])).'</small><br>';
                        $html .= '<button class="btn btn-sm btn-link mark-read-btn" data-id="'.$row['id'].'" data-status="'.($row['is_read'] == 1 ? 0 : 1).'">'.$mark_text.'</button>';
                        $html .= '</li>';
                    }
                    $html .= '</ul>';

                    // Pagination buttons
                    $html .= '<nav aria-label="Page navigation">';
                    $html .= '<ul class="pagination justify-content-center mt-3">';
                    for ($i=1; $i <= $total_pages; $i++) {
                        $active = $i == $page ? 'active' : '';
                        $html .= '<li class="page-item '.$active.'"><button class="page-link page-btn" data-page="'.$i.'">'.$i.'</button></li>';
                    }
                    $html .= '</ul>';
                    $html .= '</nav>';

                    return $html;
                } else {
                    return '<div class="alert alert-info">No notifications found.</div>';
                }
            }







            //  Add to Cart
            public function add_to_cart($connect) {
                if (empty($_SESSION['user_id'])) {
                    return "login_required";
                }

                $user_id = $_SESSION['user_id'];
                $cart_id = mt_rand(11111, 99999);
                $pro_id = intval($_POST['pro_id']);
                
                // Check if product already in cart
                $check = mysqli_query($connect, "SELECT * FROM my_cart WHERE user_id='$user_id' AND pro_id='$pro_id'");
                if (mysqli_num_rows($check) > 0) {
                    // Update quantity
                    mysqli_query($connect, "UPDATE my_cart SET quantity = quantity + 1 WHERE user_id='$user_id' AND pro_id='$pro_id'");
                } else {
                    // Get product price
                    $result = mysqli_query($connect, "SELECT selling_price FROM ec_products WHERE pro_id='$pro_id'");
                    $product = mysqli_fetch_assoc($result);
                    $total_pro_price = $product['selling_price'];

                    // Insert new cart row
                    mysqli_query($connect, "INSERT INTO my_cart (cart_id, user_id, pro_id, quantity, total_pro_price) VALUES ('$cart_id','$user_id', '$pro_id', '1', '$total_pro_price')");
                }

                return "success";
            }

            //  Remove item from cart
            public function remove_cart_item($connect) {
                $user_id = $_SESSION['user_id'];
                $pro_id = intval($_POST['pro_id']);

                mysqli_query($connect, "DELETE FROM my_cart WHERE user_id='$user_id' AND pro_id='$pro_id'");
                return "success";
            }

            //  Update quantity
            public function update_cart_quantity($connect) {
                $user_id = $_SESSION['user_id'];
                $pro_id = intval($_POST['pro_id']);
                $quantity = intval($_POST['quantity']);
                

                // Get product price
                $result = mysqli_query($connect, "SELECT selling_price FROM ec_products WHERE pro_id='$pro_id'");
                $product = mysqli_fetch_assoc($result);
                $total_pro_price = $product['selling_price'];

                $total_pro_price = $total_pro_price*$quantity;

                mysqli_query($connect, "UPDATE my_cart SET quantity='$quantity', total_pro_price='$total_pro_price' WHERE user_id='$user_id' AND pro_id='$pro_id'");
                return "success";
            }

            //  Fetch Cart Items
            public function get_user_cart($connect, $user_id) {
                $user_id = mysqli_real_escape_string($connect, $user_id);
                $sql = "SELECT my_cart.*, ec_products.*
                            FROM my_cart
                            JOIN ec_products ON my_cart.pro_id = ec_products.pro_id
                            WHERE my_cart.user_id = '$user_id'";
                $result = mysqli_query($connect, $sql);
                return $result;
            }

            // --- Optional: Get grand total ---
            public function getCartGrandTotal()
            {
                $grand_total = 0;
                if(!empty($_SESSION['cart'])) {
                    foreach($_SESSION['cart'] as $item) {
                        $grand_total += $item['cart_selling_price'] * $item['quantity'];
                    }
                }
                return $grand_total;
            }

            // --- Optional: Get cart count ---
            public function getCartCount()
            {
                return !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
            }

            public function contact_us($connect)
            {
            
                $name = mysqli_real_escape_string($connect,$_POST['name']);
                $email = mysqli_real_escape_string($connect,$_POST['email']);
                $subject = mysqli_real_escape_string($connect,$_POST['subject']);
                $message = mysqli_real_escape_string($connect,$_POST['message']);
                $created_at = date('M d, Y');


                

                $register_insert = "INSERT INTO `contact_us`(`name`,`email`,`subject`,`message`,`created_at`) VALUES('".$name."','".$email."','".$subject."','".$message."','".$created_at."')";

                $register_sql = mysqli_query($connect,$register_insert);
                
                if($register_sql)
                {
                    echo 1;
                }
                else
                {
                    //echo 0;
                    echo mysqli_error($connect);
                }
            }


        }






?>