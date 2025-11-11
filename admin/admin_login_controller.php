<?php
include("../db.php");
include("AdminFunctions.php");

$admin = new AdminFunctions;

if(isset($_POST['processuser']))
{
    $admin_login = $admin->adminLogin($connect);
}
?>