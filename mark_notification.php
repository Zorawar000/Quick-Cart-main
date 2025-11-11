<?php
include('db.php');

if (!isset($_SESSION['user_id'])) {
    echo "error";
    exit();
}

if (isset($_POST['id']) && isset($_POST['is_read'])) {
    $notification_id = intval($_POST['id']);
    $is_read = intval($_POST['is_read']);
    $user_id = $_SESSION['user_id'];

    $update_query = "UPDATE notification_table SET is_read = $is_read WHERE id = $notification_id AND user_id = '$user_id'";
    if (mysqli_query($connect, $update_query)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
