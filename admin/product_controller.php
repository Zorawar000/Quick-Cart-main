<?php
include("../db.php");
include("AdminFunctions.php");

$admin = new AdminFunctions();

// Add product
if(isset($_POST['add-product'])) {
    $result = $admin->addProduct($connect);
    echo $result ? 1 : "Failed to add product!";
    exit;
}

// Fetch subcategories dynamically
if(isset($_POST['get_subcategories']) && !empty($_POST['cate_id'])) {
    $cate_id = $_POST['cate_id'];
    echo $admin->getSubCategoriesByParent($connect, $cate_id);
    exit;
}
