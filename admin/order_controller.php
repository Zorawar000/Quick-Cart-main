<?php

// Controller to handle order actions (delete)
include_once("../db.php");
include_once("AdminFunctions.php");

// admin session check (db.php already calls session_start())
if (empty($_SESSION['admin_username'])) {
    echo "Unauthorized";
    exit();
}

$admin = new AdminFunctions();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'] ?? '';
    if ($admin->deleteOrder($connect, $order_id)) {
        echo 1; // success (matches frontend expectation)
    } else {
        echo "Failed to delete order.";
    }
    exit();
}

// You may add other order related POST actions here (update status, etc.)
?>