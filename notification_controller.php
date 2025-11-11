<?php
include('db.php');
include('new_project_class.php');

if (empty($_SESSION['user_id'])) {
    echo "Please login first.";
    exit();
}

$obj = new new_project_work();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'mark_read') {
        $notification_id = $_POST['notification_id'];
        $read_status = $_POST['read_status'];
        echo $obj->markNotificationReadUnread($connect, $notification_id, $read_status);
        exit();
    }
    if ($_POST['action'] == 'fetch_notifications') {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        echo $obj->fetchNotificationsWithPagination($connect, $page);
        exit();
    }
}
?>
