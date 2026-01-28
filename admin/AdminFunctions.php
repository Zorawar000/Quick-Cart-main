<?php

class AdminFunctions
{
    // Add Category
    public function addCategory($connect)
    {
        //print_r($_POST);die;
        $cate_id = mt_rand(11111,99999);
        $cate_name = mysqli_real_escape_string($connect, $_POST['cate_name']);
        $meta_title = mysqli_real_escape_string($connect, $_POST['meta_title']);
        $meta_key = mysqli_real_escape_string($connect, $_POST['meta_key']);
        $meta_desc = mysqli_real_escape_string($connect, $_POST['meta_desc']);
        $status = mysqli_real_escape_string($connect, $_POST['status']);
        $added_on = date('M d, Y');
        $slug_url = $this->generateSlug($cate_name);

        $sql = "INSERT INTO `ec_categories`(`cate_id`,`cate_name`,`meta_title`,`meta_desc`,`meta_key`,`status`,`slug_url`,`added_on`) VALUES('".$cate_id."','".$cate_name."','".$meta_title."','".$meta_desc."','".$meta_key."','".$status."','".$slug_url."','".$added_on."')";
        $check = mysqli_query($connect,$sql);
        if ($check) {
            echo 1;
        } else {
            //echo "SQL Error: " . mysqli_error($connect);
            echo 0;
        }
    }

    // Add Sub-Category
    public function addSubCategory($connect)
    {
        //print_r($_POST);die;
        $cate_id = mt_rand(11111,99999);
        $cate_name = mysqli_real_escape_string($connect, $_POST['cate_name']);
        $parent_id = mysqli_real_escape_string($connect, $_POST['parent_id']);
        $meta_title = mysqli_real_escape_string($connect, $_POST['meta_title']);
        $meta_desc = mysqli_real_escape_string($connect, $_POST['meta_desc']);
        $meta_key = mysqli_real_escape_string($connect, $_POST['meta_key']);
        $status = mysqli_real_escape_string($connect, $_POST['status']);
        $added_on = date('M d, Y');
        $slug_url = $this->generateSlug($cate_name);

        $sql = "INSERT INTO `ec_sub_categories`(`cate_id`,`cate_name`,`parent_id`,`meta_title`,`meta_desc`,`meta_key`,`status`,`slug_url`,`added_on`) VALUES('".$cate_id."','".$cate_name."','".$parent_id."','".$meta_title."','".$meta_desc."','".$meta_key."','".$status."','".$slug_url."','".$added_on."')";
        $check = mysqli_query($connect, $sql);
        if ($check) {
            echo 1;
        } else {
            //echo "SQL Error: " . mysqli_error($connect);
            echo 0;
        }
    }

    // Add Product
    public function addProduct($connect)
    {
        $pro_id = mt_rand(11111, 99999);
        $pro_name = mysqli_real_escape_string($connect, $_POST['pro_name']);
        $pro_cate = mysqli_real_escape_string($connect, $_POST['pro_cate']);
        $pro_sub_cate = mysqli_real_escape_string($connect, $_POST['pro_sub_cate']);
        $pro_desc = mysqli_real_escape_string($connect, $_POST['pro_desc']);
        $stock = mysqli_real_escape_string($connect, $_POST['stock']);
        $mrp = mysqli_real_escape_string($connect, $_POST['mrp']);
        $selling_price = mysqli_real_escape_string($connect, $_POST['selling_price']);

        // File upload fix
        $file_name = '';
        if(isset($_FILES['pro_image']) && $_FILES['pro_image']['name'] != '') {
            $file_name = time().'_'.basename($_FILES['pro_image']['name']);
            $temp_name = $_FILES['pro_image']['tmp_name'];
            $destination = "../uploads/" . $file_name;
            move_uploaded_file($temp_name, $destination);
        }

        $meta_title = mysqli_real_escape_string($connect, $_POST['meta_title']);
        $meta_key = mysqli_real_escape_string($connect, $_POST['meta_key']);
        $meta_desc = mysqli_real_escape_string($connect, $_POST['meta_desc']);
        $status = mysqli_real_escape_string($connect, $_POST['status']);
        $added_on = date('M d, Y');
        $slug_url = $this->generateSlug($pro_name);

        $sql = "INSERT INTO `ec_products`(`pro_id`,`pro_name`,`pro_cate`,`pro_sub_cate`,`pro_desc`,`stock`,`mrp`,`selling_price`,`pro_image`,`meta_title`,`meta_desc`,`meta_key`,`slug_url`,`status`,`added_on`) 
                VALUES('$pro_id','$pro_name','$pro_cate','$pro_sub_cate','$pro_desc','$stock','$mrp','$selling_price','$file_name','$meta_title','$meta_desc','$meta_key','$slug_url','$status','$added_on')";

        $check = mysqli_query($connect, $sql);

        return $check; // true/false
    }

    // Fetch subcategories by parent category
    public function getSubCategoriesByParent($connect, $cate_id) 
    {
        $cate_id = mysqli_real_escape_string($connect, $cate_id);
        $sql = "SELECT * FROM ec_sub_categories WHERE parent_id='$cate_id'";
        $result = mysqli_query($connect, $sql);

        $options = '<option value="">--select--</option>';
        while($row = mysqli_fetch_assoc($result)) {
            $options .= '<option value="'.$row['cate_id'].'">'.ucwords($row['cate_name']).'</option>';
        }
        return $options;
    }



    // Admin Login
   public function adminLogin($connect)
    {
        $usernameOrEmail = mysqli_real_escape_string($connect,$_POST['username']);
        $password = $_POST['password'];
        $sql = "SELECT * FROM `admin_users` WHERE username = '".$usernameOrEmail."' OR email = '".$usernameOrEmail."'";
        $res = mysqli_query($connect, $sql);
        $numrow = mysqli_num_rows($res);
        if($numrow>0){
            $admin = mysqli_fetch_array($res);
            if(password_verify($password, $admin['password'])){
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_full_name'] = $admin['full_name'];
                mysqli_query($connect, "UPDATE admin_users SET last_login = NOW() WHERE admin_id='".$admin['admin_id']."'");
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            echo 0;
        }
    }    

    // Get Categories
    public function getCategories($connect)
    {
        $sql = "SELECT * FROM `ec_categories`";
        return mysqli_query($connect, $sql);
    }

    // Get Products
    public function getProducts($connect)
    {
        $sql = "SELECT * FROM `ec_products`";
        return mysqli_query($connect, $sql);
    }

    // Get Sub-Categories
    public function getSubCategories($connect)
    {
        $sql = "SELECT * FROM ec_sub_categories ORDER BY id DESC";
        return mysqli_query($connect, $sql);
    }

    // Slug Generator
    public function generateSlug($string)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return $slug;
    }

    // Change Password
    public function changePassword($connect)
    {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate passwords match
        if($new_password !== $confirm_password) {
            echo "New password and confirm password do not match!";
            exit();
        }
        
        // Validate password length
        if(strlen($new_password) < 6) {
            echo "Password must be at least 6 characters long!";
            exit();
        }
        
        // Get current admin data
        $admin_id = $_SESSION['admin_id'];
        $sql = "SELECT password FROM admin_users WHERE admin_id = '$admin_id'";
        $result = mysqli_query($connect, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            $admin = mysqli_fetch_assoc($result);
            
            // Verify current password
            if(password_verify($current_password, $admin['password'])) {
                // Hash new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                // Update password
                $update_sql = "UPDATE admin_users SET password = '$hashed_password', updated_at = NOW() WHERE admin_id = '$admin_id'";
                
                if(mysqli_query($connect, $update_sql)) {
                    echo "success";
                } else {
                    echo "Failed to update password!";
                }
            } else {
                echo "Current password is incorrect!";
            }
        } else {
            echo "Admin not found!";
        }
    }

    // Get Admin Profile
    public function getAdminProfile($connect)
    {
        $admin_id = $_SESSION['admin_id'];
        $sql = "SELECT * FROM admin_users WHERE admin_id = '$admin_id'";
        $result = mysqli_query($connect, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }


    
    // Count total products
    public function countProducts($connect){
        $query = mysqli_query($connect, "SELECT COUNT(*) AS total FROM ec_products");
        $row = mysqli_fetch_assoc($query);
        return $row['total'];
    }

    // Count total categories
    public function countCategories($connect){
        $query = mysqli_query($connect, "SELECT COUNT(*) AS total FROM ec_categories");
        $row = mysqli_fetch_assoc($query);
        return $row['total'];
    }

    // Count total subcategories
    public function countSubcategories($connect){
        $query = mysqli_query($connect, "SELECT COUNT(*) AS total FROM ec_sub_categories");
        $row = mysqli_fetch_assoc($query);
        return $row['total'];
    }

    // Count total orders
    public function countOrders($connect){
        $query = mysqli_query($connect, "SELECT COUNT(*) AS total FROM ec_orders");
        $row = mysqli_fetch_assoc($query);
        return $row ? (int)$row['total'] : 0;
    }

    // Delete Order (deletes order items then order) 
    public function deleteOrder($connect, $order_id)
    {
        $order_id = mysqli_real_escape_string($connect, $order_id);
        if (empty($order_id)) {
            return false;
        }

        // Start transaction
        if (function_exists('mysqli_begin_transaction')) {
            mysqli_begin_transaction($connect);
        }

        // Delete related order items first (if table exists)
        $q1 = "DELETE FROM `ec_order_items` WHERE `order_id` = '$order_id'";
        if (!mysqli_query($connect, $q1)) {
            if (function_exists('mysqli_rollback')) { mysqli_rollback($connect); }
            return false;
        }

        // Delete order
        $q2 = "DELETE FROM `ec_orders` WHERE `order_id` = '$order_id' LIMIT 1";
        if (!mysqli_query($connect, $q2)) {
            if (function_exists('mysqli_rollback')) { mysqli_rollback($connect); }
            return false;
        }

        // Commit
        if (function_exists('mysqli_commit')) {
            mysqli_commit($connect);
        }

        return true;
    }
    // Add Banner Type
    public function addBannerType($connect)
    {
        //print_r($_POST); die;

        $banner_type_id     = mt_rand(11111, 99999);
        $banner_type        = mysqli_real_escape_string($connect, $_POST['banner_type']);
        $page_name          = mysqli_real_escape_string($connect, $_POST['page_name']);
        $banner_positions   = mysqli_real_escape_string($connect, $_POST['banner_positions']);
        $banner_type_desc = mysqli_real_escape_string($connect, $_POST['banner_type_desc']);
        $status             = mysqli_real_escape_string($connect, $_POST['status']);

        $added_on           = date('Y-m-d H:i:s');
        $slug_url           = $this->generateSlug($banner_type);

        $sql = "INSERT INTO `ec_banner_types`(`banner_type_id`,`banner_type`,`page_name`,`banner_positions`,`banner_type_desc`,`status`,`banner_slug_url`,`added_on`)VALUES('".$banner_type_id."','".$banner_type."','".$page_name."','".$banner_positions."','".$banner_type_desc."','".$status."','".$slug_url."','".$added_on."')";

        $check = mysqli_query($connect, $sql);

        if ($check) {
            echo 1;
        } else {
            echo mysqli_error($connect); // debugging ke liye
        }
    }
    // Get Active Banner Types (for add-banner dropdown)
    public function getActiveBannerTypes($connect)
    {
        $sql = "SELECT banner_type_id,banner_type,page_name,banner_positions FROM ec_banner_types WHERE status = 1 ORDER BY id DESC";

        return mysqli_query($connect, $sql);
    }

    // Add Banner (Auto generated preview URL)
    public function addBanner($connect)
    {
        // ---------- Server-side validation ----------
        if (
            empty($_POST['banner_name']) ||
            empty($_POST['banner_type_id_ref']) ||
            empty($_POST['status'])
        ) {
            echo "Required fields missing";
            exit;
        }

        // ---------- Basic data ----------
        $banner_id      = mt_rand(11111, 99999);
        $banner_name    = mysqli_real_escape_string($connect, $_POST['banner_name']);
        $banner_type_id_ref = mysqli_real_escape_string($connect, $_POST['banner_type_id_ref']);
        $status         = mysqli_real_escape_string($connect, $_POST['status']);
        $added_on       = date('Y-m-d H:i:s');

        // ---------- Image upload ----------
        if (!isset($_FILES['banner_image']) || $_FILES['banner_image']['name'] == '') {
            echo "Please select banner image";
            exit;
        }

        $img_name = time() . '_' . basename($_FILES['banner_image']['name']);
        $tmp_name = $_FILES['banner_image']['tmp_name'];
        $uploadDir = "../uploads/";
        $path = $uploadDir . $img_name;

        if (!move_uploaded_file($tmp_name, $path)) {
            echo "Image upload failed";
            exit;
        }

        // ---------- Auto redirect URL ----------
        $today = date('Ymd');
        $redirect_url = "banner-view.php?bid=$banner_id&img=$img_name&d=$today";

        // ---------- Insert query ----------
        $sql = "INSERT INTO ec_banners
                (
                    banner_id,
                    banner_name,
                    banner_type_id_ref,
                    banner_image,
                    redirect_url,
                    status,
                    added_on
                )
                VALUES
                (
                    '$banner_id',
                    '$banner_name',
                    '$banner_type_id_ref',
                    '$img_name',
                    '$redirect_url',
                    '$status',
                    '$added_on'
                )";

        $check = mysqli_query($connect, $sql);

        if ($check) {
            echo 1;
        } else {
            echo mysqli_error($connect);
        }
    }

    // Get All Banners (List Page)
    public function getAllBanners($connect)
    {
        $sql = "SELECT                 
                b.id AS banner_b_id,
                b.banner_id,
                b.banner_name,
                b.banner_image,
                b.redirect_url,

                bt.id AS banner_t_id,
                bt.banner_type_id,
                bt.banner_type,
                bt.page_name,
                bt.banner_positions,
                bt.status AS type_status,
                bt.added_on AS type_added_on
                FROM ec_banners b
                LEFT JOIN ec_banner_types bt 
                    ON b.banner_type_id_ref = bt.banner_type_id
                ORDER BY b.id DESC";

        return mysqli_query($connect, $sql);
    }

}

?>