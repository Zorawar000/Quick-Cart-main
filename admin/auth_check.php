<?php
// session is started by including ../db.php from header.php

// Check if admin is logged in
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Optional: Check session timeout (30 minutes)
if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    // Session expired
    session_unset();
    session_destroy();
    header("Location: login.php?expired=1");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
