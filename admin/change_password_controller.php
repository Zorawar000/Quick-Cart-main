<?php
include("../db.php");
include("AdminFunctions.php");

$admin = new AdminFunctions;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $admin_change_password = $admin->changePassword($connect);
}
?>
