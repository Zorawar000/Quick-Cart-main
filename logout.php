<?php

include('db.php');
include('new_project_class.php');

if (!empty($_SESSION['user_id'])) {
    $new_project = new new_project_work();
    $new_project->last_logout_update($connect); // No need to assign return value
}

// Clear all session variables
session_unset();

// Destroy session
session_destroy();

// Redirect to login
header("Location: login1.php");
exit();
?>
