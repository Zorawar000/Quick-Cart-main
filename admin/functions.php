<?php
include("../db.php");
if(isset($_POST['add-categories'])){

    $cate_id = mt_rand(11111,99999);
    $cate_name = $_POST['cate_name'];
    $meta_title = $_POST['meta_title'];
    $meta_key = $_POST['meta_key'];
    $meta_desc = $_POST['meta_desc'];
    $status = $_POST['status'];
    $added_on = date('M d, Y');
    $slug_url = SlugUrl($cate_name);

    $sql = "INSERT INTO `ec_categories`(`cate_id`,`cate_name`,`meta_title`,`meta_desc`,`meta_key`,`slug_url`,`status`,`added_on`) VALUES('".$cate_id."','".$cate_name."','".$meta_title."','".$meta_desc."','".$meta_key."','".$slug_url."','".$status."','".$added_on."')";

    $check = mysqli_query($connect,$sql);

    if($check)
    {?>
        <script type="text/javascript">alert('Inserted Successfully'); window.location.href="view-categories.php";</script>

    <?php
    }


}

if(isset($_POST['add-sub-categories'])){

    $cate_id = mt_rand(11111,99999);
    $cate_name = $_POST['cate_name'];
    $meta_title = $_POST['meta_title'];
    $meta_key = $_POST['meta_key'];
    $meta_desc = $_POST['meta_desc'];
    $status = $_POST['status'];
    $added_on = date('M d, Y');
    $parent_id = $_POST['parent_id'];
    $slug_url = SlugUrl($cate_name);

    $sql = "INSERT INTO `ec_sub_categories`(`cate_id`,`parent_id`,`cate_name`,`meta_title`,`meta_desc`,`meta_key`,`slug_url`,`status`,`added_on`) VALUES('".$cate_id."','".$parent_id."','".$cate_name."','".$meta_title."','".$meta_desc."','".$meta_key."','".$slug_url."','".$status."','".$added_on."')";

    $check = mysqli_query($connect,$sql);

    if($check)
    {?>
        <script type="text/javascript">alert('Inserted Successfully'); window.location.href="view-sub-categories.php";</script>

    <?php
    }


}



if(isset($_POST['add-product'])){

    $pro_id = mt_rand(11111,99999);
    $pro_name = $_POST['pro_name'];
    $pro_cate = $_POST['pro_cate'];
    $pro_sub_cate = $_POST['pro_sub_cate'];
    $pro_desc = $_POST['pro_desc'];
    $stock = $_POST['stock'];
    $mrp = $_POST['mrp'];
    $selling_price = $_POST['selling_price'];

    $file_name = $_FILES['pro_image']['name'];
    $temp_name = $_FILES['pro_image']['tmp_name'];
    $destination = "../uploads/".$file_name;
    move_uploaded_file($temp_name,$destination);

    $meta_title = $_POST['meta_title'];
    $meta_key = $_POST['meta_key'];
    $meta_desc = $_POST['meta_desc'];
    $status = $_POST['status'];
    $added_on = date('M d, Y');
    $slug_url = SlugUrl($pro_name);

    $sql = "INSERT INTO `ec_products`(`pro_id`,`pro_name`,`pro_cate`,`pro_sub_cate`,`pro_desc`,`stock`,`mrp`,`selling_price`,`pro_image`,`meta_title`,`meta_desc`,`meta_key`,`slug_url`,`status`,`added_on`) VALUES('".$pro_id."','".$pro_name."','".$pro_cate."','".$pro_sub_cate."','".$pro_desc."','".$stock."','".$mrp."','".$selling_price."','".$file_name."','".$meta_title."','".$meta_desc."','".$meta_key."','".$slug_url."','".$status."','".$added_on."')";

    $check = mysqli_query($connect,$sql);

    if($check)
    {?>
        <script type="text/javascript">alert('Inserted Successfully'); /* window.location.href="view-sub-categories.php"; */</script>

    <?php
    }


}

function get_Categories(){
    
    include("../db.php");
    $sql = "SELECT *FROM `ec_categories`";
    $check = mysqli_query($connect,$sql);
    $sno = 1;

    while($result = mysqli_fetch_assoc($check)){
       echo $output = " <tr>
                        <td>".$sno++."</td>
                        <td>".$result['cate_id']."</td>
                        <td>".$result['cate_name']."</td>
                        <td>".$result['slug_url']."</td>
                        <td>".$result['status']."</td>
                        <td>".$result['added_on']."</td>
                    </tr>";
    }
}


function get_Sub_Categories(){
    
include("../db.php");
    $sql = "SELECT *FROM `ec_sub_categories`";
    $check = mysqli_query($connect,$sql);
    $sno = 1;

    while($result = mysqli_fetch_assoc($check)){
        $parent_id = $result['parent_id'];
    $sql2 = "SELECT cate_name FROM `ec_categories` WHERE cate_id = $parent_id";
    $check2 = mysqli_query($connect,$sql2);
    $parent = mysqli_fetch_assoc($check2);
       echo $output = " <tr>
                        <td>".$sno++."</td>
                        <td>".$result['cate_id']."</td>
                        <td>".$result['cate_name']."</td>
                        <td>".$parent['cate_name']."</td>
                        <td>".$result['slug_url']."</td>
                        <td>".$result['status']."</td>
                        <td>".$result['added_on']."</td>
                    </tr>";
    }
}
/* echo get_Categories(); */

function SlugUrl($string){
    $slug = trim($string); // trim the string

    $slug = preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); //only take alphanumerical characters, but keep the spaces and dashes to.......

    $slug = str_replace(' ','-',$slug); //replace spaces by dashes

    $slug = strtolower($slug); // make it lower case

    return $slug;
}


if(isset($_POST['cate_id'])){

    include("../db.php");
    $cate_id = $_POST['cate_id'];
    $sql = "SELECT *FROM `ec_sub_categories` WHERE parent_id = $cate_id";
    $check = mysqli_query($connect,$sql);
    
    ?>
    
    <option value="">--select--</option>
    
    <?php
   while($result = mysqli_fetch_assoc($check)){
       echo "<option value=".$result['cate_id'].">".$result['cate_name']."</option>";
   }
    //print_r($result);
}

?>