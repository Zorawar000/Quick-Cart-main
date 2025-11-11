<?php

// Clear all session variables
session_unset();

// Destroy all session data
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
