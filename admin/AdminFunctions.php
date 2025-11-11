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
}

?>