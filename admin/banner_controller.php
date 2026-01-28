<?php
include("../db.php");
include("AdminFunctions.php");

$admin = new AdminFunctions();

if (isset($_POST['add-banner'])) {
    $admin->addBanner($connect);
}
